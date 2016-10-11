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
use PhotoModel;
use PhotoGalleryModel;
use Illuminate\Database\Capsule\Manager as Capsule;
use Upload\File as UploadFile;
use Upload\Files as UploadFiles;
use Upload\Storage\FileSystem;
use Upload\Validation\Mimetype as UploadMimeType;
use Upload\Validation\Size as UploadSize;
use Upload\Exception\UploadException;
use Exception;


class Photos extends Back
{
    const IMAGE_PATH = 'uploads/images';

    /**
     * Добавления материалов
     */
    public function anyAdd()
    {
        $selectedGalleryId = 0;
        $items = PhotoGalleryModel::all();

        if (Arr::get($this->getPostData(), 'submit') !== null) {

            $data = Arr::extract($this->getPostData(), ['title', 'desc', 'gallery_id']);

            $selectedGalleryId = $data['gallery_id'];

            try {
                // Транзакция для Записание данных в базу
                Capsule::connection()->transaction(function () use ($data, $selectedGalleryId) {

                    if(is_array($_FILES['image']['name'])) { // Загрузка картинок
                        foreach ($_FILES['image']['name'] as $key => $item) {

                            $images = ['name' => $_FILES['image']['name'][$key], 'error' => $_FILES['image']['error'][$key], 'tmp_name' => $_FILES['image']['tmp_name'][$key]];

                            $file = new UploadFiles($images, new FileSystem(static::IMAGE_PATH)); // todo: Avelacnel tmi annun@

                            // Если не загрузился пропустить
                            if( ! $file->isOk()) continue;

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
                                $model = PhotoModel::create([
                                    'path' => $image,
                                    'title' => $data['title'],
                                    'desc' => $data['desc'],
                                    'is_bound' => 1, // Указивает привязку, стоб не показивал в мести с обычними словами переводов
                                ]);
                            }

                            // Если выбран Галлерия прикрепить к нему
                            if($selectedGalleryId){
                                PhotoGalleryModel::find($selectedGalleryId)->photos()->attach($model);
                            }
                        }
                    } else { // Загрузка картинки
                        $file = new UploadFile('image', new FileSystem(static::IMAGE_PATH)); // todo: Avelacnel tmi annun@

                        // Optionally you can rename the file on upload
                        $file->setName(uniqid());

//                    // Validate file upload
//                    $file->addValidations(array(
//                        // Ensure file is of type image
//                        new UploadMimeType(['image/png', 'image/jpg', 'image/gif']),
//
//                        // Ensure file is no larger than 5M (use "B", "K", M", or "G")
//                        new UploadSize('50M')
//                    ));

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
                            $model = PhotoModel::create([
                                'path' => $image,
                                'title' => $data['title'],
                                'desc' => $data['desc'],
                                'is_bound' => 1, // Указивает привязку, стоб не показивал в мести с обычними словами переводов
                            ]);
                        }

                        // Если выбран Галлерия прикрепить к нему
                        if($selectedGalleryId){
                            PhotoGalleryModel::find($selectedGalleryId)->photos()->attach($model);
                        }
                    }

                });

                Message::instance()->success('Photo has successfully added');

            } catch (Exception $e) {
                Message::instance()->warning('Photo has don\'t added');
            }
        }

        $this->layout->content = View::make('back/photos/add')
            ->with('selectedGalleryId', $selectedGalleryId)
            ->with('items', $items);
    }
}