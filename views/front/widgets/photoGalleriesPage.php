<?php
/**
 * Created by PhpStorm.
 * User: Arsen
 * Date: 11/6/2015
 * Time: 3:20 PM
 *
 * @var $items \Illuminate\Pagination\Paginator
 * @var $item PhotoGalleryModel
 */

use Ivliev\Imagefly\Imagefly;
use Helpers\Uri;
use Illuminate\Pagination\LengthAwarePaginator;


?>

<? if ($items instanceof LengthAwarePaginator): ?>
    <div class="inner_content_wrapper">
        <div class="inner_content">
            <div class="clearfix">
                <h1>
                    <strong><?= __('Photo Gallery')?></strong>
                </h1>

                <? foreach ($items->getCollection()->all() as $item): ?>

                    <div class="photo-galleries-item">
                        <div class="photo-gallery-item">
                            <div class="header">
                                <a href="<?= Uri::makeUriFromId('photo_gallery/' . $item->slug) ?>">
                                    <div class="h3">
                                        <?= __($item->text())?>
                                    </div>
                                </a>
                            </div>
                            <div class="leftbar_images_slider clearfix">
                                <div class="leftbar_images_slider_item">

                                    <? foreach ($item->demoImages() as $key => $i): ?>
                                        <div class="leftbar_slider_images leftbar_slider_image_<?= $key%3 + 1 ?>">
                                            <a class="fancybox" href="<?= $i->path?>" title="<?= $item->text() ?>" rel="gallary_g">
                                                <img class="photo-gallery-image" src="<?= Imagefly::imagePath($i->path, 'w280-q52') ?>" alt="<?= $item->text() ?>">
                                            </a>
                                        </div>
                                    <? endforeach ?>

                                </div>
                            </div>
                            <span class="photo-galery-link">
                                <a href="<?= Uri::makeUriFromId('photo_gallery/' . $item->slug) ?>"><?= __('Show More')?> >> </a>
                            </span>
                        </div>
                    </div>

                <? endforeach ?>

            </div>
        </div>

        <?= $items->render() ?>

    </div>
<? endif ?>
