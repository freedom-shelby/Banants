<?php
/**
 * Created by PhpStorm.
 * User: Suren
 * Date: 11/19/2015
 * Time: 3:16 PM
 */

namespace Back;

if(!defined('ROOT_PATH')){header('HTTP/1.0 404 Not Found'); die("<h1>404 Not Found</h1>The page that you have requested could not be found.");}

use Helpers\Uri;
use Http\Exception;
use View;
use Message;
use Helpers\Arr;
use Illuminate\Contracts\Validation;
use EntityModel;
use EntityTranslationModel;
use Langs;
use Illuminate\Database\Capsule\Manager as Capsule;
use Http\Exception as HttpException;


class Entities extends Back
{
    public function getList(){
        $item = (new EntityModel)->whereIs_bound(0)->get();
        $this->layout->content = View::make('back/entities/list')
            ->with('items', $item);
    }

    /**
     * Добавления материалов
     */
    public function anyAdd()
    {
        $item = new EntityModel();

        if (null !== Arr::get($this->getPostData(),'submit')) {

            $data = Arr::extract($this->getPostData(), ['entity', 'content']);

            // Транзакция для Записание данных в базу
            Capsule::connection()->transaction(function() use ($data, $item){

                $newEntity = EntityModel::create([
                    'text' => $data['entity'],
                ]);

                foreach($data['content'] as $iso => $item){
                    $lang_id = Langs::instance()->getLang($iso)['id'];
                    EntityTranslationModel::create([
                        'text' => $item['text'],
                        'lang_id' => $lang_id,
                        'entity_id' => $newEntity->id,
                    ]);
                }
            });

            Message::instance()->success('Entity has successfully added');

        }

        $this->layout->content = View::make('back/entities/add');
    }

    /**
     * Редактирование материалов
     */
    public function anyEdit()
    {
        $id = (int) $this->getRequestParam('id') ?: null;

        $item = EntityModel::find($id);

        if (empty($item)) {
            throw new HttpException(404,json_encode(['errorMessage' => 'Incorrect Article']));
        }

        // Загрузка контента для каждово языка
        $translations = [];
        foreach(Langs::instance()->getLangsExcept(Langs::DEFAULT_LANGUAGE) as $iso => $lang){
            $translations[$iso] = $item->translations()->where('lang_id', '=', $lang['id'])->first();
        }

        if (null !== Arr::get($this->getPostData(),'submit')) {

            $data = Arr::extract($this->getPostData(), ['entity', 'content']);

            // Транзакция для Записание данных в базу
            try {
                Capsule::connection()->transaction(function () use ($data, $item) {
                    $item->update([
                        'text' => $data['entity'],
                    ]);
                    foreach ($data['content'] as $iso => $d) {
                        $lang_id = Langs::instance()->getLang($iso)['id'];
                        $content = EntityTranslationModel::find($d['id']);
                        $content->update([
                            'text' => $d['text'],
                            'lang_id' => $lang_id,
                            'entity_id' => $item->id,
                        ]);
                    }
                });
                Message::instance()->success('Entity was successfully edited');
            } catch (Exception $e) {
                Message::instance()->warning('Entity was don\'t edited');
            }
        }
        $this->layout->content = View::make('back/entities/edit')
            ->with('item', $item)
            ->with('translations', $translations);
    }

    public function getDelete()
    {
        $this->layout = false;

        $id = (int) $this->getRequestParam('id') ?: null;

        $item = EntityModel::find($id);

        if (empty($item)) {
            throw new HttpException(404,json_encode(['errorMessage' => 'Incorrect Article']));
        }

        // Транзакция для Записание данных в базу
        Capsule::connection()->transaction(function() use ($item){
            foreach($item->translations() as $i){
                $i->translations()->delete();
            }
            $item->delete();
        });

        Message::instance()->success('Entity has successfully deleted');
        Uri::to('/Admin/Entities');
    }
}