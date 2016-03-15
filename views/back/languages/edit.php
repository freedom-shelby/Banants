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
                        <label class="control-label">Select File</label>
                        <input id="image" class="file-loading" name="image" type="file" data-show-upload="false" data-show-caption="true" accept="image/*">
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
<script>
    $(document).on('ready', function(){
        $("#image").on("filepredelete", function(jqXHR){
            var abort = true;
            if (confirm("Are you sure you want to delete this image?")) {
                abort = false;
            }
            return abort; // you can also send any data/object that you can receive on `filecustomerror` event
        });
        $("#image").fileinput({
            previewFileType: "image",
            browseClass: "btn btn-success",
            browseLabel: "Pick Image",
            browseIcon: "<i class=\"glyphicon glyphicon-picture\"></i> ",
            removeClass: "btn btn-danger",
            removeLabel: "Delete",
            removeIcon: "<i class=\"glyphicon glyphicon-trash\"></i> ",
            uploadClass: "btn btn-info",
            uploadLabel: "Upload",
            uploadIcon: "<i class=\"glyphicon glyphicon-upload\"></i> ",
            allowedFileTypes: ["image"],
            previewClass: "bg-warning",
            initialPreview: [
                <?=($item->flag) ? '\'<img style="height:160px" src="'.File::getImagePath($item->flag).'">\'' : ''?>
                ],
            initialPreviewConfig: [{
                caption: '<?=$item->name.' Flag'?>',
                width: "120px",
                url: '<?=Helpers\Uri::makeRouteUri("back.languages.image.delete")?>',
                key: <?=$item->id?>
            }]
        });
    });
</script>