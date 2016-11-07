<?php
/**
 * Created by PhpStorm.
 * User: Arsen
 * Date: 11/6/2015
 * Time: 3:20 PM
 */
?>
<div class="banner_team2">
    <div class="team1_logo">
        <img src="<?= $item->homeTeam()->defaultImage()->path ?>" alt="logo_main" />

        <? if( ! $item->homeTeam()->is_own): ?>
            <span class="team_name_"><?= __($item->homeTeam()->text()) ?></span>
        <? endif ?>

    </div>
    <div class="match-score-info">
        <span>19.11</span>
        <span class="match-time">15:00</span>
    </div>
    <div class="team2_logo">
        <img src="<?= $item->awayTeam()->defaultImage()->path ?>" alt="team2_logo" />

        <? if( ! $item->awayTeam()->is_own): ?>
            <span class="team_name_"><?= __($item->awayTeam()->text()) ?></span>
        <? endif ?>

    </div>
</div>