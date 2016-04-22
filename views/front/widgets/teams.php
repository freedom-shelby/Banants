<?php
/**
 *
 * Created by PhpStorm.
 * User: Rob
 * Date: 11/6/2015
 * Time: 3:20 PM
 */

use Helpers\Uri;

?>

<div class="container_top_slideshow clearfix">
    <? foreach ($items as $item):?>
        <div class="item">
            <a href="<?=Uri::makeUriFromId($item->slug)?>" title="slideshow_images" rel="gallery">
                <img src="<?=$item->defaultImage()->path?>" alt="slideshow_images" />
                <div class="container_top_slider_text">
                    <div class="container_top_slider_text_inner">
                        <?=$item->title?>
                    </div>
                </div><!-- container_top_slider_text -->
            </a>
        </div><!--item-->
    <? endforeach ?>
</div><!-- container_top_slideshow -->