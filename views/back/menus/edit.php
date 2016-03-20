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
            <h1>Edit Menu Item</h1>
        </div>
        <form method="post" action="<?=Helpers\Uri::makeUriFromId('Admin/Menus/Edit/'.$item->id)?>" enctype="multipart/form-data" id="form">
            <div class="panel-body">
                <div class="group container-fluid">
                    <div class="row col-sm-6 pull-right">
                        <div class="form-group col-sm-13">
                            <label for="alias">Slug</label>
                            <input type="text" name="slug" value="<?=$item->slug?>" class="form-control" id="slug" placeholder="Slug" required>
                        </div>
                        <div class="form-group col-sm-9">
                            <label for="parentId">Select Parent</label>
                            <select name="parentId">
                                <option value="0">
                                    &bull;
                                    Root
                                </option>
                                <?if(!empty($node)):?>
                                    <?foreach($node as $key => $n):?>
                                        <option value="<?=$key?>" <?=($item->parent_id == $key) ? ' selected' : ''?>>
                                            <?=str_repeat('&nbsp',$n->lvl*2)?>&#1012<?=$n->lvl+2?>;
                                            <?=$n->text()?>
                                        </option>
                                    <?endforeach?>
                                <?endif?>
                            </select>
                        </div>
                        <div class="checkbox-inline form-group col-sm-13">
                            <label>
                                <input type="checkbox" name="status" value="1" <?=($item->status) ? ' checked' : ''?>> Status
                            </label>
                        </div>
                    </div>
                    <div class="row col-sm-6 pull-left">
                        <div class="form-group col-sm-13">
                            <label for="entity">Text</label>
                            <input type="text" name="entity" value="<?=$item->text()?>" class="form-control" id="entity" placeholder="Primary Language" required>
                        </div>
                        <!-- Nav tabs -->
                        <ul class="nav nav-tabs" role="tablist">
                            <?foreach(Lang::instance()->getLangsExcept(Lang::DEFAULT_LANGUAGE) as $iso => $lang):?>
                                <li class="<?=(Lang::instance()->isPrimary($iso)) ? 'active' : ''?>"><a href="#<?=$iso?>" data-toggle="tab"><?=$lang['name']?></a></li>
                            <?endforeach?>
                        </ul>
                        <!-- Tab panes -->
                        <div class="tab-content">
                            <?foreach(Lang::instance()->getLangsExcept(Lang::DEFAULT_LANGUAGE) as $iso => $lang):?>
                                <div class="tab-pane <?=(Lang::instance()->isPrimary($iso)) ? 'active' : ''?>" id="<?=$iso?>">
                                    <input type="hidden" name="content[<?=$iso?>][id]" value="<?= isset($contents[$iso]->id) ? $contents[$iso]->id : ''?>">
                                    <div class="form-group col-sm-13">
                                        <label for="text">Text</label>
                                        <input type="text" name="content[<?=$iso?>][text]" value="<?= isset($contents[$iso]->text) ? $contents[$iso]->text : ''?>" class="form-control" id="text" placeholder="Text" <?=((Lang::instance()->isPrimary($iso)) ? ' required' : '')?>>
                                    </div>
                                </div>
                            <?endforeach?>
                            <div class="form-group col-sm-13">
                                <label class="control-label">Select File</label>
                                <input id="image" class="file-loading" name="image" type="file" data-show-upload="false" data-show-caption="true" accept="image/*">
                            </div>
                            <div class="form-group col-sm-13">
                                <div class="btn-group" role="group" aria-label="...">
                                    <input type="submit" name="submit" value="Save" class="btn btn-primary">
                                </div>
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
            initialPreview: [
                <?=($item->icon) ? '\'<img style="height:160px" src="'.File::getImagePath($item->icon).'">\'' : ''?>
            ],
            initialPreviewConfig: [{
                caption: '<?=$item->text().' Icon'?>',
                width: "120px",
                url: '<?=Helpers\Uri::makeRouteUri("back.menus.image.delete")?>',
                key: <?=$item->id?>
            }]
        });

    });
</script>