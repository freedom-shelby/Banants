<?php
/**
 * Created by SURO.
 * User: Suren
 * Date: 11/19/2015
 * Time: 2:54 PM
 */
?>
<!-- Activation steps Block -->
<!--.complete & .active classes shows status of step-->
<ul id="activation-steps">
    <li id="step-1" class="active">
        <div id="get-started"><img src="../media/images/get-started-bg.png" /></div>
        <p class="step-text">Country & Number</p>
        <div class="step-circle-block">
            <div class="step-circle">
                <p class="step-status">1</p>
            </div>
            <p class="step-line"></p>
            <p class="step-line-bg"></p>
        </div>
        <p class="step-status-text show">
            <span class="selected-country">South Africa</span>.
            <span class="selected-code">+27</span>
            <span class="selected-number"></span>
        </p>
    </li>
    <li id="step-2" class="">
        <p class="step-text">Mobile Operator</p>
        <div class="step-circle-block">
            <div class="step-circle">
                <p class="step-status">2</p>
            </div>
            <p class="step-line"></p>
            <p class="step-line-bg"></p>
        </div>
        <p class="step-status-text">
            <span class="selected-operator">Orange</span>
        </p>
    </li>
    <li id="step-3" class="">
        <p class="step-text">Package</p>
        <div class="step-circle-block">
            <div class="step-circle">
                <p class="step-status">3</p>
            </div>
            <p class="step-line"></p>
            <p class="step-line-bg"></p>
        </div>
        <p class="step-status-text">
            <span class="selected-package"></span>
        </p>
    </li>
    <li id="step-4" class="">
        <p class="step-text">Checkout</p>
        <div class="step-circle-block">
            <div class="step-circle">
                <p class="step-status">4</p>
            </div>
            <p class="step-line"></p>
            <p class="step-line-bg"></p>
        </div>
        <p class="step-status-text">In Process</p>
    </li>
    <li id="step-5" class="">
        <p class="step-text">Payment & Confirmation</p>
        <div class="step-circle-block">
            <div class="step-circle">
                <p class="step-status">5</p>
            </div>
        </div>
        <p class="step-status-text">In Process</p>
    </li>
</ul> <!-- / #activation-steps -->
<!-- Activation form goes here -->
<form id="activation-form" action="" >

    <?=$content?: ''?>

</form> <!-- /#activation-form -->
