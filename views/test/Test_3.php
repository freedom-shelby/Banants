<?

    // ID персонала
    $id = (int) $this->getRequestParam('id') ?: null;

    $model = PersonnelModel::find($id);

    if (empty($model)) {
        throw new HttpException(404,json_encode(['errorMessage' => 'Incorrect Personnel']));
    }

    $firstNameModel = $model->firstNameModel()->first();
    $lastNameModel = $model->lastNameModel()->first();
    $middleNameModel = $model->middleNameModel()->first();

    if (Arr::get($this->getPostData(), 'submit') !== null) {

        $data = Arr::extract($this->getPostData(), ['slug', 'personnel_type', 'first_name', 'last_name', 'middle_name', 'sort', 'was_born', 'status', 'content', 'image']);

        // Транзакция для Записание данных в базу
        try {
            Capsule::connection()->transaction(function () use ($data, $model, $firstNameModel, $lastNameModel, $middleNameModel) {
                // Загрузка картинки

                $file = new UploadFile('image', new FileSystem(static::IMAGE_PATH));

                // Optionally you can rename the file on upload
                $file->setName(uniqid());

                // Try to upload file
                try {
                    // Success!
                    $file->upload();
                    $image = '/' . static::IMAGE_PATH . '/' . $file->getNameWithExtension();
                } catch (UploadException $e) {
                    // Fail!
                    $image = null;
                    Message::instance()->warning($file->getErrors());
                } catch (Exception $e) {
                    // Fail!
                    $image = null;
                    Message::instance()->warning($file->getErrors());
                }

                $firstNameModel = EntityModel::updateOrCreate(
                    ['id' => $firstNameModel->id,],
                    ['text' => $data['first_name'],
                    ]);
                $lastNameModel = EntityModel::updateOrCreate(
                    ['id' => $lastNameModel->id,],
                    ['text' => $data['last_name'],
                    ]);
                $middleNameModel = EntityModel::updateOrCreate(
                    ['id' => $middleNameModel->id,],
                    ['text' => $data['last_name'],
                    ]);

                $newArticle = ArticleModel::updateOrCreate(
                    [
                        'id' => ($model->article()) ? $model->article()->id : null,
                    ],
                    [
                        'slug' => PersonnelModel::SLUG  .'/'. uniqid(),
                        'status' => $data['status'],
                    ]
                );
                foreach ($data['content'] as $iso => $d) {
                    $lang_id = Lang::instance()->getLang($iso)['id'];

                    if(Lang::DEFAULT_LANGUAGE != $iso)
                    {
                        EntityTranslationModel::updateOrCreate(['id' => $d['first_name_id']], ['text' => $d['first_name'], 'lang_id' => $lang_id, 'entity_id' => $firstNameModel->id]);
                        EntityTranslationModel::updateOrCreate(['id' => $d['last_name_id']], ['text' => $d['last_name'], 'lang_id' => $lang_id, 'entity_id' => $lastNameModel->id]);
                        EntityTranslationModel::updateOrCreate(['id' => $d['middle_name_id']], ['text' => $d['middle_name'], 'lang_id' => $lang_id, 'entity_id' => $middleNameModel->id]);

                        $fullName = $d['first_name'] .' '. $d['last_name'] .' '. $d['middle_name'];
                    }else{
                        $fullName = $data['first_name'] .' '. $data['last_name'] .' '. $data['middle_name'];
                    }

                    $parent = ArticleModel::whereSlug(PersonnelModel::SLUG)->first();

                    $newArticle->makeChildOf($parent);

                    $contentModel = ContentModel::updateOrCreate(
                        [
                            'id' => $d['content_id'] ?: null
                        ],
                        [
                            'article_id' => $newArticle->id,
                            'title' => $fullName,
                            'crumb' => $fullName,
                            'desc' => $d['desc'],
                            'meta_title' => $fullName,
                            'meta_desc' => $fullName,
                            'meta_keys' => $fullName,
                            'lang_id' => $lang_id,
                        ]
                    );

                    // Приклепляет много ко многим связ (syncWithoutDetaching)
                    $newArticle->contents()->sync([$contentModel->id], false);
                }

                Event::fire('Admin.entitiesUpdate');

                // если нету нового изображения оставить прежний
                if($image){
                    $imageId = PhotoModel::create([
                        'path' => $image,
                        'is_bound' => 1, // Указивает привязку, стоб не показивал в мести с обычними словами переводов
                    ])->id;
                    $model->update([
                        'photo_id' => $imageId,
                    ]);
                }

                $model->update([
                    'personnel_type_id' => $data['personnel_type'],
                    'slug' => $data['slug'],
                    'sort' => $data['sort'],
                    'was_born' => $data['was_born'],
                    'status' => $data['status'],
                    'first_name_id' => $firstNameModel->id,
                    'last_name_id' => $lastNameModel->id,
                    'middle_name_id' => $middleNameModel->id,
                    'article_id' => $newArticle->id,
                ]);
            });
            Message::instance()->success('Personnel was successfully saved');
        } catch (Exception $e) {
            Message::instance()->warning('Personnel was don\'t saved');
        }
    }

    $model = PersonnelModel::find($id);
    $firstNameModel = $model->firstNameModel()->first();
    $lastNameModel = $model->lastNameModel()->first();
    $middleNameModel = $model->middleNameModel()->first();
    $articleModel = $model->article();

    // Загрузка контента для каждово языка
    $contents = [];
    foreach(Lang::instance()->getLangs() as $iso => $lang){
        $contents[$iso]['firstName'] = $firstNameModel->translations()->whereLang_id($lang['id'])->first();
        $contents[$iso]['lastName'] = $lastNameModel->translations()->whereLang_id($lang['id'])->first();
        $contents[$iso]['middleName'] = $middleNameModel->translations()->whereLang_id($lang['id'])->first();
        $contents[$iso]['content'] = ($model->article()) ? $articleModel->contents()->whereLang_id($lang['id'])->first() : null;
    }

    $this->layout->content = View::make('back/personnel/edit')
        ->with('item', $model)
        ->with('contents', $contents);
