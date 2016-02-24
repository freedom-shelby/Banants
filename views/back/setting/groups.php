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
        <legend>Settings Groups List</legend>
        <div class="panel-body">
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                    <tr>
                        <th>Group Name</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?if($items):?>
                        <?foreach($items as $item):?>
                            <tr>
                                <td>
                                    <?=$item->group?>
                                </td>
                                <td>
                                    <a href="<?=\Helpers\Uri::makeUri('Admin/Settings').'/'.$item->group . App::URI_EXT?>">Edit</a>
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