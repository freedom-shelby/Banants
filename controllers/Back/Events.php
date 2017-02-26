<?php
/**
 * Created by PhpStorm.
 * User: Suren
 * Date: 11/19/2015
 * Time: 3:16 PM
 */

namespace Back;
restrictAccess();

use Carbon\Carbon;
use Football\Events\EventManager;
use Football\Tournaments\Tournament;
use View;
use Message;
use Helpers\Arr;
use PhotoModel;
use TournamentModel;
use TeamHasTournamentModel;
use Illuminate\Database\Capsule\Manager as Capsule;
use Exception;
use Helpers\Uri;
use Http\Exception as HttpException;
use Illuminate\Database\QueryException;
use Upload\File as UploadFile;
use Upload\Storage\FileSystem;
use Upload\Exception\UploadException;
use Event;
use EventModel;
use FormationModel;
use EntityModel;
use EventTeamStatisticModel;
use EntityTranslationModel;
use Lang\Lang;

class Events extends Back
{
    const PATH = 'uploads/document/event/statistic';

    /**
     * Добавления Турнамента
     */
    public function anyEdit()
    {
        $id = (int) $this->getRequestParam('id') ?: null;

        if (Arr::get($this->getPostData(), 'submit') !== null)
        {
            $data = Arr::extract($this->getPostData(), ['home', 'away', 'photo-id']);
            $data['event_id'] = $id;

            try {
                // Транзакция для Записание данных в базу
                Capsule::connection()->transaction(function () use ($data) {
                    EventManager::factory($data);
                });

                Message::instance()->success('Tournament has successfully added');
            } catch (Exception $e) {
                Message::instance()->warning('Tournament has don\'t added');
            }
        }

        $model = EventModel::find($id);
        $items = EventManager::factory($model);

        $formations = FormationModel::all();

        $this->layout->content = View::make('back/tournaments/events/edit')
            ->with('items', $items)
            ->with('formations', $formations);
    }

    public function anyEditTeam()
    {
        $id = (int) $this->getRequestParam('id') ?: null;

        $item = TournamentModel::find($id);
        $nameModel = $item->nameModel()->first();
        $fullNameModel = $item->fullNameModel()->first();

        if (empty($item)) {
            throw new HttpException(404,json_encode(['errorMessage' => 'Incorrect Model']));
        }

        if (Arr::get($this->getPostData(),'submit') !== null) {

            $data = Arr::extract($this->getPostData(), ['slug', 'name', 'full_name', 'type', 'status', 'max_rounds', 'current_round', 'content', 'image']);

            // Транзакция для Записание данных в базу
            try {
                Capsule::connection()->transaction(function () use ($data, $item, $nameModel, $fullNameModel)
                {
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

                        $item->update([
                            'photo_id' => $imageId,
                        ]);
                    }

                    $nameModel->update([
                        'text' => $data['name'],
                        'is_bound' => 1, // Указивает привязку, стоб не показивал в мести с обычними словами переводов
                    ]);

                    $fullNameModel->update([
                        'text' => $data['full_name'],
                        'is_bound' => 1, // Указивает привязку, стоб не показивал в мести с обычними словами переводов
                    ]);

                    foreach ($data['content'] as $iso => $d) {
                        $langId = Lang::instance()->getLang($iso)['id'];

                        EntityTranslationModel::updateOrCreate(['id' => $d['name_id']], ['text' => $d['name'], 'lang_id' => $langId, 'entity_id' => $nameModel->id]);
                        EntityTranslationModel::updateOrCreate(['id' => $d['full_name_id']], ['text' => $d['full_name'], 'lang_id' => $langId, 'entity_id' => $fullNameModel->id]);
                    }

                    Event::fire('Admin.entitiesUpdate');

                    $item->update([
                        'slug' => $data['slug'],
                        'status' => $data['status'],
                        'max_rounds' => $data['max_rounds'],
                        'current_round' => $data['current_round'],
                        'name_id' => $nameModel->id,
                        'full_name_id' => $fullNameModel->id,
                    ]);

//                    $item->photos()->detach();
//                    if(isset($data['photos'])){
//                        foreach ($data['photos'] as $photoId) {
//                            $item->photos()->attach($photoId);
//                        }
//                    }
                });

                Message::instance()->success('Tournament was successfully edited');
            } catch (QueryException $e) {
                Message::instance()->warning('Tournament was don\'t edited');
            }
        }

        // Загрузка контента для каждово языка
        $model = TournamentModel::find($id);
        $nameModel = $model->nameModel()->first();
        $fullNameModel = $model->fullNameModel()->first();

        // Загрузка контента для каждово языка
        $contents = [];
        foreach(Lang::instance()->getLangsExcept(Lang::DEFAULT_LANGUAGE) as $iso => $lang){
            $contents[$iso]['name'] = $nameModel->translations()->whereLang_id($lang['id'])->first();
            $contents[$iso]['fullName'] = $fullNameModel->translations()->whereLang_id($lang['id'])->first();
        }

        $this->layout->content = View::make('back/tournaments/editTeam')
            ->with('item', $item)
            ->with('contents', $contents);
    }
}