<?php
/**
 * Created by SUR-SER.
 * User: SURO
 * Date: 02.09.2015
 * Time: 16:24
 */

namespace Test;

use Intervention\Image\ImageManagerStatic as Image;

class Imagefly extends \Controller
{
    public function getImageTest(){
        $this->layout = null;
        $imagePath = $this->getRequestParam('imagePath');

        $img = Image::cache(function($image) use ($imagePath){
            $image->make($imagePath)->fit(140)->encode(null, 52);
//            $image->make($imagePath)->resize(300)->encode(null, 52);
        }, 12000, true);

        echo $img->response();
    }

    public function getTest2(){
        $this->layout = null;

        $img = Image::cache(function($image) {
            $image->make('5721fc06d139a.jpg')->fit(140)->encode(null, 52);
//            $image->make('5721fc06d139a.jpg')->resize(300)->encode(null, 52);
        }, 12000, true);

//        $img = Image::make('5721fc06d139a.jpg')->resize(300, 300)->greyscale();


//        $img = Image::make('5721fc06d139a.jpg')->crop(300, 300, 200, 600);
//        $img = Image::make('5721fc06d139a.jpg')->fit(400, 200);

//        echo $img->response(null, 10);
//        echo $img->fit(100,100)->response(null, 52);
        echo $img->response();

//        echo "<pre>";
//        print_r($img);
//        die;
    }

    public function getTest3(){
        $this->layout = null;

        $img = Image::make('5721fc06d139a.jpg');

//        $img = Image::make('5721fc06d139a.jpg')->resize(300, 300)->greyscale();


//        $img = Image::make('5721fc06d139a.jpg')->crop(300, 300, 200, 600);
//        $img = Image::make('5721fc06d139a.jpg')->fit(400, 200);

        echo $img->resize(300, 300)->response(null, 52);
    }
}