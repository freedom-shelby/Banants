<?php
restrictAccess();


use Baum\Node as BaumNode;
use Illuminate\Database\Eloquent;

/**
 * Node
 *
 * Nested sets are appropiate when you want either an ordered tree (menus,
 * commercial categories, etc.) or an efficient way of querying big trees.
 */
class Node extends BaumNode
{

    public static function getNestedList($column, $key = null, $seperator = ' ')
    {
        $instance = new static;

        $key = $key ?: $instance->getKeyName();
        $depthColumn = $instance->getDepthColumnName();

//    $nodes = $instance->newNestedSetQuery()->get()->toArray();
        $nodes = $instance->newNestedSetQuery()->get()->getDictionary();

        return array_combine(
            array_map(
                function ($node) use ($key) {
                    return $node[$key];
                }, $nodes),
            array_map(
                function ($node) use ($seperator, $depthColumn, $column) {
                    return str_repeat($seperator, $node->$depthColumn) . $node->$column;
                }, $nodes)
        );
    }

    public static function getNode()
    {
        $instance = new static;

        $nodes = $instance->newNestedSetQuery();
        $nodes = $nodes->get();
        $nodes = $nodes->getDictionary();

        return $nodes;
    }

    public static function getSortableNode()
    {
        $instance = new static;

        $nodes = $instance->newNestedSetQuery();
        $nodes = $nodes->get()->toHierarchy();
//        $nodes = $nodes->whereStatus(1)->get()->toHierarchy();
//echo '<pre>';
//print_r($nodes);
//die;
        $output = '<ol class="sortable ui-sortable">';
            $output .= static::renderSortableNode($nodes);
        $output .= '</ol>';

        return $output;
    }

    public static function renderSortableNode($nodes)
    {
        $output = '';
        if(isset($nodes)){
            foreach($nodes as $node){
                $output .= '<li class="' . ((!$node->status) ? 'invisible-article' : '') . '"id="node_' . $node->id . '">';

                    // Если status 0 то присвоить клаас чтобы не показавыть с активноми
                    $output .= '<div class="node-item"><a href=""></a>
                                    <span class="glyphicon glyphicon-move move" aria-hidden="true"></span>
                                    <a href="' . \Helpers\Uri::makeUri("Admin/Articles/Edit").'/'.$node->id . App::URI_EXT . '">
                                        ' . $node->title . '
                                    </a>
                                    <div class="pull-right">
                                        <a href="' . \Helpers\Uri::makeUri("Admin/Articles/Edit").'/'.$node->id . App::URI_EXT . '">
                                            <i class="glyphicon glyphicon-pencil" aria-hidden="true"></i>
                                        </a>
                                        <a class="remove-confirm" href="' . \Helpers\Uri::makeUri("Admin/Articles/Delete").'/'.$node->id . App::URI_EXT . '">
                                            <i class="glyphicon glyphicon-remove-sign"></i>
                                        </a>
                                    </div>
                                </div>';

                    if(isset($node->children)) {
                        $output .= '<ol>';
                            $output .= static::renderSortableNode($node->children);
                        $output .= '</ol>';
                    }

                $output .= '</li>';
            }
        }

        return $output;
    }
}
