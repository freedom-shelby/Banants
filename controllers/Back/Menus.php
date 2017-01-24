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
use Exception;

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

            $data = Arr::extract($this->getPostData(), ['slug', 'parentId', 'icon', 'status', 'entity', 'content']);
            $parent = MenuItemModel::find($data['parentId']);

            // Транзакция для Записание данных в базу
            Capsule::connection()->transaction(function() use ($data, $parent, $id)
            {
                $newEntity = EntityModel::create([
                    'text' => $data['entity'],
                    'is_bound' => 1, // Указивает привязку, стоб не показивал в мести с обычними словами переводов
                ]);

                foreach($data['content'] as $iso => $item){
                    $langId = Lang::instance()->getLang($iso)['id'];
                    EntityTranslationModel::create([
                        'text' => $item['text'],
                        'lang_id' => $langId,
                        'entity_id' => $newEntity->id,
                    ]);
                }

                Event::fire('Admin.entitiesUpdate');
                Event::fire('Admin.menuUpdate');

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
        $entityModel = $model->entities()->first();

        if (empty($model)) {
            throw new HttpException(404,json_encode(['errorMessage' => 'Incorrect Article']));
        }

        if (Arr::get($this->getPostData(),'submit') !== null) {

            $data = Arr::extract($this->getPostData(), ['slug', 'icon', 'parentId', 'status', 'entity', 'content']);

            $parent = MenuItemModel::find($data['parentId']);
            // Транзакция для Записание данных в базу
            try {
                Capsule::connection()->transaction(function () use ($data, $model, $parent, $entityModel)
                {
                    $entityModel->update([
                        'text' => $data['entity'],
                    ]);
                    foreach ($data['content'] as $iso => $d) {
                        $langId = Lang::instance()->getLang($iso)['id'];
                        EntityTranslationModel::updateOrCreate(['id' => $d['id']], ['text' => $d['text'], 'lang_id' => $langId, 'entity_id' => $entityModel->id]);
                    }

                    Event::fire('Admin.entitiesUpdate');
                    Event::fire('Admin.menuUpdate');

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

        $model = MenuItemModel::find($id);
        $entityModel = $model->entities()->first();

        // Загрузка контента для каждово языка
        $contents = [];
        foreach(Lang::instance()->getLangsExcept(Lang::DEFAULT_LANGUAGE) as $iso => $lang){
            $contents[$iso] = $entityModel->translations()->where('lang_id', '=', $lang['id'])->first();
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

                    Event::fire('Admin.menuUpdate');

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

        $item = MenuItemModel::find($id);

        if (empty($item)) {
            throw new HttpException(404,json_encode(['errorMessage' => 'Incorrect Article']));
        }

        // Транзакция для Записание данных в базу
        Capsule::connection()->transaction(function() use ($item){

            foreach($item->getDescendantsAndSelf() as $desc){
                $a = $desc->entities();
                foreach($a as $b){
                    $c = $b->translations();
                    $c->delete();
                    $b->delete();
                }
//                $desc->entities()->translations()->delete();
                $a->delete();
            }
            @unlink(ltrim(UploadFile::getImagePath($item->icon), '/'));
//            $item->delete();
        });

        Event::fire('Admin.menuUpdate');

        Message::instance()->success('Menu Item has successfully deleted');
        Uri::to('/Admin');
    }

    /**
     * Удаление иконки
     */
    public function postImageDelete(){

        $this->layout = null;

        $id = (int) Arr::get($this->getPostData(), 'key');

        $item = Capsule::table('menu_items')->find($id);

        if (empty($item)) {
            Message::instance()->warning('Image was not delete');
        }else{
            try {
                // Удаление картинки из сервера
                @unlink(ltrim(UploadFile::getImagePath($item['icon']), '/'));

                Capsule::table('menu_items')->whereId($id)->update(
                    ['icon' => null]
                );

                Message::instance()->success('Image was successfully deleted');
            } catch (Exception $e) {
                Message::instance()->warning('Image was not delete');
            }
        }

        echo json_encode(['errorMessage' => Message::instance()->flash_all()]);
    }
}