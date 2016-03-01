<?php

/**
 * Created by PhpStorm.
 * User: SUR0
 * Date: 01.03.2016
 * Time: 1:31
 * Класс предназначен для обработки событий
 */
namespace Event;

restrictAccess();

class Emmiter
{
    /**
     * Слушатели событий
     * @var array
     */
    private $_listeners = array();

    /**
     * Слушатели для опредеоённой группы
     * @var array
     */
    private $_wildcards = array();

    /**
     * Очерёдность событий которые выстреливаются
     * @var array
     */
    private $_firing = array();

    /**
     * список отсортированных событий
     * @var array
     */
    private $_sorted = array();


    /**
     * Добавление слушателя события
     * @param string|array $events - события
     * @param mixed $listener - слушатель
     * @param [int] $priority - приоритет
     */
    public function listen($events, $listener, $priority = 0){

        foreach((array) $events as $event){
            if (strpos($event, '*') !== false)
            {
                $this->setupWildcardListen($event, $listener);
            }
            else
            {
                $this->_listeners[$event][$priority][] = $this->makeListener($listener);

                unset($this->_sorted[$event]);
            }
        }
    }

    /**
     * Выстреливание события
     */
    public function fire($event, $data = array(), $halt = false){

        $responses = array();

        if ( ! is_array($data)) $data = array($data);

        $this->_firing[] = $event;

        foreach($this->getListeners($event) as $listener){

            $response = call_user_func_array($this->makeCallbackableListener($listener), $data);

            if ( ! is_null($response) && $halt)
            {
                array_pop($this->_firing);

                return $response;
            }

            if ($response === false) break;

            $responses[] = $response;
        }

        array_pop($this->_firing);

        return $halt ? null : $responses;
    }

    private function setupWildcardListen($event, $listener)
    {
        //TODO: добавить обработку
        $this->_wildcards[$event][] = $this->makeListener($listener);
    }

    /**
     * Добавление слушателя
     * @param $listener
     * $event->listen('event.name',function($data));
     * $event->listen('event.name',"Handler");
     * $event->listen('event.name',"Handler@customHandle");
     * $event->listen('event.name',array('Handler','func');
     * @return string
     */
    private function makeListener($listener)
    {
        if(is_array($listener)){
            return $listener[0].'@'.$listener[1];
        }else{
            return $listener;
        }
    }

    /**
     * Возвращает слушатели для событий
     * @param $event_name
     * @return array
     */
    public function getListeners($event_name)
    {
        $wildcards = $this->getWildcardListeners($event_name);

        if ( ! isset($this->_sorted[$event_name]))
        {
            $this->sortListeners($event_name);
        }

        return array_merge($this->_sorted[$event_name], $wildcards);
    }


    /**
     * Возвращает слушатели для группы событий
     * @param $event_name
     * @return array
     */
    public function getWildcardListeners($event_name)
    {
        $wildcards = array();
        foreach ($this->_wildcards as $key => $listeners)
        {
            if ($this->wildcardIs($key,$event_name)) $wildcards = array_merge($wildcards, $listeners);
        }

        return $wildcards;
    }

    /**
     * Сортрует слушатели по приоритетам
     * @param $event_name
     */
    private function sortListeners($event_name)
    {
        $this->_sorted[$event_name] = array();

        if (isset($this->_listeners[$event_name]))
        {
            krsort($this->_listeners[$event_name]);

            $this->_sorted[$event_name] = call_user_func_array(
                'array_merge', $this->_listeners[$event_name]
            );
        }
    }

    /**
     * Преобразовывает переданный слушатель для вызова
     * @param $listener
     * @return mixed|string
     */
    private function makeCallbackableListener($listener){

        if(is_string($listener)){

            if(strpos($listener,'@') !== false){
                return str_replace('@','::',$listener);
            }else{
                return $listener.'::'.'handle';
            }
        }else{
            return $listener;
        }


    }

    /**
     * Сравнивает значение группы с событием
     * @param $pattern
     * @param $value
     * @return bool
     */
    public static function wildcardIs($pattern, $value)
    {
        if ($pattern == $value) return true;

        $pattern = preg_quote($pattern, '#');

        // Asterisks are translated into zero-or-more regular expression wildcards
        // to make it convenient to check if the strings starts with the given
        // pattern such as "library/*", making any string check convenient.
        $pattern = str_replace('\*', '.*', $pattern).'\z';

        return (bool) preg_match('#^'.$pattern.'#', $value);
    }

    /**
     * Возвращает событие которое выстреливается
     * @return mixed
     */
    public function firing()
    {
        return  end($this->_firing);
    }

    /**
     * Добавляет класс подписчика и регистрирует его
     * @param $subscriber
     */
    public function subscribe($subscriber){
        if(is_string($subscriber)){
            call_user_func_array(array($subscriber,'subscribe'),array($this));
        }else{
            $subscriber->subscribe($this);
        }

    }

    /**
     * Находит и регистрирует подписчиков по умолчанию
     */
    public function findAutoSubscribers(){

        $files = self::list_files('Subscribers');
        $this->getListOfAutoSubscribers($files,$subscribers);
        if(!empty($subscribers))
            foreach($subscribers as $subscriber){
                $this->subscribe('Subscribers\\'.$subscriber);

            }

    }

    /**
     * Рекурсивно возвращает список классов которые зарегистрировались на события
     * @param $files
     * @param $data
     */
    private function getListOfAutoSubscribers($files, &$data){

        foreach($files as $key => $val){
            if(is_array($val)){
                $this->getListOfAutoSubscribers($val,$data);
            }else{
                $data[] = str_replace(EXT,'',str_replace('Subscribers'.DIRECTORY_SEPARATOR,'',$key));

            }
        }
    }

    /**
     * Хрень из коханы))
     * Recursively finds all of the files in the specified directory at any
     * location in the [Cascading Filesystem](kohana/files), and returns an
     * array of all the files found, sorted alphabetically.
     *
     *     // Find all view files.
     *     $views = Kohana::list_files('views');
     *
     * @param   string  $directory  directory name
     * @param   array   $paths      list of paths to search
     * @return  array
     */
    public static function list_files($directory = NULL, array $paths = NULL)
    {
        if ($directory !== NULL)
        {
            // Add the directory separator
            $directory .= DIRECTORY_SEPARATOR;
        }

        if ($paths === NULL)
        {
            // Use the default paths
            $paths = [ROOT_PATH.'app/'];
        }

        // Create an array for the files
        $found = array();

        foreach ($paths as $path)
        {
            if (is_dir($path.$directory))
            {
                // Create a new directory iterator
                $dir = new \DirectoryIterator($path.$directory);

                foreach ($dir as $file)
                {
                    // Get the file name
                    $filename = $file->getFilename();

                    if ($filename[0] === '.' OR $filename[strlen($filename)-1] === '~')
                    {
                        // Skip all hidden files and UNIX backup files
                        continue;
                    }

                    // Relative filename is the array key
                    $key = $directory.$filename;

                    if ($file->isDir())
                    {
                        if ($sub_dir = self::list_files($key, $paths))
                        {
                            if (isset($found[$key]))
                            {
                                // Append the sub-directory list
                                $found[$key] += $sub_dir;
                            }
                            else
                            {
                                // Create a new sub-directory list
                                $found[$key] = $sub_dir;
                            }
                        }
                    }
                    else
                    {
                        if ( ! isset($found[$key]))
                        {
                            // Add new files to the list
                            $found[$key] = realpath($file->getPathName());
                        }
                    }
                }
            }
        }

        // Sort the results alphabetically
        ksort($found);

        return $found;
    }
}