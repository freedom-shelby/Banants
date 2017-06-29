<?php
/**
 *
 * Created by PhpStorm.
 * User: Arsen
 * Date: 11/6/2015
 * Time: 3:20 PM
 */

use Helpers\Uri;
use Ivliev\Imagefly\Imagefly;

?>

<div class="container_top_slideshow anons-widget clearfix">
    <? foreach ($items as $item):?>
        <div class="item">
            <a href="<?=Uri::makeUriFromId($item->slug)?>" title="<?=$item->title?>" rel="gallery">
                <img src="<?=Imagefly::imagePath($item->defaultImage()->path, 'w720-q100')?>" alt="<?=$item->title?>" />
                <div class="container_top_slider_text">
                    <div class="container_top_slider_text_inner">
                        <?=$item->title?>
                    </div>
                </div>
            </a>
        </div>
    <? endforeach ?>
</div>