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
use Helpers\Arr;
use Illuminate\Contracts\Validation;
use VideoModel;
use Illuminate\Database\Capsule\Manager as Capsule;
use Exception;
use Http\Exception as HttpException;


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

    public function getList()
    {
        $items = VideoModel::orderBy('created_at', 'desc')->get();

        $this->layout->content = View::make('back/videos/list')
            ->with('items', $items);
    }

    public function getDelete()
    {
        $this->layout = false;

        $id = (int) $this->getRequestParam('id') ?: null;

        $item = VideoModel::find($id);

        if (empty($item)) {
            throw new HttpException(404,json_encode(['errorMessage' => 'Incorrect Video']));
        }

        // Транзакция для Записание данных в базу
        Capsule::connection()->transaction(function() use ($item)
        {
            $item->delete();
        });

        Message::instance()->success('Video has successfully deleted');

        Uri::to('/Admin/Videos/List');
    }
}