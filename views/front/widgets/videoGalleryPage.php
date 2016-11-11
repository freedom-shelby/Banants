<?php
/**
 * Created by PhpStorm.
 * User: Arsen
 * Date: 11/6/2015
 * Time: 3:20 PM
 *
 * @var $items \Illuminate\Pagination\Paginator
 * @var $item VideoModel
 */

use Ivliev\Imagefly\Imagefly;
use Helpers\Uri;
use Illuminate\Pagination\LengthAwarePaginator;


?>

<? if ($items instanceof LengthAwarePaginator): ?>
    <div class="inner_content_wrapper">
        <div class="inner_content article photo-gallery">
            <div class="stadion_page">
                <div class="stadion_info clearfix">
                    <div class="stadion_info_wrapper">
                        <h1><?= __('Video Galleries') ?></h1>
                        <div class="content_middle_slider_wrapper module_style clearfix">
                            <div class="content_middle_slider">
                                <div class="content_middle_slider_item">

                                    <? foreach ($items->getCollection()->all() as $item): ?>
                                        <div class="content_slider_images ">
                                            <div class="videoimage_wrapper">
                                                <a class="various fancybox.iframe" href="http://www.youtube.com/embed/<?= $item->youtube_id ?>?autoplay=1">
                                                    <img class="video-img" src="http://img.youtube.com/vi/<?= $item->youtube_id ?>/0.jpg" alt="1" />
                                                    <img class="videoplayer_icon" src="/media/assets/images/videoplayer_icon.png" alt="videoplayer_icon" />
                                                </a>
                                            </div>
                                        </div>
                                    <? endforeach ?>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <?= $items->render() ?>

        </div>
    </div>
<? endif ?>
