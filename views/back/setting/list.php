<?php
/**
 * Created by PhpStorm.
 * User: CrossComp
 * Date: 12/9/14
 * Time: 3:30 AM
 */
?>
<!--Begin Container-->
<div class="row">
    <div class="col-md-8 col-md-offset-2">
        <legend>Settings List</legend>
        <div class="panel-body">
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                    <tr>
                        <th>Title</th>
                        <th>Name</th>
                        <th>Description</th>
                        <th>Value</th>
                        <th>Edit</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?if($items):?>
                        <?foreach($items as $item):?>
                            <tr>
                                <td>
                                    <?=$item['title']?>
                                </td>
                                <td>
                                    <?=$item['name']?>
                                </td>
                                <td>
                                    <?=$item['desc']?>
                                </td>
                                <td>
                                    <?=$item['value']?>
                                </td>
                                <td>
                                    <a href="<?=\Helpers\Uri::makeUri('Admin/Settings/Edit').'/'.$item['id'] . App::URI_EXT?>"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span></a>
                                </td>
                            </tr>
                        <?endforeach?>
                    <?else:?>
                        <div class="alert alert-info" role="alert">
                            <p>Setting List Is Empty</p>
                        </div>
                    <?endif?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<!--End Container-->