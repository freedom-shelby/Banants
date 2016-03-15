<?php
/**
 * Created by PhpStorm.
 * User: Arsen
 * Date: 03/03/16
 * Time: 3:23 AM
 */

namespace Back;
restrictAccess();


use Event;
use Helpers\Uri;
use Http\Exception as HttpException;
use View;
use Message;
use LangModel;
use Helpers\Arr;
use Illuminate\Database\QueryException;
use Exception;
use Illuminate\Database\Capsule\Manager as Capsule;
use File as UploadFile;
use Upload\Storage\FileSystem;
use Upload\Validation\Mimetype as UploadMimeType;
use Upload\Validation\Size as UploadSize;

class Languages extends Back {

    protected $_flag;

    /**
     * Список всех элементов
     */
    public function getList(){

        $items = LangModel::get()->toArray();
        $this->layout->content = View::make('back/languages/list')
            ->with('items', $items);
    }

    /**
     *  Добавление язика
     */
    public function anyAdd(){

        if (Arr::get($this->getPostData(),'submit') !== null)
        {
            $data = Arr::extract($this->getPostData(), ['name', 'iso', 'status']);

            try {
                Event::fire('Admin.beforeLanguageUpdate');

                // Загрузка картинки
                $file = new UploadFile('image', new FileSystem('uploads/images'));

                // Optionally you can rename the file on upload
                $file->setName(uniqid());

                // Validate file upload
                $file->addValidations(array(
                    // Ensure file is of type image
                    new UploadMimeType(['image/png','image/jpg','image/gif']),

                    // Ensure file is no larger than 5M (use "B", "K", M", or "G")
                    new UploadSize('50M')
                ));

                // Try to upload file
                try {
                    // Success!
                    $file->upload();
                    $data['flag'] = $file->getNameWithExtension();
                } catch (Exception $e) {
                    // Fail!
                    Message::instance()->warning($file->getErrors());
                }

                // здесь надо использовать метод insert по тому что LangModel принадлежит к деревям Baum
                $lastId = LangModel::insertGetId($data);

                Message::instance()->success('Language was successfully added');
                Uri::to('/Admin/Languages/Edit/' . $lastId);
            }
            catch(Exception $e){
                Message::instance()->warning('Language was not adding');
                Uri::to('/Admin/Languages/Add');
            }
        }

        $this->layout->content = View::make('back/languages/add');
    }

    /**
     *  Редактирование язика
     */
    public function anyEdit(){

        $id = (int) $this->getRequestParam('id') ?: null;

        if (Arr::get($this->getPostData(),'submit') !== null) {

            //Редактирование данных в базе
            $data = Arr::extract($this->getPostData(), ['name', 'iso', 'status']);

            try {
                // Загрузка картинки
                $file = new UploadFile('image', new FileSystem('uploads/images'));

                // Optionally you can rename the file on upload
                $file->setName(uniqid());

                // Validate file upload
                $file->addValidations(array(
                    // Ensure file is of type image
                    new UploadMimeType(['image/png','image/jpg','image/gif']),

                    // Ensure file is no larger than 5M (use "B", "K", M", or "G")
                    new UploadSize('50M')
                ));

                // Try to upload file
                try {
                    // Success!
                    $file->upload();
                    $data['flag'] = $file->getNameWithExtension();
                } catch (Exception $e) {
                    // Fail!
                    Message::instance()->warning($file->getErrors());
                }

                // здесь надо использовать QueryBuilder потому-что стадартни update исползует метод Baum-а
                Capsule::table('langs')->whereId($id)->update($data);

                Event::fire('Admin.languageUpdate');
            } catch(QueryException $e){
                Message::instance()->warning('Language was not editing');
            }
        }

        $item = LangModel::find($id);
        if (empty($item)) {
            throw new HttpException(404,json_encode(['errorMessage' => 'Incorrect Language']));
        }

        // отправка в шаблон
        $this->layout->content = View::make('back/languages/edit')
            ->with('item', $item);
    }

    public function getDelete()
    {
        $this->layout = false;

        $id = (int) $this->getRequestParam('id') ?: null;

        $item = LangModel::find($id);

        if (empty($item)) {
            throw new HttpException(404,json_encode(['errorMessage' => 'Incorrect Article']));
        }

        Event::fire('Admin.beforeLanguageUpdate');

        // Удаления картинки из сервера
        @unlink(ltrim(UploadFile::getImagePath($item->flag), '/'));
        $item->delete();

        Message::instance()->success('Articles has successfully deleted');
        Uri::to('/Admin/Languages');
    }

    /**
     * Удаление картинки флага
     */
    public function postImageDelete(){

        $this->layout = null;

        $id = (int) Arr::get($this->getPostData(), 'key');

        $item = Capsule::table('langs')->find($id);

        if (empty($item)) {
            Message::instance()->warning('Image was not delete');
        }else{
            try {
                // Удаление картинки из сервера
                @unlink(ltrim(UploadFile::getImagePath($item['flag']), '/'));

                Capsule::table('langs')->whereId($id)->update(
                    ['flag' => null]
                );

                Message::instance()->success('Image was successfully deleted');
            } catch (Exception $e) {
                Message::instance()->warning('Image was not delete');
            }
        }

        echo json_encode(['errorMessage' => Message::instance()->flash_all()]);
    }
}