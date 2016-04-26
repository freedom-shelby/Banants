<?php
/**
 * Created by PhpStorm.
 * User: crosscomp
 * Date: 22.01.2015
 * Time: 11:54
 */
?>
<div class="container-fluid">
    <div class="panel panel-primary">
        <div class="panel-heading">
            <h3>Categories List</h3>
        </div>
        <div class="panel-body">
            <a class="btn btn-primary" href="<?=Helpers\Uri::makeUriFromId('Admin/Menus/Add/' . $id)?>">Add Menu</a>
            <button name="menu-node-save" class="btn btn-primary">Save</button>
            <div>
                <label for="show-invisible-items">Show Invisible Menus</label>
                <input class="checkbox-inline" type="checkbox" id="show-invisible-items"/>
            </div>
            <?if($items->count()):?>
                <?=$items::getMenuSortableNode()?>
            <?endif?>
        </div>
    </div>
</div>

<script>
    $(document).ready(function(){
        // Показать толко те елементи которие принедлежат текущему меню
        $((document)).find(".menu-node-item").hide();
        $((document)).find("[data-menu-id='" + <?=$id?> + "']").show();
    });
</script>