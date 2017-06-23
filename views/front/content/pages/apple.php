<?php
/**
 * Created by PhpStorm.
 * User: Arsen
 * Date: 11/6/2015
 * Time: 3:20 PM
 *
 * @var $title string
 */
?>

<div class="inner_content_wrapper">
    <div class="inner_content form_page">
        <div class="apply_wrapper">
            <h1 class="apply">Подать заявку</h1>
            <div class="choose">
                <label class="aplic_type" for="#"><b>Тип заявки</b></label>
                <select>
                    <option class="application" value="Գրանցվել պարապմունքների"> Записаться на тренировку</option>
<!--                    <option value="Դիմում 1">Заявка 1</option>-->
<!--                    <option value="Դիմում 2">Заявка 2</option>-->
<!--                    <option value="Դիմում 3">Заявка 3</option>-->
                </select>
                <div class="personal_info">
                    <div class="wrapper">
                        <form class="clearfix">
                            <label class="required_info" for="username">Имя</label>
                            <div class="required_info_name">
                                <input id="username" type="text" name="name" value="" size="#"> <br/>
                            </div>
                            <label class="required_info" for="lastname">Фамилия </label>
                            <div class="required_info_name">
                                <input id="lastname" type="text" name="name" value="" size="30"><br/>
                            </div>
                            <label class="required_info" for="age">Возраст</label>
                            <div class="required_info_name">
                                <input id="age" type="text" name="name" value="" size="30"><br/>
                            </div>
                            <label class="required_info" for="phone">Телефон</label>
                            <div class="required_info_name">
                                <input id="phone" type="text" name="name" value="" size="30"><br/>
                            </div>
                            <label class="required_info" for="email">Эл. адрес</label>
                            <div class="required_info_name">
                                <input id="email" type="text" name="name" value="" size="30"><br/>
                            </div>
                            <label class="required_info" for="comments">Комментарий</label>
                            <div class="text"><textarea id="comments" name="#" id="#" cols="#" rows="#">

                                </textarea>
                            </div>
                        </form>
                    </div>
                    <button type="button" value="Подтвердить">Подтвердить</button>
                </div>
            </div>
        </div>
    </div>
</div>