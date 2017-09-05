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

            $data = Arr::extract($this->getPostData(), ['slug', 'entity', 'short_name', 'formation', 'league', 'article', 'status', 'is_own', 'content', 'image']);

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

                    //todo:: add from settings
                    $imageId = 2;

                    if($image) {
                        $imageId = PhotoModel::create([
                            'path' => $image,
                            'is_bound' => 1, // Указивает привязку, стоб не показивал в мести с обычними словами переводов
                        ])->id;
                    }

                    // Загрузка баннера
                    $banner = new UploadFile('banner', new FileSystem(static::IMAGE_PATH));

                    // Optionally you can rename the file on upload
                    $banner->setName(uniqid());

                    // Try to upload file
                    try {
                        // Success!
                        $banner->upload();
                        $bannerPath = '/' . static::IMAGE_PATH . '/' . $banner->getNameWithExtension();
                    } catch (UploadException $e) {
                        // Fail!
                        $bannerPath = null;
                        Message::instance()->warning($banner->getErrors());
                    } catch (Exception $e) {
                        // Fail!
                        $bannerPath = null;
                        Message::instance()->warning($banner->getErrors());
                    }

                    //todo:: add from settings
                    $bannerId = 1;

                    if($bannerPath) {
                        $bannerId = PhotoModel::create([
                            'path' => $bannerPath,
                            'is_bound' => 1, // Указивает привязку, стоб не показивал в мести с обычними словами переводов
                        ])->id;
                    }
                    // #Загрузка баннера

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

                    $shortNameEntity = EntityModel::create([
                        'text' => $data['short_name'],
                        'is_bound' => 1, // Указивает привязку, стоб не показивал в мести с обычними словами переводов
                    ]);

                    foreach ($data['content'] as $iso => $item) {
                        $lang_id = Lang::instance()->getLang($iso)['id'];
                        EntityTranslationModel::create([
                            'text' => $item['short_name'],
                            'lang_id' => $lang_id,
                            'entity_id' => $shortNameEntity->id,
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
                        'banner_id' => $bannerId,
                        'entity_id' => $entity->id,
                        'short_name_id' => $shortNameEntity->id,
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
            $shortNameModel = $model->firstShortNameModel();

            if (empty($model)) {
                throw new HttpException(404,json_encode(['errorMessage' => 'Incorrect Team']));
            }

            $data = Arr::extract($this->getPostData(), ['slug', 'entity', 'short_name', 'formation', 'league', 'article', 'status', 'is_own', 'content', 'image']);

            // Транзакция для Записание данных в базу
            try {
                Capsule::connection()->transaction(function () use ($data, $model, $entityModel, $shortNameModel) {
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

                    // Загрузка баннера
                    $bannerFile = new UploadFile('banner', new FileSystem(static::IMAGE_PATH));

                    // Optionally you can rename the file on upload
                    $bannerFile->setName(uniqid());

                    // Try to upload file
                    try {
                        // Success!
                        $bannerFile->upload();
                        $bannerPath = '/' . static::IMAGE_PATH . '/' . $bannerFile->getNameWithExtension();
                    } catch (UploadException $e) {
                        // Fail!
                        $bannerPath = null;
                        Message::instance()->warning($bannerFile->getErrors());
                    } catch (Exception $e) {
                        // Fail!
                        $bannerPath = null;
                        Message::instance()->warning($bannerFile->getErrors());
                    }
                    // #Загрузка баннера

                    $entityModel = EntityModel::updateOrCreate(
                        ['id' => $entityModel->id,],
                        ['text' => $data['entity'],
                        ]);
                    $shortNameModel = EntityModel::updateOrCreate(
                        ['id' => $shortNameModel->id,],
                        ['text' => $data['short_name'],
                        ]);

                    foreach ($data['content'] as $iso => $d) {
                        $langId = Lang::instance()->getLang($iso)['id'];

                        EntityTranslationModel::updateOrCreate(['id' => $d['id']], ['text' => $d['text'], 'lang_id' => $langId, 'entity_id' => $entityModel->id]);
                        EntityTranslationModel::updateOrCreate(['id' => $d['short_name_id']], ['text' => $d['short_name'], 'lang_id' => $langId, 'entity_id' => $shortNameModel->id]);
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

                    // если нету нового изображения оставить прежний
                    if($bannerPath){
                        $bannerId = PhotoModel::create([
                            'path' => $bannerPath,
                            'is_bound' => 1, // Указивает привязку, стоб не показивал в мести с обычними словами переводов
                        ])->id;
                        $model->update([
                            'banner_id' => $bannerId,
                        ]);
                    }

                    $model->update([
                        'slug' => $data['slug'],
                        'status' => $data['status'],
                        'entity_id' => $entityModel->id,
                        'short_name_id' => $shortNameModel->id,
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
        $shortNameModel = $model->firstShortNameModel();

        // Загрузка контента для каждово языка
        $contents = [];
        foreach(Lang::instance()->getLangsExcept(Lang::DEFAULT_LANGUAGE) as $iso => $lang){
            if($entityModel) $contents[$iso] = $entityModel->translations()->whereLang_id($lang['id'])->first();
            if($shortNameModel) $contents[$iso]['shortName'] = $shortNameModel->translations()->whereLang_id($lang['id'])->first();
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