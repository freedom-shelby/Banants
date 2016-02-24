<?php
/**
 * Created by SURO.
 * User: Suren
 * Date: 11/19/2015
 * Time: 12:38 PM
 */
?>
<fieldset id="4" class="select-checkout ">

    <div class="auth-block">

        <!-- Login block -->
<!--        <div id="login" class="login-block">-->
<!--            <p class="login-title">Please Register or Login</p>-->
<!--            <p class="login-subtitle">Existing User ?</p>-->
<!--            <div class="login-form">-->
<!--                <div class="email-row">-->
<!--                    <input class="email input-icon-email" type="text" name="email" placeholder="Email" />-->
<!--                    <span>or</span>-->
<!--                    <input class="mobile input-icon-mobile" type="text" name="phone" placeholder="Phone Number" onkeypress="validateNumber(event)" />-->
<!--                </div>-->
<!--                <div class="pass-row">-->
<!--                    <input class="password input-icon-lock" type="password" placeholder="Password" />-->
<!--                    <button class="btn btn-login">Log In</button>-->
<!--                    <p class="txt"><a href="#">Forgot your email or password?</a></p>-->
<!--                    <div class="line"></div>-->
<!--                    <p class="txt">New User?</p>-->
<!--                    <button class="btn btn-reg">Register</button>-->
<!--                </div>-->
<!--            </div>-->
        </div><!-- /END Login block -->
<!---->
        <!-- Registration block -->
<!--        <div id="registration" class="registration-block">-->
<!--            <p class="reg-title">Please Register</p>-->
<!--            <div class="register-row">-->
<!--                <input class="first-name input-icon-user" type="text" name="f_name" placeholder="First Name" />-->
<!--                <span>&nbsp;</span>-->
<!--                <input class="input-icon-user" type="text" name="l_name" placeholder="Last Name" />-->
<!--            </div>-->
<!--            <div class="register-row">-->
<!--                <input class="email input-icon-email" type="text" name="email" placeholder="Email" />-->
<!--                <span><i class="required">*</i>or</span>-->
<!--                <div class="reg-phone">-->
<!--                    <input class="mobile input-icon-mobile" type="text" name="phone" placeholder="Permanent Mobile" onkeypress="validateNumber(event)" />-->
<!--                    <select class="reg-code">-->
<!--                        <option value="0">+374</option>-->
<!--                        <option value="1">+375</option>-->
<!--                        <option value="1">+376</option>-->
<!--                    </select>-->
<!--                </div>-->
<!--                <i class="required">*</i>-->
<!--            </div>-->
<!--            <div class="register-row no-padding">-->
<!--                <input class="password input-icon-lock" type="text" name="email" placeholder="Password" />-->
<!--                <span>&nbsp;</span>-->
<!--                <input class="confirm-password input-icon-lock" type="text" name="phone" placeholder="Confirm Password" />-->
<!--            </div>-->
<!--            <div class="register-row agree">-->
<!--                <input id="terms" type="checkbox" name="agree" value="" checked="checked">-->
<!--                <label for="terms"><span></span>-->
<!--                    I agree to the <a href="#">Terms & Conditions</a> of Us-->
<!--                </label>-->
<!--                <p class="note">Note: A verification code will be sent to your eMail and / or permanent mobile</p>-->
<!--            </div>-->
<!--            <div class="register-row text-center">-->
<!--                <button class="btn btn-reg">Register</button>-->
<!--            </div>-->
<!--        </div>-->
        <!-- /END Registration block -->
<!---->
<!--        <div id="registration-verify" class="virify-block">-->
<!--            <p class="verify-title">Please verify your account</p>-->
<!--            <p class="verify-subtitle">A verification code has been sent to:</p>-->
<!--            <p class="verify-info">-->
<!--                <span class="verify-email">ilit@mailtest.com</span> (VAR) and-->
<!--                <span class="selected-code">+374</span>-->
<!--                <span class="selected-number">12121</span>(VAR)-->
<!--            </p>-->
<!--            <p>-->
                <!--input valu 123 is for demo check-->
<!--                <input class="virify-code input-icon-email" type="text" placeholder="Enter code sent to eMail or Mobile" />-->
<!--            </p>-->
<!--            <p><button class="btn btn-confirm">Confirm</button></p>-->
<!--            <p class="receive-info-txt">-->
<!--                Didn't receive a code?-->
<!--                                 <span class="action-links">-->
<!--                                    <a href="#">Resend Code</a> or <a href="#">Edit Details</a>-->
<!--                                 </span>-->
<!--            </p>-->
<!--        </div>-->

        <!-- Review Order block -->
        <div id="review-order" class="details-block ">
            <p class="details-title">Review Order</p>

            <div class="details-conetnt">
                <p class="details-item-title">Recipient Details</p>

                <div class="details-row text-to-left">
                    <span class="name">Recipient Mobile:</span>
                                    <span class="value">
                                        <span class="selected-code">+<?=$countryCode?></span>
                                        <span class="selected-number"><?=$number?></span>
                                    </span>
                </div>
                <div class="details-row text-to-left">
                    <span class="name">Operator:</span>
                                    <span class="value">
                                        <span class="selected-operator"><?=$operator?></span>
                                    </span>
                </div>
                <div class="details-row text-to-left">
                    <span class="name">Package:</span>
                    <span class="value"><?=$package?> ( <span class="selected-package"><?=$currency?></span> )</span>
                </div>
                <div class="details-row text-to-left">
                    <span class="name">Price:</span>
                    <span class="value"><?=$currency?> <?=$package?></span>
                </div>
                <div class="details-row text-to-left">
                    <span class="name">Service Fee:</span>
                    <span class="value"><?=$currency?> <?=$package*10/100?></span>
                </div>
                <div class="details-row text-bold text-to-left">
                    <span class="name">Total:</span>
                    <span class="value"><?=$currency?> <?=$package+($package*10/100)?></span>
                </div>
            </div>

            <div class="details-conetnt">
                <p class="details-item-title">Sender Details (Optional)</p>

                <div class="details-row">
                    <span class="name">Message to recipient<br/>(Will be sent by SMS)</span>
                                    <span class="value">
                                        <textarea id="sms-message" placeholder="e.g. Hope you enjoy the credit, from Bob (only 30 ASCII characters allowed)"></textarea>
                                    </span>
                </div>

                <div class="details-row">
                    <p class="payment text-right">
                        Proceed to Secure Payment
                        <img src="../media/images/payment-img.png" />
                    </p>
                    <div class="agree text-right">
                        <input id="terms" type="checkbox" name="agree" value="" checked="checked">
                        <label for="terms"><span></span>
                            I agree to the <a href="#">Terms & Conditions</a> of Us
                        </label>
                    </div>
                    <div class="action-buttons text-right">
                        <button class="btn btn-checkout next-step">Checkout</button>
                    </div>
                </div>
            </div>
        </div>
    </div><!-- /END Review Order block -->

    <!--<button class="btn btn-next next-step">Next</button>-->
</fieldset><!-- /END Step 4 - Checkout -->
