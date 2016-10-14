<?php
/**
 * Created by PhpStorm.
 * User: Arsen
 * Date: 11/6/2015
 * Time: 3:20 PM
 *
 * @var $item \Football\Tournaments\Types\DoubleRoundRobin
 */
?>

<!--<div class="widget widget-with-tabs">-->
<!--    <div class="widget-header">-->
<!--        <div class="widget-tabs">-->
<!---->
<!--            --><?// foreach ($items as $key => $item): ?>
<!--                <div class="tab---><?//= ++$key ?><!-- --><?//= ($key == 1) ? ' active' : ''?><!--"><div>-->
<!--                        <span>--><?//= __($item->getName()) ?><!--</span>-->
<!--                    </div>-->
<!--                </div>-->
<!--            --><?// endforeach ?>
<!---->
<!--        </div>-->
<!--    </div>-->
<!--    <div class="widget-body">-->
<!--        <div class="widget-tabs-body">-->
<!---->
<!--            --><?// foreach ($items as $key => $item): ?>
<!--                <div class="tab---><?//= ++$key ?><!-- --><?//= ($key == 1) ? ' active' : ''?><!--">-->
<!---->
<!--                    --><?//= $item->renderBasicWidget()?>
<!---->
<!--                </div>-->
<!--            --><?// endforeach ?>
<!---->
<!--        </div>-->
<!--    </div>-->
<!--    <div class="widget-footer">-->
<!--        <div class="widget-pagination">-->
<!--            <div class="owl-controls clickable">-->
<!--                <div class="owl-pagination">-->
<!---->
<!--                    --><?// foreach ($items as $item): ?>
<!--                        <div class="owl-page circle">-->
<!--                            <span class=""></span>-->
<!--                        </div>-->
<!--                    --><?// endforeach ?>
<!---->
<!--                </div>-->
<!---->
<!--            </div>-->
<!--        </div>-->
<!--    </div>-->
<!--</div>-->

<div class="info-col">
    <p class="col-title"><?= __($item->getFullName()) ?></p>
    <div class="inner_content contener-white">
        <div class="static-table tournir-table">
            <table>
                <tbody>
                <tr>
                    <th></th>
                    <th><?= __('G') ?></th>
                    <th><?= __('W') ?></th>
                    <th><?= __('D') ?></th>
                    <th><?= __('L') ?></th>
                    <th><?= __('GF') ?></th>
                    <th><?= __('GA') ?></th>
                    <th><?= __('P') ?></th>
                </tr>

                <? foreach ($item->getTeams() as $team): ?>
                    <tr>
                        <td class="name">
                            <span><?= $team->pos ?></span>
                            <?= __($team->team()->text()) ?>
                        </td>
                        <td><?= $team->played ?></td>
                        <td><?= $team->win ?></td>
                        <td><?= $team->draw ?></td>
                        <td><?= $team->lose ?></td>
                        <td><?= $team->goals_for ?></td>
                        <td><?= $team->goals_against ?></td>
                        <td><?= $team->points ?></td>
                    </tr>
                <? endforeach ?>

                </tbody>
            </table>
        </div>
        <p class="col-title"><?= __('Rounds') ?></p>
    </div>
</div>