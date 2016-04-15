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

class Anons extends AbstractWidget{

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

        // Матерялов из клуба
        $data = ArticleModel::find(Setting::instance()->getSettingVal('main_articles.club_article_news_id'))->descendants()->limit($this->_param['settings']['anons_club_articles_count'])->get();
        foreach ($data as $item) {
            $this->_items[] = $item;
        }

        // Матерялов из Бананца
        $data = ArticleModel::find(Setting::instance()->getSettingVal('main_articles.banants_article_news_id'))->descendants()->limit($this->_param['settings']['anons_banants_articles_count'])->get();
        foreach ($data as $item) {
            $this->_items[] = $item;
        }

        $this->_position = $model->position;
        $this->_sort = $model->sort;
        $this->_template = $model->template;
        $this->_type = $model->type;
    }
}