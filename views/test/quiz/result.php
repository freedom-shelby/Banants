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
    <?=__($quiz->getQuestion())?><BR>
    <table>
        <tr>
            <td>Answer</td>
            <td>Count</td>
            <td>Percent</td>
        </tr>
        <?foreach($quiz->getAnswers() as $id => $answer):?>
            <tr>
                <td><?=__($answer['title'])?></td>
                <td><?=$answer['count']?></td>
                <td><?=$answer['percent']?></td>
            </tr>
        <?endforeach?>
    </table>
</body>
</html>
