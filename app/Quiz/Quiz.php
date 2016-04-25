<?php

/**
 * ���������� ��� �������
 *
 * Created by PhpStorm.
 * User: Hovhannisyan
 * Date: 31.10.2015
 * Time: 13:42
 */

//todo: amen User-i hamar mta&el vor konkret et harcin patasxana& chlini, ete mi qani hat harc lini sxala ashxatelu, mek el quiz-i himikva ID-in settingsneric vercni


class Quiz
{
    private $_question;
    private $_answers = array();
    private $_quizId;
    private $_userId;
    private $_model;
    private $_totalResponses;

    /**
     * ������������� ID �����������
     * @param mixed $userId
     * @return $this
     */
    public function setUserId($userId)
    {
        $this->_userId = $userId;
        return $this;
    }

    /**
     * ���������� ������
     * @return mixed
     */
    public function getQuestion()
    {
        return $this->_question;
    }

    /**
     * ����������� ������
     * @return array
     */
    public function getAnswers()
    {
        return $this->_answers;
    }

    /**
     * ������������� ID ������
     * @param mixed $quizId
     * @return $this
     */
    public function setQuizId($quizId)
    {
        $this->_quizId = $quizId;
        return $this;
    }

    /**
     * ��������� �� �������� �� �� ������ ������� �����������
     * @return bool
     * @throws Kohana_Exception
     */
    public function isAnswered()
    {
        return (bool) QuizAnswerModel::find($this->_quizId)->where('user_id', '=', $this->_userId)->first();
    }

    /**
     * ���������� ����������� ������� ��� ������� ������
     * @param $responsesCount
     * @return float
     */
    public function getPercent($responsesCount)
    {
        return round(100 * $responsesCount / ($this->_totalResponses ? $this->_totalResponses : 1), 1);
    }

    /**
     * ��������� ������ ������ ������
     * @param $id
     * @throws Kohana_Exception
     */
    public function addResponse($id)
    {
        try{

            // ���������� �� +1 ����� ���������� ������
            $this->_model->total_responses = $this->_totalResponses + 1;
            $this->_model->save();

            // ���������� �� +1 ����� ���������� �������
            $modelAnswer = QuizAnswerModel::find($id);
            $modelAnswer->responses_count = $this->_answers[$id]['count'] + 1;
            $modelAnswer->save();

            UserModel::create([
                'user_name' => 'TEST',
                'ip' => \App::instance()->http()->getIpAddress()
            ]);

            // ��������� ������ ������
            QuizResponsesModel::create([
                'user_id' => $this->_userId,
                'quiz_id' => $this->_quizId,
                'quiz_answer_id' => $id
                ]);

        }catch (Exception $e){
        }
        // ��������� �������
        $this->find();
    }

    /**
     * ������ �� ���� ������ ������
     * @return $this
     */
    public function find()
    {
        $this->_model = QuizModel::find($this->_quizId);

        $this->_question = $this->_model->question();
        $answers = $this->_model->answers()->get();

        // �������� ����� ���������� �������
        $this->_totalResponses = $this->_model->total_responses;

        foreach ($answers as $a) {
            $this->_answers[$a->id]['title'] = $a->title();
            $this->_answers[$a->id]['count'] = $a->responses_count;
            $this->_answers[$a->id]['percent'] = $this->getPercent($a->responses_count);
        }

        return $this;
    }
}