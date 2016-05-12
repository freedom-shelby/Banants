<?php
namespace Ivliev\Imagefly;

use Controller;
use Ivliev\Imagefly\Imagefly;


class ImageflyController extends Controller
{

    /*
     * |--------------------------------------------------------------------------
     * | Imagefly Controller
     * |--------------------------------------------------------------------------
     * |
     * |
     */
    public function getIndex()
    {
        // Get values from request
        $params = $this->getRequestParam('params');
        $imagePath = $this->getRequestParam('imagePath');
        new Imagefly($params, $imagePath);
    }
}