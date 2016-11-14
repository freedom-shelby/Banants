<?php
/**
 *
 * Created by PhpStorm.
 * User: Arsen
 * Date: 11/6/2015
 * Time: 3:20 PM
 */

?>

<? foreach (array_chunk($photos->getCollection()->all(), 3) as $row): ?>
    <div class="row">
        <? foreach ($row as $item): ?>
            <div class="col-lg-4 thumb">
                <div class="thumbnail article-context-menu">
                    <img class="img-responsive" src="<?= $item['path'] ?>" alt="" data-photo-id="<?= $item['id'] ?>">
                </div>
            </div>
        <? endforeach ?>
    </div>
<? endforeach ?>
<?= $photos->render() ?>