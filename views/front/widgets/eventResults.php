<?php
/**
 * Created by PhpStorm.
 * User: Arsen
 * Date: 11/6/2015
 * Time: 3:20 PM
 *
 * @var $data \Football\Events\EventManager
 * @var $title string
 */

use Ivliev\Imagefly\Imagefly;
use Carbon\Carbon;
use Helpers\Uri;
?>

<div class="results">
    <div class="match-col">
        <div class="nxsh1"></div>
        <div class="result-match">
            <p class="date-match"><?= Carbon::parse($data->played_at)->format('d\\/m\\/Y H:i') ?></p>
            <a href="#">
                <span class="name"><?= __($data->getHomeTeam()->team()->text()) ?></span>
                <img src="<?= Imagefly::imagePath($data->getHomeTeam()->team()->defaultImage()->path, 'w65-q65') ?>" alt="">
            </a>
            <a href="" class="result"><?= $data->getHomeTeam()->score ?> - <?= $data->getAwayTeam()->score ?></a>
            <a href="#">
                <img src="<?= Imagefly::imagePath($data->getAwayTeam()->team()->defaultImage()->path, 'w65-q65') ?>" alt="">
                <span class="name"><?= __($data->getAwayTeam()->team()->text()) ?></span>
            </a>
        </div>
        <div class="result-bottom">
            <a href="<?= $data->getTournament()->hasTable() ? Uri::makeUriFromId($data->getTournament()->getUri()) : '#' ?>">
                <img src="<?= Imagefly::imagePath($data->getTournament()->getDefaultImage()->path, 'w36-q36') ?>" alt="1 Liga">
                <span><?= __($data->getTournament()->getName()) ?></span>
            </a>
            <? if ($data->getTournament()->hasRound()): ?>
                <a href="#">
                    <?= __('Round') . ' ' . $data->round ?>
                </a>
            <? endif ?>
        </div>
    </div>
</div>