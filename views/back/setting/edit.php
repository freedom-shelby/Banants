<?php
/**
 * Created by PhpStorm.
 * User: CrossComp
 * Date: 12/9/14
 * Time: 5:41 AM
 */
?>
<!--Begin Container-->
<div class="row">
    <div class="col-md-8 col-md-offset-2">
        <legend>Edit Setting</legend>
        <form method="post" action="<?=\Helpers\Uri::makeUri('/Admin/Settings/Edit').'/'.$id . App::URI_EXT?>" id="form">
            <div class="panel-body">
                <div class="group">
                    <div class="form-group col-sm-7">
                        <label for="title">Title</label>
                        <p><?=$item->title?></p>
                    </div>
                    <div class="form-group col-sm-7">
                        <label for="desc">Description</label>
                        <p><?=$item->desc?></p>
                    </div>
                    <div class="form-group col-sm-7">
                        <label for="value">Value</label>
                        <input type="text" name="value" class="form-control" id="value" placeholder="value" value="<?=$item->value?>" required>
                    </div>
                    <div class="clearfix"></div>
                    <input type="submit" name="submit" value="Save" class="btn btn-primary">
                </div>
            </div>
        </form>
    </div>
</div>
<!--End Container-->