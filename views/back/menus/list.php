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
			<h3>Articles List</h3>
        </div>
		<div class="panel-body">
            <a class="btn btn-primary" href="<?=\Helpers\Uri::makeRouteUri('back.articles.add')?>">Add Article</a>
            <?if($articles->count()):?>
			<div class="table-responsive">
                <table class="table">
                    <thead>
                    <tr>
                        <th>Name</th>
                        <th>Slug</th>
                        <th>Data Created</th>
                        <th>Data Updated</th>
                        <th>Edit</th>
                        <th>Delete</th>
                    </tr>
                    </thead>
                    <tbody>
				    <?foreach($articles as $a):?>
                        <tr>
                            <td><a href="<?=\Helpers\Uri::makeUri('Admin/Articles/Edit').'/'.$a->id . App::URI_EXT?>"><?=$a->title?></a></td>
                            <td><?=$a->slug?></td>
                            <td><?=(!$a->created_at) ?: $a->created_at->toDateTimeString()?></td>
                            <td><?=(!$a->updated_at) ?: $a->updated_at->toDateTimeString()?></td>
                            <td>
                                <a href="<?=\Helpers\Uri::makeUri('Admin/Articles/Edit').'/'.$a->id . App::URI_EXT?>"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span></a>
                            </td>
                            <td>
                                <a class="remove-confirm" href="<?=\Helpers\Uri::makeUri('Admin/Articles/Delete').'/'.$a->id . App::URI_EXT?>"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></a>
                            </td>
                        </tr>
				    <?endforeach?>
                </table>
			</div>
		<?endif?>
		</div>
	</div>
</div>