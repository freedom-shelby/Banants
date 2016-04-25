<?php
/**
 * Created by PhpStorm.
 * User: Rob
 * Date: 11/6/2015
 * Time: 3:20 PM
 */
?>

<div id="home" class="home quizzes">
    <h3>
        <?=__($quiz->getQuestion())?>
    </h3>
    <form id="quizzes" action="#" method="post">

        <?foreach($quiz->getAnswers() as $id => $answer):?>
            <div class="quizzes_list">
                <input type="radio" name="quiz" value="<?=$id?>" />
                <label for="quiz"><?=__($answer['title'])?></label>
            </div>
        <?endforeach?>

        <input  type="submit" value="Ответить"/>
    </form>
</div>

<div id="home_thanks" class=" home quizzes home_thanks hidden">
    <h3 class="thanks_line">
        <?=__('Thank you, your answer is accepted !')?>
    </h3>
</div><!-- quizzes -->

<div id="home_error" class=" home quizzes home_thanks hidden">
    <h3 class="thanks_line">
        <?=__('Sorry but you have already answered this question')?>
    </h3>
</div><!-- quizzes -->