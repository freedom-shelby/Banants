<div class="inner_content_wrapper">
    <div class="inner_content article photo-gallery">
        <div class="stadion_page">
            <div class="stadion_info clearfix">
                <div class="stadion_info_wrapper">
                    <h3>ՎԻԴԵՈՍՐԱՀ</h3>
                    <div class="content_middle_slider_wrapper module_style clearfix">
                        <div class="content_middle_slider">

                            <? if (isset($items)): ?>
                                <? foreach ($items as $data): ?>
                                    <div class="content_middle_slider_item">

                                        <? foreach ($data as $item): ?>
                                            <div class="content_slider_images ">
                                                <div class="videoimage_wrapper">
                                                    <a class="various fancybox.iframe" href="http://www.youtube.com/embed/<?= $item['youtube_id'] ?>?autoplay=1">
                                                        <img class="video-img" src="http://img.youtube.com/vi/<?= $item['youtube_id'] ?>/0.jpg" alt="1" />
                                                        <img class="videoplayer_icon" src="/media/assets/images/videoplayer_icon.png" alt="videoplayer_icon" />
                                                    </a>
                                                </div>
                                            </div>
                                        <? endforeach ?>

                                    </div>
                                <? endforeach ?>
                            <? endif ?>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>