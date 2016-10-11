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
			<h3>Photo Galleries List</h3>
        </div>
		<div class="panel-body">
            <a class="btn btn-primary" href="<?= Helpers\Uri::makeRouteUri('back.photo.gallery.add') ?>">Add Gallery</a>
            <? if($items->count()): ?>
			<div class="table-responsive">
                <table class="table">
                    <thead>
                    <tr>
                        <th>Name</th>
                        <th>Slug</th>
                        <th>Total Photos</th>
                        <th>Data Created</th>
                        <th>Data Updated</th>
                        <th>Edit</th>
                        <th>Delete</th>
                    </tr>
                    </thead>
                    <tbody>
				    <? foreach($items as $item): ?>
                        <tr>
                            <td><a href="<?= Helpers\Uri::makeUriFromId('Admin/PhotoGallery/Edit/'.$item->id) ?>"><?= __($item->text()) ?></a></td>
                            <td><?= $item->slug ?></td>
                            <td><?= $item->photos()->get()->count() ?></td>
                            <td><?= (!$item->created_at) ?: $item->created_at->toDateTimeString() ?></td>
                            <td><?= (!$item->updated_at) ?: $item->updated_at->toDateTimeString() ?></td>
                            <td>
                                <a href="<?= Helpers\Uri::makeUriFromId('Admin/PhotoGallery/Edit/'.$item->id) ?>"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span></a>
                            </td>
                            <td>
                                <a class="remove-confirm" href="<?= Helpers\Uri::makeUriFromId('Admin/PhotoGallery/Delete/'.$item->id) ?>"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></a>
                            </td>
                        </tr>
				    <? endforeach ?>
                </table>
			</div>
		<? endif ?>
		</div>
	</div>
</div>