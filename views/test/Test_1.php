<div class="infrastruct_slider clearfix">
    <div class=infrastruct_slider_item">
        <div class="infrastruct_slider_list clearfix">
            <a href="<?= Uri::makeUriFromId($item->slug) ?>">
                <div class="news_list_images">
                    <img src="<?= Imagefly::imagePath($item->defaultImage()->path, 'w176-q52') ?>" alt="news_list_images" />
                </div>
            </a>
        </div>
    </div>
</div>

