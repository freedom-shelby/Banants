<?php
/**
 * Created by PhpStorm.
 * User: Rob
 * Date: 11/6/2015
 * Time: 3:20 PM
 */

use Helpers\Uri;
use Ivliev\Imagefly\Imagefly;

?>

<div class="news_wrapper">
    <div class="news_item clearfix">
        <a href="<?=Uri::makeUriFromId('article_roman_about_cup')?>">
            <div class="news_item_images">
                <img src="<?=Imagefly::imagePath('/uploads/images/news_6/romanasxabadze.jpg', 'w90-c-q52')?>" alt="news_item_images" />
            </div><!-- news_item_images -->
            <div class="news_item_info">
                <span>
                    <?=__('topNews1')?>
                </span>
            </div><!-- news_item_info -->
        </a>
    </div><!-- news_item -->
    <div class="news_item news_item_active clearfix">
        <a href="<?=Uri::makeUriFromId('article_banants_pyunik_1_1')?>">
            <div class="news_item_images">
                <img src="<?=Imagefly::imagePath('/uploads/images/news2/03.jpg', 'w90-c-q52')?>" alt="news_item_images" />
            </div><!-- news_item_images -->
            <div class="news_item_info">
                <span>
                    <?=__('topNews2')?>
                </span>
            </div><!-- news_item_info -->
        </a>
    </div><!-- news_item -->
</div><!-- news_wrapper -->