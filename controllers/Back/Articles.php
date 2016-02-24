<?php
/**
 * Created by PhpStorm.
 * User: Suren
 * Date: 11/19/2015
 * Time: 3:16 PM
 */

namespace Back;

if(!defined('ROOT_PATH')){header('HTTP/1.0 404 Not Found'); die("<h1>404 Not Found</h1>The page that you have requested could not be found.");}

use Helpers\Uri;
use Http\Exception;
use View;
use Message;
use Helpers\Arr;
use Illuminate\Contracts\Validation;
use \ArticleModel;
use \ContentModel;
use Illuminate\Database\Capsule\Manager as Capsule;
use Http\Exception as HttpException;


class Articles extends Back
{
    public function getList(){
        $articles = ArticleModel::all();
        $this->layout->content = View::make('back/articles/list')
            ->with('articles', $articles);
    }

    /**
     * Добавления материалов
     */
    public function anyAdd()
    {
        $articles = new ArticleModel();
//        $content = new ContentModel();

        if (null !== Arr::get($this->getPostData(),'submit')) {

            $data = Arr::extract($this->getPostData(), ['slug', 'parentId', 'status', 'content']);
            $parent = ArticleModel::find($data['parentId']);

            // Транзакция для Записание данных в базу
            Capsule::connection()->transaction(function() use ($data, $parent){

                $newArticle = ArticleModel::create([
                    'slug' => $data['slug'],
                    'status' => $data['status'],
                ]);
                if ($parent) {
                    $newArticle->makeChildOf($parent);
                } else {
                    $newArticle->makeRoot();
                }

                foreach($data['content'] as $iso => $item){
                    $lang_id = \Langs::instance()->getLang($iso)['id'];
                    $content = ContentModel::create([
                        'title' => $item['title'],
                        'crumb' => $item['crumb'],
                        'desc' => $item['desc'],
                        'meta_title' => $item['metaTitle'],
                        'meta_desc' => $item['metaDesc'],
                        'meta_keys' => $item['metaKeys'],
                        'lang_id' => $lang_id,
                    ]);
                    $newArticle->contents()->attach($content);
                }
            });

            Message::instance()->success('Articles has successfully added');
//            Message::warning($e->errors('validation'));
//            $this->redirect('admin/articles/add/');

        }

        $this->layout->content = View::make('back/articles/add')
            ->with('node', $articles::getNode());
    }

    /**
     * Редактирование материалов
     */
    public function anyEdit()
    {
        $id = (int) $this->getRequestParam('id') ?: null;

        $article = ArticleModel::find($id);

        if (empty($article)) {
            throw new HttpException(404,json_encode(['errorMessage' => 'Incorrect Article']));
        }

        // Загрузка контента для каждово языка
        $contents = [];
        foreach(\Langs::instance()->getLangs() as $iso => $lang){
            $contents[$iso] = $article->contents()->where('lang_id', '=', $lang['id'])->first();
        }
//        echo '<pre>';
//var_dump($contents);die;
        if (null !== Arr::get($this->getPostData(),'submit')) {

            $data = Arr::extract($this->getPostData(), ['slug', 'parentId', 'status', 'content']);
//echo '<pre>'; print_r($data);die;

            $parent = ArticleModel::find($data['parentId']);
            // Транзакция для Записание данных в базу
            try {
                Capsule::connection()->transaction(function () use ($data, $article, $parent) {
                    if ($parent) {
                        $article->makeChildOf($parent);
                    } else {
                        $article->makeRoot();
                    }

                    // Заодно обновляет и пункты меню привязанные к slug-у
                    (new \MenuItemModel)->whereSlug($article->slug)->update([
                        'slug' => $data['slug'],
                    ]);

                    $article->update([
                        'slug' => $data['slug'],
                        'status' => $data['status'],
                    ]);

                    foreach ($data['content'] as $iso => $item) {
                        $lang_id = \Langs::instance()->getLang($iso)['id'];
                        $content = ContentModel::find($item['id']);
                        $content->update([
                            'title' => $item['title'],
                            'crumb' => $item['crumb'],
                            'desc' => $item['desc'],
                            'meta_title' => $item['metaTitle'],
                            'meta_desc' => $item['metaDesc'],
                            'meta_keys' => $item['metaKeys'],
                            'lang_id' => $lang_id,
                        ]);
//                    $article->contents()->attach($content);
                    }
                });
                Message::instance()->success('Article was successfully edited');
            } catch (Exception $e) {
                Message::instance()->warning('Article was don\'t edited');
            }
        }
        $this->layout->content = View::make('back/articles/edit')
            ->with('node', $article::getNode())
            ->with('article', $article)
            ->with('contents', $contents);
    }

    public function getDelete()
    {
        $this->layout = false;

        $id = (int) $this->getRequestParam('id') ?: null;

        $article = ArticleModel::find($id);

        if (empty($article)) {
            throw new HttpException(404,json_encode(['errorMessage' => 'Incorrect Article']));
        }

        // Транзакция для Записание данных в базу
        Capsule::connection()->transaction(function() use ($article){

            // Заодно удаляет и пункты меню привязанные к slug-у
            (new \MenuItemModel)->whereSlug($article->slug)->delete();

            foreach($article->getDescendantsAndSelf() as $desc){
                $desc->contents()->delete();
            }
            $article->delete();
        });

        Message::instance()->success('Articles has successfully deleted');
        Uri::to('/Admin/Categories');
    }
}