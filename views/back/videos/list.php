<?php
/**
 * Created by PhpStorm.
 * User: crosscomp
 * Date: 22.01.2015
 * Time: 11:54
 */

use Helpers\Uri;

?>
<div class="container-fluid team-list">
    <div class="panel panel-primary">
        <div class="panel-heading">
            <h3>Videos List</h3>
        </div>
        <div class="panel-body">
            <a class="btn btn-primary" href="<?=Uri::makeUriFromId('Admin/Videos/Add')?>">Add Video</a>

            <? if($items->count()): ?>
                <div class="table-responsive">
                    <table class="table list-items">
                        <thead>
                        <tr>
                            <th>Path</th>
                            <th>Video ID</th>
                            <th>Logo</th>
                            <th>Delete</th>
                        </tr>
                        </thead>
                        <tbody>

                        <? foreach($items as $item): ?>
                            <tr>
                                <td><?= __($item->path) ?></td>
                                <td><?= __($item->youtube_id) ?></td>
                                <td><img class="video-images" src="http://img.youtube.com/vi/<?= $item->youtube_id ?>/mqdefault.jpg" alt="content_slider_middle_images1"></td>
                                <td>
                                    <a class="remove-confirm" href="<?= Uri::makeUriFromId('Admin/Videos/Delete/'.$item->id) ?>"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></a>
                                </td>
                            </tr>
                        <? endforeach ?>

                    </table>
                </div>
            <? endif ?>

        </div>
    </div>
</div>