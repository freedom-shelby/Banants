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
                            <a href="<?= Uri::makeUriFromId('photo_gallery/' . $item->slug) ?>" title="<?= $item->text() ?>">
                                <img class="photo-gallery-image" src="<?= Imagefly::imagePath($item->defaultImage()->path, 'w280-q52') ?>" alt="<?= $item->text() ?>">
                            </a>
                        </div>
                    <? endforeach ?>

                </div>
            <? endforeach ?>
        <? endif ?>

    </div>
    <span class="photogalery_link"><a href="<?= Uri::makeUriFromId('photos') ?>"><?= __('Photo Gallery') ?></a></span>
</div>