<?php
/**
 * Created by PhpStorm.
 * User: crosscomp
 * Date: 12/9/14
 * Time: 3:23 AM
 */
namespace Back;

if(!defined('ROOT_PATH')){header('HTTP/1.0 404 Not Found'); die("<h1>404 Not Found</h1>The page that you have requested could not be found.");}

use View;
use Setting;
use Helpers\Arr;
use Helpers\Uri;
use Message;
use Exception;

class Settings extends Back {

    /**
     *  Редактирование
     */
    public function anyEdit(){
//die;
        $id = (int) $this->getRequestParam('id') ?: null;

        $item = \SettingsModel::find($id);

        if (null !== Arr::get($this->getPostData(), 'submit')) {
            $data = Arr::get($this->getPostData(), 'value');

            $item->value = $data;

            try {
                //изменения елемента по id
                $item->save();

                Message::instance()->success('Setting has successfully edited');

            }catch (Exception $e){
//                Message::instance()->warning('Setting was don\'t edited');
//echo '<pre>';
//print_r($e->getMessage());die;
            }
        }

        $this->layout->content = View::make('back/setting/edit')
            ->with('id', $id)
            ->with('item', $item);
    }

    public function getList()
    {
        $alias = $this->getRequestParam('alias') ?: null;

        $this->layout->content = View::make('back/setting/list')
            ->with('items', Setting::instance()->get_group($alias));
    }

    public function getGroups()
    {
        $this->layout->content = View::make('back/setting/groups')
            ->with('items', Setting::instance()->get_all_groups());
    }
}