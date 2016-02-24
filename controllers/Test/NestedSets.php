<?php
/**
 * Created by PhpStorm.
 * User: Hovhannisyan
 * Date: 26.01.2016
 * Time: 23:20
 */

/**
 * TEST TEST TEST
 */

namespace Test;

use \Category;
use Baum\Node;
use Helpers\Uri;
use Illuminate\Database\Eloquent\Model as Eloquent;


class NestedSets extends \Controller
{
    public function anyIndex()
    {
        echo "<pre>";

//        var_dump((new \CategoryMigrator)->down());
//        var_dump((new \CategoryMigrator)->up());
//        var_dump((new \ClusterMigrator)->up());

//        var_dump((new \CategorySeeder)->run());

//        var_dump((new \MultiScopedCategorySeeder)->run());

//        print_r(\Category::find(1));
//        print_r(\hmap(\Category::getNestedList()));
//        print_r(\Category::getNestedList('name'));

//        print_r(\Category::getNestedList('name'));

//        print_r((new \CategoryColumnsTest())->testGetRight());


//        $root = Category::create(['name' => 'Root category 2']);

        // Directly with a relation
//        $child1 = $root->children()->create(['name' => 'Child 1']);

        // with the `makeChildOf` method
//        $child2 = Category::create(['name' => 'Child 3']);
//        $child2->makeChildOf($root);

//        print_r(Category::root()->get()->toArray());

//        $node2 = Category::find(2);


//        $node2 = \ArticleModel::find(1);
//        $node3 = \ArticleModel::find(3);
//        $node54 = \ArticleModel::find(54);

//        $otherNode = Category::find(17);
//        $node = Category::roots()->get()->toArray();
//        print_r( $node->isAncestorOf($node2));
//        print_r( $node2->ancestors()->find(6)->toArray());

//        print_r( $node2->getAncestorsWithoutRoot()->toArray());

//        $node = Category::find(41);
//        foreach($node->getDescendantsAndSelf() as $descendant) {
//            echo "{$descendant->name} <br>";
//        }

//        $node = Category::where('name', '=', 'Root 2')->first();
//        $a = $node->getDescendants(5, array('id', 'parent_id', 'name'))->find(1)->toArray();
//        print_r($a);

//        $tree = Category::where('name', '=', 'Root 1')->first()->getDescendantsAndSelf()->toHierarchy();
//        $tree = Category::find(1)->all()->toHierarchy();
//        print_r($tree->toArray());

//        $node = new \MenuItemModel();
//        var_dump($node::rebuild());
//        print_r($node->getNestedList('slug', null, '.'));
//        $node->moveLeft();
//        $node2->moveToLeftOf($node3);

//        print_r($node::getNestedList('name', 0, '.'));

//        print_r($node::getNode());
//        print_r(\Langs::instance()->getLangs());
//        print_r(\Langs::instance()->getPrimaryLang());
//        print_r($node->contents()->get()->toArray());

//        $node2->delete();

//        $root = $node->children()->create(['slug' => 'Test']);

//        var_dump($node54->makeChildOf($node3));

//        var_dump($node3->isLeaf());
//        if($node2){
//            $node3->makeChildOf($node2);
//        }else{
//            $node3->makeRoot();
//        }

    }
}