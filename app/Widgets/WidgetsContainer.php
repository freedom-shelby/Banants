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
restrictAccess();


use Widgets\Widget;
use ArticleModel;
use View;
use Router;
use Http\Exception as HttpException;
use Cache\LocalStorage as Cache;


class WidgetsContainer {

    const WIDGET_NAMESPACE = 'Widgets\Widget\\';

    /**
     * Активние Виджеты
     * @var array
     */
    protected $_items = [];

    /**
     * Активние Виджеты по типу
     * @var array
     */
    protected $_widgets = [];

    protected static $_instance;


    /**
     * Возвращает объект виджета
     * @return WidgetsContainer
     */
    public static function instance(){

        if(self::$_instance == null){
            self::$_instance = new self();
        }
        return self::$_instance;
    }

    public function __construct(){

        $slug = Router::getCurrentRoute()->getActionVariable('page') ?: 'home';

        $cache = new Cache();
        $cache->setLocalPath($slug.'_widgets');
        $cache->load();
        if($cache->isValid()){
            $items = json_decode($cache->getData());
        }else{
            $article = ArticleModel::where('slug','=',$slug)->first();

            if(empty($article)){
                throw new HttpException(404);
            }

//            $items = $items->widgets()->whereStatus(1)->orderBy('sort')->get();

            $data = $article->ancestorsAndSelf()->whereStatus(1)->get();
//                ->widgets()->whereStatus(1)->orderBy('sort')->get();
            $items = [];
//            $a = [];
//            $a += ['1' , '2'];
////            array_merge($a , ['1' , '2']);
//            echo "<pre>";
//            print_r($a);
//            die;
            foreach($data as $item){
                echo "<pre>";
                print_r(json_decode($item->widgets()->whereStatus(1)->orderBy('sort')->get()));
                die;
//                array_merge($items, json_decode($item->widgets()->whereStatus(1)->orderBy('sort')->get()));
                $items += json_decode($item->widgets()->whereStatus(1)->orderBy('sort')->get());
//                $item->widgets()->whereStatus(1)->orderBy('sort')->get();
            }

echo "<pre>";
print_r($items);
die;
            $cache->setData(json_encode($items));
            $cache->save();
        }
echo "<pre>";
print_r($items);
die;
        if(!empty($items)){
            foreach($items as $i){
                $class = static::WIDGET_NAMESPACE . $i->type;
                $tmp = (new $class);
                $tmp->init($i);
                // todo: в админке проверять чтобы Sorting биль уникалним
                $this->_items[$tmp->getPosition()][$tmp->getSorting()] = $tmp;
                $this->_widgets[$i->type] = $tmp;
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

        return $content;
    }

    /**
     * Рисует виджет по типу
     * $type = тип виджета
     * @param string $type
     * @return View
     */
    public function drawWidgetByType($type)
    {

        $content = '';
        if( ! empty($this->_widgets[$type])){
            $content .= $this->_widgets[$type]->render() . PHP_EOL;
        }

        return $content;
    }
}