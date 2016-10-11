<?php
/**
 * Created by PhpStorm.
 * User: crosscomp
 * Date: 12/9/14
 * Time: 3:23 AM
 */
namespace Back;
restrictAccess();


use View;
use Setting;
use QuizModel;
use QuizAnswerModel;
use Lang\Lang;
use Helpers\Uri;
use Message;
use Helpers\Arr;
use Illuminate\Database\Capsule\Manager as Capsule;
use EntityModel;
use EntityTranslationModel;
use Event;
use Http\Exception as HttpException;
use Illuminate\Database\QueryException;

class Quiz extends Back {

    public function anyAdd()
    {
        if (Arr::get($this->getPostData(),'submit') !== null) {

            $data = Arr::extract($this->getPostData(), ['name', 'content']);

            // Транзакция для Записание данных в базу
            $lastInsertId = Capsule::connection()->transaction(function() use ($data){

                $newEntity = EntityModel::create([
                    'text' => $data['name'],
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

                return QuizModel::create([
                    'entity_id' => $newEntity->id,
                ])->id;
            });

            Event::fire('Admin.entitiesUpdate');
            Message::instance()->success('Quiz has successfully added');

            Uri::to('/Admin/Quiz/Edit/' . $lastInsertId);
        }

        $this->layout->content = View::make('back/quiz/add');
    }

    public function anyEdit()
    {
        $id = (int) $this->getRequestParam('id') ?: null;

        $item = QuizModel::find($id);
        $nameModel = $item->entities()->first();

        if (empty($item)) {
            throw new HttpException(404,json_encode(['errorMessage' => 'Incorrect Model']));
        }

        if (Arr::get($this->getPostData(),'submit') !== null) {

            $data = Arr::extract($this->getPostData(), ['name', 'content']);

            // Транзакция для Записание данных в базу
            try {
                Capsule::connection()->transaction(function () use ($data, $nameModel) {
                    $nameModel->update([
                        'text' => $data['name'],
                    ]);
                    foreach ($data['content'] as $iso => $d) {
                        $lang_id = Lang::instance()->getLang($iso)['id'];
                        $content = EntityTranslationModel::find($d['id']);
                        $content->update([
                            'text' => $d['text'],
                            'lang_id' => $lang_id,
                            'entity_id' => $nameModel->id,
                        ]);
                    }
                });
                Event::fire('Admin.entitiesUpdate');
                Message::instance()->success('Quiz was successfully edited');
            } catch (QueryException $e) {
                Message::instance()->warning('Quiz was don\'t edited');
            }
        }

        // Загрузка контента для каждово языка
        $translations = [];
        foreach(Lang::instance()->getLangsExcept(Lang::DEFAULT_LANGUAGE) as $iso => $lang){
            $translations[$iso] = $nameModel->translations()->where('lang_id', '=', $lang['id'])->first();
        }

        $answers = $item->answers()->get();

        $this->layout->content = View::make('back/quiz/edit')
            ->with('item', $item)
            ->with('name', $nameModel)
            ->with('translations', $translations)
            ->with('answers', $answers);
    }

    public function getList()
    {
        $items = QuizModel::all();

        $this->layout->content = View::make('back/quiz/list')
            ->with('items', $items);
    }

    public function getCurrent()
    {
        Uri::to('/Admin/Quiz/Response/' . Setting::instance()->getSettingVal('widgets.quizz'));
    }

    public function getResponse()
    {
        $id = (int) $this->getRequestParam('id') ?: null;

        $item = QuizModel::find($id);

        $this->layout->content = View::make('back/quiz/response')
            ->with('item', $item);
    }

    public function getDelete()
    {
        $id = (int) $this->getRequestParam('id') ?: null;

        QuizModel::destroy($id);

        Message::instance()->success('Quiz has successfully deleted');
        Uri::to('/Admin/Quiz/List');
    }

    public function anyAnswerAdd()
    {
        $id = (int) $this->getRequestParam('id') ?: null;

        if (Arr::get($this->getPostData(),'submit') !== null) {

            $data = Arr::extract($this->getPostData(), ['name', 'content']);

            // Транзакция для Записание данных в базу
            Capsule::connection()->transaction(function() use ($id, $data){

                $newEntity = EntityModel::create([
                    'text' => $data['name'],
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

                QuizAnswerModel::create([
                    'quiz_id' => $id,
                    'entity_id' => $newEntity->id,
                ]);
            });

            Event::fire('Admin.entitiesUpdate');
            Message::instance()->success('Quiz Answer has successfully added');

            Uri::to('/Admin/Quiz/Edit/' . $id);
        }

        $this->layout->content = View::make('back/quiz/answer/add');
    }

    public function anyAnswerEdit()
    {
        $id = (int) $this->getRequestParam('id') ?: null;

        $item = QuizAnswerModel::find($id);
        $nameModel = $item->entities()->first();

        if (empty($item)) {
            throw new HttpException(404,json_encode(['errorMessage' => 'Incorrect Model']));
        }

        if (Arr::get($this->getPostData(),'submit') !== null) {

            $data = Arr::extract($this->getPostData(), ['name', 'content']);

            // Транзакция для Записание данных в базу
            try {
                Capsule::connection()->transaction(function () use ($data, $nameModel) {
                    $nameModel->update([
                        'text' => $data['name'],
                    ]);
                    foreach ($data['content'] as $iso => $d) {
                        $lang_id = Lang::instance()->getLang($iso)['id'];
                        $content = EntityTranslationModel::find($d['id']);
                        $content->update([
                            'text' => $d['text'],
                            'lang_id' => $lang_id,
                            'entity_id' => $nameModel->id,
                        ]);
                    }
                });
                Event::fire('Admin.entitiesUpdate');
                Message::instance()->success('Quiz was successfully edited');
            } catch (QueryException $e) {
                Message::instance()->warning('Quiz was don\'t edited');
            }
        }

        // Загрузка контента для каждово языка
        $translations = [];
        foreach(Lang::instance()->getLangsExcept(Lang::DEFAULT_LANGUAGE) as $iso => $lang){
            $translations[$iso] = $nameModel->translations()->where('lang_id', '=', $lang['id'])->first();
        }

        $this->layout->content = View::make('back/quiz/answer/edit')
            ->with('item', $item)
            ->with('name', $nameModel)
            ->with('translations', $translations);
    }

    public function getAnswerDelete()
    {
        $id = (int) $this->getRequestParam('id') ?: null;

        QuizAnswerModel::destroy($id);

        Message::instance()->success('Quiz Answer has successfully deleted');
        Uri::to('/Admin/Quiz/List');
    }
}