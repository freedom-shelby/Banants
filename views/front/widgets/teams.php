<?php
/**
 *
 * Created by PhpStorm.
 * User: Arsen
 * Date: 11/6/2015
 * Time: 3:20 PM
 *
 * @var $team \Football\Team
 * @var $item \Football\Player
 */

use Helpers\Uri;
use Ivliev\Imagefly\Imagefly;

//todo: Надо включить сортировку
?>

<? if ($team->hasBanner()): ?>
    <div class="inner_content_wrapper">
        <div class="inner_content">
            <div class="team_wrapper">
                <div>
                    <div class="photo_wrapper" style="width: 100%;">
                        <a class="fancybox" title="<?= __($team->getTitle()) ?>" href="<?= $team->getBanner()->path ?>" rel="gallary_p">
                            <img style="width: 100%;" src="<?= $team->getBanner()->path ?>" alt="<?= __($team->getTitle()) ?>" />
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
<? endif ?>

<h1 class="news_slider_item_text"><?= __($team->getTitle()) ?></h1>
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

                        <? foreach ($team->getPlayers() as $item): ?>
                            <a href="<?= Uri::makeUriFromId($item->getSlug()) ?>">
                                <div class="team_item">
                                    <div class="team_item_header">
                                        <div class="team_item_header_top"></div>
                                        <div class="team_item_header_bottom"></div>
                                    </div>
                                    <div class="team_item_images pictures_wrapper">
                                        <img class="flag_icon" src="<?= $item->getCountry()->flag ?>" alt="flag">
                                        <div class="player_number"><?= $item->getNumber() ?></div>
                                        <div class="player_wrapper">
                                            <img src="<?= Imagefly::imagePath($item->getDefaultImage(), 'w140-q52') ?>" alt="<?= __($item->getFullName() ) ?>">
                                        </div>
                                    </div>
                                    <div class="team_item_title">
                                        <h3><?= __($item->getFullName()) ?></h3>
                                    </div>
                                    <div class="team_item_bottom">
                                        <div class="team_item_footer_top"></div>
                                        <div class="team_item_footer_bottom"></div>
                                        <div class="team_item_footer_desc">
                                            <h4><?= __($item->getPosition()->title()) ?></h4>
                                            <img src="<?= $item->getPosition()->icon?>" alt="<?= __($item->getPosition()->title() )?>">
                                        </div>
                                    </div>
                                </div>
                            </a>
                        <? endforeach ?>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>