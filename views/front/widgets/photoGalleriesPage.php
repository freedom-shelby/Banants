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
        <div class="clearfix">
            <h3><strong><?= __('PHOTO GALLERY')?></strong></h3>

            <? if (isset($items)): ?>
                <? foreach ($items as $item): ?>

                    <div class="photo-galleries-item">
                        <div class="leftbar_images_slider_wrapper">
                            <a href="<?= Uri::makeUriFromId('photo_gallery/' . $item->slug) ?>"><div class="h3"><?= __($item->text())?></div></a>
                            <div class="leftbar_images_slider clearfix">
                                <div class="leftbar_images_slider_item">

                                    <? foreach ($item->demoImages() as $key => $i): ?>
                                        <div class="leftbar_slider_images leftbar_slider_image_<?= $key%3 + 1 ?>">
                                            <a class="fancybox" href="<?= $i->path?>" title="FC Banants" rel="gallary_g">
                                                <img class="photo-gallery-image" src="<?= Imagefly::imagePath($i->path, 'w280-q52') ?>" alt="leftbar_images_slider_images">
                                            </a>
                                        </div>
                                    <? endforeach ?>

                                </div>
                            </div>
                            <span class="photo-galery-link"><a href="<?= Uri::makeUriFromId('gallery/' . $item->slug) ?>"><?= __('Show More')?> >> </a></span>
                        </div>
                    </div>

                <? endforeach ?>
            <? endif ?>

        </div>
    </div>
</div>