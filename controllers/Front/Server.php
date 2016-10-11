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
use User;
use Setting;

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
//echo "<pre>";
//print_r($this->getPostData());
//die;
        $quiz = (new Quiz)->setQuizId(Setting::instance()->getSettingVal('widgets.quizz'))->setUserId(User::instance()->getId())->find();
        $data = (int) Arr::get($this->getPostData(), 'quiz');

        $result['status'] = 'nok';

        if(isset($data))
        {
            if( ! $quiz->isAnswered()){
                $quiz->addResponse($data);

                $result['html'] = View::make('front/server/quizzes')
                    ->with('quiz', $quiz)->render();
                $result['status'] = 'ok';
            }

            echo json_encode($result);
        }
    }
}