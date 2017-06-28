<?

    // ID персонала
    $id = (int)$this->getRequestParam('id') ?: null;

    if (Arr::get($this->getPostData(), 'submit') !== null) {

//            $data = Arr::extract($this->getPostData(), ['slug', 'first_name', 'last_name', 'middle_name', 'sort', 'personnel_type', 'was_born', 'status', 'content', 'image']);
        $data = Arr::extract($this->getPostData(), ['slug', 'first_name', 'last_name', 'middle_name', 'sort', 'was_born', 'status', 'content', 'image']);

//            try {
        // Транзакция для Записание данных в базу
//                Capsule::connection()->transaction(function () use ($data, $id) {
        // Загрузка картинки
        $file = new UploadFile('image', new FileSystem(static::IMAGE_PATH));

        // Optionally you can rename the file on upload
        $file->setName(uniqid());

        // Try to upload file
        try {
            $imageId = null;

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
        if($image) {
            $imageId = PhotoModel::create([
                'path' => $image,
                'is_bound' => 1, // Указивает привязку, стоб не показивал в мести с обычними словами переводов
            ])->id;
        }

        $firstNameEntity = EntityModel::create([
            'text' => $data['first_name'],
            'is_bound' => 1, // Указивает привязку, стоб не показивал в мести с обычними словами переводов
        ]);

        $lastNameEntity = EntityModel::create([
            'text' => $data['last_name'],
            'is_bound' => 1, // Указивает привязку, стоб не показивал в мести с обычними словами переводов
        ]);

        $middleNameEntity = EntityModel::create([
            'text' => $data['middle_name'],
            'is_bound' => 1, // Указивает привязку, стоб не показивал в мести с обычними словами переводов
        ]);

        $newArticle = ArticleModel::create([
            'slug' => PersonnelModel::SLUG  .'/'. uniqid(),
            'status' => $data['status'],
        ]);

        $parent = ArticleModel::whereSlug(PersonnelModel::SLUG)->first();

        $newArticle->makeChildOf($parent);

        foreach($data['content'] as $iso => $item){
            $lang_id = Lang::instance()->getLang($iso)['id'];

            if(Lang::DEFAULT_LANGUAGE != $iso)
            {
                // Add First Name Translations
                EntityTranslationModel::create([
                    'text' => $item['first_name'],
                    'lang_id' => $lang_id,
                    'entity_id' => $firstNameEntity->id,
                ]);

                // Add Last Name Translations
                EntityTranslationModel::create([
                    'text' => $item['last_name'],
                    'lang_id' => $lang_id,
                    'entity_id' => $lastNameEntity->id,
                ]);

                // Add Last Name Translations
                EntityTranslationModel::create([
                    'text' => $item['middle_name'],
                    'lang_id' => $lang_id,
                    'entity_id' => $middleNameEntity->id,
                ]);

                // Add Articles With Translations
                $fullName = $item['first_name'] .' '. $item['last_name'] .' '. $item['middle_name'];
            }else{
                $fullName = $data['first_name'] .' '. $data['last_name'] .' '. $data['middle_name'];
            }


            $content = ContentModel::create([
                'title' => $fullName,
                'crumb' => $fullName,
                'desc' => $item['desc'],
                'meta_title' => $fullName,
                'meta_desc' => $fullName,
                'meta_keys' => $fullName,
                'lang_id' => $lang_id,
            ]);
            $newArticle->contents()->attach($content);
        }

        Event::fire('Admin.entitiesUpdate');

        PersonnelModel::create([
            'personnel_type_id' => $id,
            'sort' => $data['sort'],
            'was_born' => $data['was_born'],
            'status' => $data['status'],
            'photo_id' => $imageId,
            'first_name_id' => $firstNameEntity->id,
            'last_name_id' => $lastNameEntity->id,
            'middle_name_id' => $middleNameEntity->id,
            'article_id' => $newArticle->id,
        ]);
//                });

        Message::instance()->success('Personnel has successfully added');

//            } catch (Exception $e) {
//                Message::instance()->warning('Personnel has don\'t added');
//            }
    }

    $this->layout->content = View::make('back/personnel/add');
