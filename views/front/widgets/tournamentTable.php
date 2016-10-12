<?php
/**
 * Created by PhpStorm.
 * User: Arsen
 * Date: 11/6/2015
 * Time: 3:20 PM
 */

//todo: Здес надо 4 табов
?>

<div class="widget widget-with-tabs">
    <div class="widget-header">
        <div class="widget-tabs">

            <? foreach ($items as $key => $item): ?>
                <div class="tab-<?= ++$key ?> <?= ($key == 1) ? ' active' : ''?>"><div>
                        <span><?= __($item->getName()) ?></span>
                    </div>
                </div>
            <? endforeach ?>

<!--            <div class="tab0 active"><div><span>--><?//=__('Premier League')?><!--</span></div></div>-->
<!--            <div class="tab1"><div><span>--><?//=__('First League')?><!--</span></div></div>-->
        </div>
    </div>
    <div class="widget-body">
        <div class="widget-tabs-body">

            <? foreach ($items as $key => $item): ?>
                <div class="tab-<?= ++$key ?> <?= ($key == 1) ? ' active' : ''?>">

                    <?= $item->renderBasicWidget()?>

                </div>
            <? endforeach ?>

        </div>
    </div>
    <div class="widget-footer">
        <div class="widget-pagination">
            <div class="owl-controls clickable">
                <div class="owl-pagination">

                    <? foreach ($items as $item): ?>
                        <div class="owl-page circle">
                            <span class=""></span>
                        </div>
                    <? endforeach ?>

                </div>
<!--                <div class="owl-buttons">-->
<!--                    <div class="owl-prev wgt-prev"></div>-->
<!--                    <div class="owl-next wgt-next"></div>-->
<!--                </div>-->
            </div>
        </div>

    </div>
</div><!-- tournament_table -->