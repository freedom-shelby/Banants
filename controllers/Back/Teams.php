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
use PlayerModel;
use ContentModel;
use EntityModel;
use EntityTranslationModel;
use PhotoModel;
use TeamModel;
use ArticleModel;
use ArticleHasOnlySelfWidgetModel;
use Illuminate\Database\Capsule\Manager as Capsule;
use Http\Exception as HttpException;
use Illuminate\Database\QueryException;
use Upload\File as UploadFile;
use Upload\Storage\FileSystem;
use Upload\Validation\Mimetype as UploadMimeType;
use Upload\Validation\Size as UploadSize;
use Upload\Exception\UploadException;
use Exception;
use Setting;

class Teams extends Back
{

    const IMAGE_PATH = 'uploads/images/football/team';

    /**
     * Добавления материалов
     */
    public function anyAdd()
    {
//        echo "<pre>";
//        print_r($this->getPostData());
//        die;
        if (Arr::get($this->getPostData(), 'submit') !== null) {

            $data = Arr::extract($this->getPostData(), ['slug', 'entity', 'formation', 'league', 'article', 'status', 'is_own', 'content', 'image']);

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

                    $imageId = 1;

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

                    // Если приклеплён к отделному матеряалу, прикрепляет митерял к виджету
                    if(Setting::instance()->getSettingVal('football.team_article') != $data['article']){
                        ArticleHasOnlySelfWidgetModel::create([
                            'article_id' => $data['article'],
                            'widget_id' => Setting::instance()->getSettingVal('football.team_widget'),
                        ]);
                    }

                    TeamModel::create([
                        'formation_id' => $data['formation'],
                        'league_id' => $data['league'],
                        'slug' => $data['slug'],
                        'status' => $data['status'],
                        'photo_id' => $imageId,
                        'entity_id' => $entity->id,
                        'is_own' => $data['is_own'],
                        'article_id' => $data['article'],
                    ]);
                });

                Message::instance()->success('Team has successfully added');

            } catch (Exception $e) {
                Message::instance()->warning('Team has don\'t added');
            }
        }

        $article = new ArticleModel();

        $this->layout->content = View::make('back/teams/add')
            ->with('node', $article::getNode())
            ->with('defaultTeamArticle', Setting::instance()->getSettingVal('football.team_article'));
    }

    /**
     * Редактирование
     */
    public function anyEdit()
    {
        $id = (int) $this->getRequestParam('id') ?: null;

        if (Arr::get($this->getPostData(),'submit') !== null) {

            $model = TeamModel::find($id);
            $entityModel = $model->entity()->first();

            if (empty($model)) {
                throw new HttpException(404,json_encode(['errorMessage' => 'Incorrect Team']));
            }

            $data = Arr::extract($this->getPostData(), ['slug', 'entity', 'formation', 'league', 'article', 'status', 'is_own', 'content', 'image']);

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
                        'entity_id' => $entityModel->id,
                        'formation_id' => $data['formation'],
                        'league_id' => $data['league'],
                        'is_own' => $data['is_own'],
                        'article_id' => $data['article'],
                    ]);
                });
                Message::instance()->success('Team was successfully saved');
            } catch (Exception $e) {
                Message::instance()->warning('Team was don\'t saved');
            }
        }

        $model = TeamModel::find($id);
        $entityModel = $model->entity()->first();

        // Загрузка контента для каждово языка
        $contents = [];
        foreach(Lang::instance()->getLangsExcept(Lang::DEFAULT_LANGUAGE) as $iso => $lang){
            $contents[$iso] = $entityModel->translations()->whereLang_id($lang['id'])->first();
        }

        $article = new ArticleModel();

        $this->layout->content = View::make('back/teams/edit')
            ->with('item', $model)
            ->with('node', $article::getNode())
            ->with('contents', $contents);
    }

    public function getListAll()
    {
        $items = TeamModel::all();

        $this->layout->content = View::make('back/teams/listAll')
            ->with('items', $items);
    }

    public function getDelete()
    {
        $this->layout = false;

        $id = (int)$this->getRequestParam('id') ?: null;

        $model = TeamModel::find($id);

        if (empty($model)) {
            throw new HttpException(404, json_encode(['errorMessage' => 'Incorrect Team']));
        }

        // Транзакция для Записание данных в базу
        Capsule::connection()->transaction(function () use ($model)
        {
            $model->delete();
        });

        Message::instance()->success('Team has successfully deleted');
        Uri::to('/Admin/Team/ListAll');
    }

    public function getList(){

        $id = (int) $this->getRequestParam('id') ?: null;

        $items = PlayerModel::whereTeam_id($id)->get();

        $this->layout->content = View::make('back/teams/list')
            ->with('id', $id)
            ->with('items', $items);
    }
}