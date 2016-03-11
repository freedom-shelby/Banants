<?php
/**
 * Created by PhpStorm.
 * User: Arsen
 * Date: 12/9/14
 * Time: 5:41 AM
 */
?>
<!--Begin Container-->
<div class="container">
    <div class="panel panel-primary">
        <div class="panel-heading">
            <h3 class="panel-title">Add Language</h3>
        </div>
        <form method="post" action="" enctype="multipart/form-data" id="form">
            <div class="panel-body">
                <div class="group">
                    <div class="form-group col-sm-7">
                        <label for="title">Name</label>
                        <input type="text" name="name" class="form-control" id="name" placeholder="Name" required>
                    </div>
                    <div class="form-group col-sm-7">
                        <label for="iso">Iso 2</label>
                        <input type="text" name="iso" class="form-control" id="iso" placeholder="Iso" required>
                    </div>
                    <div class="form-group col-sm-7">
                        <label class="control-label">Select File</label>
                        <input id="input-21" type="file" accept="image/*" class="file-loading">
                    </div>
                    <div class="form-group col-sm-7">
                        <label for="status">Select Status Of Language</label>
                        <select name="status">
                            <option value="1">Active</option>
                            <option value="0">Inactive</option>
                        </select>
                    </div>
                    <div class="clear"></div>
                    <div class="form-group col-sm-7">
                        <input type="submit" name="submit" value="Add Item" class="btn btn-primary">
                    </div>

                </div>
            </div>
        </form>
    </div>
</div>
<script>
    $(document).on('ready', function() {
        $("#input-21").fileinput({
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
//        $("#input-707").on("filepredelete", function(jqXHR) {
//            var abort = true;
//            if (confirm("Are you sure you want to delete this image?")) {
//                abort = false;
//            }
//            return abort; // you can also send any data/object that you can receive on `filecustomerror` event
//        });
//            initialPreview: [
//                "<img style='height:160px' src='http://loremflickr.com/200/150/nature?random=1'>",
//                "<img style='height:160px' src='http://loremflickr.com/200/150/nature?random=2'>",
//                "<img style='height:160px' src='http://loremflickr.com/200/150/nature?random=3'>",
//            ],
//            initialPreviewConfig: [
//                {caption: "Nature-1.jpg", width: "120px", url: "/site/file-delete", key: 1},
//                {caption: "Nature-2.jpg", width: "120px", url: "/site/file-delete", key: 2},
//                {caption: "Nature-3.jpg", width: "120px", url: "/site/file-delete", key: 3},
//            ],
    });
</script>
<!--End Container-->