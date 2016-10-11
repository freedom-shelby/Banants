<?php
/**
 * Created by PhpStorm.
 * User: crosscomp
 * Date: 23.01.2015
 * Time: 12:23
 */
use Lang\Lang;
use Helpers\Uri;

?>

<div class="container photo-gallery">
    <div class="panel panel-primary">
        <div class="panel-heading">
            <h1>Edit <?=$item->name()?></h1>
        </div>
            <div class="panel-body">
                <form method="post" enctype="multipart/form-data" id="form">
                    <div class="panel-body">
                        <div class="group container-fluid">
                            <div class="row col-sm-6 pull-right">
                                <div class="form-group col-sm-13">
                                    <label for="alias">Slug</label>
                                    <input type="text" name="slug" value="<?=$item->slug?>" class="form-control" id="slug" placeholder="Slug" required>
                                </div>
                                <div class="checkbox-inline form-group col-sm-13">
                                    <label>
                                        <input type="checkbox" name="status" value="1" checked> Status
                                    </label>
                                </div>
                                <div class="form-group col-sm-9">
                                    <label class="col-md-4" for="max_rounds">Max Rounds</label>
                                    <input class="col-md-3" type="number" name="max_rounds" value="<?=$item->max_rounds?>">
                                </div>
                                <div class="form-group col-sm-9">
                                    <label class="col-md-4" for="max_rounds">Current Round</label>
                                    <input class="col-md-3" type="number" name="current_round" value="<?=$item->current_round?>">
                                </div>
                            </div>
                            <div class="row col-sm-6 pull-left">
                                <div class="bordered">
                                    <div>
                                        <div class="form-group col-sm-13">
                                            <label for="name">Tournament Name</label>
                                            <input type="text" value="<?=$item->name()?>" name="name" class="form-control" id="name" placeholder="Primary Language" required>
                                        </div>
                                        <!-- Nav tabs -->
                                        <ul class="nav nav-tabs" role="tablist">

                                            <?foreach(Lang::instance()->getLangsExcept(Lang::DEFAULT_LANGUAGE) as $iso => $lang):?>
                                                <li class="<?=(Lang::instance()->isPrimary($iso)) ? 'active' : ''?>"><a href="#name-<?=$iso?>" data-toggle="tab"><?=$lang['name']?></a></li>
                                            <?endforeach?>

                                        </ul>
                                        <!-- Tab panes -->
                                        <div class="tab-content">

                                            <?foreach(Lang::instance()->getLangsExcept(Lang::DEFAULT_LANGUAGE) as $iso => $lang):?>
                                                <div class="tab-pane <?=(Lang::instance()->isPrimary($iso)) ? 'active' : ''?>" id="name-<?=$iso?>">
                                                    <input type="hidden" name="content[<?=$iso?>][name_id]" value="<?= isset($contents[$iso]['name']->id) ? $contents[$iso]['name']->id : ''?>">
                                                    <div class="form-group col-sm-13">
                                                        <label for="name">Translated Name</label>
                                                        <input type="text" name="content[<?=$iso?>][name]" value="<?= isset($contents[$iso]['name']->text) ? $contents[$iso]['name']->text : ''?>" class="form-control" id="name" placeholder="Tournament Name" <?=((Lang::instance()->isPrimary($iso)) ? ' required' : '')?>>
                                                    </div>
                                                </div>
                                            <?endforeach?>

                                        </div>
                                    </div>
                                    <div>
                                        <div class="form-group col-sm-13">
                                            <label for="full-name">Tournament Full Name</label>
                                            <input type="text" name="full_name" value="<?=$item->fullName()?>" class="form-control" id="full-name" placeholder="Primary Language" required>
                                        </div>
                                        <!-- Nav tabs -->
                                        <ul class="nav nav-tabs" role="tablist">

                                            <?foreach(Lang::instance()->getLangsExcept(Lang::DEFAULT_LANGUAGE) as $iso => $lang):?>
                                                <li class="<?=(Lang::instance()->isPrimary($iso)) ? 'active' : ''?>"><a href="#full-name-<?=$iso?>" data-toggle="tab"><?=$lang['name']?></a></li>
                                            <?endforeach?>

                                        </ul>
                                        <!-- Tab panes -->
                                        <div class="tab-content">

                                            <?foreach(Lang::instance()->getLangsExcept(Lang::DEFAULT_LANGUAGE) as $iso => $lang):?>
                                                <div class="tab-pane <?=(Lang::instance()->isPrimary($iso)) ? 'active' : ''?>" id="full-name-<?=$iso?>">
                                                    <input type="hidden" name="content[<?=$iso?>][full_name_id]" value="<?= isset($contents[$iso]['fullName']->id) ? $contents[$iso]['fullName']->id : ''?>">
                                                    <div class="form-group col-sm-13">
                                                        <label for="full-name">Translated Name</label>
                                                        <input type="text" name="content[<?=$iso?>][full_name]" value="<?= isset($contents[$iso]['fullName']->text) ? $contents[$iso]['fullName']->text : ''?>" class="form-control" id="full-name" placeholder="Tournament Name" <?=((Lang::instance()->isPrimary($iso)) ? ' required' : '')?>>
                                                    </div>
                                                </div>
                                            <?endforeach?>

                                        </div>
                                    </div>
                                </div>
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
                    <legend></legend>
                    <div id="photo-gallery" class="ui-widget-content ui-state-default">
                        <h4 class="ui-widget-header">
                            <span class="glyphicon glyphicon-picture"></span> <?= $item->name() ?> Gallery
                        </h4>
                        <ul class="gallery ui-helper-reset">

<!--                            --><?// foreach ($item->photos()->get() as $i): ?>
<!--                                <li class="ui-widget-content ui-corner-tr ui-draggable ui-draggable-handle" data-photo-id="--><?//= $i['id'] ?><!--" style="display: list-item; width: 48px;">-->
<!--                                    <input type="hidden" name="photos[]" value="--><?//= $i['id'] ?><!--">-->
<!--                                    <h5 class="ui-widget-header">High Tatras 4</h5>-->
<!--                                    <img src="--><?//= $i->path ?><!--" alt="On top of Kozi kopka" width="96" height="72" style="display: inline-block; height: 36px;">-->
<!--                                    <a href="--><?//= $i->path ?><!--" target="_blank" title="View larger image" class="ui-icon ui-icon-zoomin">View larger</a>-->
<!--                                    <a href="#" title="Delete this image" class="ui-icon ui-icon-trash">Delete image</a>-->
<!--                                </li>-->
<!--                            --><?// endforeach; ?>

                        </ul>
                    </div>
                </form>

                <div id="photo-paginate" data-server-url="<?= \Helpers\Uri::makeRouteUri('back.server.photo.gallery')?>">
                    <!-- отрисовка View для картинок с постраницей -->
                </div>

            </div>
    </div>
</div>

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
                <?=($item->defaultImage()) ? '\'<img style="height:160px" src="'.$item->defaultImage()->path.'">\'' : ''?>
            ],
            initialPreviewConfig: [{
                caption: '<?=$item->name().' Icon'?>',
                width: "120px",
                url: '<?=Uri::makeRouteUri("back.league.image.delete")?>',
                key: <?=$item->id?>
            }]
        });
    });
</script>