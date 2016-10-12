<?php
/**
 * Created by PhpStorm.
 * User: crosscomp
 * Date: 23.01.2015
 * Time: 12:23
 *
 * @var \Football\Tournaments\Tournament $item
 * @var \Football\Tournaments\Tournament->getTeams() $item
 */
use Helpers\Uri;

?>
<div class="container-fluid">
    <div class="panel panel-primary">
        <div class="panel-heading">
            <h3>Categories List</h3>
        </div>
        <div class="panel-body round-robin">
            <div>
                <form method="post" id="submit">
                    <table class="non-fixed-width-table form-group col-sm-9">
                        <thead>
                        <tr>
                            <th>Pos</th>
                            <th>Club</th>
                            <th>Played</th>
                            <th>Win</th>
                            <th>Draw</th>
                            <th>Lose</th>
                            <th>Goals For</th>
                            <th>Goals Against</th>
                            <th>Difference</th>
                            <th>Points</th>
                        </tr>
                        </thead>
                        <tbody class="sortable-table ui-sortable">

                        <? foreach($teams as $team): ?>
                            <tr class="ui-sortable-handle" data-team="<?= $team->id ?>">
                                <td><input type="number" value="<?= $team->pos ?>" name="team[<?= $team->id ?>][pos]" readonly></td>
                                <td><?= $team->team()->text() ?></td>
                                <td><input type="number" value="<?= $team->played ?>" name="team[<?= $team->id ?>][played]" disabled></td>
                                <td><input type="number" value="<?= $team->win ?>" name="team[<?= $team->id ?>][win]"></td>
                                <td><input type="number" value="<?= $team->draw ?>" name="team[<?= $team->id ?>][draw]"></td>
                                <td><input type="number" value="<?= $team->lose ?>" name="team[<?= $team->id ?>][lose]"></td>
                                <td><input type="number" value="<?= $team->goals_for ?>" name="team[<?= $team->id ?>][goals_for]"></td>
                                <td><input type="number" value="<?= $team->goals_against ?>" name="team[<?= $team->id ?>][goals_against]"></td>
                                <td><input type="number" value="<?= $team->difference ?>" name="team[<?= $team->id ?>][difference]" disabled></td>
                                <td><input type="number" value="<?= $team->points ?>" name="team[<?= $team->id ?>][points]" disabled></td>
                            </tr>
                        <? endforeach ?>

                        </tbody>
                    </table>
                    <div class="form-group col-sm-3">
                        <label class="col-md-9" for="current_round">Select Current Round</label>
                        <select name="current_round">

                            <? for($i = 1; $i <= $item->getMaxRounds(); $i++): ?>
                                <option value="<?= $i ?>" <?= ($i == $item->getCurrentRound()) ? 'selected' : ''?>>
                                    <?= $i ?>
                                </option>
                            <? endfor ?>

                        </select>
                    </div>
                </form>
            </div>
            <div class="panel-footer form-group col-sm-9">
                <button type="submit" class="btn btn-primary" form="submit" name="submit">Save</button>
                <a class="btn btn-primary" href="<?= Uri::makeUriFromId('Admin/Tournament/Edit/Team/' . $item->getId()) ?>">Edit Teams</a>
            </div>
        </div>
    </div>
</div>