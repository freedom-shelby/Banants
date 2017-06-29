<?php
/**
 * Created by PhpStorm.
 * User: Arsen
 * Date: 11/6/2015
 * Time: 3:20 PM
 *
 * @var $items array
 * @var $item EventModel
 */

use Ivliev\Imagefly\Imagefly;
use \Helpers\Uri;
use Carbon\Carbon;

?>

<div class="content_top_right_info_blog_wrapper last-match-anons clearfix">

    <? foreach ($items as $item): ?>
        <div class="content_top_right_info_blog clearfix">
            <a href="<?= Uri::makeUriFromId($item->slug()) ?>">
                <div class="content_top_right_info_blog_images">
                    <img src="<?= Imagefly::imagePath($item->defaultImage()->path, 'w135-q52') ?>" alt="<?= __($item->homeTeam()->shortName()) ?> - <?= __($item->awayTeam()->shortName()) ?>" />
                </div>
                <div class="content_top_right_info_blog_aside">
                    <h4>
                        <?= __($item->homeTeam()->shortName()) ?> - <?= __($item->awayTeam()->shortName()) ?>
                        <?= $item->home()->score ?>:<?= $item->away()->score ?>
                    </h4>
                    <span class="small_size_span"><?= __('There was') ?> <?= Carbon::parse($item->played_at)->format('d\\/m\\/Y') ?> <?= __('at') ?> <?= Carbon::parse($item->played_at)->format('H:i') ?></span>
                    <div>
                    <span>
                        <a href="<?= Uri::makeUriFromId($item->slug()) ?>">
                            <span class="icon_hover icon-statistic_hover"></span>
                            <span><?= __('Match stats') ?></span>
                        </a>
                    </span>
                    </div>
<!--                    <div class="photo_video">-->
<!--                    <span>-->
<!--                        <a href="--><?//= Uri::makeUriFromId($item->slug()) ?><!--">-->
<!--                            <span class="icon_hover icon-video_rightbar"></span>-->
<!--                            <span>--><?//= __('Video') ?><!--</span>-->
<!--                        </a>-->
<!--                    </span>-->
<!--                    </div>-->
<!--                    <div class="photo_video">-->
<!--                    <span>-->
<!--                        <a href="--><?//= Uri::makeUriFromId($item->slug()) ?><!--">-->
<!--                            <span class="icon_hover icon-photo_hover"></span>-->
<!--                            <span>--><?//= __('Pictures') ?><!--</span>-->
<!--                        </a>-->
<!--                    </span>-->
<!--                    </div>-->
                </div>
            </a>
        </div>
    <? endforeach ?>

</div>