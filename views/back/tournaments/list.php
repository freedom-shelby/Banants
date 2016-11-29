<?php
/**
 * Created by PhpStorm.
 * User: crosscomp
 * Date: 22.01.2015
 * Time: 11:54
 */
use Helpers\Uri;

?>
<div class="container-fluid">
    <div class="panel panel-primary">
        <div class="panel-heading">
			<h3>Tournaments List</h3>
        </div>
		<div class="panel-body">
            <a class="btn btn-primary" href="<?= Helpers\Uri::makeRouteUri('back.tournament.add') ?>">Add Tournament</a>
            <? if($items->count()): ?>
			<div class="table-responsive">
                <table class="table list-items">
                    <thead>
                    <tr>
                        <th>Name</th>
                        <th>Slug</th>
                        <th>Logo</th>
                        <th>Type</th>
                        <th>Started At</th>
                        <th>Ended At</th>
                        <th>Data Created</th>
                        <th>Data Updated</th>
                        <th>Edit</th>
                        <th>List Rounds</th>
                        <th>Edit Table</th>
                        <th>Delete</th>
                    </tr>
                    </thead>
                    <tbody>
				    <? foreach($items as $item): ?>
                        <tr>
                            <td><a href="<?= Uri::makeUriFromId('Admin/Tournament/Edit/Table/'.$item->id) ?>"><?= __($item->name()) ?></a></td>
                            <td><?= $item->slug ?></td>
                            <td><img src="<?=$item->defaultImage()->path?>" class="img-circle" alt="Cinque Terre"></td>
                            <td><?= __($item->type()->text()) ?></td>
                            <td><?= (!$item->start_at) ?: $item->created_at->toDateTimeString() ?></td>
                            <td><?= (!$item->ended_at) ?: $item->created_at->toDateTimeString() ?></td>
                            <td><?= (!$item->created_at) ?: $item->created_at->toDateTimeString() ?></td>
                            <td><?= (!$item->updated_at) ?: $item->updated_at->toDateTimeString() ?></td>
                            <td>
                                <a href="<?= Uri::makeUriFromId('Admin/Tournament/Edit/Team/'.$item->id) ?>"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span></a>
                            </td>
                            <td>
                                <div class="dropdown">
                                    <a aria-expanded="false" role="button" data-toggle="dropdown" class="dropdown-toggle" href="#"><span class="glyphicon glyphicon-calendar" aria-hidden="true"></span><span class="caret"></span></a>
                                    <ul role="menu" class="dropdown-menu">

                                        <? for($i = 1; $i <= $item->max_rounds; $i++): ?>
                                            <li>
                                                <a href="<?= Uri::makeUriFromId('Admin/Tournament/Edit/Round/' . $item->id . '/' . $i) ?>" class="label <?= ($i == $item->current_round) ? 'label-success': ''?>">Round <?= $i ?></a>
                                            </li>
                                        <? endfor ?>

                                    </ul>
                                </div>
                            </td>
                            <td>
                                <a href="<?= Uri::makeUriFromId('Admin/Tournament/Edit/Table/'.$item->id) ?>"><span class="glyphicon glyphicon-list-alt" aria-hidden="true"></span></a>
                            </td>
                            <td>
                                <a class="remove-confirm" href="<?= Uri::makeUriFromId('Admin/Tournament/Delete/'.$item->id) ?>"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></a>
                            </td>
                        </tr>
				    <? endforeach ?>
                </table>
			</div>
		<? endif ?>
		</div>
	</div>
</div>