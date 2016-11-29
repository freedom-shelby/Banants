<?php
/**
 * Created by PhpStorm.
 * User: Suren
 * Date: 11/19/2015
 * Time: 3:16 PM
 */

namespace Back;
restrictAccess();


use Event;
use Helpers\Uri;
use View;
use Message;
use Lang\Lang;
use Helpers\Arr;
use Illuminate\Contracts\Validation;
use ArticleModel;
use ContentModel;
use EntityModel;
use EntityTranslationModel;
use PhotoModel;
use PlayerModel;
use Illuminate\Database\Capsule\Manager as Capsule;
use Http\Exception as HttpException;
use Illuminate\Database\QueryException;
use Upload\File as UploadFile;
use Upload\Storage\FileSystem;
use Upload\Validation\Mimetype as UploadMimeType;
use Upload\Validation\Size as UploadSize;
use Upload\Exception\UploadException;
use Exception;

class Players extends Back
{
    const IMAGE_PATH = 'uploads/images/players';

    /**
     * Добавления материалов
     */
    public function anyAdd()
    {
        // ID команди
        $id = (int)$this->getRequestParam('id') ?: null;

//        $articles = new ArticleModel();

        if (Arr::get($this->getPostData(), 'submit') !== null) {

            $data = Arr::extract($this->getPostData(), ['slug', 'first_name', 'last_name', 'position', 'country', 'number', 'status', 'content', 'image']);

            try {
                // Транзакция для Записание данных в базу
                Capsule::connection()->transaction(function () use ($data, $id) {
                    // Загрузка картинки
                    $file = new UploadFile('image', new FileSystem(static::IMAGE_PATH)); // todo: Avelacnel tmi annun@

                    // Optionally you can rename the file on upload
                    $file->setName(uniqid());

//                    // Validate file upload
//                    $file->addValidations(array(
//                        // Ensure file is of type image
//                        new UploadMimeType(['image/png', 'image/jpg', 'image/gif']),
//
//                        // Ensure file is no larger than 5M (use "B", "K", M", or "G")
//                        new UploadSize('50M')
//                    ));

                    // Try to upload file
                    try {
                        // Success!
                        $file->upload();
                        $image = '/' . static::IMAGE_PATH . '/' . $file->getNameWithExtension();
                    } catch (UploadException $e) {
                        // Fail!
                        $image = null;
                        Message::instance()->warning($file->getErrors());
                    } catch (Exception $e) {
                        // Fail!
                        $image = null;
                        Message::instance()->warning($file->getErrors());
                    }
                    if($image) {
                        $imageId = PhotoModel::create([
                            'path' => $image,
                            'is_bound' => 1, // Указивает привязку, стоб не показивал в мести с обычними словами переводов
                        ])->id;
                    }

                    $firstNameEntity = EntityModel::create([
                        'text' => $data['first_name'],
                        'is_bound' => 1, // Указивает привязку, стоб не показивал в мести с обычними словами переводов
                    ]);

                    foreach ($data['content'] as $iso => $item) {
                        $lang_id = Lang::instance()->getLang($iso)['id'];
                        EntityTranslationModel::create([
                            'text' => $item['first_name'],
                            'lang_id' => $lang_id,
                            'entity_id' => $firstNameEntity->id,
                        ]);
                    }

                    $lastNameEntity = EntityModel::create([
                        'text' => $data['last_name'],
                        'is_bound' => 1, // Указивает привязку, стоб не показивал в мести с обычними словами переводов
                    ]);

                    foreach ($data['content'] as $iso => $item) {
                        $lang_id = Lang::instance()->getLang($iso)['id'];
                        EntityTranslationModel::create([
                            'text' => $item['last_name'],
                            'lang_id' => $lang_id,
                            'entity_id' => $lastNameEntity->id,
                        ]);
                    }

                    Event::fire('Admin.entitiesUpdate');

                    PlayerModel::create([
                        'team_id' => $id,
                        'country_id' => $data['country'],
                        'position_id' => $data['position'],
                        'slug' => $data['slug'],
                        'number' => $data['number'],
                        'status' => $data['status'],
                        'photo_id' => $imageId,
                        'first_name_id' => $firstNameEntity->id,
                        'last_name_id' => $lastNameEntity->id,
                    ]);
                });

                Message::instance()->success('Player has successfully added');

            } catch (Exception $e) {
                Message::instance()->warning('Player has don\'t added');
            }
        }

        $this->layout->content = View::make('back/players/add');
    }

    /**
     * Редактирование
     */
    public function anyEdit()
    {
        $id = (int) $this->getRequestParam('id') ?: null;

        $model = PlayerModel::find($id);
        $firstNameModel = $model->firstNameModel()->first();
        $lastNameModel = $model->lastNameModel()->first();

        if (empty($model)) {
            throw new HttpException(404,json_encode(['errorMessage' => 'Incorrect Player']));
        }

        if (Arr::get($this->getPostData(),'submit') !== null) {

            $data = Arr::extract($this->getPostData(), ['slug', 'image', 'country', 'position', 'status', 'number', 'team', 'first_name', 'last_name', 'content']);

            // Транзакция для Записание данных в базу
            try {
                Capsule::connection()->transaction(function () use ($data, $model, $firstNameModel, $lastNameModel) {
                    // Загрузка картинки

                    $file = new UploadFile('image', new FileSystem(static::IMAGE_PATH));

                    // Optionally you can rename the file on upload
                    $file->setName(uniqid());

//                    // Validate file upload
//                    $file->addValidations(array(
//                        // Ensure file is of type image
//                        new UploadMimeType(['image/png','image/jpg','image/gif']),
//
//                        // Ensure file is no larger than 5M (use "B", "K", M", or "G")
//                        new UploadSize('50M')
//                    ));

                    // Try to upload file
                    try {
                        // Success!
                        $file->upload();
                        $image = '/' . static::IMAGE_PATH . '/' . $file->getNameWithExtension();
                    } catch (UploadException $e) {
                        // Fail!
                        $image = null;
                        Message::instance()->warning($file->getErrors());
                    } catch (Exception $e) {
                        // Fail!
                        $image = null;
                        Message::instance()->warning($file->getErrors());
                    }

                    $firstNameModel = EntityModel::updateOrCreate(
                        ['id' => $firstNameModel->id,],
                        ['text' => $data['first_name'],
                    ]);
                    $lastNameModel = EntityModel::updateOrCreate(
                        ['id' => $lastNameModel->id,],
                        ['text' => $data['last_name'],
                    ]);

                    foreach ($data['content'] as $iso => $d) {
                        $lang_id = Lang::instance()->getLang($iso)['id'];

                        EntityTranslationModel::updateOrCreate(['id' => $d['first_name_id']], ['text' => $d['first_name'], 'lang_id' => $lang_id, 'entity_id' => $firstNameModel->id]);
                        EntityTranslationModel::updateOrCreate(['id' => $d['last_name_id']], ['text' => $d['last_name'], 'lang_id' => $lang_id, 'entity_id' => $lastNameModel->id]);
                    }

                    Event::fire('Admin.entitiesUpdate');

                    // если нету нового изображения оставить прежний
                    if($image){
                        $imageId = PhotoModel::create([
                            'path' => $image,
                            'is_bound' => 1, // Указивает привязку, стоб не показивал в мести с обычними словами переводов
                        ])->id;
                        $model->update([
                            'photo_id' => $imageId,
                        ]);
                    }

                    $model->update([
                        'team_id' => $data['team'],
                        'slug' => $data['slug'],
                        'number' => $data['number'],
                        'status' => $data['status'],
                        'country_id' => $data['country'],
                        'position_id' => $data['position'],
                        'first_name_id' => $firstNameModel->id,
                        'last_name_id' => $lastNameModel->id,
                    ]);
                });
                Message::instance()->success('Player was successfully saved');
            } catch (Exception $e) {
                Message::instance()->warning('Player was don\'t saved');
            }
        }

        $model = PlayerModel::find($id);
        $firstNameModel = $model->firstNameModel()->first();
        $lastNameModel = $model->lastNameModel()->first();

        // Загрузка контента для каждово языка
        $contents = [];
        foreach(Lang::instance()->getLangsExcept(Lang::DEFAULT_LANGUAGE) as $iso => $lang){
            $contents[$iso]['firstName'] = $firstNameModel->translations()->whereLang_id($lang['id'])->first();
            $contents[$iso]['lastName'] = $lastNameModel->translations()->whereLang_id($lang['id'])->first();
        }
//echo "<pre>";
//print_r($contents);
//die;
        $this->layout->content = View::make('back/players/edit')
            ->with('item', $model)
            ->with('contents', $contents);
    }

    public function getDelete()
    {
        $this->layout = false;

        $id = (int)$this->getRequestParam('id') ?: null;

        $article = ArticleModel::find($id);

        if (empty($article)) {
            throw new HttpException(404, json_encode(['errorMessage' => 'Incorrect Article']));
        }

        // Транзакция для Записание данных в базу
        Capsule::connection()->transaction(function () use ($article) {

            // Заодно удаляет и пункты меню привязанные к slug-у
            (new \MenuItemModel)->whereSlug($article->slug)->delete();

            foreach ($article->getDescendantsAndSelf() as $desc) {
                $desc->contents()->delete();
            }
            $article->delete();
        });

        Message::instance()->success('Player has successfully deleted');
        Uri::to('/Admin/Categories');
    }
}