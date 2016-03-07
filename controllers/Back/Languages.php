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
use Illuminate\Database\Capsule\Manager as Capsule;


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

        if (Arr::get($this->getPostData(),'submit') !== null) {
            //проверяет загрузку и тип картинки
//            if($_FILES['flag']['error'] != UPLOAD_ERR_NO_FILE) {
//                if (!HDVP_ImgUpload::check_one_img('flag')) {
//                    Message::instance()->success('Images was not adding');
//
//                    Uri::to('admin/languages/add/');
//                } else {
//                    $this->_flag = HDVP_ImgUpload::one_img_from_post_request('flag');
//                }
//            }

            $data = Arr::extract($this->getPostData(), ['name', 'iso', 'status']);

//            $item ->values($data)
//                ->set('flag', $this->_flag);

            try {
                // здесь надо использовать метод insert по тому что LangModel принадлежит к деревям Baum
                $lastId = LangModel::insertGetId($data);

                Message::instance()->success('Language was successfully added');
                Uri::to('/Admin/Languages/Edit/' . $lastId);
            }
            catch(QueryException $e){
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
                //старт транзакции

                //проверяет загрузку и тип картинки
//                if($_FILES['flag']['error'] != UPLOAD_ERR_NO_FILE) {
//                    if (!HDVP_ImgUpload::check_one_img('flag')) {
//                        Messages::factory()
//                            ->set_alert_type('warning')
//                            ->set_message('Images was not adding');
//
//                        $this->redirect('adminshop/languages/edit/'.$id);
//                    } else {
//                        $this->_flag = HDVP_ImgUpload::one_img_from_post_request('flag');
//                        $item->set('flag', $this->_flag);
//                    }
//                }

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

        $item->delete();

        Message::instance()->success('Articles has successfully deleted');
        Uri::to('/Admin/Languages');
    }

    /**
     * Удаление картинки флага
     */
    public function actionDeleteImage(){

        $id = (int) $this->getRequestParam('id') ?: null;

        $item = LangModel::find($id);

        if (empty($item)) {
            Message::instance()->warning('Image was not delete');
            Uri::to('/Admin/Languages/' . $id);
        }

        try {
            /**
             * удаление картинки из сервера
             */
            @unlink($item->flag);

            Capsule::table('langs')->whereId($id)->update(
                ['flag' => null]
            );

            Message::instance()->success('Image was successfully deleted');
            Uri::to('/Admin/Languages/' . $id);
        } catch (QueryException $e) {
            Uri::to('/Admin/Languages/' . $id);
        }
    }
}