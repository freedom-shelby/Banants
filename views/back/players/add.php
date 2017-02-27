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
            <h1>Add Player</h1>
        </div>
        <form method="post" enctype="multipart/form-data" id="form">
            <div class="panel-body">
                <div class="group container-fluid">
                    <div class="row col-sm-5 pull-right">
<!--                        <div class="form-group col-sm-13">-->
<!--                            <label for="alias">Slug</label>-->
<!--                            <input type="text" name="slug" class="form-control" id="slug" placeholder="Slug" required>-->
<!--                        </div>-->
                        <div class="form-group col-sm-9">
                            <label for="country">Select Country</label>
                            <select name="country">
                                <?foreach(CountryModel::all() as $i):?>
                                    <option value="<?=$i->id?>">
                                        <?=$i->title()?>
                                    </option>
                                <?endforeach?>
                            </select>
                        </div>
                        <div class="form-group col-sm-9">
                            <label for="position">Select Position</label>
                            <select name="position">
                                <?foreach(PositionModel::all() as $i):?>
                                    <option value="<?=$i->id?>">
                                        <?=$i->title()?>
                                    </option>
                                <?endforeach?>
                            </select>
                        </div>
                        <div class="form-group col-sm-9">
                            <div class="dates">
                                <label for="was_born">Was Born</label>
                                <div class='input-group date datetimepicker'>
                                    <input type='text' name="was_born" class="form-control" />
                                    <span class="input-group-addon">
                                        <span class="glyphicon glyphicon-calendar"></span>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="form-group col-sm-9">
                            <label for="number">Set Player Number</label>
                            <input type="number" name="number" class="form-control" id="number" placeholder="Number">
                        </div>
                        <div class="form-group col-sm-9">
                            <label for="height">Set Player Height</label>
                            <input type="text" name="height" class="form-control" id="height" placeholder="Height">
                        </div>
                        <div class="form-group col-sm-9">
                            <label for="weight">Set Player Weight</label>
                            <input type="text" name="weight" class="form-control" id="weight" placeholder="Weight">
                        </div>
                        <div class="form-group col-sm-9">
                            <label class="control-label">Select File</label>
                            <input id="image" class="file-loading" name="image" type="file" data-show-upload="false" data-show-caption="true" accept="image/*">
                        </div>
                        <div class="checkbox-inline form-group col-sm-13">
                            <label>
                                <input type="checkbox" name="status" value="1" checked> Status
                            </label>
                        </div>
                    </div>
                    <div class="row col-sm-7 pull-left">
                        <div class="bordered">
                            <div>
                                <div class="form-group col-sm-13">
                                    <label for="entity">First Name</label>
                                    <input type="text" name="first_name" class="form-control" id="entity" placeholder="Primary Language" required>
                                </div>
                                <!-- Nav tabs -->
                                <ul class="nav nav-tabs" role="tablist">
                                    <?foreach(Lang::instance()->getLangsExcept(Lang::DEFAULT_LANGUAGE) as $iso => $lang):?>
                                        <li class="<?=(Lang::instance()->isPrimary($iso)) ? 'active' : ''?>"><a href="#first-name-<?=$iso?>" data-toggle="tab"><?=$lang['name']?></a></li>
                                    <?endforeach?>
                                </ul>
                                <!-- Tab panes -->
                                <div class="tab-content">
                                    <?foreach(Lang::instance()->getLangsExcept(Lang::DEFAULT_LANGUAGE) as $iso => $lang):?>
                                        <div class="tab-pane <?=(Lang::instance()->isPrimary($iso)) ? 'active' : ''?>" id="first-name-<?=$iso?>">
                                            <div class="form-group col-sm-13">
                                                <label for="text">Translated Name</label>
                                                <input type="text" name="content[<?=$iso?>][first_name]" class="form-control" id="text" placeholder="Player Name" <?=((Lang::instance()->isPrimary($iso)) ? ' required' : '')?>>
                                            </div>
                                        </div>
                                    <?endforeach?>
                                </div>
                            </div>
                            <div>
                                <div class="form-group col-sm-13">
                                    <label for="entity">Last Name</label>
                                    <input type="text" name="last_name" class="form-control" id="entity" placeholder="Primary Language" required>
                                </div>
                                <!-- Nav tabs -->
                                <ul class="nav nav-tabs" role="tablist">
                                    <?foreach(Lang::instance()->getLangsExcept(Lang::DEFAULT_LANGUAGE) as $iso => $lang):?>
                                        <li class="<?=(Lang::instance()->isPrimary($iso)) ? 'active' : ''?>"><a href="#last-name-<?=$iso?>" data-toggle="tab"><?=$lang['name']?></a></li>
                                    <?endforeach?>
                                </ul>
                                <!-- Tab panes -->
                                <div class="tab-content">
                                    <?foreach(Lang::instance()->getLangsExcept(Lang::DEFAULT_LANGUAGE) as $iso => $lang):?>
                                        <div class="tab-pane <?=(Lang::instance()->isPrimary($iso)) ? 'active' : ''?>" id="last-name-<?=$iso?>">
                                            <div class="form-group col-sm-13">
                                                <label for="text">Translated Name</label>
                                                <input type="text" name="content[<?=$iso?>][last_name]" class="form-control" id="text" placeholder="Player Name" <?=((Lang::instance()->isPrimary($iso)) ? ' required' : '')?>>
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
                                <div class="tab-pane <?=(Lang::instance()->isPrimary($iso)) ? 'active' : ''?>" id="<?=$iso?>">
                                    <div class="form-group col-sm-13">
                                        <label for="desc">Biography</label>
                                        <textarea name="content[<?=$iso?>][desc]" class="tinymce"></textarea>
                                    </div>
                                    <div class="form-group col-sm-13">
                                        <div class="btn-group" role="group" aria-label="...">
                                            <input type="submit" name="submit" value="Add Player" class="btn btn-primary">
                                        </div>
                                    </div>
                                </div>
                            <?endforeach?>
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

    $('.datetimepicker').datetimepicker({
        format: 'YYYY-MM-DD HH:mm:SS',
        viewDate: moment(new Date()).hours(15).minutes(0).seconds(0).milliseconds(0)
    });
</script>
