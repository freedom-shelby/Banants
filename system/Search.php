<?php
/**
 * Разработчик: SUR-SER
 */

class Search {

    /**
     * Элементы в которых надо осуществить поиск
     * @var array
     */
    protected $items;

    /**
     * Результат поиска
     * @var array
     */
    protected $result = array();

    /**
     * Ключи по которым нужно искать в элементах и их вес
     * например: array('title' => 3, 'desc' => 0.7, 'author' => 5)
     * @var array
     */
    protected $keywords;

    /**
     * Разбитое словосочетание на слова по которым надо искать
     * @var array
     */
    protected $words = array();

    /**
     * Текст который нужно найти
     * @var string
     */
    protected $text;

    /**
     * Минимальная длинна слова которое нужно найти
     * @var int
     */
    protected $wordMinLaegth;

    /**НЕ ИСПОЛЬЗУЕТСЯ
     * Шаблон поиска слов
     * @var string
     */
    protected $matchPattern = '';

    /**
     * С какого элемента выводить результат
     * @var int
     */
    protected $offset = 0;

    /**
     * Сколько элементов выводить
     * @var int
     */
    protected $limit = 20;

    public function __construct($text, $items, $searchIn, $wordMinLength = 0){
        $this->items = $items;
        $this->keywords = $searchIn;
        $this->text = $text;
        $this->wordMinLength = $wordMinLength;
        $this->textToArray();
        $this->search();
    }

    public function debug(){

        return $this->result;
    }


    /**
     * Переводим текст в массив со словами
     * @return NULL
     */
    protected function textToArray() {

        $this->words = explode(" ",$this->text);
        $i = 0;

        foreach ($this->words as $word) {

            $word = trim($word);

            if(empty($word)){
                unset($this->words[$i++]);
                continue;
            }

            if($this->wordMinLength){

                if (strlen($word) < $this->wordMinLength) {
                    unset($this->words[$i]);
                }else {
                    $this->words[$i] = str_replace('.', '\.', $word);
                }

            }else{
                $this->words[$i] = str_replace('.', '\.', $word);
            }
            $i++;
        }
    }

    /**
     * Закрашиваем слова
     * @param string $search    -Слово которое нужно раскрасить
     * @param string $string    -Строка в которои данное слово
     * @param string $color     -HEX цвет в формате HTML например: #fff
     * @return string
     */
    protected function colorize($search, $string, $color) {

        $result = preg_replace('/('.$search.')/ius',"<span style='background-color:".$color.";'>$1</span>",$string);

        return $result;
    }

    /**
     * Очищает строку
     * @param string $str
     * @return string
     */
    protected function stringClean($str){
        return htmlspecialchars(strip_tags($str));
    }

    /**
     * Основной поиск
     */
    protected function search() { //echo '<pre>';
        if(empty($this->words) OR empty($this->keywords) OR empty($this->items)) return;
        $i = 0.0000000001;

        foreach ($this->items as $key => $item) {
            $this->items[$key]['weight'] = (double)0;
            $weight = (double)0;
            $tmp_item = array();
            foreach($this->words as $word){
                foreach($this->keywords as $field => $value){
                    // Вызивает функцию из Мадели которий возврашает текст
                    $weight += (double)preg_match_all('/('.$word.')/ius',$this->stringClean($item->$field()),$out) * $value;
                }

            }
            $this->items[$key]['weight'] = $weight;
            $i += 0.0000000001;
            if($this->items[$key]['weight']!=0) {

                $this->result[(string)($this->items[$key]['weight']-$i)] = $item;

            }else { //var_dump($this->items[$key]);
                unset($this->items[$key]);
            }

        }//echo '<pre>'; var_dump($result);
        if(!empty($this->result))
            krsort($this->result);

    }


    /**
     * Возвращает колво записей
     * @return int
     */
    public function getItemsCount(){
        return count($this->result);
    }

    /**
     * Определяет с какой записи выводить результат
     * @param int $offset
     * @return object $this
     */
    public function setOffset($offset){
        $this->offset = $offset;
        return $this;
    }

    /**
     * Определяет сколько элементов выводить
     * @param int $limit
     * @return object $this
     */
    public function setLimit($limit){
        $this->limit = $limit;
        return $this;
    }

    public function getResult(){
        return array_slice($this->result,$this->offset,$this->limit);
    }

    public function getSearchText(){
        return HTML::chars($this->text);
    }

    public function getResultText(){
        return count($this->result) ? 'Search Result For: <strong style="color:#d0379b;">'.HTML::chars($this->text).'</strong>' : 'Search for "<strong style="color:#FF6A00;">'.HTML::chars($this->text).'</strong>" returned no results';
    }
} 