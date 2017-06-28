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
use EntityModel;
use EntityTranslationModel;
use Illuminate\Database\Capsule\Manager as Capsule;
use Http\Exception as HttpException;
use Illuminate\Database\QueryException;
use SpecializationModel;


class Specializations extends Back
{
    public function getList(){
        $item = SpecializationModel::all();
        $this->layout->content = View::make('back/specializations/list')
            ->with('items', $item);
    }

    /**
     * Добавления материалов
     */
    public function anyAdd()
    {
        if (Arr::get($this->getPostData(),'submit') !== null) {
            $item = new EntityModel();

            $data = Arr::extract($this->getPostData(), ['entity', 'content']);

            // Транзакция для Записание данных в базу
            Capsule::connection()->transaction(function() use ($data, $item){

                $newEntity = EntityModel::create([
                    'text' => $data['entity'],
                ]);

                foreach($data['content'] as $iso => $item){
                    $lang_id = Lang::instance()->getLang($iso)['id'];
                    EntityTranslationModel::create([
                        'text' => $item['text'],
                        'lang_id' => $lang_id,
                        'entity_id' => $newEntity->id,
                    ]);
                }

                SpecializationModel::create([
                    'entity_id' => $newEntity->id,
                ]);
            });

            Event::fire('Admin.entitiesUpdate');
            Message::instance()->success('Specialization has successfully added');
        }

        $this->layout->content = View::make('back/specializations/add');
    }

    /**
     * Редактирование материалов
     */
    public function anyEdit()
    {
        $id = (int) $this->getRequestParam('id') ?: null;

        $model = SpecializationModel::find($id);
        $item = $model->entities();

        if (empty($item)) {
            throw new HttpException(404,json_encode(['errorMessage' => 'Incorrect Specialization']));
        }

        // Загрузка контента для каждово языка
        $translations = [];
        foreach(Lang::instance()->getLangsExcept(Lang::DEFAULT_LANGUAGE) as $iso => $lang){
            $translations[$iso] = $item->translations()->where('lang_id', '=', $lang['id'])->first();
        }

        if (Arr::get($this->getPostData(),'submit') !== null) {

            $data = Arr::extract($this->getPostData(), ['entity', 'content']);

            // Транзакция для Записание данных в базу
            try {
                Capsule::connection()->transaction(function () use ($data, $item) {
                    $item->update([
                        'text' => $data['entity'],
                    ]);
                    foreach ($data['content'] as $iso => $d) {
                        $lang_id = Lang::instance()->getLang($iso)['id'];
                        $content = EntityTranslationModel::find($d['id']);
                        $content->update([
                            'text' => $d['text'],
                            'lang_id' => $lang_id,
                            'entity_id' => $item->id,
                        ]);
                    }
                });
                Event::fire('Admin.entitiesUpdate');
                Message::instance()->success('Specialization was successfully edited');
            } catch (QueryException $e) {
                Message::instance()->warning('Specialization was don\'t edited');
            }
        }
        $this->layout->content = View::make('back/specializations/edit')
            ->with('item', $item)
            ->with('translations', $translations);
    }

    public function getDelete()
    {
        $this->layout = false;

        $id = (int) $this->getRequestParam('id') ?: null;

        $item = SpecializationModel::find($id);

        if (empty($item)) {
            throw new HttpException(404,json_encode(['errorMessage' => 'Incorrect Specialization']));
        }

        // Транзакция для Записание данных в базу
        Capsule::connection()->transaction(function() use ($item){
            $item->delete();
            Event::fire('Admin.entitiesUpdate');
        });

        Message::instance()->success('Specialization has successfully deleted');
        Uri::to('/Admin/Specializations');
    }
}