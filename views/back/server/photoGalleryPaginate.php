<?php
/**
 *
 * Created by PhpStorm.
 * User: Arsen
 * Date: 11/6/2015
 * Time: 3:20 PM
 */

?>

<div class="ui-widget ui-helper-clearfix">

    <ul id="gallery" class="gallery ui-helper-reset ui-helper-clearfix">
        <? foreach ($photos->getCollection()->all() as $item): ?>
            <li class="ui-widget-content ui-corner-tr" data-photo-id="<?= $item['id'] ?>">
                <input type="hidden" name="photos[]" value="<?= $item['id'] ?>">
                <h5 class="ui-widget-header">High Tatras</h5>
                <img src="<?= $item['path'] ?>" alt="The peaks of High Tatras" width="96" height="72">
                <a href="<?= $item['path'] ?>" title="View larger image" class="ui-icon ui-icon-zoomin" target="_blank">View larger</a>
                <a href="#" title="Recycle this image" class="ui-icon ui-icon-refresh">Recycle image</a>
            </li>
        <? endforeach ?>
    </ul>
</div>

<?= $photos->render() ?>
