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
            <h1>Edit Personnel</h1>
        </div>
        <div class="panel-body">
            <form method="post" enctype="multipart/form-data" id="form">
                <div class="group container-fluid">
                    <div class="row col-sm-5 pull-right">
                        <div class="form-group col-sm-13">
                            <label for="alias">Slug</label>
                            <input type="text" name="slug" value="<?=$item->slug?>" class="form-control" id="slug" placeholder="Slug" required>
                        </div>
                        <div class="form-group col-sm-9">
                            <label for="personnel_type">Select Personnel Post</label>
                            <select name="personnel_type">
                                <?foreach(PersonnelTypeModel::all() as $i):?>
                                    <option value="<?=$i->id?>" <?=($item->personnel_type_id == $i->id) ? ' selected' : ''?>>
                                        <?=$i->name?>
                                    </option>
                                <?endforeach?>
                            </select>
                        </div>
                        <div class="form-group col-sm-9">
                            <div class="dates">
                                <label for="was_born">Was Born</label>
                                <div class='input-group date datetimepicker'>
                                    <input type='text' name="was_born" class="form-control" value="<?= $item->was_born ?>"/>
                                    <span class="input-group-addon">
                                        <span class="glyphicon glyphicon-calendar"></span>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="form-group col-sm-9">
                            <label for="sort">Set Sort Position</label>
                            <input type="number" value="<?=$item->sort?>" name="sort" class="form-control" id="sort" placeholder="Sort">
                        </div>
                        <div class="form-group col-sm-9">
                            <label class="control-label">Select File</label>
                            <input id="image" class="file-loading" name="image" type="file" data-show-upload="false" data-show-caption="true" accept="image/*">
                        </div>
                        <div class="checkbox-inline form-group col-sm-13">
                            <label>
                                <input type="checkbox" name="status" value="1" <?=($item->status) ? ' checked' : ''?>> Status
                            </label>
                        </div>
                    </div>
                    <div class="row col-sm-7 pull-left">
                        <div class="bordered">
                            <div>
                                <div class="form-group col-sm-13">
                                    <label for="entity">First Name</label>
                                    <input type="text" value="<?=$item->firstName()?>" name="first_name" class="form-control" id="entity" placeholder="Primary Language" required>
                                </div>
                                <!-- Nav tabs -->
                                <ul class="nav nav-tabs" role="tablist" id="first-name">
                                    <?foreach(Lang::instance()->getLangsExcept(Lang::DEFAULT_LANGUAGE) as $iso => $lang):?>
                                        <li class="<?=(Lang::instance()->isPrimary($iso)) ? 'active' : ''?>"><a href="#first-name-<?=$iso?>" data-toggle="tab"><?=$lang['name']?></a></li>
                                    <?endforeach?>
                                </ul>
                                <!-- Tab panes -->
                                <div class="tab-content" id="first-name">
                                    <?foreach(Lang::instance()->getLangsExcept(Lang::DEFAULT_LANGUAGE) as $iso => $lang):?>
                                        <div class="tab-pane <?=(Lang::instance()->isPrimary($iso)) ? 'active' : ''?>" id="first-name-<?=$iso?>">
                                            <input type="hidden" name="content[<?=$iso?>][first_name_id]" value="<?=isset($contents[$iso]['firstName']->id) ? $contents[$iso]['firstName']->id : ''?>">
                                            <div class="form-group col-sm-13">
                                                <label for="text">Translated Name</label>
                                                <input type="text" name="content[<?=$iso?>][first_name]" value="<?=isset($contents[$iso]['firstName']->text) ? $contents[$iso]['firstName']->text : ''?>" class="form-control" id="text" placeholder="Player Name" <?=((Lang::instance()->isPrimary($iso)) ? ' required' : '')?>>
                                            </div>
                                        </div>
                                    <?endforeach?>
                                </div>
                            </div>
                            <div>
                                <div class="form-group col-sm-13">
                                    <label for="entity">Last Name</label>
                                    <input type="text" value="<?=$item->lastName()?>" name="last_name" class="form-control" id="entity" placeholder="Primary Language" required>
                                </div>
                                <!-- Nav tabs -->
                                <ul class="nav nav-tabs" role="tablist" id="last-name">
                                    <?foreach(Lang::instance()->getLangsExcept(Lang::DEFAULT_LANGUAGE) as $iso => $lang):?>
                                        <li class="<?=(Lang::instance()->isPrimary($iso)) ? 'active' : ''?>"><a href="#last-name-<?=$iso?>" data-toggle="tab"><?=$lang['name']?></a></li>
                                    <?endforeach?>
                                </ul>
                                <!-- Tab panes -->
                                <div class="tab-content" id="last-name">
                                    <?foreach(Lang::instance()->getLangsExcept(Lang::DEFAULT_LANGUAGE) as $iso => $lang):?>
                                        <div class="tab-pane <?=(Lang::instance()->isPrimary($iso)) ? 'active' : ''?>" id="last-name-<?=$iso?>">
                                            <input type="hidden" name="content[<?=$iso?>][last_name_id]" value="<?=isset($contents[$iso]['lastName']->id) ? $contents[$iso]['lastName']->id : ''?>">
                                            <div class="form-group col-sm-13">
                                                <label for="text">Translated Name</label>
                                                <input type="text" name="content[<?=$iso?>][last_name]" value="<?=isset($contents[$iso]['lastName']->text) ? $contents[$iso]['lastName']->text : ''?>" class="form-control" id="text" placeholder="Player Name" <?=((Lang::instance()->isPrimary($iso)) ? ' required' : '')?>>
                                            </div>
                                        </div>
                                    <?endforeach?>
                                </div>
                            </div>
                            <div>
                                <div class="form-group col-sm-13">
                                    <label for="entity">Middle Name</label>
                                    <input type="text" value="<?=$item->middleName()?>" name="middle_name" class="form-control" id="entity" placeholder="Primary Language" required>
                                </div>
                                <!-- Nav tabs -->
                                <ul class="nav nav-tabs" role="tablist" id="middle-name">
                                    <?foreach(Lang::instance()->getLangsExcept(Lang::DEFAULT_LANGUAGE) as $iso => $lang):?>
                                        <li class="<?=(Lang::instance()->isPrimary($iso)) ? 'active' : ''?>"><a href="#middle-name-<?=$iso?>" data-toggle="tab"><?=$lang['name']?></a></li>
                                    <?endforeach?>
                                </ul>
                                <!-- Tab panes -->
                                <div class="tab-content" id="middle-name">
                                    <?foreach(Lang::instance()->getLangsExcept(Lang::DEFAULT_LANGUAGE) as $iso => $lang):?>
                                        <div class="tab-pane <?=(Lang::instance()->isPrimary($iso)) ? 'active' : ''?>" id="middle-name-<?=$iso?>">
                                            <input type="hidden" name="content[<?=$iso?>][middle_name_id]" value="<?=isset($contents[$iso]['middleName']->id) ? $contents[$iso]['middleName']->id : ''?>">
                                            <div class="form-group col-sm-13">
                                                <label for="text">Translated Name</label>
                                                <input type="text" name="content[<?=$iso?>][middle_name]" value="<?=isset($contents[$iso]['middleName']->text) ? $contents[$iso]['middleName']->text : ''?>" class="form-control" id="text" placeholder="Player Name" <?=((Lang::instance()->isPrimary($iso)) ? ' required' : '')?>>
                                            </div>
                                        </div>
                                    <?endforeach?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row col-sm-7 pull-left">
                        <!-- Nav tabs -->
                        <ul class="nav nav-tabs" role="tablist">
                            <?foreach(Lang::instance()->getLangs() as $iso => $lang):?>
                                <li class="<?=(Lang::instance()->isPrimary($iso)) ? 'active' : ''?>"><a href="#<?=$iso?>" data-toggle="tab"><?=$lang['name']?></a></li>
                            <?endforeach?>
                        </ul>
                        <!-- Tab panes -->
                        <div class="tab-content">
                            <?foreach(Lang::instance()->getLangs() as $iso => $lang):?>
                                <input type="hidden" name="content[<?=$iso?>][content_id]" value="<?=isset($contents[$iso]['content']->id) ? $contents[$iso]['content']->id : ''?>">
                                <div class="tab-pane <?=(Lang::instance()->isPrimary($iso)) ? 'active' : ''?>" id="<?=$iso?>">
                                    <div class="form-group col-sm-13">
                                        <label for="desc">Biography</label>
                                        <textarea name="content[<?=$iso?>][desc]" class="tinymce" >
                                            <?=isset($contents[$iso]['content']->desc) ? $contents[$iso]['content']->desc : '' ?>
                                        </textarea>
                                    </div>
                                </div>
                            <?endforeach?>
                        </div>
                        <div class="form-group col-sm-13">
                            <div class="btn-group" role="group" aria-label="...">
                                <input type="submit" name="submit" value="Save" class="btn btn-primary">
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
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
                <?=($item->defaultImage()) ? '\'<img style="height:160px" src="'.$item->defaultImage()->path.'">\'' : ''?>
            ],
            initialPreviewConfig: [{
                caption: '<?=$item->firstName().' Icon'?>',
                width: "120px",
                url: '<?=Uri::makeRouteUri("back.menus.image.delete")?>',
                key: <?=$item->id?>
            }]
        });

        $('.datetimepicker').datetimepicker({
            format: 'YYYY-MM-DD HH:mm:SS',
            viewDate: moment(new Date()).hours(15).minutes(0).seconds(0).milliseconds(0)
        });
    });
</script>