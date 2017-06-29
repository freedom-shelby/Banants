<?php
/**
 * Created by PhpStorm.
 * User: crosscomp
 * Date: 23.01.2015
 * Time: 12:23
 */

use Lang\Lang;
?>

<div class="container">
    <div class="panel panel-primary">
        <div class="panel-heading">
            <h1>Best Player</h1>
        </div>
        <form method="post" id="form">
            <div class="panel-body">
                <div class="group container-fluid">
                    <div class="row col-sm-6 pull-right">
                        <div class="form-group col-sm-9">
                            <label for="parentId">Select Best Player</label>
                            <select name="best_player">

                                <? if(!empty($players)): ?>
                                    <? foreach($players as $key => $n): ?>

                                        <option value="<?= $key?> ">
                                            <?= $n->fullName() ?>
                                        </option>

                                    <? endforeach ?>
                                <? endif ?>

                            </select>
                        </div>
                    </div>
                    <div class="row col-sm-6 pull-left">
                        <div class="form-group col-sm-3">
                            <label for="instat_index">Instat Index</label>
                            <input type="number" name="instat_index" class="form-control" id="instat_index" placeholder="Instat" required>
                        </div>
                        <div class="form-group col-sm-3">
                            <label for="shots">Shots</label>
                            <input type="number" name="shots" class="form-control" id="shots" placeholder="Shots" required>
                        </div>
                        <div class="form-group col-sm-3">
                            <label for="goals">Text</label>
                            <input type="number" name="goals" class="form-control" id="goals" placeholder="Goals" required>
                        </div>
                    </div>
                </div>
                <div class="form-group col-sm-13">
                    <div class="btn-group" role="group" aria-label="...">
                        <input type="submit" name="submit" value="Save" class="btn btn-primary">
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>

