<?php
/**
 * User: Arsen
 * Date: 03.10.14
 * Time: 0:52
 * Класс страницы
 * Употребляется в виде для отображения элементов страницы
 * по средствам его методов
 */
namespace Widgets;

use Illuminate\Database\Eloquent\Model;
use Widgets\Widget;
use WidgetModel;
use ArticleModel;
use View;


class WidgetsContainer {

    const WIDGET_NAMESPACE = 'Widgets\Widget\\';

    /**
     * Активние Виджеты
     * @var array
     */
    protected $_items = [];

    /**
     * Шаблон
     */
    protected $_template = [
        'left' => 'front/widgets/rightTemplate',
        'right' => 'front/widgets/leftTemplate',
    ];

    protected static $_instance;


    /**
     * Возвращает объект виджета
     * @param Model $model
     * @return WidgetsContainer
     */
    public static function instance($model = null){

        if(self::$_instance == null){
            self::$_instance = new self($model);
        }
        return self::$_instance;
    }

    public function __construct($model){
        $items = $model->widgets()->whereStatus(1)->get();

        if(!empty($items)){
            foreach($items as $i){
                $class = static::WIDGET_NAMESPACE . $i->type;
                $tmp = (new $class);
                $tmp->init($i);
                // todo: в админке проверять чтобы Sorting биль уникалним
                $this->_items[$tmp->getPosition()][$tmp->getSorting()] = $tmp;
            }
        }
    }

    /**
     * Рисует виджеты для позиици
     * $position = ['left','right']
     * @param string $position
     * @return View
     */
    public function draw($position)
    {
        $content = '';
        if( ! empty($this->_items[$position])){
            foreach($this->_items[$position] as $item){
                $content .= $item->render() . PHP_EOL;
            }
        }

        return View::make($this->_template[$position])
            ->with('content', $content);
    }
}