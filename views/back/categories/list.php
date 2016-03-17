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
            <a class="btn btn-primary" href="<?=\Helpers\Uri::makeRouteUri('back.articles.add')?>">Add Article</a>
            <button name="article-node-save" class="btn btn-primary">Save</button>
            <div>
                <label for="show-invisible-items">Show Invisible Articles</label>
                <input class="checkbox-inline" type="checkbox" id="show-invisible-items"/>
            </div>
            <?if($categories->count()):?>
                <?=$categories::getArticleSortableNode()?>
            <?endif?>
		</div>
	</div>
</div>

<div>
    <h3>Response Examples</h3>
    <p>
        <br>
        <input id="serialize" name="serialize" type="submit" value="Serialize">
    </p>
    <pre id="serializeOutput"></pre>

    <p>
        <input id="toArray" name="toArray" type="submit" value="To array">
    </p>
    <pre id="toArrayOutput"></pre>

    <p>
        <input id="toHierarchy" name="toHierarchy" type="submit" value="To hierarchy">
    </p>
    <pre id="toHierarchyOutput"></pre>
</div>