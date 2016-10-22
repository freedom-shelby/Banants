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

<div class="container_top_slideshow content_middle_right_slideshow clearfix">
    <div class="item">
        <a href="<?=Uri::makeUriFromId('academy_squads')?>" title="slideshow_images" rel="gallary_d">
            <img src="<?=Imagefly::imagePath('/uploads/images/academy/capello2.jpg', 'w521-q52')?>" alt="container_top_slideshow_images" />
            <div class="container_top_slider_text">
                <div class="container_top_slider_text_inner">
                    <?= __('Academy News') ?>
                    <br>
                </div>
            </div>
        </a>
    </div>
</div>