<?php
/**
 * Created by PhpStorm.
 * User: Suren
 * Date: 11/19/2015
 * Time: 3:16 PM
 */

namespace Back;
restrictAccess();

use View;
use Message;
use Helpers\Arr;
use PhotoGalleryModel;
use Illuminate\Database\Capsule\Manager as Capsule;
use Exception;
use Helpers\Uri;
use Http\Exception as HttpException;
use Illuminate\Database\QueryException;
use Event;
use EntityModel;
use EntityTranslationModel;
use Lang\Lang;

class PhotoGalleries extends Back
{
    /**
     * Добавления Галерии
     */
    public function anyAdd()
    {
        if (Arr::get($this->getPostData(), 'submit') !== null) {

            $data = Arr::extract($this->getPostData(), ['slug', 'entity', 'content']);

            try {
                // Транзакция для Записание данных в базу
                $lastInsertId = Capsule::connection()->transaction(function () use ($data) {

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

                    return PhotoGalleryModel::create([
                        'entity_id' => $newEntity->id,
                        'slug' => $data['slug'],
                    ])->id;
                });
                Message::instance()->success('Photo Gallery has successfully added');
            } catch (Exception $e) {
                Message::instance()->warning('Photo Gallery  has don\'t added');
            }

            Uri::to('/Admin/PhotoGallery/Edit/' . $lastInsertId);
        }

        $this->layout->content = View::make('back/photoGalleries/add');
    }

    public function anyEdit()
    {
        $id = (int) $this->getRequestParam('id') ?: null;

        $item = PhotoGalleryModel::find($id);
        $entityModel = $item->entities()->first();

        if (empty($item)) {
            throw new HttpException(404,json_encode(['errorMessage' => 'Incorrect Model']));
        }

        if (Arr::get($this->getPostData(),'submit') !== null) {

            $data = Arr::extract($this->getPostData(), ['entity', 'slug', 'photos', 'content']);

//             Транзакция для Записание данных в базу
            try {
                Capsule::connection()->transaction(function () use ($data, $item, $entityModel) {

                    $entityModel->update([
                        'text' => $data['entity'],
                        'is_bound' => 1, // Указивает привязку, стоб не показивал в мести с обычними словами переводов
                    ]);
                    foreach ($data['content'] as $iso => $d) {
                        $langId = Lang::instance()->getLang($iso)['id'];
                        EntityTranslationModel::updateOrCreate(['id' => $d['id']], ['text' => $d['text'], 'lang_id' => $langId, 'entity_id' => $entityModel->id]);
                    }

                    Event::fire('Admin.entitiesUpdate');

                    $item->update([
                        'slug' => $data['slug'],
                    ]);

                    $item->photos()->detach();
                    if(isset($data['photos'])){
                        foreach ($data['photos'] as $photoId) {
                            $item->photos()->attach($photoId);
                        }
                    }
                });

                Message::instance()->success('Photo Gallery was successfully edited');
            } catch (QueryException $e) {
                Message::instance()->warning('Photo Gallery was don\'t edited');
            }
        }

        // Загрузка контента для каждово языка
        $contents = [];
        foreach(Lang::instance()->getLangsExcept(Lang::DEFAULT_LANGUAGE) as $iso => $lang){
            $contents[$iso] = $entityModel->translations()->where('lang_id', '=', $lang['id'])->first();
        }

        $this->layout->content = View::make('back/photoGalleries/edit')
            ->with('item', $item)
            ->with('contents', $contents);

    }

    public function getList()
    {
        $items = PhotoGalleryModel::all();

        $this->layout->content = View::make('back/photoGalleries/list')
            ->with('items', $items);
    }

    public function getDelete()
    {
        $id = (int) $this->getRequestParam('id') ?: null;

        PhotoGalleryModel::destroy($id);

        Message::instance()->success('Photo Gallery has successfully deleted');
        Uri::to('/Admin/PhotoGallery/List');
    }
}