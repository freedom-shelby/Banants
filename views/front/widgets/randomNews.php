<?php
/**
 * Created by PhpStorm.
 * User: Rob
 * Date: 11/6/2015
 * Time: 3:20 PM
 */

use Helpers\Uri;
use Ivliev\Imagefly\Imagefly;

?>

<div class="carousel_slider_wrapper clearfix">
    <div class="carousel_slider">

        <?foreach($items as $item):?>
            <div class="carousel_slider_item">
                <a class="fancybox" href="<?=Uri::makeUriFromId($item->slug)?>" title="slideshow_images" rel="gallary_b">
                    <div class="carousel_slider_images">
                        <img src="<?=Imagefly::imagePath($item->defaultImage()->path, 'w140-q52')?>" alt="carousel_images" />
                    </div><!-- carousel_slider_images -->
                    <div class="carousel_slider_info">
                        <span><?=$item->title?></span>
                    </div>
                </a>
            </div><!-- carousel_slider_item -->
        <?endforeach?>

    </div><!-- carousel_slider -->
    <span class="all_news_link"><a href="<?=Uri::makeUriFromId('Club')?>">Перейти к новостям клуба</a></span>
</div>