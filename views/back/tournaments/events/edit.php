<?php
/**
 * Created by PhpStorm.
 * User: crosscomp
 * Date: 22.01.2015
 * Time: 11:54
 *
 * @var $items \Football\Events\EventManager
 * @var $formations FormationModel
 */
use Helpers\Uri;

?>
<div class="panel panel-primary">
    <div class="panel-heading">
        <h3>Team Statistics</h3>
    </div>
    <div class="panel-body">
        <div class="group container-fluid">
            <form action="" method="post" id="submit">
                <div class="row col-sm-5 pull-right">
                    <div class="form-group col-sm-13">
                        <label for="alias">Statistic on Instat PDF File</label>
                        <input type="file" name="pdf" value="" class="form-control" id="pdf">
                    </div>
                    <div class="inline form-group col-sm-6">
                        <label>
                            <span>Default Image</span>
                            <img id="article-photo-url" src="<?= $items->getDefaultImage()->path ?>" class="img-thumbnail" alt="Default Image">
                            <input id="article-photo-id" type="text" name="photo-id" value="<?= $items->getDefaultImage()->id ?>" hidden>
                        </label>
                    </div>
                    <div class="row article-thumbnail">
                        <div class="col-lg-12">
                            <h1 class="page-header">Last Uploaded Images</h1>
                        </div>
                        <div id="photo-paginate" data-server-url="<?= \Helpers\Uri::makeRouteUri('back.server.photo')?>">
                            <!-- отрисовка View для картинок с постраницей -->
                        </div>
                    </div>
                </div>
                <div class="row col-sm-7 pull-left">
                    <table class="table table-bordered">
                        <thead>
                        <tr>
                            <th>Home Team</th>
                            <th>Stats</th>
                            <th>Away Team</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td>
                                <?= $items->getHomeTeam()->team()->text() ?>
                                <input type="hidden" name="home[team_id]" value="<?= $items->getHomeTeam()->team_id ?>">
                            </td>
                            <td><?= __('Teams') ?></td>
                            <td>
                                <?= $items->getAwayTeam()->team()->text() ?>
                                <input type="hidden" name="away[team_id]" value="<?= $items->getAwayTeam()->team_id ?>">
                            </td>
                        </tr>
                        <tr>
                            <td><input type="number" name="home[shots]" value="<?= $items->getHomeTeam()->shots ?>"></td>
                            <td><?= __('Shots') ?></td>
                            <td><input type="number" name="away[shots]" value="<?= $items->getAwayTeam()->shots ?>"></td>
                        </tr>
                        <tr>
                            <td><input type="number" name="home[on_target]" value="<?= $items->getHomeTeam()->on_target ?>"></td>
                            <td><?= __('On target') ?></td>
                            <td><input type="number" name="away[on_target]" value="<?= $items->getAwayTeam()->on_target ?>"></td>
                        </tr>
                        <tr>
                            <td><input type="number" name="home[possession]" value="<?= $items->getHomeTeam()->possession ?>"></td>
                            <td><?= __('Possession') ?></td>
                            <td><input type="number" name="away[possession]" value="<?= $items->getAwayTeam()->possession ?>"></td>
                        </tr>
                        <tr>
                            <td><input type="number" name="home[passes]" value="<?= $items->getHomeTeam()->passes ?>"></td>
                            <td><?= __('Passes') ?></td>
                            <td><input type="number" name="away[passes]" value="<?= $items->getAwayTeam()->passes ?>"></td>
                        </tr>
                        <tr>
                            <td><input type="number" name="home[target_passing]" value="<?= $items->getHomeTeam()->target_passing ?>"></td>
                            <td><?= __('Target passing') ?></td>
                            <td><input type="number" name="away[target_passing]" value="<?= $items->getAwayTeam()->target_passing ?>"></td>
                        </tr>
                        <tr>
                            <td><input type="number" name="home[offsides]" value="<?= $items->getHomeTeam()->offsides ?>"></td>
                            <td><?= __('Offsides') ?></td>
                            <td><input type="number" name="away[offsides]" value="<?= $items->getAwayTeam()->offsides ?>"></td>
                        </tr>
                        <tr>
                            <td><input type="number" name="home[corners]" value="<?= $items->getHomeTeam()->corners ?>"></td>
                            <td><?= __('Corners') ?></td>
                            <td><input type="number" name="away[corners]" value="<?= $items->getAwayTeam()->corners ?>"></td>
                        </tr>
                        <tr>
                            <td><input type="number" name="home[fouls]" value="<?= $items->getHomeTeam()->fouls ?>"></td>
                            <td><?= __('Fouls') ?></td>
                            <td><input type="number" name="away[fouls]" value="<?= $items->getAwayTeam()->fouls ?>"></td>
                        </tr>
                        <tr>
                            <td><input type="number" name="home[yellow_cards]" value="<?= $items->getHomeTeam()->yellow_cards ?>"></td>
                            <td><?= __('Yellow cards') ?></td>
                            <td><input type="number" name="away[yellow_cards]" value="<?= $items->getAwayTeam()->yellow_cards ?>"></td>
                        </tr>
                        <tr>
                            <td><input type="number" name="home[red_cards]" value="<?= $items->getHomeTeam()->red_cards ?>"></td>
                            <td><?= __('Red cards') ?></td>
                            <td><input type="number" name="away[red_cards]" value="<?= $items->getAwayTeam()->red_cards ?>"></td>
                        </tr>
                        <tr>
                            <td>
                                <select name="home[team_formation_id]">

                                    <? foreach ($formations as $item): ?>
                                        <option value="<?= $item->id ?>" <?= ($items->getHomeTeam()->team_formation_id) == $item->id ? 'selected' : '' ?>><?= $item->title ?></option>
                                    <? endforeach ?>

                                </select>
                            </td>
                            <td><?= __('Formation') ?></td>
                            <td>
                                <select name="away[team_formation_id]">

                                    <? foreach ($formations as $item): ?>
                                        <option value="<?= $item->id ?>" <?= ($items->getAwayTeam()->team_formation_id) == $item->id ? 'selected' : '' ?>><?= $item->title ?></option>
                                    <? endforeach ?>

                                </select>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                    <div class="panel-footer form-group col-md-12">
                        <button type="submit" class="btn btn-primary" form="submit" name="submit">Save</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>