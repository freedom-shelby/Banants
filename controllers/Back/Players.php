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
use View;
use Message;
use Lang\Lang;
use Helpers\Arr;
use Illuminate\Contracts\Validation;
use ArticleModel;
use ContentModel;
use EntityModel;
use EntityTranslationModel;
use PhotoModel;
use PlayerModel;
use Illuminate\Database\Capsule\Manager as Capsule;
use Http\Exception as HttpException;
use Illuminate\Database\QueryException;
use Upload\File as UploadFile;
use Upload\Storage\FileSystem;
use Upload\Validation\Mimetype as UploadMimeType;
use Upload\Validation\Size as UploadSize;
use Exception;

class Players extends Back
{
    /**
     * Добавления материалов
     */
    public function anyAdd()
    {
        // ID команди
        $id = (int)$this->getRequestParam('id') ?: null;

//        $articles = new ArticleModel();

        if (Arr::get($this->getPostData(), 'submit') !== null) {

            $data = Arr::extract($this->getPostData(), ['slug', 'first_name', 'last_name', 'position', 'country', 'status', 'content', 'image']);

            try {
                // Транзакция для Записание данных в базу
                Capsule::connection()->transaction(function () use ($data, $id) {
                    // Загрузка картинки
                    $file = new UploadFile('image', new FileSystem('uploads/images/players')); // todo: Avelacnel tmi annun@

                    // Optionally you can rename the file on upload
                    $file->setName(uniqid());

//                    // Validate file upload
//                    $file->addValidations(array(
//                        // Ensure file is of type image
//                        new UploadMimeType(['image/png', 'image/jpg', 'image/gif']),
//
//                        // Ensure file is no larger than 5M (use "B", "K", M", or "G")
//                        new UploadSize('50M')
//                    ));

                    // Try to upload file
                    try {
                        // Success!
                        $file->upload();
                        $image = $file->getNameWithExtension();
                    } catch (Exception $e) {
                        // Fail!
                        Message::instance()->warning($file->getErrors());
                    }
                    $imageId = PhotoModel::create([
                        'path' => $image,
                        'is_bound' => 1, // Указивает привязку, стоб не показивал в мести с обычними словами переводов
                    ])->id;
                    $firstNameEntity = EntityModel::create([
                        'text' => $data['first_name'],
                        'is_bound' => 1, // Указивает привязку, стоб не показивал в мести с обычними словами переводов
                    ]);

                    foreach ($data['content'] as $iso => $item) {
                        $lang_id = Lang::instance()->getLang($iso)['id'];
                        EntityTranslationModel::create([
                            'text' => $item['first_name'],
                            'lang_id' => $lang_id,
                            'entity_id' => $firstNameEntity->id,
                        ]);
                    }

                    $lastNameEntity = EntityModel::create([
                        'text' => $data['last_name'],
                        'is_bound' => 1, // Указивает привязку, стоб не показивал в мести с обычними словами переводов
                    ]);

                    foreach ($data['content'] as $iso => $item) {
                        $lang_id = Lang::instance()->getLang($iso)['id'];
                        EntityTranslationModel::create([
                            'text' => $item['last_name'],
                            'lang_id' => $lang_id,
                            'entity_id' => $lastNameEntity->id,
                        ]);
                    }

                    Event::fire('Admin.entitiesUpdate');

                    PlayerModel::create([
                        'team_id' => $id,
                        'country_id' => $data['country'],
                        'position_id' => $data['position'],
                        'slug' => $data['slug'],
                        'status' => $data['status'],
                        'photo_id' => $imageId,
                        'first_name_id' => $firstNameEntity->id,
                        'last_name_id' => $lastNameEntity->id,
                    ]);
                });

                Message::instance()->success('Player has successfully added');

            } catch (Exception $e) {
                Message::instance()->warning('Player has don\'t added');
            }
        }

        $this->layout->content = View::make('back/players/add');
    }

    /**
     * Редактирование материалов
     */
    public function anyEdit()
    {
        $id = (int)$this->getRequestParam('id') ?: null;

        $article = ArticleModel::find($id);

        if (empty($article)) {
            throw new HttpException(404, json_encode(['errorMessage' => 'Incorrect Article']));
        }


        if (Arr::get($this->getPostData(), 'submit') !== null) {

            $data = Arr::extract($this->getPostData(), ['slug', 'parentId', 'status', 'content']);

            $parent = ArticleModel::find($data['parentId']);
            // Транзакция для Записание данных в базу
            try {
                Event::fire('Admin.beforeArticleUpdate', $article);
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
                        $lang_id = Lang::instance()->getLang($iso)['id'];

                        if (((int)$item['id']) != 0) {
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
                Event::fire('Admin.articleUpdate', $article);
            } catch (QueryException $e) {
                Message::instance()->warning('Article was don\'t edited');
            }
        }

        // Загрузка контента для каждово языка
        $contents = [];
        foreach (Lang::instance()->getLangs() as $iso => $lang) {
            $contents[$iso] = $article->contents()->where('lang_id', '=', $lang['id'])->first();
        }

        $this->layout->content = View::make('back/articles/edit')
            ->with('node', $article::getNode())
            ->with('article', $article)
            ->with('contents', $contents);
    }

    public function getDelete()
    {
        $this->layout = false;

        $id = (int)$this->getRequestParam('id') ?: null;

        $article = ArticleModel::find($id);

        if (empty($article)) {
            throw new HttpException(404, json_encode(['errorMessage' => 'Incorrect Article']));
        }

        // Транзакция для Записание данных в базу
        Capsule::connection()->transaction(function () use ($article) {

            // Заодно удаляет и пункты меню привязанные к slug-у
            (new \MenuItemModel)->whereSlug($article->slug)->delete();

            foreach ($article->getDescendantsAndSelf() as $desc) {
                $desc->contents()->delete();
            }
            $article->delete();
        });

        Message::instance()->success('Articles has successfully deleted');
        Uri::to('/Admin/Categories');
    }
}