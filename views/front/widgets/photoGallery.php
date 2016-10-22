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
    <span class="photogalery_link"><a href="https://www.flickr.com/photos/133834241@N06/albums"><?= __('Photo Gallery') ?></a></span>
</div>