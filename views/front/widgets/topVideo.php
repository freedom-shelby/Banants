<?php
/**
 * Created by PhpStorm.
 * User: Arsen
 * Date: 11/6/2015
 * Time: 3:20 PM
 */
?>

<? if (isset($item)): ?>
    <div class="video_wrapper">
        <div class="videoimage_wrapper">
            <a class="various fancybox.iframe" href="https://www.youtube.com/embed/<?= $item->youtube_id ?>?autoplay=1">
                <img src="http://img.youtube.com/vi/<?= $item->youtube_id ?>/mqdefault.jpg" alt="video_image">
                <img class="videoplayer_icon" src="/media/assets/images/videoplayer_icon.png" alt="videoplayer_icon">
            </a>
        </div>
        <span></span>
    </div>
<? else: ?>
    <div class="video_wrapper">
        <div class="videoimage_wrapper">
            <a class="various fancybox.iframe" href="https://www.youtube.com/embed/BPmM838v1PY?autoplay=1">
                <img src="http://img.youtube.com/vi/BPmM838v1PY/mqdefault.jpg" alt="video_image">
                <img class="videoplayer_icon" src="/media/assets/images/videoplayer_icon.png" alt="videoplayer_icon">
            </a>
        </div>
        <span></span>
    </div>
<? endif ?>

