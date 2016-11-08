<?php
/**
 * Created by PhpStorm.
 * User: Arsen
 * Date: 11/6/2015
 * Time: 3:20 PM
 */

use Helpers\Uri;
use Helpers\Strings;
use Ivliev\Imagefly\Imagefly;

//todo: Нужен функционал для сколко раз смотрели
?>

<div class="news_slider_wrapper clearfix">
    <div class="news_slider homepage clearfix">

        <? foreach($items as $data): ?>
            <div class="news_slider_item">

                <? foreach($data as $item): ?>
                    <div class="news_list clearfix">
                        <a href="<?= Uri::makeUriFromId($item->slug) ?>">
                            <div class="news_list_images">
                                <img src="<?= Imagefly::imagePath($item->defaultImage()->path, 'w176-q52') ?>" alt="news_list_images" />
                            </div>
                            <div class="news_list_info">
                                <h3><?= $item->title ?></h3>
                                <div class="news_list_middle">
                                    <span><?= __(':dayth of :month', [':month' => __($item->created_at->format('F')), ':day' => $item->created_at->format('j'),]) ?></span>
                                    <span class="news_list_watch">
                                        <span><i class="watch_icon"></i><?= rand(1, 100) ?></span>
                                    </span>
                                </div>
                                <span>

                                    <?= Strings::limitWords($item->desc, 20) ?>...

                                </span>
                            </div>
                        </a>
                    </div>
                <? endforeach ?>

            </div>
        <? endforeach ?>

    </div>
    <span class="all_news_link"><a href="<?= Uri::makeUriFromId('/club_news') ?>"><?=  __('View all news')  ?></a></span>
</div>