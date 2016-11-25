<?php
/**
 * Created by PhpStorm.
 * User: Arsen
 * Date: 11/6/2015
 * Time: 3:20 PM
 *
 * @var $items array[round][EventModel]
 * @var $item EventModel
 * @var $round int
 */

use Ivliev\Imagefly\Imagefly;

?>
<div class="last-round-events">
    <h2 class="match-info"><?= __('Round') ?> <?= $round ?></h2>
    <ul>

        <? foreach ($items as $item): ?>
            <li class="match-column">
                <div class="match-result">
                    <div class="match-row">
                        <img src="<?= Imagefly::imagePath($item->home()->team()->defaultImage()->path, 'w30-q65') ?>" alt="">
                    </div>
                    <div class="match-row name">
                        <span class=""><?= __($item->home()->team()->text()) ?></span>
                    </div>
                    <div class="result match-row">
                        <span><?= $item->home()->score ?> - <?= $item->away()->score ?></span>
                    </div>
                    <div class="match-row">
                        <img src=<?= Imagefly::imagePath($item->away()->team()->defaultImage()->path, 'w30-q65') ?> alt="">
                    </div>
                    <div class="match-row name">
                        <span class=""><?= __($item->away()->team()->text()) ?></span>
                    </div>
                </div>
            </li>
        <? endforeach ?>

    </ul>
</div>

<!--<div class="last-round-events" style="-->
<!--    background-color: #3487be;-->
<!--">-->
<!--    <ul style="-->
<!--    background-color: #3487be;-->
<!--    height: 112px;-->
<!--">-->
<!--        <li class="match-col next-tour" style="-->
<!--    background-color: #3487be;-->
<!--">-->
<!--            <p class="date-match">Gավաթի խաղարկություն</p><div class="result-match" style="-->
<!--    margin-top: -5px;-->
<!--"><p class="">16-45-12 15:00</p>-->
<!---->
<!--                <a href="#">-->
<!--                    <img src="/media/assets/images/team_logo/Ararat-yerevan-logo.png" alt="">-->
<!--                    <span class="name">Ararat</span>-->
<!--                </a>-->
<!--                <a href="" class="result">4 - 2</a>-->
<!--                <a href="#">-->
<!--                    <img src="/media/assets/images/team_logo/gandzasar-kapan-logo.png" alt="">-->
<!--                    <span class="name">Gandzasar</span>-->
<!--                </a>-->
<!--            </div>-->
<!--        </li>-->
<!---->
<!---->
<!--    </ul>-->
<!--</div>-->