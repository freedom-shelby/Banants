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
use LeagueModel;
use Illuminate\Database\Capsule\Manager as Capsule;
use Http\Exception as HttpException;
use Illuminate\Database\QueryException;
use Upload\File as UploadFile;
use Upload\Storage\FileSystem;
use Upload\Validation\Mimetype as UploadMimeType;
use Upload\Validation\Size as UploadSize;
use Upload\Exception\UploadException;
use Exception;

class Leagues extends Back
{
    const IMAGE_PATH = 'uploads/images/football/league';

    /**
     * Добавления материалов
     */
    public function anyAdd()
    {
        if (Arr::get($this->getPostData(), 'submit') !== null) {

            $data = Arr::extract($this->getPostData(), ['slug', 'entity', 'country', 'status', 'content', 'image']);

            try {
                // Транзакция для Записание данных в базу
                Capsule::connection()->transaction(function () use ($data) {
                    // Загрузка картинки
                    $file = new UploadFile('image', new FileSystem(static::IMAGE_PATH));

                    // Optionally you can rename the file on upload
                    $file->setName(uniqid());

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

                    $entity = EntityModel::create([
                        'text' => $data['entity'],
                        'is_bound' => 1, // Указивает привязку, стоб не показивал в мести с обычними словами переводов
                    ]);

                    foreach ($data['content'] as $iso => $item) {
                        $lang_id = Lang::instance()->getLang($iso)['id'];
                        EntityTranslationModel::create([
                            'text' => $item['text'],
                            'lang_id' => $lang_id,
                            'entity_id' => $entity->id,
                        ]);
                    }

                    Event::fire('Admin.entitiesUpdate');

                    LeagueModel::create([
                        'country_id' => $data['country'],
                        'slug' => $data['slug'],
                        'status' => $data['status'],
                        'photo_id' => $imageId,
                        'entity_id' => $entity->id,
                    ]);
                });

                Message::instance()->success('League has successfully added');

            } catch (Exception $e) {
                Message::instance()->warning('League has don\'t added');
            }
        }

        $this->layout->content = View::make('back/leagues/add');
    }

    /**
     * Редактирование
     */
    public function anyEdit()
    {
        $id = (int) $this->getRequestParam('id') ?: null;

        $model = LeagueModel::find($id);
        $entityModel = $model->entity()->first();

        if (empty($model)) {
            throw new HttpException(404,json_encode(['errorMessage' => 'Incorrect League']));
        }

        if (Arr::get($this->getPostData(),'submit') !== null) {

            $data = Arr::extract($this->getPostData(), ['slug', 'image', 'country', 'status', 'entity', 'content']);

            // Транзакция для Записание данных в базу
            try {
                Capsule::connection()->transaction(function () use ($data, $model, $entityModel) {
                    // Загрузка картинки

                    $file = new UploadFile('image', new FileSystem(static::IMAGE_PATH));

                    // Optionally you can rename the file on upload
                    $file->setName(uniqid());

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

                    $entityModel->updateOrCreate(
                        ['id' => $entityModel->id,],
                        ['text' => $data['entity'],
                    ]);

                    foreach ($data['content'] as $iso => $d) {
                        $langId = Lang::instance()->getLang($iso)['id'];

                        EntityTranslationModel::updateOrCreate(['id' => $d['id']], ['text' => $d['text'], 'lang_id' => $langId, 'entity_id' => $entityModel->id]);
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
                        'slug' => $data['slug'],
                        'status' => $data['status'],
                        'country_id' => $data['country'],
                        'entity_id' => $entityModel->id,
                    ]);
                });
                Message::instance()->success('League was successfully saved');
            } catch (Exception $e) {
                Message::instance()->warning('League was don\'t saved');
            }
        }

        $model = LeagueModel::find($id);
        $entityModel = $model->entity()->first();

        // Загрузка контента для каждово языка
        $contents = [];
        foreach(Lang::instance()->getLangsExcept(Lang::DEFAULT_LANGUAGE) as $iso => $lang){
            $contents[$iso] = $entityModel->translations()->whereLang_id($lang['id'])->first();
        }

        $this->layout->content = View::make('back/leagues/edit')
            ->with('item', $model)
            ->with('contents', $contents);
    }

    public function getList()
    {
        $items = LeagueModel::all();

        $this->layout->content = View::make('back/leagues/list')
            ->with('items', $items);
    }

    public function getDelete()
    {
        $this->layout = false;

        $id = (int)$this->getRequestParam('id') ?: null;

        $model = LeagueModel::find($id);

        if (empty($model)) {
            throw new HttpException(404, json_encode(['errorMessage' => 'Incorrect League']));
        }

        // Транзакция для Записание данных в базу
        Capsule::connection()->transaction(function () use ($model)
        {
            $model->delete();
        });

        Message::instance()->success('League has successfully deleted');
        Uri::to('/Admin/Leagues/List');
    }
}