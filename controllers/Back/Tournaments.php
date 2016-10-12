<?php
/**
 * Created by PhpStorm.
 * User: Suren
 * Date: 11/19/2015
 * Time: 3:16 PM
 */

namespace Back;
restrictAccess();

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
use EntityModel;
use EntityTranslationModel;
use Lang\Lang;

class Tournaments extends Back
{
    const IMAGE_PATH = 'uploads/images/football/tournament';

    /**
     * Добавления Галерии
     */
    public function anyAdd()
    {
        if (Arr::get($this->getPostData(), 'submit') !== null)
        {
            $data = Arr::extract($this->getPostData(), ['slug', 'name', 'full_name', 'type', 'status', 'max_rounds', 'content', 'image']);

            try {
                // Транзакция для Записание данных в базу
                $model = Capsule::connection()->transaction(function () use ($data) {
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

                    $name = EntityModel::create([
                        'text' => $data['name'],
                        'is_bound' => 1, // Указивает привязку, стоб не показивал в мести с обычними словами переводов
                    ]);

                    foreach ($data['content'] as $iso => $item) {
                        $lang_id = Lang::instance()->getLang($iso)['id'];
                        EntityTranslationModel::create([
                            'text' => $item['name'],
                            'lang_id' => $lang_id,
                            'entity_id' => $name->id,
                        ]);
                    }

                    $fullName = EntityModel::create([
                        'text' => $data['full_name'],
                        'is_bound' => 1, // Указивает привязку, стоб не показивал в мести с обычними словами переводов
                    ]);

                    foreach ($data['content'] as $iso => $item) {
                        $lang_id = Lang::instance()->getLang($iso)['id'];
                        EntityTranslationModel::create([
                            'text' => $item['full_name'],
                            'lang_id' => $lang_id,
                            'entity_id' => $fullName->id,
                        ]);
                    }

                    Event::fire('Admin.entitiesUpdate');

                    return TournamentModel::create([
                        'type_id' => $data['type'],
                        'slug' => $data['slug'],
                        'status' => $data['status'],
                        'max_rounds' => $data['max_rounds'],
                        'photo_id' => $imageId,
                        'name_id' => $name->id,
                        'full_name_id' => $fullName->id,
                    ]);
                });

                Message::instance()->success('Tournament has successfully added');

                Uri::to('/Admin/Tournament/Edit/Team/' . $model->id);
            } catch (Exception $e) {
                Message::instance()->warning('Tournament has don\'t added');
            }
        }

        $this->layout->content = View::make('back/tournaments/add');
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

    public function anyEditTable()
    {
        $id = (int) $this->getRequestParam('id') ?: null;

        $model = TournamentModel::find($id);
        $item = Tournament::factory($model);

        if (empty($item)) {
            throw new HttpException(404,json_encode(['errorMessage' => 'Incorrect Model']));
        }

        if (Arr::get($this->getPostData(),'submit') !== null) {

            $data = Arr::extract($this->getPostData(), ['team', 'current_round']);
            // Транзакция для Записание данных в базу
            try {
                $item = Capsule::connection()->transaction(function () use ($data, $item)
                {
                    return $item->generateWith($data['team'])
                        ->setCurrentRound($data['current_round'])
                        ->save();

//                    foreach ($data['team'] as $key => $d) {
//                        TeamHasTournamentModel::updateOrCreate(
//                            ['id' => $key],
//                            ['pos' => $d['pos'], 'points' => $d['points'], 'win' => $d['win'], 'draw' => $d['draw'], 'lose' => $d['lose'], 'goals_for' => $d['goals_for'], 'goals_against' => $d['goals_against']]);
//                    }
                });

                Message::instance()->success('Tournament Table was successfully edited');
            } catch (QueryException $e) {
                Message::instance()->warning('Tournament Table was don\'t edited');
            }
        }

        $teams = $item->getTeams();

        $this->layout->content = View::make('back/tournaments/editTable')
            ->with('item', $item)
            ->with('teams', $teams);

    }

    public function anyEditRound()
    {
        $id = (int) $this->getRequestParam('id') ?: null;
        $roundNumber = (int) $this->getRequestParam('number') ?: null;

        $model = TournamentModel::find($id);
        $item = Tournament::factory($model);
//        $round = Tournament::factory($model);

        if (empty($item)) {
            throw new HttpException(404,json_encode(['errorMessage' => 'Incorrect Model']));
        }

        if (Arr::get($this->getPostData(),'submit') !== null) {
echo "<pre>";
print_r($this->getPostData());
die;
            $data = Arr::extract($this->getPostData(), ['team', 'current_round']);
            // Транзакция для Записание данных в базу
            try {
                $item = Capsule::connection()->transaction(function () use ($data, $item)
                {
                    return $item->generateWith($data['team'])
                        ->setCurrentRound($data['current_round'])
                        ->save();

//                    foreach ($data['team'] as $key => $d) {
//                        TeamHasTournamentModel::updateOrCreate(
//                            ['id' => $key],
//                            ['pos' => $d['pos'], 'points' => $d['points'], 'win' => $d['win'], 'draw' => $d['draw'], 'lose' => $d['lose'], 'goals_for' => $d['goals_for'], 'goals_against' => $d['goals_against']]);
//                    }
                });

                Message::instance()->success('Tournament Table was successfully edited');
            } catch (QueryException $e) {
                Message::instance()->warning('Tournament Table was don\'t edited');
            }
        }

        $teams = $item->getTeams();

        $this->layout->content = View::make('back/tournaments/editRound')
            ->with('item', $item)
            ->with('teams', $teams);

    }

    public function getList()
    {
        $items = TournamentModel::all();

        $this->layout->content = View::make('back/tournaments/list')
            ->with('items', $items);
    }


    public function getListRounds()
    {
        $id = (int) $this->getRequestParam('id') ?: null;

        $item = TournamentModel::find($id);

        $this->layout->content = View::make('back/tournaments/listRounds')
            ->with('item', $item);
    }

    public function getDelete()
    {
        $id = (int) $this->getRequestParam('id') ?: null;

        TournamentModel::destroy($id);

        Message::instance()->success('Tournament has successfully deleted');
        Uri::to('/Admin/PhotoGallery/List');
    }
}