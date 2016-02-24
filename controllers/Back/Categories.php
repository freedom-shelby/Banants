<?php
/**
 * Created by PhpStorm.
 * User: Suren
 * Date: 11/19/2015
 * Time: 3:16 PM
 */

namespace Back;

if(!defined('ROOT_PATH')){header('HTTP/1.0 404 Not Found'); die("<h1>404 Not Found</h1>The page that you have requested could not be found.");}

use View;
use Helpers\Arr;
use Illuminate\Database\Capsule\Manager as Capsule;
use Message;

class Categories extends Back
{
    public function getList()
    {
        $categories = new \ArticleModel();
        $this->layout->content = View::make('back/categories/list')
            ->with('categories', $categories);

    }

    public function anySaveSorting()
    {
        $this->layout = false;

        $data = Arr::get($this->getPostData(),'data');

        //В качестве ответа выводим окно логина
        $response = 'Unfaithful Categories Sorting';


        if(!empty($data))
        {
            $data = json_decode($data, true);
            $article = new \ArticleModel();

            if(!empty($data))
            {
                Capsule::connection()->transaction(function() use ($data, $article, &$response){
                    foreach($data as $item)
                    {
                        $article::find($item['id'])->update([
                            'parent_id' => $item['parent_id'],
                            'lvl' => $item['depth'],
                            'lft' => $item['left'],
                            'rgt' => $item['right'],
                        ]);
                    }

                    $response = 'Categories Sorting has successfully saved';
                });
            }
        }

        Message::instance()->info($response);

        echo Message::instance()->flash_all();
    }

}