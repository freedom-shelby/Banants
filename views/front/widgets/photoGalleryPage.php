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

<div class="inner_content_wrapper">
    <div class="inner_content">
        <div class="stadion_page">
            <div class="stadion_info clearfix">
                <div class="stadion_info_wrapper">
                    <h3><a href="#"><strong><?= __($title) ?></strong></a></h3>
                    <div class="leftbar_images_slider_wrapper">
                        <div class="leftbar_images_slider clearfix">

                        <? if (isset($items)): ?>
                            <? foreach ($items as $data): ?>
                                <div class="leftbar_images_slider_item">
                                    <div class="slider clearfix">

                                        <? foreach ($data as $key => $item): ?>
                                            <div class="photo-item">
                                                <a class="fancybox" title="slideshow_images" href="<?= $item['path'] ?>" rel="gallary_b">
                                                    <img class="image" src="<?= Imagefly::imagePath($item['path'], 'w279-h187-q60-c') ?>" alt="Banants Stadium" />
                                                </a>
                                            </div>
                                        <? endforeach ?>

                                    </div>
                                </div>
                            <? endforeach ?>
                        <? endif ?>

                        </div>
                        <span class="photogalery_link"><a href="<?= Uri::makeUriFromId('photos')?>"><?= __('Photo Gallery') ?></a></span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>