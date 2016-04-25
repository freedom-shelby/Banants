<?php
/**
 * Created by PhpStorm.
 * User: Suren
 * Date: 11/19/2015
 * Time: 3:16 PM
 */

namespace Front;
restrictAccess();


use Http\Exception as Exception;
use View;
use ArticleModel;

use Widgets\WidgetsContainer;
use Helpers\Arr;
use Quiz;

class Server extends Front
{

    public function __construct(array $requestParams)
    {
        parent::__construct($requestParams);
//        WidgetsContainer::instance();
    }

    /**
     * Главная страница сайта
     */
    public function anyQuizResponse()
    {
        $this->layout = null;

        $quiz = (new Quiz)->setQuizId(1)->setUserId(1)->find();
        $data = (int) Arr::get($this->getPostData(), 'quiz');

        if(isset($data))
        {
            if(\UserModel::whereIp(\App::instance()->http()->getIpAddress())->first()){
                echo 'nok';
            }else{
                $quiz->addResponse($data);
                echo 'ok';
            }
        }


    }

}