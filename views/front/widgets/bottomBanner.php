<?php
/**
 * Created by PhpStorm.
 * User: Arsen
 * Date: 11/6/2015
 * Time: 3:20 PM
 */

use Helpers\Uri;
use Ivliev\Imagefly\Imagefly;

?>
<div>
    <div class="container_bottom_images_wrapper">
        <a href="https://twitter.com/banantsfc/" target="_blank">
            <img src="<?=Imagefly::imagePath('/media/assets/images/twitter_logo.jpg', 'w315-q52')?>" alt="advertisment">
        </a>
    </div>
    <div class="container_bottom_images_wrapper">
        <a href="https://www.facebook.com/fcbanantsyerevan/" target="_blank">
            <img src="<?=Imagefly::imagePath('/media/assets/images/facebook-logo.jpg', 'w315-q52')?>" alt="advertisment">
        </a>
    </div>
    <div class="container_bottom_images_wrapper">
        <a href="<?=Uri::makeUriFromId('sport_cafe')?>" target="_blank">
            <img src="<?=Imagefly::imagePath('/uploads/images/cafe/sport-cafe.jpg', 'w280-q52')?>" alt="advertisment">
        </a>
    </div>
    <div class="container_bottom_images_wrapper">
        <a href="http://www.horizondvp.com/" target="_blank">
            <img src="<?=Imagefly::imagePath('/uploads/images/banners/sunrise-logo.jpg', 'w252-q52')?>" alt="advertisment">
        </a>
    </div>
</div>