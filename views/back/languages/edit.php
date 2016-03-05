<?php
/**
 * Created by PhpStorm.
 * User: CrossComp
 * Date: 12/9/14
 * Time: 5:41 AM
 */
?>
<!--Begin Container-->
<div class="container">
    <div class="panel panel-primary">
        <div class="panel-heading">
            <h3 class="panel-title">Edit Language</h3>
        </div>
        <form method="post" action="<?=\Helpers\Uri::makeUri('Admin/Languages/Edit').'/'.$item->id . App::URI_EXT?>" enctype="multipart/form-data" id="form">
            <div class="panel-body">
                <div class="group">
                    <div class="form-group col-sm-7">
                        <label for="title">Name</label>
                        <input type="text" name="name" class="form-control" id="name" placeholder="Name" value="<?=$item->name?>" required>
                    </div>
                    <div class="form-group col-sm-7">
                        <label for="iso">Iso 2</label>
                        <input type="text" name="iso" class="form-control" id="iso" placeholder="Iso" value="<?=$item->iso?>" required>
                    </div>
                    <div class="form-group col-sm-7">
                        <label for="flag">Upload Image</label>
                        <input type="file" name="flag" class="multi" accept="gif|jpg|png">
                    </div>
                    <div class="form-group col-sm-7">
                        <label for="status">Select Status Of Language</label>
                        <select name="status">
                            <option value="1" <?=$item->status ? 'selected' : null?>>Active</option>
                            <option value="0" <?=$item->status ? null : 'selected'?>>Inactive</option>
                        </select>
                    </div>
                    <div class="clear"></div>
                    <div class="form-group col-sm-7">
                        <input type="submit" name="submit" value="Save" class="btn btn-primary">
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
<!--End Container-->