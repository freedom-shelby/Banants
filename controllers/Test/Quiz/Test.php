<?php

namespace Test\Quiz;

use Controller;
use Quiz;
use View;
use Helpers\Arr;

class Test extends Controller {

	const CurrentQuizId = 1;
	const CurrentUserId = 1;

	public function anyIndex()
	{
		$quiz = (new Quiz)->setQuizId(self::CurrentQuizId)->setUserId(self::CurrentUserId)->find();

//		if($quiz->isAnswered()){
//			$this->redirect('http://banantstest/result');
//		}

		$content = View::make('test/quiz/test')
							->with('quiz', $quiz);
		echo $content;
	}

	public function anyResult()
	{
		$quiz = (new Quiz)->setQuizId(self::CurrentQuizId)->setUserId(self::CurrentUserId)->find();

		$data = (int) Arr::get($this->getPostData(), 'quiz');

		if(isset($data))
		{
			$quiz->addResponse($data);
		}

		$content = View::make('test/quiz/result')
			->with('quiz', $quiz);

		echo $content;
	}
}
