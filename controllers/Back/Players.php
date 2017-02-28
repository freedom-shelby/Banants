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

        if (Arr::get($this->getPostData(), 'submit') !== null) {

            $data = Arr::extract($this->getPostData(), ['slug', 'first_name', 'last_name', 'position', 'country', 'was_born', 'number', 'height', 'weight', 'status', 'content', 'image']);

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
                        $imageId = null;

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

                    $lastNameEntity = EntityModel::create([
                        'text' => $data['last_name'],
                        'is_bound' => 1, // Указивает привязку, стоб не показивал в мести с обычними словами переводов
                    ]);

                    $newArticle = ArticleModel::create([
                        'slug' => 'players/'.uniqid(),
                        'status' => $data['status'],
                    ]);
//
                    $parent = ArticleModel::whereSlug(PlayerModel::SLUG)->first();

                    $newArticle->makeChildOf($parent);

                    foreach($data['content'] as $iso => $item){
                        $lang_id = Lang::instance()->getLang($iso)['id'];

                        if(Lang::DEFAULT_LANGUAGE != $iso)
                        {
                            // Add First Name Translations
                            EntityTranslationModel::create([
                                'text' => $item['first_name'],
                                'lang_id' => $lang_id,
                                'entity_id' => $firstNameEntity->id,
                            ]);
//
                            // Add Last Name Translations
                            EntityTranslationModel::create([
                                'text' => $item['last_name'],
                                'lang_id' => $lang_id,
                                'entity_id' => $lastNameEntity->id,
                            ]);

                            // Add Articles With Translations
                            $fullName = $item['first_name'] .' '. $item['last_name'];
                        }else{
                            $fullName = $data['first_name'] .' '. $data['last_name'];
                        }

                        $content = ContentModel::create([
                            'title' => $fullName,
                            'crumb' => $fullName,
                            'desc' => $item['desc'],
                            'meta_title' => $fullName,
                            'meta_desc' => $fullName,
                            'meta_keys' => $fullName,
                            'lang_id' => $lang_id,
                        ]);
                        $newArticle->contents()->attach($content);
                    }

                    Event::fire('Admin.entitiesUpdate');

                    PlayerModel::create([
                        'team_id' => $id,
                        'country_id' => $data['country'],
                        'position_id' => $data['position'],
//                        'slug' => $data['slug'],
                        'number' => $data['number'],
                        'height' => $data['height'],
                        'weight' => $data['weight'],
                        'was_born' => $data['was_born'],
                        'status' => $data['status'],
                        'photo_id' => $imageId,
                        'first_name_id' => $firstNameEntity->id,
                        'last_name_id' => $lastNameEntity->id,
                        'article_id' => $newArticle->id,
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

        if (empty($model)) {
            throw new HttpException(404,json_encode(['errorMessage' => 'Incorrect Player']));
        }

        $firstNameModel = $model->firstNameModel()->first();
        $lastNameModel = $model->lastNameModel()->first();

        if (Arr::get($this->getPostData(),'submit') !== null) {

            $data = Arr::extract($this->getPostData(), ['slug', 'image', 'country', 'was_born', 'position', 'status', 'number', 'height', 'weight', 'team', 'first_name', 'last_name', 'content']);

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

                    $newArticle = ArticleModel::updateOrCreate(
                        [
                            'id' => ($model->article()) ? $model->article()->id : null,
                        ],
                        [
                            'slug' => 'players/'.uniqid(),
                            'status' => $data['status'],
                        ]
                    );
                    foreach ($data['content'] as $iso => $d) {
                        $lang_id = Lang::instance()->getLang($iso)['id'];

                        if(Lang::DEFAULT_LANGUAGE != $iso)
                        {
                            EntityTranslationModel::updateOrCreate(['id' => $d['first_name_id']], ['text' => $d['first_name'], 'lang_id' => $lang_id, 'entity_id' => $firstNameModel->id]);
                            EntityTranslationModel::updateOrCreate(['id' => $d['last_name_id']], ['text' => $d['last_name'], 'lang_id' => $lang_id, 'entity_id' => $lastNameModel->id]);

                            $fullName = $d['first_name'] .' '. $d['last_name'];
                        }else{
                            $fullName = $data['first_name'] .' '. $data['last_name'];
                        }

                        $parent = ArticleModel::whereSlug(PlayerModel::SLUG)->first();

                        $newArticle->makeChildOf($parent);
//echo "<pre>";
//var_dump($d['content_id']);
//echo "</pre>";
//die;
                        $contentModel = ContentModel::updateOrCreate(
                            [
                                'id' => $d['content_id'] ?: null
                            ],
                            [
                                'article_id' => $newArticle->id,
                                'title' => $fullName,
                                'crumb' => $fullName,
                                'desc' => $d['desc'],
                                'meta_title' => $fullName,
                                'meta_desc' => $fullName,
                                'meta_keys' => $fullName,
                                'lang_id' => $lang_id,
                            ]
                        );

                        // Приклепляет много ко многим связ (syncWithoutDetaching)
                        $newArticle->contents()->sync([$contentModel->id], false);
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
                        'height' => $data['height'],
                        'weight' => $data['weight'],
                        'was_born' => $data['was_born'],
                        'status' => $data['status'],
                        'country_id' => $data['country'],
                        'position_id' => $data['position'],
                        'first_name_id' => $firstNameModel->id,
                        'last_name_id' => $lastNameModel->id,
                        'article_id' => $newArticle->id,
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
        $articleModel = $model->article();

        // Загрузка контента для каждово языка
        $contents = [];
        foreach(Lang::instance()->getLangs() as $iso => $lang){
            $contents[$iso]['firstName'] = $firstNameModel->translations()->whereLang_id($lang['id'])->first();
            $contents[$iso]['lastName'] = $lastNameModel->translations()->whereLang_id($lang['id'])->first();
            $contents[$iso]['content'] = ($model->article()) ? $articleModel->contents()->whereLang_id($lang['id'])->first() : null;
        }

        $this->layout->content = View::make('back/players/edit')
            ->with('item', $model)
            ->with('contents', $contents);
    }

    public function getDelete()
    {
        $this->layout = false;

        $id = (int)$this->getRequestParam('id') ?: null;

        $model = PlayerModel::find($id);

        if (empty($model)) {
            throw new HttpException(404, json_encode(['errorMessage' => 'Incorrect Article']));
        }

        // Транзакция для Записание данных в базу
        Capsule::connection()->transaction(function () use ($model) {

            $model->article()->delete();
            $model->delete();
        });

        Message::instance()->success('Player has successfully deleted');
        Uri::to('/Admin');
    }
}