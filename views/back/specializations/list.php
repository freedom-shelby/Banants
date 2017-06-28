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
			<h3>Specializations List</h3>
        </div>
		<div class="panel-body">
            <a class="btn btn-primary" href="<?=Helpers\Uri::makeRouteUri('back.specializations.add')?>">Add Specialization</a>
            <?if($items->count()):?>
			<div class="table-responsive">
                <table class="table">
                    <thead>
                    <tr>
                        <th>Text</th>
                        <th>Edit</th>
                        <th>Delete</th>
                    </tr>
                    </thead>
                    <tbody>
				    <?foreach($items as $item):?>
                        <tr>
                            <td><a href="<?=Helpers\Uri::makeUri('Admin/Specializations/Edit').'/'.$item->id . App::URI_EXT?>"><?=$item->text()?></a></td>
                            <td>
                                <a href="<?=Helpers\Uri::makeUri('Admin/Specializations/Edit').'/'.$item->id . App::URI_EXT?>"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span></a>
                            </td>
                            <td>
                                <a class="remove-confirm" href="<?=Helpers\Uri::makeUri('Admin/Specializations/Delete').'/'.$item->id . App::URI_EXT?>"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></a>
                            </td>
                        </tr>
				    <?endforeach?>
                </table>
			</div>
		<?endif?>
		</div>
	</div>
</div>