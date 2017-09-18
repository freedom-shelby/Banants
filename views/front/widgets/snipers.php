<?php
/**
 * Created by PhpStorm.
 * User: Arsen
 * Date: 11/6/2015
 * Time: 3:20 PM
 */

use Ivliev\Imagefly\Imagefly;
use Helpers\Uri;
?>
<div class="widget-snipers">
    <div class="tournament_slider_title_wrapper clearfix">
        <div class="tournament_slider_title">
            <span class="tournament_slider_title_text"><?=__('TOP SCORERS')?></span>
    <!--        <span class="tournament_slider_prev">--><?//=__('PASSES')?><!--</span>-->
    <!--        <span class="tournament_slider_next">--><?//=__('GOAL+PASS')?><!--</span>-->
    <!--        <span class="tournament_slider_next">--><?//=__('PLAYING TIME')?><!--</span>-->
        </div>
    </div>
    <div class="shooter_slider clearfix">
        <div class="shooter_slider_item">
            <div class="best_player clearfix">
                <div class="best_player_content">
                    <h3><?=__('Norayr')?> <?=__('Gyozalyan')?></h3>
                    <div class="best_player_images_wrapper">
                        <img src="/uploads/tmp/armenian-flag.jpg" class="sb-back-flag" alt="best_player" />
                        <img src="<?= Imagefly::imagePath('/uploads/images/players/598862a2570d1.png', 'w100-q70')?>" class="sb-front-player" alt="best_player" />
                        <div class="cylinder"></div>
                    </div>
                    <div class="best_player_right">
                        <div class="best_player_info">
                            <span> <?=__('Age')?> 27<br> <?=__('Goals')?> 3</span>
                        </div>
                        <div class="best_player_multiple">
                            <a class="" href="<?= Uri::makeUriFromId('players/' . 'norayr-_gyozalyan_10') ?>"><span class="icon-cal2 shooter_icons"></span></a>
                            <!--                            <a class="" href="#"><span class="icon-photo_hover shooter_icons"></span></a>-->
                            <!--                            <a class="" href="#"><span class="icon-video_hover shooter_icons"></span></a>-->
                        </div>
                    </div>
                </div>
            </div>
            <div class="best_player clearfix">
                <div class="best_player_content">
                    <h3><?=__('Rumyan')?> <?=__('Hovsepyan')?></h3>
                    <div class="best_player_images_wrapper">
                        <img src="/uploads/images/background_flags/armenian-flag.jpg" class="sb-back-flag" alt="best_player" />
                        <img src="<?= Imagefly::imagePath('/uploads/images/players/59885de3beedd.png', 'w100-q70')?>" class="sb-front-player" alt="best_player" />
                        <div class="cylinder"></div>
                    </div>
                    <div class="best_player_right">
                        <div class="best_player_info">
                            <span> <?=__('Age')?> 25<br> <?=__('Goals')?> 2</span>
                        </div>
                        <div class="best_player_multiple">
                            <a class="" href="<?= Uri::makeUriFromId('players/' . 'rumyan_hovsepyan_8') ?>"><span class="icon-cal2 shooter_icons"></span></a>
                            <!--                            <a class="" href="#"><span class="icon-photo_hover shooter_icons"></span></a>-->
                            <!--                            <a class="" href="#"><span class="icon-video_hover shooter_icons"></span></a>-->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <!--    <div class="shooter_slider_item">-->
    <!--        <div class="best_player clearfix">-->
    <!--            <div class="best_player_content">-->
    <!---->
    <!--            </div>-->
    <!--        </div>-->
    <!--        <div class="best_player clearfix">-->
    <!--            <div class="best_player_content">-->
    <!---->
    <!--            </div>-->
    <!--        </div>-->
    <!--    </div>-->
    </div>
</div>