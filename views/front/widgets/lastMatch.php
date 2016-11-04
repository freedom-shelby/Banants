<?php
/**
 * Created by PhpStorm.
 * User: Arsen
 * Date: 11/6/2015
 * Time: 3:20 PM
 */
?>
<div class="banner_team1">
    <div class="team1_logo">
        <img src="<?= $item->homeTeam()->defaultImage()->path ?>" alt="logo_main" />
<!--        <span class="team_name_">--><?//= __($item->homeTeam()->text()) ?><!--</span>-->
    </div>
    <div class="banner_team1_text">
        <p>
            <b>
                <span><?= $item->home()->score ?></span> <span>-</span>  <span><?= $item->away()->score ?></span>
            </b>
        </p>
    </div>
    <div class="team1_logo">
        <img src="<?= $item->awayTeam()->defaultImage()->path ?>" alt="logo_team1" />
        <span class="team_name_"><?= __($item->homeTeam()->text()) ?></span>
    </div>
</div>