<?php
/**
 * Created by PhpStorm.
 * User: Sergey
 * Date: 12/9/14
 * Time: 3:30 AM
 */
?>
<!--Begin Container-->
<div class="container-fluid">
    <div class="panel panel-primary">
        <div class="panel-heading">
            <h3 class="panel-title">Languages List</h3>
        </div>
        <div class="panel-body">
            <a class="btn btn-primary" href="<?=\Helpers\Uri::makeRouteUri('back.languages.add')?>">Add Language</a>
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                    <tr>
                        <th>Name</th>
                        <th>Flag Path</th>
                        <th>ISO 3</th>
                        <th>Status</th>
                        <th>Edit</th>
                    </tr>
                    </thead>
                    <tbody>

                    <?if(!empty($items)):?>
                        <?foreach($items as $item):?>
                            <tr>
                                <td>
                                    <?=$item['name']?>
                                </td>
                                <td>
                                    <?=$item['flag']?>
                                </td>
                                <td>
                                    <?=$item['iso']?>
                                </td>
                                <td>
                                    <?=$item['is_enabled']? 'Active': 'Inactive'?>
                                </td>
                                <td>
                                    <a href="<?=\Helpers\Uri::makeUri('Admin/Languages/Edit').'/'.$item->id . App::URI_EXT?>"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span></a>
                                </td>
                            </tr>
                        <?endforeach?>
                    <?else:?>
                        <div class="alert alert-info" role="alert">
                            <p>Languages List Is Empty</p>
                        </div>
                    <?endif?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<!--End Container-->