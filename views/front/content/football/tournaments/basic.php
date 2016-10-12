<?php
/**
 * Created by PhpStorm.
 * User: Arsen
 * Date: 11/10/2016
 * Time: 3:20 PM
 */

?>
<table class="score-table-widget">
    <tbody>
    <tr>
        <th></th>
        <th><?= __('GP') ?></th>
        <th><?= __('PTS') ?></th>
    </tr>

    <? foreach ($items as $item): ?>
        <tr>
            <td><a class="team" href="#"><?= __($item->team()->text()) ?></a></td>
            <td><span><?= $item->played ?></span></td>
            <td><span><?= $item->points ?></span></td>
        </tr>
    <? endforeach ?>

    </tbody>
</table>