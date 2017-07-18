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
            <h3>Teams List</h3>
        </div>
        <div class="panel-body">
            <a class="btn btn-primary" href="<?=Uri::makeUriFromId('Admin/Player/Add/'.$id)?>">Add Player</a>
            <?if($items->count()):?>
                <div class="table-responsive">
                    <table class="table list-items">
                        <thead>
                        <tr>
                            <th>Full Name</th>
                            <th>Image</th>
                            <th>Edit</th>
                            <th>Delete</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?foreach($items as $item):?>
                            <tr>
                                <td><a href="<?=Uri::makeUriFromId('Admin/Player/Edit/'.$item->id)?>"><?=__($item->firstName()) .' '. __($item->lastName())?></a></td>
                                <td class="second-item"><img src="<?=$item->defaultImage()->path?>" class="img-circle" alt="Cinque Terre"></td>
                                <td>
                                    <a href="<?=Uri::makeUriFromId('Admin/Player/Edit/'.$item->id)?>"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span></a>
                                </td>
                                <td>
                                    <a class="remove-confirm" href="<?=Uri::makeUriFromId('Admin/Player/Delete/'.$item->id)?>"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></a>
                                </td>
                            </tr>
                        <?endforeach?>
                    </table>
                </div>
            <?endif?>
        </div>
    </div>
</div>