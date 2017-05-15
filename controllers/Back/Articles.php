<?php
/**
 * Created by PhpStorm.
 * User: Suren
 * Date: 11/19/2015
 * Time: 3:16 PM
 */

namespace Back;
restrictAccess();


use Event;
use Helpers\Uri;
use Illuminate\Pagination\AbstractPaginator;
use Illuminate\Pagination\Paginator;
use View;
use Message;
use Lang\Lang;
use Helpers\Arr;
use Illuminate\Contracts\Validation;
use ArticleModel;
use ContentModel;
use Illuminate\Database\Capsule\Manager as Capsule;
use Http\Exception as HttpException;
use Illuminate\Database\QueryException;
use PhotoModel;
use MenuItemModel;
use Carbon\Carbon;


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

        if (Arr::get($this->getPostData(),'submit') !== null) {

            $data = Arr::extract($this->getPostData(), ['slug', 'parentId', 'status', 'photo-id', 'content']);
            $parent = ArticleModel::find($data['parentId']);

            // Транзакция для Записание данных в базу
            Capsule::connection()->transaction(function() use ($data, $parent){

                $newArticle = ArticleModel::create([
                    'slug' => $data['slug'],
                    'status' => $data['status'],
                    'photo_id' => $data['photo-id'],
                ]);
                if ($parent) {
                    $newArticle->makeChildOf($parent);
                } else {
                    $newArticle->makeRoot();
                }

                foreach($data['content'] as $iso => $item){
                    $lang_id = Lang::instance()->getLang($iso)['id'];
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

                $time = Carbon::now();

                Lang::instance()->setCurrentLang(Lang::DEFAULT_LANGUAGE);

                $slug = strtolower($newArticle->title) . '_' . $time->year . '_' . $time->month . '_' . $time->day . '_' . $time->minute.$time->second; // todo:: add slugable CLASS by DateTime
                $slug = str_replace(' ', '_', $slug); // todo:: add slugable CLASS by DateTime

                if(ArticleModel::whereSlug($slug)->first())
                {
                    $slug .= uniqid();
                }

                $newArticle->update(['slug' => $slug]);

//            $model->contents()->detach($model->id);
                    // do the rest of the cleanup...
            });

            Message::instance()->success('Articles has successfully added');
//            Message::warning($e->errors('validation'));
//            $this->redirect('admin/articles/add/');

        }

        $this->layout->content = View::make('back/articles/add')
            ->with('node', $articles::getCategoryNode());
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
        
        if (Arr::get($this->getPostData(),'submit') !== null) {

            $data = Arr::extract($this->getPostData(), ['slug', 'parentId', 'status', 'photo-id', 'content']);

            $parent = ArticleModel::find($data['parentId']);
            // Транзакция для Записание данных в базу
            try {
                Event::fire('Admin.beforeArticleUpdate',$article);
                Capsule::connection()->transaction(function () use ($data, $article, $parent) {
                    if ($parent) {
                        $article->makeChildOf($parent);
                    } else {
                        $article->makeRoot();
                    }

                    // Заодно обновляет и пункты меню привязанные к slug-у
                    (new MenuItemModel)->whereSlug($article->slug)->update([
                        'slug' => $data['slug'],
                    ]);

                    $article->update([
                        'slug' => $data['slug'],
                        'status' => $data['status'],
                        'photo_id' => $data['photo-id'],
                    ]);

                    foreach ($data['content'] as $iso => $item) {
                        $lang_id = Lang::instance()->getLang($iso)['id'];

                        if(((int)$item['id']) != 0) {
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
                        } else {
                            //todo: надо по тестить почему без ID каждий раз создаётся все записи а не обновляются
                            $content = ContentModel::create([
                                'article_id' => $data['content']['ru']['id'],
                                'title' => $item['title'],
                                'crumb' => $item['crumb'],
                                'desc' => $item['desc'],
                                'meta_title' => $item['metaTitle'],
                                'meta_desc' => $item['metaDesc'],
                                'meta_keys' => $item['metaKeys'],
                                'lang_id' => $lang_id,
                            ]);
                            $article->contents()->attach($content);

                        }
//                    $article->contents()->attach($content);
                    }
                });
                Event::fire('Admin.articleUpdate',$article);
            } catch (QueryException $e) {
                Message::instance()->warning('Article was don\'t edited');
            }
        }

        // Загрузка контента для каждово языка
        $contents = [];
        foreach(Lang::instance()->getLangs() as $iso => $lang){
            $contents[$iso] = $article->contents()->where('lang_id', '=', $lang['id'])->first();
        }

        $this->layout->content = View::make('back/articles/edit')
            ->with('node', $article::getCategoryNode())
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
            Event::fire('Admin.articleUpdate',$article);
        });

        Message::instance()->success('Articles has successfully deleted');
        Uri::to('/Admin/Categories');
    }
}