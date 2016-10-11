<?php
/**
 * Created by PhpStorm.
 * User: crosscomp
 * Date: 23.01.2015
 * Time: 12:23
 */
use Lang\Lang;

?>

<div class="container photo-gallery">
    <div class="panel panel-primary">
        <div class="panel-heading">
            <h1>Edit Photo Gallery</h1>
        </div>
            <div class="panel-body">
                <form method="post" id="form">

                    <div class="panel-body">
                        <div class="group container-fluid">
                            <div class="row col-sm-6 pull-right">
                                <div class="form-group col-sm-13">
                                    <label for="alias">Slug</label>
                                    <input type="text" name="slug" value="<?=$item->slug?>" class="form-control" id="slug" placeholder="Slug" required>
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
                                        <div class="btn-group" role="group" aria-label="...">
                                            <input type="submit" name="submit" value="Save" class="btn btn-primary">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <legend></legend>
                    <div id="photo-gallery" class="ui-widget-content ui-state-default">
                        <h4 class="ui-widget-header">
                            <span class="glyphicon glyphicon-picture"></span> <?= $item->name ?> Gallery
                        </h4>
                        <ul class="gallery ui-helper-reset">

                            <? foreach ($item->photos()->get() as $i): ?>
                                <li class="ui-widget-content ui-corner-tr ui-draggable ui-draggable-handle" data-photo-id="<?= $i['id'] ?>" style="display: list-item; width: 48px;">
                                    <input type="hidden" name="photos[]" value="<?= $i['id'] ?>">
                                    <h5 class="ui-widget-header">High Tatras 4</h5>
                                    <img src="<?= $i->path ?>" alt="On top of Kozi kopka" width="96" height="72" style="display: inline-block; height: 36px;">
                                    <a href="<?= $i->path ?>" target="_blank" title="View larger image" class="ui-icon ui-icon-zoomin">View larger</a>
                                    <a href="#" title="Delete this image" class="ui-icon ui-icon-trash">Delete image</a>
                                </li>
                            <? endforeach; ?>

                        </ul>
                    </div>
                </form>

                <div id="photo-paginate" data-server-url="<?= \Helpers\Uri::makeRouteUri('back.server.photo.gallery')?>">
                    <!-- отрисовка View для картинок с постраницей -->
                </div>

            </div>
    </div>
</div>