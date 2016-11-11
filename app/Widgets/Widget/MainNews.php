<?php
/**
 * User: Arsen
 * Date: 03.10.14
 * Time: 0:52
 * Класс страницы
 * Употребляется в виде для отабражения элементов страницы
 * по средствам его методов
 */

namespace Widgets\Widget;
restrictAccess();


use Widgets\AbstractWidget;
use View;
use Setting;
use ArticleModel;
use App;

class MainNews extends AbstractWidget{

    /**
     * Тип страницы
     */
    protected $_type;

    /**
     * Позиция
     */
    protected $_position;

    /**
     * Индекс сортировки
     */
    protected $_sort;

    /**
     * Шаблон
     */
    protected $_template;

    /**
     * Параметри в виде JSON-а
     */
    protected $_param;

    /**
     * Матеряли
     * @type array[ArticleModel]
     */
    protected $_items = [];


    public function getPosition()
    {
        return $this->_position;
    }

    public function getSorting()
    {
        return $this->_sort;
    }

    public function render()
    {
        return View::make($this->_template)
            ->with('items', $this->_items);

    }

    public function init($model)
    {
        $this->_param = json_decode($model->param, true);

        // Матерялов из клуба (от 1-го до 8-го матеряла)
        $data = ArticleModel::find(Setting::instance()->getSettingVal('main_articles.category_id'))
            ->descendants()
            ->where('photo_id', '!=' , 1)
            ->reOrderBy('created_at', 'desc')
            ->limit($this->_param['settings']['max_news_limit'])
            ->offset(4)->get(); // todo:: Anonsi Limitic sksi offset@

        foreach ($data as $item) {
            $this->_items[] = $item;
        }

        $this->_items = array_chunk($this->_items, $this->_param['settings']['news_per_page'], true);

        $this->_position = $model->position;
        $this->_sort = $model->sort;
        $this->_template = $model->template;
        $this->_type = $model->type;
    }
}