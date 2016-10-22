<?php
/**
 * Created by PhpStorm.
 * User: Arsen
 * Date: 11/6/2015
 * Time: 3:20 PM
 */
?>


<div class="content_middle_slider_wrapper module_style clearfix">
    <div class="content_middle_slider">

        <? if (isset($items)): ?>
            <? foreach ($items as $data): ?>
                <div class="content_middle_slider_item">

                    <? foreach ($data as $key => $item): ?>
                        <div class="content_slider_images content_middle_image_<?= $key%4 + 1 ?>">
                            <div class="videoimage_wrapper">
                                <a class="various fancybox.iframe" href="http://www.youtube.com/embed/<?= $item['youtube_id'] ?>?autoplay=1">
                                    <img class="video-images image" src="http://img.youtube.com/vi/<?= $item['youtube_id'] ?>/mqdefault.jpg" alt="content_slider_middle_images1">
                                    <img class="videoplayer_icon" src="/media/assets/images/videoplayer_icon.png" alt="videoplayer_icon">
                                </a>
                            </div>
                        </div>
                    <? endforeach ?>

                </div>
            <? endforeach ?>
        <? endif ?>

    </div>
    <span class="all_news_link"><a href="#"><?= __('Video archive. The best moments.') ?></a></span>
</div><!-- leftbar_images_slider_wrapper -->