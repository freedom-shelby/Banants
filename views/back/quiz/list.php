<?php
/**
 * Created by PhpStorm.
 * User: crosscomp
 * Date: 22.01.2015
 * Time: 11:54
 */
 ?>
<div class="container-fluid">
    <div class="panel panel-primary">
        <div class="panel-heading">
			<h3>Quiz List</h3>
        </div>
		<div class="panel-body">
            <a class="btn btn-primary" href="<?= Helpers\Uri::makeRouteUri('back.quiz.add') ?>">Add Quiz</a>
            <? if($items->count()): ?>
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Responses Count</th>
                            <th>Data Created</th>
                            <th>Data Updated</th>
                            <th>Statistic</th>
                            <th>Edit</th>
                            <th>Delete</th>
                        </tr>
                        </thead>
                        <tbody>
                        <? foreach($items as $item): ?>
                            <tr>
                                <td><?= $item->id ?></td>
                                <td><a href="<?= Helpers\Uri::makeUriFromId('/Admin/Quiz/Edit/'.$item->id) ?>"><?= __($item->question()) ?></a></td>
                                <td><?= $item->total_responses ?></td>
                                <td><?= (!$item->created_at) ?: $item->created_at->toDateTimeString() ?></td>
                                <td><?= (!$item->updated_at) ?: $item->updated_at->toDateTimeString() ?></td>
                                <td>
                                    <a href="<?= Helpers\Uri::makeUriFromId('Admin/Quiz/Response/'.$item->id) ?>"><span class="glyphicon glyphicon-stats" aria-hidden="true"></span></a>
                                </td>
                                <td>
                                    <a href="<?= Helpers\Uri::makeUriFromId('Admin/Quiz/Edit/'.$item->id) ?>"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span></a>
                                </td>
                                <td>
                                    <a class="remove-confirm" href="<?= Helpers\Uri::makeUriFromId('Admin/Quiz/Delete/'.$item->id) ?>"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></a>
                                </td>
                            </tr>
                        <? endforeach ?>
                    </table>
                </div>
		    <? endif ?>
		</div>
	</div>
</div>