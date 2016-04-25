<?php
/**
 * Created by PhpStorm.
 * User: CrossComp
 * Date: 12/9/14
 * Time: 3:30 AM
 */
?>
<!--Begin Container-->
<div class="row">
    <div class="col-md-8 col-md-offset-2">
        <legend><?=__($item->question())?></legend>
        <div class="panel-body">
            <div class="table-responsive">
                <table class="table">
                    <caption>Answered Counts</caption>
                    <thead>
                        <tr>
                            <th>ИД</th>
                            <th>Вопрос</th>
                            <th>Проголосовали</th>
                        </tr>
                    </thead>
                    <tbody>

                    <?foreach($item->answers()->get() as $answer):?>
                        <tr>
                            <th scope="row"><?=$answer->id?></th>
                            <td><?=__($answer->title())?></td>
                            <td><?=__($answer->responses_count)?></td>
                        </tr>
                    <?endforeach?>

                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<!--End Container-->