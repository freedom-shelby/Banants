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
<!--Begin Container-->
<div class="container">
    <div class="panel panel-primary">
        <div class="panel-heading">
            <h1>Add Team</h1>
        </div>
        <form method="post" enctype="multipart/form-data" id="form">
            <div class="panel-body">
                <div class="group container-fluid">
                    <div class="row col-sm-6 pull-right">
                        <div class="form-group col-sm-13">
                            <label for="alias">Slug</label>
                            <input type="text" name="slug" class="form-control" id="slug" placeholder="Slug" required>
                        </div>
                        <div class="form-group col-sm-9">
                            <label for="formation">Select Formation</label>
                            <select name="formation">

                                <?foreach(FormationModel::all() as $i):?>
                                    <option value="<?=$i->id?>">
                                        <?=$i->title?>
                                    </option>
                                <?endforeach?>

                            </select>
                        </div>
                        <div class="form-group col-sm-9">
                            <label for="league">Select League</label>
                            <select name="league">

                                <?foreach(LeagueModel::all() as $i):?>
                                    <option value="<?=$i->id?>">
                                        <?=__($i->text())?>
                                    </option>
                                <?endforeach?>

                            </select>
                        </div>
                        <div class="form-group col-sm-9 article-node">
                            <label for="article">Select Article</label>
                            <select name="article">
                                <option value="0">
                                    &bull;
                                    Root
                                </option>

                                <? if(!empty($node)):?>
                                    <? foreach($node as $key => $n): ?>

                                        <option value="<?= $key ?>" <?= ($defaultTeamArticle == $key) ? ' selected' : '' ?>>
                                            <?= str_repeat('&nbsp',$n->lvl*2)?>&#1012<?=$n->lvl+2?>;
                                            <?= $n->title?>
                                        </option>

                                    <? endforeach ?>
                                <? endif ?>

                            </select>
                        </div>
                        <div class="checkbox-inline form-group col-sm-13">
                            <label>
                                <input type="checkbox" name="status" value="1" checked>Status
                            </label>
                        </div>
                        <div class="form-group col-sm-13">
                            <label>
                                <input type="checkbox" name="is_own" value="1">Branch team
                            </label>
                        </div>
                    </div>
                    <div class="row col-sm-6 pull-left">
                        <div class="bordered">
                            <div>
                                <div class="form-group col-sm-13">
                                    <label for="entity">Team Name</label>
                                    <input type="text" name="entity" class="form-control" id="entity" placeholder="Primary Language" required>
                                </div>
                                <!-- Nav tabs -->
                                <ul class="nav nav-tabs" role="tablist">

                                    <?foreach(Lang::instance()->getLangsExcept(Lang::DEFAULT_LANGUAGE) as $iso => $lang):?>
                                        <li class="<?=(Lang::instance()->isPrimary($iso)) ? 'active' : ''?>"><a href="#text-<?=$iso?>" data-toggle="tab"><?=$lang['name']?></a></li>
                                    <?endforeach?>

                                </ul>
                                <!-- Tab panes -->
                                <div class="tab-content">

                                    <?foreach(Lang::instance()->getLangsExcept(Lang::DEFAULT_LANGUAGE) as $iso => $lang):?>
                                        <div class="tab-pane <?=(Lang::instance()->isPrimary($iso)) ? 'active' : ''?>" id="text-<?=$iso?>">
                                            <div class="form-group col-sm-13">
                                                <label for="text">Translated Name</label>
                                                <input type="text" name="content[<?=$iso?>][text]" class="form-control" id="text" placeholder="Team Name" <?=((Lang::instance()->isPrimary($iso)) ? ' required' : '')?>>
                                            </div>
                                        </div>
                                    <?endforeach?>

                                </div>
                            </div>
                        </div>
                        <div class="bordered">
                            <div>
                                <div class="form-group col-sm-13">
                                    <label for="entity">Team Short Name</label>
                                    <input type="text" name="short_name" class="form-control" id="short_name" placeholder="Primary Language" required>
                                </div>
                                <!-- Nav tabs -->
                                <ul class="nav nav-tabs" role="tablist">

                                    <?foreach(Lang::instance()->getLangsExcept(Lang::DEFAULT_LANGUAGE) as $iso => $lang):?>
                                        <li class="<?=(Lang::instance()->isPrimary($iso)) ? 'active' : ''?>"><a href="#short_name-<?=$iso?>" data-toggle="tab"><?=$lang['name']?></a></li>
                                    <?endforeach?>

                                </ul>
                                <!-- Tab panes -->
                                <div class="tab-content">

                                    <?foreach(Lang::instance()->getLangsExcept(Lang::DEFAULT_LANGUAGE) as $iso => $lang):?>
                                        <div class="tab-pane <?=(Lang::instance()->isPrimary($iso)) ? 'active' : ''?>" id="short_name-<?=$iso?>">
                                            <div class="form-group col-sm-13">
                                                <label for="short_name">Translated Name</label>
                                                <input type="short_name" name="content[<?=$iso?>][short_name]" class="form-control" id="short_name" placeholder="Team Short Name" <?=((Lang::instance()->isPrimary($iso)) ? ' required' : '')?>>
                                            </div>
                                        </div>
                                    <?endforeach?>

                                </div>
                            </div>
                        </div>
                        <div class="form-group col-sm-13">
                            <label class="control-label">Select Logo</label>
                            <input id="image" class="file-loading" name="image" type="file" data-show-upload="false" data-show-caption="true" accept="image/*">
                        </div>
                        <div class="form-group col-sm-13">
                            <div class="btn-group" role="group" aria-label="...">
                                <input type="submit" name="submit" value="Add Team" class="btn btn-primary">
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