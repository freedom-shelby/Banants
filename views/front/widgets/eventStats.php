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

?>

<div class="inner_content contener-white">
    <p class="fild-name"><?= __('MATCH FACTS') ?></p>
    <div  class="static-table">
        <table class="table table-bordered">
            <tr>
                <th class="team-column"><?= __($data->getHomeTeam()->team()->text()) ?></th>
                <th></th>
                <th class="team-column"><?= __($data->getAwayTeam()->team()->text()) ?></th>
            </tr>
            <tr>
                <td><?= $data->getHomeTeam()->shots ?></td>
                <td><?= __('Shots') ?></td>
                <td><?= $data->getAwayTeam()->shots ?></td>
            </tr>
            <tr>
                <td><?= $data->getHomeTeam()->on_target ?></td>
                <td><?= __('On target') ?></td>
                <td><?= $data->getAwayTeam()->on_target ?></td>
            </tr>
            <tr>
                <td><?= $data->getHomeTeam()->possession ?>%</td>
                <td><?= __('Possession') ?></td>
                <td><?= $data->getAwayTeam()->possession ?>%</td>
            </tr>
            <tr>
                <td><?= $data->getHomeTeam()->passes ?></td>
                <td><?= __('Passes') ?></td>
                <td><?= $data->getAwayTeam()->passes ?></td>
            </tr>
            <tr>
                <td><?= $data->getHomeTeam()->target_passing ?></td>
                <td><?= __('Target passing') ?></td>
                <td><?= $data->getAwayTeam()->target_passing ?></td>
            </tr>
            <tr>
                <td><?= $data->getHomeTeam()->offsides ?></td>
                <td><?= __('Offsides') ?></td>
                <td><?= $data->getAwayTeam()->offsides ?></td>
            </tr>
            <tr>
                <td><?= $data->getHomeTeam()->corners ?></td>
                <td><?= __('Corners') ?></td>
                <td><?= $data->getAwayTeam()->corners ?></td>
            </tr>
            <tr>
                <td><?= $data->getHomeTeam()->fouls ?></td>
                <td><?= __('Fouls') ?></td>
                <td><?= $data->getAwayTeam()->fouls ?></td>
            </tr>
            <tr>
                <td><?= $data->getHomeTeam()->yellow_cards ?></td>
                <td><?= __('Yellow cards') ?></td>
                <td><?= $data->getAwayTeam()->yellow_cards ?></td>
            </tr>
            <tr>
                <td><?= $data->getHomeTeam()->red_cards ?></td>
                <td><?= __('Red cards') ?></td>
                <td><?= $data->getAwayTeam()->red_cards ?></td>
            </tr>
        </table>
    </div>
    <p class="fild-name"><?= __('Statistics') ?></p>
    <div class="diagram">
        <div>
            <div class='wr-diagram'>
                <div id="1-diagram"
                     data-home-team-score="<?= $data->getHomeTeam()->possession ?>"
                     data-away-team-score="<?= $data->getAwayTeam()->possession ?>">
                </div>
            </div>
            <div><?= __('Possession') ?></div>
        </div>
        <div>
            <div class='wr-diagram'>
                <div id="1-diagram"
                     data-home-team-score="<?= $data->getHomeTeamShotsOnTarget()?>"
                     data-away-team-score="<?= $data->getAwayTeamShotsOnTarget()?>">
                </div>
            </div>
            <div><?= __('Shots') ?></div>
        </div>
        <div>
            <div class='wr-diagram'>
                <div id="1-diagram"
                     data-home-team-score="<?= $data->getHomeTeamPassesOnTarget() ?>"
                     data-away-team-score="<?= $data->getAwayTeamPassesOnTarget() ?>">
                </div>
            </div>
            <div><?= __('Target passing') ?></div>
        </div>
        <div>
            <div class='wr-diagram'>
                <div id="1-diagram"
                     data-home-team-score="<?= $data->getHomeTeamTotalFouls() ?>"
                     data-away-team-score="<?= $data->getAwayTeamTotalFouls() ?>">
                </div>
            </div>
            <div>
                <?= __('Fouls') ?>
            </div>
        </div>
        <div class="clearfix"></div>
    </div>
</div>