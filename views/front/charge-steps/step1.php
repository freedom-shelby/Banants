<?php
/**
 * Created by SURO.
 * User: Suren
 * Date: 11/19/2015
 * Time: 12:38 PM
 */
?>
<!-- Step 1 - Country & Number content -->
<fieldset id="1" class="select-country current">

    <div class="country-form-block">
        <div class="country custom-ddslick">
            <label>Select country for topup </label>

            <select id="country-ddslick">
                <?foreach($countries as $country):?>
                    <option value="<?=$country->id?>" data-imagesrc="media/images/flags/<?=$country->iso3?>.jpg"  data-description="+<?=$country->phoneInfo->code?>"><?=$country->name?></option>
                <?endforeach?>
            </select>
        </div>
        <div class="q-mark">
            <label class="mobile-hide">or</label>
            <span class="icon micon-qusetion-circle tooltip-right" title="Description goes here.Lorem ipsum dolor sit amet"></span>
        </div>
        <div class="phone-num">
            <label><span class="mobile-show">or</span> enter number with country code</label>
            <div class="num-and-code">
                <span class="code selected-code"></span>
                <input autocomplete="off" id="enter-phone-num" class="phon-number" type="text" placeholder="Enter phone number to topup"/>
                <p class="error-message"></p>
            </div>
        </div>
        <div class="q-mark">
            <label>&nbsp;</label>
            <span class="icon micon-qusetion-circle tooltip-right" title="Description goes here.Lorem ipsum dolor sit amet"></span>
        </div>
        <div class="action-buttons">
            <label>&nbsp;</label>
            <button disabled="disabled" class="btn btn-next next-step">Next</button>
        </div>
    </div>

    <div class="country-map-block">
        <h1 class="title">Topup.Me covers 300 operators in more than 100 countries. Check below if your operator is supported:</h1>

        <div class="row">
            <div class="col-xs-8">
                <p class="map-title">
                    Click pins on map to select country <br/>
                    <img src="../media/images/double-arrow-down.png" />
                </p>
                <div class="map-bg">
                    <span class="icon micon-pin-full-icon position-1"></span>
                    <span class="icon micon-pin-full-icon position-2"></span>
                    <span class="icon micon-pin-full-icon position-3"></span>
                    <span class="icon micon-pin-full-icon position-4"></span>
                </div>
            </div>
            <div class="col-xs-4 operators-block">
                <p class="country-title">
                    
                </p>
                <ul class="operators">
                    <!-- Operators Block Goes Here -->
                    <img style="display: block; margin: auto;" src="/media/images/loading.gif"/>
                </ul>
                <p class="operator-support">
                    <a class="show-message-block" href="#">Operator not supported? Let us know here and we’ll do our best to add it to our service.</a>
                </p>
            </div>
        </div>

    </div>


</fieldset><!-- /END Step 1 - Country & Number content -->
