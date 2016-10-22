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
use PhotoModel;

class Server extends Back
{

    public function __construct(array $requestParams)
    {
        parent::__construct($requestParams);
//        WidgetsContainer::instance();
    }

    /**
     * Получает картинки
     */
    public function getPhotos()
    {
        $this->layout = null;

        // todo: poxel vor amen article kcva& nkarner@ cuyc ta
        $photos = PhotoModel::orderBy('created_at', 'DESC')->paginate(12);

        echo View::make('back/server/photoPaginate')
            ->with('photos', $photos);
    }

    /**
     * Получает картинки
     */
    public function getPhotosForGallery()
    {
        $this->layout = null;

        $photos = PhotoModel::orderBy('created_at', 'DESC')->paginate(21);

        echo View::make('back/server/photoGalleryPaginate')
            ->with('photos', $photos);
    }
}