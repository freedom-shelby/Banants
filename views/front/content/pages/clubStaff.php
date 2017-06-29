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

<div class="inner_content_wrapper">
    <div class="inner_content">
        <h1><strong><?= __('BANANTS STAFF') ?></strong></h1>
        <div class="daily_news_page">

            <? if ($items->count()): ?>
                <? foreach ($items->chunk(2) as $data): ?>
                    <div class="personal_info clearfix">

                        <? foreach ($data as $item): ?>
                            <div class="person">
                                <div class="person_images_wrapper pictures_wrapper">
                                    <a class="fancybox" title="<?= __($item->fullName())?>" href="<?= __($item->defaultImage()->path)?>" rel="gallary_p">
                                        <img class="image" src="<?= __($item->defaultImage()->path)?>" alt="<?= __($item->fullName())?>" />
                                    </a>
                                </div>
                                <div class="person_contacts">
                                    <div class="person_contacts_info">
                                        <h3><?= __($item->fullName())?></h3>
                                        <p><?= __($item->specialization()->text()) ?></p>
                                    </div>
                                </div>
                            </div>
                        <? endforeach ?>

                    </div>
                <? endforeach ?>
            <? endif ?>

        </div>
    </div>
</div>