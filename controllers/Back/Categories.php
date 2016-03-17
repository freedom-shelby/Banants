<?php
/**
 * Created by PhpStorm.
 * User: Suren
 * Date: 11/19/2015
 * Time: 3:16 PM
 */

namespace Back;
restrictAccess();


use View;
use Helpers\Arr;
use Illuminate\Database\Capsule\Manager as Capsule;
use Message;
use ArticleModel;

class Categories extends Back
{
    public function getList()
    {
        $categories = new ArticleModel();
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
            $article = new ArticleModel();

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