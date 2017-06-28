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
use Illuminate\Database\Capsule\Manager as Capsule;
use Http\Exception as HttpException;
use Illuminate\Database\QueryException;
use Upload\File as UploadFile;
use Upload\Storage\FileSystem;
use Upload\Validation\Mimetype as UploadMimeType;
use Upload\Validation\Size as UploadSize;
use Upload\Exception\UploadException;
use Exception;
use PersonnelModel;
use PersonnelTypeModel;

class Personnel extends Back
{
    const IMAGE_PATH = 'uploads/images/personnel';

    /**
     * Добавления материалов
     */
    public function anyAdd()
    {
        // ID команди
        $id = (int)$this->getRequestParam('id') ?: null;

        if (Arr::get($this->getPostData(), 'submit') !== null) {

//            $data = Arr::extract($this->getPostData(), ['slug', 'first_name', 'last_name', 'middle_name', 'sort', 'personnel_type', 'was_born', 'status', 'content', 'image']);
            $data = Arr::extract($this->getPostData(), ['slug', 'first_name', 'last_name', 'middle_name', 'sort', 'was_born', 'status', 'content', 'image']);

            try {
                // Транзакция для Записание данных в базу
                Capsule::connection()->transaction(function () use ($data, $id) {
                    // Загрузка картинки
                    $file = new UploadFile('image', new FileSystem(static::IMAGE_PATH));

                    // Optionally you can rename the file on upload
                    $file->setName(uniqid());

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

                    $middleNameEntity = EntityModel::create([
                        'text' => $data['middle_name'],
                        'is_bound' => 1, // Указивает привязку, стоб не показивал в мести с обычними словами переводов
                    ]);

                    $newArticle = ArticleModel::create([
                        'slug' => PersonnelModel::SLUG  .'/'. uniqid(),
                        'status' => $data['status'],
                    ]);

                    $parent = ArticleModel::whereSlug(PersonnelModel::SLUG)->first();

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

                            // Add Last Name Translations
                            EntityTranslationModel::create([
                                'text' => $item['last_name'],
                                'lang_id' => $lang_id,
                                'entity_id' => $lastNameEntity->id,
                            ]);

                            // Add Last Name Translations
                            EntityTranslationModel::create([
                                'text' => $item['middle_name'],
                                'lang_id' => $lang_id,
                                'entity_id' => $middleNameEntity->id,
                            ]);

                            // Add Articles With Translations
                            $fullName = $item['first_name'] .' '. $item['last_name'] .' '. $item['middle_name'];
                        }else{
                            $fullName = $data['first_name'] .' '. $data['last_name'] .' '. $data['middle_name'];
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

                    PersonnelModel::create([
                        'personnel_type_id' => $id,
                        'sort' => $data['sort'],
                        'was_born' => $data['was_born'],
                        'status' => $data['status'],
                        'photo_id' => $imageId,
                        'first_name_id' => $firstNameEntity->id,
                        'last_name_id' => $lastNameEntity->id,
                        'middle_name_id' => $middleNameEntity->id,
                        'article_id' => $newArticle->id,
                    ]);
                });

                Message::instance()->success('Personnel has successfully added');

            } catch (Exception $e) {
                Message::instance()->warning('Personnel has don\'t added');
            }
        }

        $this->layout->content = View::make('back/personnel/add');
    }

    /**
     * Редактирование
     */
    public function anyEdit()
    {
        // ID персонала
        $id = (int) $this->getRequestParam('id') ?: null;

        $model = PersonnelModel::find($id);

        if (empty($model)) {
            throw new HttpException(404,json_encode(['errorMessage' => 'Incorrect Personnel']));
        }

        $firstNameModel = $model->firstNameModel()->first();
        $lastNameModel = $model->lastNameModel()->first();
        $middleNameModel = $model->middleNameModel()->first();

        if (Arr::get($this->getPostData(), 'submit') !== null) {

            $data = Arr::extract($this->getPostData(), ['slug', 'personnel_type', 'first_name', 'last_name', 'middle_name', 'sort', 'was_born', 'status', 'content', 'image']);

            // Транзакция для Записание данных в базу
            try {
                Capsule::connection()->transaction(function () use ($data, $model, $firstNameModel, $lastNameModel, $middleNameModel) {
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

                    $firstNameModel = EntityModel::updateOrCreate(
                        ['id' => $firstNameModel->id,],
                        ['text' => $data['first_name'],
                        ]);
                    $lastNameModel = EntityModel::updateOrCreate(
                        ['id' => $lastNameModel->id,],
                        ['text' => $data['last_name'],
                        ]);
                    $middleNameModel = EntityModel::updateOrCreate(
                        ['id' => $middleNameModel->id,],
                        ['text' => $data['last_name'],
                        ]);

                    $newArticle = ArticleModel::updateOrCreate(
                        [
                            'id' => ($model->article()) ? $model->article()->id : null,
                        ],
                        [
                            'slug' => PersonnelModel::SLUG  .'/'. uniqid(),
                            'status' => $data['status'],
                        ]
                    );
                    foreach ($data['content'] as $iso => $d) {
                        $lang_id = Lang::instance()->getLang($iso)['id'];

                        if(Lang::DEFAULT_LANGUAGE != $iso)
                        {
                            EntityTranslationModel::updateOrCreate(['id' => $d['first_name_id']], ['text' => $d['first_name'], 'lang_id' => $lang_id, 'entity_id' => $firstNameModel->id]);
                            EntityTranslationModel::updateOrCreate(['id' => $d['last_name_id']], ['text' => $d['last_name'], 'lang_id' => $lang_id, 'entity_id' => $lastNameModel->id]);
                            EntityTranslationModel::updateOrCreate(['id' => $d['middle_name_id']], ['text' => $d['middle_name'], 'lang_id' => $lang_id, 'entity_id' => $middleNameModel->id]);

                            $fullName = $d['first_name'] .' '. $d['last_name'] .' '. $d['middle_name'];
                        }else{
                            $fullName = $data['first_name'] .' '. $data['last_name'] .' '. $data['middle_name'];
                        }

                        $parent = ArticleModel::whereSlug(PersonnelModel::SLUG)->first();

                        $newArticle->makeChildOf($parent);

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
                        'personnel_type_id' => $data['personnel_type'],
                        'slug' => $data['slug'],
                        'sort' => $data['sort'],
                        'was_born' => $data['was_born'],
                        'status' => $data['status'],
                        'first_name_id' => $firstNameModel->id,
                        'last_name_id' => $lastNameModel->id,
                        'middle_name_id' => $middleNameModel->id,
                        'article_id' => $newArticle->id,
                    ]);
                });
                Message::instance()->success('Personnel was successfully saved');
            } catch (Exception $e) {
                Message::instance()->warning('Personnel was don\'t saved');
            }
        }

        $model = PersonnelModel::find($id);
        $firstNameModel = $model->firstNameModel()->first();
        $lastNameModel = $model->lastNameModel()->first();
        $middleNameModel = $model->middleNameModel()->first();
        $articleModel = $model->article();

        // Загрузка контента для каждово языка
        $contents = [];
        foreach(Lang::instance()->getLangs() as $iso => $lang){
            $contents[$iso]['firstName'] = $firstNameModel->translations()->whereLang_id($lang['id'])->first();
            $contents[$iso]['lastName'] = $lastNameModel->translations()->whereLang_id($lang['id'])->first();
            $contents[$iso]['middleName'] = $middleNameModel->translations()->whereLang_id($lang['id'])->first();
            $contents[$iso]['content'] = ($model->article()) ? $articleModel->contents()->whereLang_id($lang['id'])->first() : null;
        }

        $this->layout->content = View::make('back/personnel/edit')
            ->with('item', $model)
            ->with('contents', $contents);
    }

    public function getList(){

        $id = (int) $this->getRequestParam('id') ?: null;

        $items = PersonnelModel::wherePersonnel_type_id($id)->get();

        $this->layout->content = View::make('back/personnel/list')
            ->with('id', $id)
            ->with('items', $items);
    }

    public function getDelete()
    {
        $this->layout = false;

        $id = (int)$this->getRequestParam('id') ?: null;

        $model = PersonnelModel::find($id);

        if (empty($model)) {
            throw new HttpException(404, json_encode(['errorMessage' => 'Incorrect Article']));
        }

        // Транзакция для Записание данных в базу
        Capsule::connection()->transaction(function () use ($model) {

            $model->delete();
            $model->article()->delete();
        });

        Message::instance()->success('Personnel has successfully deleted');
        Uri::to('/Admin');
    }
}