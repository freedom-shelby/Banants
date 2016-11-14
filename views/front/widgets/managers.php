<?php
/**
 *
 * Created by PhpStorm.
 * User: Arsen
 * Date: 11/6/2015
 * Time: 3:20 PM
 */

use Helpers\Uri;
use Ivliev\Imagefly\Imagefly;

//todo: Надо включить сортировку
?>

<h1 class="news_slider_item_text"><?= __($title) ?></h1>
<div class="inner_content_wrapper">
    <div class="inner_content">
        <div class="team_wrapper clearfix">
            <div class="team_wrapper_top">
                <span>

                </span>
            </div><!-- team_wrapper_top -->
            <div class="team_wrapper_body clearfix">
                <div id="item_tabs">
<!--                    <ul>-->
<!--                        <li><a href="#item_tabs_list1">--><?//=__('Players')?><!--</a></li>-->
<!--                        <li><a href="#item_tabs_list1">--><?//=__('Goalkeepers')?><!--</a></li>-->
<!--                        <li><a href="#item_tabs_list1">--><?//=__('Defenders')?><!--</a></li>-->
<!--                        <li><a href="#item_tabs_list1">--><?//=__('Midfielders')?><!--</a></li>-->
<!--                        <li><a href="#item_tabs_list1">--><?//=__('Forwards')?><!--</a></li>-->
<!--                    </ul>-->
                    <div id="item_tabs_list1" class="item_tabs_list">

                        <?foreach ($items as $item):?>
                            <div class="team_item">
                                <div class="team_item_images pictures_wrapper">
                                    <img class="flag_icon" src="<?=$item->getCountry()->flag?>" alt="flag">
                                    <div class="player_number"><?=$item->getNumber()?></div>
                                    <div class="player_wrapper">
                                        <img src="<?=Imagefly::imagePath($item->getDefaultImage(), 'w130-q52')?>" alt="player">
                                    </div>
                                </div><!-- team_item_images -->
                                <div class="team_item_title">
                                    <h3><?=__($item->getFullName())?></h3>
                                </div><!-- team_item_title -->
                                <div class="team_item_bottom">
                                    <h4><?=__($item->getPosition()->title())?></h4>
                                    <img src="<?=$item->getPosition()->icon?>" alt="goalkeeper icon">
                                </div><!-- team_item_bottom -->
                            </div><!-- team_item -->
                        <?endforeach ?>

                    </div><!--item_tabs_list1-->
                </div><!--item_tabs-->
            </div><!-- team_wrapper_body -->
        </div><!-- team_wrapper -->
    </div>	<!--inner_content-->
</div>

<div class="inner_content_wrapper coaches">
    <div class="inner_content team_members_1">
        <div class="team_wrapper coaches clearfix">
            <div class="team_wrapper_body clearfix">
                <div id="item_tabs">
                    <div id="item_tabs_list1">

                        <?foreach ($items as $item):?>
                            <div class="team_item">
                                <div class="team_item_images pictures_wrapper">
                                    <img class="flag_icon" src="<?=$item->getCountry()->flag?>" alt="flag">
                                    <div class="player_wrapper">
                                        <img src="<?=$item->getDefaultImage()?>" alt="player">
                                    </div>
                                </div><!-- team_item_images -->
                                <div class="team_item_title">
                                    <h3><?=__($item->getFullName())?></h3>
                                </div><!-- team_item_title -->
                                <div class="team_item_bottom">
                                    <h4><?=__($item->getPosition()->title())?></h4>
                                </div><!-- team_item_bottom -->
                            </div><!-- team_item -->
                        <?endforeach ?>

<!--                        <div class="team_item">-->
<!--                            <div class="team_item_images pictures_wrapper">-->
<!--                                <img class="flag_icon" src="images/flag.jpg" alt="flag" />-->
<!--                                <img src="images/coach4.jpg" alt="player" />-->
<!--                            </div>-->
<!--                            <div class="team_item_title">-->
<!--                                <h3>Тито Ромалио</h3>-->
<!--                            </div>-->
<!--                            <div class="team_item_bottom">-->
<!--                            </div>-->
<!--                        </div>-->
                    </div>
                </div><!--item_tabs-->
            </div><!-- team_wrapper_body -->
        </div><!-- team_wrapper -->
    </div>	<!--inner_content-->
</div>