<?php
/**
 * Created by PhpStorm.
 * User: Arsen
 * Date: 11/6/2015
 * Time: 3:20 PM
 */
?>
<div id="home" class="home quizzes">
    <h3>
        <?=__($quiz->getQuestion())?>
    </h3>
    <form id="quizzes" action="#" method="post">

        <? if ($quiz->isAnswered()): ?>
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
<!--                    <p class="win-line">-->
<!--                        --><?//=__('According to the poll won "Banants"')?>
<!--                    </p>-->
<!--                    <p class="thanks_line">-->
<!--                        <sub>*--><?//=__('You have already answered this question')?><!--</sub>-->
<!--                    </p>-->
                </ul>
            </div>

        <? else: ?>

            <div class="not-answered">

                <?foreach($quiz->getAnswers() as $id => $answer):?>
                    <div class="quizzes_list">
                        <input type="radio" name="quiz" value="<?=$id?>"/>
                        <label for="quiz"><?=__($answer['title'])?></label>
                    </div>
                <?endforeach?>

                <input type="submit" value="Ответить"/>
            </div>
        <? endif ?>

    </form>
    <div id="home_thanks" class=" home quizzes home_thanks hidden">
        <h3 class="thanks_line">
            <?=__('Thank you, your answer is accepted !')?>
        </h3>
    </div><!-- quizzes -->

    <div id="home_error" class=" home quizzes home_thanks hidden">
        <h3 class="thanks_line">
            <?=__('You have already answered this question')?>
        </h3>
    </div>
</div>