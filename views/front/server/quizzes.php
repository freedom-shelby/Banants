<?php
/**
 * Created by PhpStorm.
 * User: Arsen
 * Date: 11/6/2015
 * Time: 3:20 PM
 */
?>

<div class="answered">
    <ul>

        <?foreach($quiz->getAnswers() as $id => $answer):?>
            <li class="quizzes_list">
                <div class="small">
                    <label for="quiz"><?=__($answer['title'])?></label>
                </div>
                <div class="percent big">
                    <?= $answer['percent'] ?>%
                </div>
            </li>
        <?endforeach?>

        <p class="thanks_line">
            <?=__('Thank you, your answer is accepted !')?>
        </p>
    </ul>
</div>