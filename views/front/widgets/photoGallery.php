<?php
/**
 * Created by PhpStorm.
 * User: Arsen
 * Date: 11/6/2015
 * Time: 3:20 PM
 */

use Ivliev\Imagefly\Imagefly;
use Helpers\Uri;

?>

<div class="leftbar_images_slider_wrapper">
    <div class="leftbar_images_slider clearfix">

        <? if (isset($items)): ?>
            <? foreach ($items as $data): ?>
                <div class="leftbar_images_slider_item">

                    <? foreach ($data as $key => $item): ?>
                        <div class="leftbar_slider_images leftbar_slider_image_<?= $key%3 + 1 ?>">
                            <a href="<?= Uri::makeUriFromId('photo_gallery/' . $item->slug) ?>" title="FC Banants">
                                <img class="photo-gallery-image" src="<?= Imagefly::imagePath($item->defaultImage()->path, 'w280-q52') ?>" alt="leftbar_images_slider_images">
                            </a>
                        </div>
                    <? endforeach ?>

                </div>
            <? endforeach ?>
        <? endif ?>

    </div>
    <span class="photogalery_link"><a href="https://www.flickr.com/photos/133834241@N06/albums">Фото Галерея</a></span>
</div>

<!--<div class="leftbar_images_slider_wrapper">-->
<!--    <div class="leftbar_images_slider clearfix">-->
<!--        <div class="leftbar_images_slider_item">-->
<!--            <div class="leftbar_slider_images leftbar_slider_image_1">-->
<!--                <a class="fancybox" href="/uploads/images/photoGallery4/28671815913_5c5f049f28_z.jpg" title="FC Banants" rel="gallary_a">-->
<!--                    <img class="photo-gallery-image" src="--><?//=Imagefly::imagePath('/uploads/images/photoGallery4/28671815913_5c5f049f28_z.jpg', 'w280-q52')?><!--" alt="leftbar_images_slider_images">-->
<!--                </a>-->
<!--            </div>-->
<!--            <div class="leftbar_slider_images leftbar_slider_image_2">-->
<!--                <a class="fancybox" href="/uploads/images/photoGallery4/29213968131_5ceb19149a_z.jpg" title="FC Banants" rel="gallary_a">-->
<!--                    <img class="photo-gallery-image" src="--><?//=Imagefly::imagePath('/uploads/images/photoGallery4/29213968131_5ceb19149a_z.jpg', 'w280-q52')?><!--" alt="leftbar_images_slider_images">-->
<!--                </a>-->
<!--            </div>-->
<!--            <div class="leftbar_slider_images leftbar_slider_image_3">-->
<!--                <a class="fancybox" href="/uploads/images/photoGallery4/29213969741_f8f883157a_z.jpg" title="FC Banants" rel="gallary_a">-->
<!--                    <img class="photo-gallery-image" src="--><?//=Imagefly::imagePath('/uploads/images/photoGallery4/29213969741_f8f883157a_z.jpg', 'w280-q52')?><!--" alt="leftbar_images_slider_images">-->
<!--                </a>-->
<!--            </div>-->
<!--        </div>-->
<!--        <div class="leftbar_images_slider_item">-->
<!--            <div class="leftbar_slider_images leftbar_slider_image_1">-->
<!--                <a class="fancybox" href="/uploads/images/photoGallery4/29213972571_80957a5720_z.jpg" title="FC Banants" rel="gallary_a">-->
<!--                    <img class="photo-gallery-image" src="--><?//=Imagefly::imagePath('/uploads/images/photoGallery4/29213972571_80957a5720_z.jpg', 'w280-q52')?><!--" alt="leftbar_images_slider_images">-->
<!--                </a>-->
<!--            </div>-->
<!--            <div class="leftbar_slider_images leftbar_slider_image_2">-->
<!--                <a class="fancybox" href="/uploads/images/photoGallery4/29292562065_a046399515_z.jpg" title="FC Banants" rel="gallary_a">-->
<!--                    <img class="photo-gallery-image" src="--><?//=Imagefly::imagePath('/uploads/images/photoGallery4/29292562065_a046399515_z.jpg', 'w280-q52')?><!--" alt="leftbar_images_slider_images">-->
<!--                </a>-->
<!--            </div>-->
<!--            <div class="leftbar_slider_images leftbar_slider_image_3">-->
<!--                <a class="fancybox" href="/uploads/images/photoGallery4/29292564175_00696335e8_z.jpg" title="FC Banants" rel="gallary_a">-->
<!--                    <img class="photo-gallery-image" src="--><?//=Imagefly::imagePath('/uploads/images/photoGallery4/29292564175_00696335e8_z.jpg', 'w280-q52')?><!--" alt="leftbar_images_slider_images">-->
<!--                </a>-->
<!--            </div>-->
<!--        </div>-->
<!--        <div class="leftbar_images_slider_item">-->
<!--            <div class="leftbar_slider_images leftbar_slider_image_1">-->
<!--                <a class="fancybox" href="/uploads/images/photoGallery4/29292565315_c05df34bdc_z.jpg" title="FC Banants" rel="gallary_a">-->
<!--                    <img class="photo-gallery-image" src="--><?//=Imagefly::imagePath('/uploads/images/photoGallery4/29292565315_c05df34bdc_z.jpg', 'w280-q52')?><!--" alt="leftbar_images_slider_images">-->
<!--                </a>-->
<!--            </div>-->
<!--            <div class="leftbar_slider_images leftbar_slider_image_2">-->
<!--                <a class="fancybox" href="/uploads/images/photoGallery3/27926926981_ac7fb61a02_k.jpg" title="FC Banants" rel="gallary_a">-->
<!--                    <img class="photo-gallery-image" src="--><?//=Imagefly::imagePath('/uploads/images/photoGallery3/27926926981_ac7fb61a02_k.jpg', 'w280-q52')?><!--" alt="leftbar_images_slider_images">-->
<!--                </a>-->
<!--            </div>-->
<!--            <div class="leftbar_slider_images leftbar_slider_image_3">-->
<!--                <a class="fancybox" href="/uploads/images/photoGallery3/27970239566_d2b5c4d797_k.jpg" title="FC Banants" rel="gallary_a">-->
<!--                    <img class="photo-gallery-image" src="--><?//=Imagefly::imagePath('/uploads/images/photoGallery3/27970239566_d2b5c4d797_k.jpg', 'w280-q52')?><!--" alt="leftbar_images_slider_images">-->
<!--                </a>-->
<!--            </div>-->
<!--        </div>-->
<!--        <div class="leftbar_images_slider_item">-->
<!--            <div class="leftbar_slider_images leftbar_slider_image_1">-->
<!--                <a class="fancybox" href="/uploads/images/photoGallery3/27970241626_7f88601f98_k.jpg" title="FC Banants" rel="gallary_a">-->
<!--                    <img class="photo-gallery-image" src="--><?//=Imagefly::imagePath('/uploads/images/photoGallery3/27970241626_7f88601f98_k.jpg', 'w280-q52')?><!--" alt="leftbar_images_slider_images">-->
<!--                </a>-->
<!--            </div>-->
<!--            <div class="leftbar_slider_images leftbar_slider_image_2">-->
<!--                <a class="fancybox" href="/uploads/images/photoGallery3/27970244616_d2171c921c_k.jpg" title="FC Banants" rel="gallary_a">-->
<!--                    <img class="photo-gallery-image" src="--><?//=Imagefly::imagePath('/uploads/images/photoGallery3/27970244616_d2171c921c_k.jpg', 'w280-q52')?><!--" alt="leftbar_images_slider_images">-->
<!--                </a>-->
<!--            </div>-->
<!--            <div class="leftbar_slider_images leftbar_slider_image_3">-->
<!--                <a class="fancybox" href="/uploads/images/photoGallery3/27970245346_2785046b6e_k.jpg" title="FC Banants" rel="gallary_a">-->
<!--                    <img class="photo-gallery-image" src="--><?//=Imagefly::imagePath('/uploads/images/photoGallery3/27970245346_2785046b6e_k.jpg', 'w280-q52')?><!--" alt="leftbar_images_slider_images">-->
<!--                </a>-->
<!--            </div>-->
<!--        </div>-->
<!--    </div>-->
<!--    <span class="photogalery_link"><a href="https://www.flickr.com/photos/133834241@N06/albums">Фото Галерея</a></span>-->
<!--</div>-->