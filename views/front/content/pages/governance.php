<?php
/**
 * Created by PhpStorm.
 * User: Arsen
 * Date: 11/6/2015
 * Time: 3:20 PM
 *
 * @var $title string
 */
?>

<div class="inner_content_wrapper management_page">
    <div class="inner_content clearfix">
        <h1><strong><?= __('BANANTS MANAGEMENT') ?></strong></h1>

        <? if ($items->count()): ?>
            <? foreach ($items as $item): ?>
                <div class="manager_info clearfix">
                    <div class="manager-portrait">
                        <a class="fancybox" title="<?= __($item->fullName())?>" href="<?= __($item->defaultImage()->path)?>" rel="gallary_p">
                            <img class="image" src="<?= __($item->defaultImage()->path)?>" alt="<?= __($item->fullName())?>" />
                        </a>
                    </div>
                    <div class="info_text">
                        <h3><?= __($item->fullName())?></h3>
                        <p class="position"><em><?= __($item->specialization()->text()) ?></em></p>
                        <p><?= $item->was_born->format('d.m.Y') ?></p>
                    </div>
                </div>
            <? endforeach ?>
        <? endif ?>

    </div>
</div>