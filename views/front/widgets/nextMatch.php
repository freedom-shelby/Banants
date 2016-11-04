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
        <span class="team_name_"><?= __($item->homeTeam()->text()) ?></span>
    </div>
    <div class="banner_team1_text">
        <span>29.10</span>
        <span style="margin-top: 10px; display: block">15:00</span>
    </div>
    <div class="team2_logo">
        <img src="<?= $item->awayTeam()->defaultImage()->path ?>" alt="team2_logo" />
<!--        <span class="team_name_">--><?//= __($item->awayTeam()->text()) ?><!--</span>-->

    </div>
</div>