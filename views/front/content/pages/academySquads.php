<?php
/**
 * Created by PhpStorm.
 * User: Arsen
 * Date: 11/6/2015
 * Time: 3:20 PM
 *
 * @var $title string
 */

use Helpers\Uri;
?>

<div class="inner_content_wrapper">
    <div class="inner_content clearfix">
        <h1><strong><?= __('BANANTS ACADEMY TEAMS') ?></strong></h1>
        <div class="team_container clearfix">
            <div class="team_wrapper_body clearfix">

                <? if ($items->count()): ?>
                    <? foreach ($items as $item): ?>
                        <? if ($item->hasBanner()): ?>
                            <div class="team_wrapper">
                                <a href="<?= Uri::makeUrl($item->article()->slug) ?>"><h3><?= __($item->text())?></h3></a>
                                <div>
                                    <div class="photo_wrapper" style="width: 313px;">
                                        <a class="fancybox" title="<?= __($item->text())?>" href="<?= __($item->defaultBanner()->path)?>" rel="gallary_p">
                                            <img style="width: 313px;" src="<?= __($item->defaultBanner()->path)?>" alt="<?= __($item->text())?>" height="168"/>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        <? endif ?>
                    <? endforeach ?>
                <? endif ?>

            </div>
        </div>
    </div>
</div>