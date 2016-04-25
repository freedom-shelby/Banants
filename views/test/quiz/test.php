<?php
/**
 * Created by PhpStorm.
 * User: Hovhannisyan
 * Date: 31.10.2015
 * Time: 15:57
 */
?>

<html>
<body bgcolor=#ffffff>

<form method="post" action="/TestQuizResult.html">

    <P>
        <?=__($quiz->getQuestion())?><BR>

        <?foreach($quiz->getAnswers() as $id => $answer):?>
            <input type="radio" name="quiz" value="<?=$id?>"><?=__($answer['title'])?><BR>
        <?endforeach?>
    </p>

    <br>
    <input type="submit" value="Send Form">
</form>
</body>
</html>
