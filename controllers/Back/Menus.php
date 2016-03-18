<?php
/**
 * Created by PhpStorm.
 * User: Suren
 * Date: 11/19/2015
 * Time: 3:16 PM
 */

namespace Back;
restrictAccess();


use Helpers\Uri;
use Lang\Lang;
use Http\Exception;
use View;
use Message;
use Helpers\Arr;
use Illuminate\Contracts\Validation;
use MenuModel;
use MenuItemModel;
use Illuminate\Database\Capsule\Manager as Capsule;
use Http\Exception as HttpException;
use Illuminate\Database\QueryException;
use EntityModel;
use EntityTranslationModel;
use Event;
use File as UploadFile;
use Upload\Storage\FileSystem;
use Upload\Validation\Mimetype as UploadMimeType;
use Upload\Validation\Size as UploadSize;

class Menus extends Back
{
    public function getList(){

        $id = (int) $this->getRequestParam('id') ?: null;

        $items = new MenuItemModel();

        $this->layout->content = View::make('back/menus/list')
            ->with('items', $items)
            ->with('id', $id);
    }

    /**
     * Добавления пункта меню
     */
    public function anyAdd()
    {
        $id = (int) $this->getRequestParam('id') ?: null;

        if (Arr::get($this->getPostData(),'submit') !== null) {

            $data = Arr::extract($this->getPostData(), ['slug', 'parentId', 'status', 'entity', 'content']);
            $parent = MenuItemModel::find($data['parentId']);

            // Транзакция для Записание данных в базу
            Capsule::connection()->transaction(function() use ($data, $parent, $id)
            {
                // Загрузка картинки
                $file = new UploadFile('image', new FileSystem('uploads/images'));

                // Optionally you can rename the file on upload
                $file->setName(uniqid());

                // Validate file upload
                $file->addValidations(array(
                    // Ensure file is of type image
                    new UploadMimeType(['image/png','image/jpg','image/gif']),

                    // Ensure file is no larger than 5M (use "B", "K", M", or "G")
                    new UploadSize('50M')
                ));

                // Try to upload file
                try {
                    // Success!
                    $file->upload();
                    $data['icon'] = $file->getNameWithExtension();
                } catch (Exception $e) {
                    // Fail!
                    Message::instance()->warning($file->getErrors());
                }

                $newEntity = EntityModel::create([
                    'text' => $data['entity'],
                    'is_bound' => 1, // Указивает привязку, стоб не показивал в мести с обычними словами переводов
                ]);

                foreach($data['content'] as $iso => $item){
                    $lang_id = Lang::instance()->getLang($iso)['id'];
                    EntityTranslationModel::create([
                        'text' => $item['text'],
                        'lang_id' => $lang_id,
                        'entity_id' => $newEntity->id,
                    ]);
                }

                Event::fire('Admin.entitiesUpdate');

                $newModel = MenuItemModel::create([
                    'menu_id' => $id,
                    'slug' => $data['slug'],
                    'status' => $data['status'],
                    'icon' => $data['icon'],
                    'entity_id' => $newEntity->id,
                ]);

                if ($parent) {
                    $newModel->makeChildOf($parent);
                } else {
                    $newModel->makeRoot();
                }
            });

            Message::instance()->success('Menu Item has successfully added');
        }

        $this->layout->content = View::make('back/menus/add')
            ->with('menu_id', $id)
            ->with('node', MenuItemModel::getNode());
    }

    /**
     * Редактирование пункта меню
     */
    public function anyEdit()
    {
        $id = (int) $this->getRequestParam('id') ?: null;

        $model = MenuItemModel::find($id);
        $entityModel = $model->entities();

        if (empty($model)) {
            throw new HttpException(404,json_encode(['errorMessage' => 'Incorrect Article']));
        }

        // Загрузка контента для каждово языка
        $contents = [];
        foreach(Lang::instance()->getLangsExcept(Lang::DEFAULT_LANGUAGE) as $iso => $lang){
            $contents[$iso] = $entityModel->translations()->where('lang_id', '=', $lang['id'])->first();
        }

        if (Arr::get($this->getPostData(),'submit') !== null) {

            $data = Arr::extract($this->getPostData(), ['slug', 'parentId', 'status', 'entity', 'content']);

            $parent = MenuItemModel::find($data['parentId']);
            // Транзакция для Записание данных в базу
            try {
                Capsule::connection()->transaction(function () use ($data, $model, $parent, $entityModel) {
                    // Загрузка картинки
                    $file = new UploadFile('image', new FileSystem('uploads/images'));

                    // Optionally you can rename the file on upload
                    $file->setName(uniqid());

                    // Validate file upload
                    $file->addValidations(array(
                        // Ensure file is of type image
                        new UploadMimeType(['image/png','image/jpg','image/gif']),

                        // Ensure file is no larger than 5M (use "B", "K", M", or "G")
                        new UploadSize('50M')
                    ));

                    // Try to upload file
                    try {
                        // Success!
                        $file->upload();
                        $data['icon'] = $file->getNameWithExtension();
                    } catch (Exception $e) {
                        // Fail!
                        Message::instance()->warning($file->getErrors());
                    }

                    $entityModel->update([
                        'text' => $data['entity'],
                    ]);
                    foreach ($data['content'] as $iso => $d) {
                        $lang_id = Lang::instance()->getLang($iso)['id'];
                        $content = EntityTranslationModel::find($d['id']);
                        $content->update([
                            'text' => $d['text'],
                            'lang_id' => $lang_id,
                            'entity_id' => $entityModel->id,
                        ]);
                    }

                    Event::fire('Admin.entitiesUpdate');

                    // если нету нового изображения оставить прежний
                    $data['icon'] ?: $model->icon;

                    $model->update([
                        'slug' => $data['slug'],
                        'status' => $data['status'],
                        'icon' => $data['icon'],
                    ]);

                    if ($parent) {
                        $model->makeChildOf($parent);
                    } else {
                        $model->makeRoot($parent);
                    }

                });
                Message::instance()->success('Menu Item was successfully edited');
            } catch (Exception $e) {
                Message::instance()->warning('Menu Item was don\'t edited');
            }
        }
        $this->layout->content = View::make('back/menus/edit')
            ->with('node', $model::getNode())
            ->with('item', $model)
            ->with('contents', $contents);
    }

    public function anySaveSorting()
    {
        $this->layout = false;

        $data = Arr::get($this->getPostData(),'data');

        //В качестве ответа выводим окно логина
        $response = 'Unfaithful Categories Sorting';


        if(!empty($data))
        {
            $data = json_decode($data, true);
            $model = new MenuItemModel();

            if(!empty($data))
            {
                Capsule::connection()->transaction(function() use ($data, $model, &$response){
                    foreach($data as $item)
                    {
                        $model::find($item['id'])->update([
                            'parent_id' => $item['parent_id'],
                            'lvl' => $item['depth'],
                            'lft' => $item['left'],
                            'rgt' => $item['right'],
                        ]);
                    }

                    $response = 'Menu Sorting has successfully saved';
                });
            }
        }

        Message::instance()->info($response);

        echo Message::instance()->flash_all();
    }

    public function getDelete()
    {
        $this->layout = false;

        $id = (int) $this->getRequestParam('id') ?: null;

        $article = ArticleModel::find($id);

        if (empty($article)) {
            throw new HttpException(404,json_encode(['errorMessage' => 'Incorrect Article']));
        }

        // Транзакция для Записание данных в базу
        Capsule::connection()->transaction(function() use ($article){

            // Заодно удаляет и пункты меню привязанные к slug-у
            (new \MenuItemModel)->whereSlug($article->slug)->delete();

            foreach($article->getDescendantsAndSelf() as $desc){
                $desc->contents()->delete();
            }
            $article->delete();
        });

        Message::instance()->success('Menu Item has successfully deleted');
        Uri::to('/Admin/Categories');
    }
}