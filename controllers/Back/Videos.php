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
use View;
use Message;
use Helpers\Arr;
use Illuminate\Contracts\Validation;
use VideoModel;
use Illuminate\Database\Capsule\Manager as Capsule;
use Exception;


class Videos extends Back
{
    /**
     * Добавления материалов
     */
    public function anyAdd()
    {
        if (Arr::get($this->getPostData(), 'submit') !== null) {

            $data = Arr::extract($this->getPostData(), ['youtube_id']);

            try {
                // Транзакция для Записание данных в базу
                Capsule::connection()->transaction(function () use ($data) {
                    VideoModel::create([
                        'youtube_id' => $data['youtube_id'],
                    ]);
                });

                Message::instance()->success('Video has successfully added');

            } catch (Exception $e) {
                Message::instance()->warning('Video has don\'t added');
            }
        }

        $this->layout->content = View::make('back/videos/add');
    }
}