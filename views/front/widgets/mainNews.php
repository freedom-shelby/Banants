<?php
/**
 * Created by PhpStorm.
 * User: Rob
 * Date: 11/6/2015
 * Time: 3:20 PM
 */

use Helpers\Uri;
use Helpers\Strings;
use Ivliev\Imagefly\Imagefly;

//todo: Дату Матеряла вывадить при помоши Carbon -а
//todo: Нужен функционал для сколко раз смотрели
?>

<div class="news_slider_wrapper clearfix">
    <div class="news_slider homepage clearfix">

        <?foreach($items as $data):?>
            <div class="news_slider_item">

                <?foreach($data as $item):?>
                    <div class="news_list clearfix">
                        <a href="<?=Uri::makeUriFromId($item->slug)?>">
                            <div class="news_list_images">
                                <img src="<?=Imagefly::imagePath($item->defaultImage()->path, 'w138-q52')?>" alt="news_list_images" />
                            </div><!-- news_list_images -->
                            <div class="news_list_info">
                                <h3><?=$item->title?></h3>
                                <div class="news_list_middle">
                                    <span>17:46 Сегодня</span>
                                    <span class="news_list_watch">
                                        <span><i class="watch_icon"></i><?=rand(1, 50)?></span>
                                    </span><!-- news_list_watch -->
                                </div><!-- news_list_middle -->
                                <span>

                                    <?=Strings::limitWords($item->desc, 20)?>...

                                </span>
                            </div><!-- news_list_info -->
                        </a>
                    </div><!-- news_list -->
                <?endforeach?>

            </div><!-- news_slider_item -->
        <?endforeach?>

    </div><!-- news_slider -->
    <span class="all_news_link"><a href="<?=Uri::makeUriFromId('/club_news')?>">Посмотреть все новости</a></span>
</div>