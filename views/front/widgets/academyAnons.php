<?php
/**
 * Created by PhpStorm.
 * User: Arsen
 * Date: 11/6/2015
 * Time: 3:20 PM
 */

use \Helpers\Uri;
use Ivliev\Imagefly\Imagefly;

?>

<div class="academy-anons">
    <a href="<?=Uri::makeUriFromId('academy_squads')?>" title="slideshow_image" rel="gallary">
        <img src="<?=Imagefly::imagePath('/uploads/images/academy/29184326872_e104f290e6_k.jpg', 'w445-h349-c-q60')?>" alt="container_top_slideshow_images" />
        <div class="container_top_slider_text">
            <div class="container_top_slider_text_inner">
                <?= __('Academy') ?>
                <br>
            </div>
        </div>
    </a>
</div>