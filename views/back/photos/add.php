<?php
/**
 * Created by PhpStorm.
 * User: crosscomp
 * Date: 23.01.2015
 * Time: 12:23
 */
use Lang\Lang;

?>
<!--Begin Container-->
<div class="container">
    <div class="panel panel-primary">
        <div class="panel-heading">
            <h1>Add Photo</h1>
        </div>
        <form method="post" enctype="multipart/form-data" id="form">
            <div class="panel-body">
                <div class="group container-fluid">
                    <div class="row col-sm-6 pull-right">
                        <div class="form-group col-sm-13">
                            <label for="gallery_id">Select Gallery</label>
                            <select name="gallery_id">
                                <option value="0">
                                    Not Selected
                                </option>

                                <? if(!empty($items)): ?>
                                    <? foreach($items as $item): ?>

                                        <option value="<?= $item->id ?>" <?= ($selectedGalleryId == $item->id) ? 'selected' : '' ?>>
                                            <?= __($item->text()) ?>
                                        </option>

                                    <? endforeach ?>
                                <? endif ?>

                            </select>
                        </div>
                        <div class="form-group col-sm-13">
                            <label for="alias">Title</label>
                            <input type="text" name="title" class="form-control" id="title" placeholder="Title">
                        </div>
                        <div class="form-group col-sm-13">
                            <label for="alias">Description</label>
                            <input type="text" name="desc" class="form-control" id="desc" placeholder="Description for photo">
                        </div>
                    </div>
                    <div class="row col-sm-6 pull-left">
                        <div class="form-group col-sm-13">
                            <label class="control-label">Select File</label>
                            <input id="image" class="file-loading" name="image[]" type="file" data-show-upload="false" data-show-caption="true" accept="image/*" multiple>
                        </div>
                        <div class="form-group col-sm-13">
                            <div class="btn-group" role="group" aria-label="...">
                                <input type="submit" name="submit" value="Add" class="btn btn-primary">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
<!--End Container-->
<script>
    $(document).on('ready', function() {
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
        });
    });
</script>
