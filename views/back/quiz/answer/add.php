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
            <h1>Add Quiz Answer</h1>
        </div>
        <form method="post" id="form">
            <div class="panel-body">
                <div class="group container-fluid">
                    <div class="form-group col-sm-13">
                        <label for="name">Name</label>
                        <input type="text" name="name" class="form-control" id="name" placeholder="Entity..." required>
                    </div>
                    <ul class="nav nav-tabs" role="tablist">

                        <?foreach(Lang::instance()->getLangsExcept(Lang::DEFAULT_LANGUAGE) as $iso => $lang):?>
                            <li class="<?=(Lang::instance()->isPrimary($iso)) ? 'active' : ''?>"><a href="#<?=$iso?>" data-toggle="tab"><?=$lang['name']?></a></li>
                        <?endforeach?>

                    </ul>
                    <div class="tab-content">

                        <?foreach(Lang::instance()->getLangsExcept(Lang::DEFAULT_LANGUAGE) as $iso => $lang):?>
                            <div class="tab-pane <?=(Lang::instance()->isPrimary($iso)) ? 'active' : ''?>" id="<?=$iso?>">
                                <div class="form-group col-sm-13">
                                    <label for="text">Translation Text</label>
                                    <input type="text" name="content[<?=$iso?>][text]" class="form-control" id="text" placeholder="Text, With parameter replacement :NAME" <?=((Lang::instance()->isPrimary($iso)) ? ' required' : '')?>>
                                </div>
                            </div>
                        <?endforeach?>

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