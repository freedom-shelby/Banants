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
        <?=__('Which of these players is the best in the team?')?>
    </h3>
    <form id="quizzes" action="#" method="post">
        <div class="quizzes_list">
            <input type="radio" name="check1" id="check1" checked="checked" />
            <label for="check1"><?=__('Petros Avetisyan')?></label>
        </div><!-- quizzes_list -->
        <div class="quizzes_list">
            <input type="radio" name="check1" id="check2" />
            <label for="check2"><?=__('Atsamaz')?> <?=__('Buraev')?></label>
        </div><!-- quizzes_list -->
        <div class="quizzes_list">
            <input type="radio" name="check1" id="check3" />
            <label for="check3"><?=__('Laercio')?> <?=__('Gomes')?></label>
        </div><!-- quizzes_list -->
        <div class="quizzes_list">
            <input type="radio" name="check1" id="check4" />
            <label for="check4"><?=__('Claudio')?> <?=__('Torrejon')?></label>
        </div><!-- quizzes_list -->
        <div class="quizzes_list">
            <input type="radio" name="check1" id="check5" />
            <label for="check5"><?=__('Layonel')?> <?=__('Adams')?></label>
        </div><!-- quizzes_list -->
        <div class="quizzes_list">
            <input type="radio" name="check1" id="check6" />
            <label for="check6"><?=__('Vlatko')?> <?=__('Drobarov')?></label>
        </div><!-- quizzes_list -->
        <input  type="submit" value="Ответить"/>
    </form>
</div>
<div id="home_thanks" class=" home quizzes home_thanks hidden">
    <h3 class="thanks_line">
        <?=__('Thank you, your answer is accepted !')?>
    </h3>
</div><!-- quizzes -->