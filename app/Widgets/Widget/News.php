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

class News extends AbstractWidget{

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

        // Матерялов из slug-а (от 1-го до последного матеряла по добавлению)
        $data = ArticleModel::whereSlug(App::instance()->getCurrentSlug())->first()
            ->descendants()
            ->where('photo_id', '!=' , 1)->reOrderBy('created_at', 'desc')
            ->limit(static::INT_MAX_VALUE) // todo:: paginationov sarqel u hanel limit -@
            ->offset($this->_param['settings']['anons_news_count'])
            ->get();

        foreach ($data as $item) {
            $this->_items[] = $item;
        }

        // todo: надо сделать Pagination
        $this->_items = array_chunk($this->_items, $this->_param['settings']['news_per_page'], true);

        $this->_position = $model->position;
        $this->_sort = $model->sort;
        $this->_template = $model->template;
        $this->_type = $model->type;
    }
}