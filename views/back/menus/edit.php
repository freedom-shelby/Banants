<?php
/**
 * Created by PhpStorm.
 * User: crosscomp
 * Date: 23.01.2015
 * Time: 12:23
 */
?>
<!--Begin Container-->
<div class="container">
    <div class="panel panel-primary">
        <div class="panel-heading">
            <h1>Edit Article</h1>
        </div>
        <form method="post" action="<?=\Helpers\Uri::makeUri('Admin/Articles/Edit').'/'.$article->id . App::URI_EXT?>" enctype="multipart/form-data" id="form">
            <div class="panel-body">
                <div class="group container-fluid">
                    <div class="row col-sm-6 pull-right">
                        <div class="form-group col-sm-13">
                            <label for="alias">Slug</label>
                            <input type="text" name="slug" value="<?=$article->slug?>" class="form-control" id="slug" placeholder="Slug" required>
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
                                        <option value="<?=$key?>" <?=($article->parent_id == $key) ? ' selected' : ''?>>
                                            <?=str_repeat('&nbsp',$n->lvl*2)?>&#1012<?=$n->lvl+2?>;
                                            <?=$n->title?>
                                        </option>
                                    <?endforeach?>
                                <?endif?>
                            </select>
                        </div>
                        <div class="checkbox-inline form-group col-sm-13">
                            <label>
                                <input type="checkbox" name="status" value="1" <?=($article->status) ? ' checked' : ''?>> Status
                            </label>
                        </div>
                    </div>
                    <div class="row col-sm-6 pull-left">
                        <!-- Nav tabs -->
                        <ul class="nav nav-tabs" role="tablist">
                            <?foreach(Langs::instance()->getLangs() as $iso => $lang):?>
                                <li class="<?=(Langs::instance()->isPrimary($iso)) ? 'active' : ''?>"><a href="#<?=$iso?>" data-toggle="tab"><?=$lang['name']?></a></li>
                            <?endforeach?>
                        </ul>
                        <!-- Tab panes -->
                        <div class="tab-content">
                            <?foreach(Langs::instance()->getLangs() as $iso => $lang):?>
                                <div class="tab-pane <?=(Langs::instance()->isPrimary($iso)) ? 'active' : ''?>" id="<?=$iso?>">
                                    <input type="hidden" name="content[<?=$iso?>][id]" value="<?=$contents[$iso]->id?>">
                                    <div class="form-group col-sm-13">
                                        <label for="title">Title</label>
                                        <input type="text" name="content[<?=$iso?>][title]" value="<?=$contents[$iso]->title?>" class="form-control" id="title" placeholder="Title" <?=((Langs::instance()->isPrimary($iso)) ? ' required' : '')?>>
                                    </div>
                                    <div class="form-group col-sm-13">
                                        <label for="crumb">Crumb</label>
                                        <input type="text" name="content[<?=$iso?>][crumb]" value="<?=$contents[$iso]->crumb?>" class="form-control" id="crumb" placeholder="Crumb" <?=((Langs::instance()->isPrimary($iso)) ? ' required' : '')?>>
                                    </div>
                                    <div class="form-group col-sm-13">
                                        <label for="desc">Description</label>
                                        <textarea name="content[<?=$iso?>][desc]" class="tinymce"><?=$contents[$iso]->desc?></textarea>
                                    </div>
                                    <legend>Meta Content</legend>
                                    <div class="form-group col-sm-13">
                                        <label for="meta_title">Title</label>
                                        <input type="text" name="content[<?=$iso?>][metaTitle]" value="<?=$contents[$iso]->meta_title?>" class="form-control" id="metaTitle" placeholder="Meta Title">
                                    </div>
                                    <div class="form-group col-sm-13">
                                        <label for="meta_desc">Description</label>
                                        <input type="text" name="content[<?=$iso?>][metaDesc]" value="<?=$contents[$iso]->meta_desc?>" class="form-control" id="metaDesc" placeholder="Meta Description">
                                    </div>
                                    <div class="form-group col-sm-13">
                                        <label for="name">Keys</label>
                                        <input type="text" name="content[<?=$iso?>][metaKeys]" value="<?=$contents[$iso]->meta_keys?>" class="form-control" id="metaKeys" placeholder="Meta Keys">
                                    </div>
                                    <div class="form-group col-sm-13">
                                        <div class="btn-group" role="group" aria-label="...">
                                            <input type="submit" name="submit" value="Edit Article" class="btn btn-primary">
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
    tinymce.init({
        selector: '.tinymce',
        height: 500,
        plugins: [
            'advlist autolink lists link image charmap print preview anchor',
            'searchreplace visualblocks code fullscreen',
            'insertdatetime media table contextmenu paste code'
        ],
        toolbar: 'insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image',
        content_css: [

        ]
    });
</script>