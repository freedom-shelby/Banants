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
            <h1 class="apply"><?= __('Apply') ?></h1>
            <div class="choose">
                <label class="aplic_type" for="#"><b><?= __('Claim type') ?></b></label>
                <select>
                    <option class="application" value="<?= __('Application') ?>"><?= __('Application') ?></option>
<!--                    <option value="--><?//= __('Schedule a workout') ?><!--">--><?//= __('Schedule a workout') ?><!--</option>-->
                </select>
                <div class="personal_info">
                    <div class="wrapper">
                        <form class="clearfix" id="apply-form" method="post" action="">
                            <label class="required_info" for="username"><?= __('Name') ?></label>
                            <div class="required_info_name">
                                <input id="username" type="text" name="name" value="" size="#" required> <br/>
                            </div>
                            <label class="required_info" for="lastname"><?= __('Surname') ?></label>
                            <div class="required_info_name">
                                <input id="lastname" type="text" name="last-name" value="" size="30" required><br/>
                            </div>
                            <label class="required_info" for="age"><?= __('Age') ?></label>
                            <div class="required_info_name">
                                <input id="age" name="age" type="number" size="6" min="18" max="99"><br/>
                            </div>
                            <label class="required_info" for="phone"><?= __('Phone') ?></label>
                            <div class="required_info_name">
                                <input id="phone" type="tel" name="phone" value="" size="30" pattern="[0-9]{8,9,10,11,12,13,,14,15,16}"><br/>
                            </div>
                            <label class="required_info" for="email"><?= __('E-mail') ?></label>
                            <div class="required_info_name">
                                <input id="email" type="email" name="email" value="" size="30" required><br/>
                            </div>
                            <label class="required_info" for="comments"><?= __('A comment') ?></label>
                            <div class="text">
                                <textarea id="comments" name="comments" cols="#" rows="#"></textarea>
                            </div>
                        </form>
                    </div>
                    <button type="submit" form="apply-form" value="submit"><?= __('Send') ?></button>
                </div>
            </div>
        </div>
    </div>
</div>