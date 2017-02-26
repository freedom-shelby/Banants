<?php
/**
 * Created by PhpStorm.
 * User: Arsen
 * Date: 11/6/2015
 * Time: 3:20 PM
 */

use Helpers\Uri;

?>
<div class="banner_team1">
    <div class="team1_logo">
        <img src="<?= $item->homeTeam()->defaultImage()->path ?>" alt="logo_main" />

        <? if( ! $item->homeTeam()->is_own): ?>
            <span class="team_name_"><?= __($item->homeTeam()->shortName()) ?></span>
        <? endif ?>

    </div>
    <div class="match-score-info">
        <p>
            <a href="<?= Uri::makeUriFromId($item->slug()) ?>">
                <b>
                    <span><?= $item->home()->score ?></span> <span>-</span>  <span><?= $item->away()->score ?></span>
                </b>
            </a>
        </p>
    </div>
    <div class="team1_logo">
        <img src="<?= $item->awayTeam()->defaultImage()->path ?>" alt="logo_team1" />

        <? if( ! $item->awayTeam()->is_own): ?>
            <span class="team_name_"><?= __($item->awayTeam()->shortName()) ?></span>
        <? endif ?>

    </div>
</div>