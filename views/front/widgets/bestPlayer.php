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
<div class="best_player">
    <div class="best_player_title">
        <h2><?= $title ?></h2>
    </div>
    <div class="best_player_content">
        <h3><?= $item->player()->fullName() ?></h3>
        <div class="best_player_images_wrapper">
            <a href="<?= Uri::makeUriFromId('players/' . $item->player()->slug) ?>">
                <img src="<?= $item->player()->country()->background_flag ?>" class="sb-back-flag" alt="<?= $item->player()->country()->title() ?>" />
                <img src="<?= Imagefly::imagePath($item->player()->defaultImage()->path, 'w100-q70')?>" class="sb-front-player" alt="<?= $item->player()->fullName() ?>" />
                <div class="cylinder"></div>
            </a>
        </div>
        <div class="best_player_right">
            <div class="best_player_info">
                <span><?=__('Instat Index')?> <?= $item->instat_index ?><br> <?=__('Goals')?> <?= $item->goals ?><br> <?=__('Shots')?> <?= $item->shots ?></span>
<!--                <span class="best-player-goalkeeper">--><?//=__('Saves')?><!-- 2<br> --><?//=__('Passes')?><!-- 62 (87 %)<br> --><?//=__('Fight in the air')?><!-- 2 (100 %)</span>-->
            </div>
            <div class="best_player_multiple clearfix">
                <a class="" href="<?= Uri::makeUriFromId('players/' . $item->player()->slug) ?>"><span class="icon-cal2 shooter_icons"></span></a>
<!--                <a class="" href="#"><span class="icon-photo_hover shooter_icons"></span></a>-->
<!--                <a class="" href="#"><span class="icon-video_hover shooter_icons"></span></a>-->
            </div>
        </div>
    </div>
</div>