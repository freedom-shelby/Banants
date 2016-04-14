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
                        ПЮНИК - БАНАНЦ 1:2 <br> (ФОТО И ВИДЕО)
                    </div>
                </div><!-- container_top_slider_text -->
            </a>
        </div><!--item-->
    <? endforeach ?>
<!--    <div class="item">-->
<!--        <a href="/pyunik_banants_03_02_16.html" title="slideshow_images" rel="gallery">-->
<!--            <img src="/uploads/images/pyunik_banants/25415800476_778949c3d9_o_2.jpg" alt="slideshow_images" />-->
<!--            <div class="container_top_slider_text">-->
<!--                <div class="container_top_slider_text_inner">-->
<!--                    ПЮНИК - БАНАНЦ 1:2 <br> (ФОТО И ВИДЕО)-->
<!--                </div>-->
<!--            </div>-->
<!--        </a>-->
<!--    </div>-->
<!--    <div class="item">-->
<!--        <a href="/ararat_ulis_03_12_15.html" title="slideshow_images" rel="gallery">-->
<!--            <img src="/uploads/images/ararat_banants/0e09527b0f5edaa60cf5702119e6a0a2_L.jpg" alt="slideshow_images" />-->
<!--            <div class="container_top_slider_text">-->
<!--                <div class="container_top_slider_text_inner">-->
<!--                    Фоторепортаж матча <br>Арарат - Улисс-->
<!--                </div>-->
<!--            </div>-->
<!--        </a>-->
<!--    </div>-->
<!--    <div class="item">-->
<!--        <a href="/banants_nachal_god_s_kruponoj_pobedoj.html" title="slideshow_images" rel="gallery">-->
<!--            <img src="/uploads/images/banants_nachal_god_s_kruponoj_pobedoj/8f704c6e91e045c72378c71d940a59ce_XL.jpg" alt="slideshow_images" />-->
<!--            <div class="container_top_slider_text">-->
<!--                <div class="container_top_slider_text_inner">-->
<!--                    "Бананц" начал год <br> с крупной победой-->
<!--                </div>-->
<!--            </div>-->
<!--        </a>-->
<!--    </div>-->
    <!--                            <div class="item">-->
    <!--                                <a href="/pyunik_banants_03_02_16.html" title="slideshow_images" rel="gallery">-->
    <!--                                    <img src="/media/assets/images/container_top_slideshow_images1.jpg" alt="slideshow_images" />-->
    <!--                                </a>-->
    <!--                                <div class="container_top_slider_text">-->
    <!--                                    <div class="container_top_slider_text_inner">-->
    <!--                                        Нвероятный ГОЛ<br> Мовсисяна потряс<br> ПУБЛИКУ!-->
    <!--                                    </div>-->
    <!--                                </div><!-- container_top_slider_text -->
    <!--                            </div><!--item-->
</div><!-- container_top_slideshow -->