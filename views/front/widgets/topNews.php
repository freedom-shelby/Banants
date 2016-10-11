<?php
/**
 * Created by PhpStorm.
 * User: Arsen
 * Date: 11/6/2015
 * Time: 3:20 PM
 */

use Helpers\Uri;
use Ivliev\Imagefly\Imagefly;

?>

<div class="news_wrapper">

    <?foreach($items as $item):?>
        <div class="news_item clearfix">
            <a href="<?=Uri::makeUriFromId($item->slug)?>">
                <div class="news_item_images">
                    <img src="<?=Imagefly::imagePath($item->defaultImage()->path, 'h100-c-q52')?>" alt="news_item_images" />
                </div><!-- news_item_images -->
                <div class="news_item_info">
                <span>
                    <?=$item->title?>
                </span>
                </div><!-- news_item_info -->
            </a>
        </div><!-- news_item -->
    <?endforeach?>
</div><!-- news_wrapper -->
