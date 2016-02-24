<?php
/**
 * Created by SURO.
 * User: Suren
 * Date: 11/19/2015
 * Time: 12:37 PM
 */
?>
<!-- Step 2 - Mobile Operator content -->
<fieldset id="2" class="select-operator">

    <div class="mobile-form-block">
        <div class="operators custom-ddslick">
            <label>Select your mobile operator (<span class="selected-country"></span>)</label>

            <select id="operators-ddslick" class="ddslick">
                <?foreach($items as $i):?>
                <option value="<?=$i['id']?>" data-imagesrc="https://fm.transfer-to.com/logo_operator/logo-<?=$i['id']?>-1.png"><?=$i['operator']?></option>
                <?endforeach?>

            </select>
        </div>
        <div class="q-mark">
            <label>&nbsp;</label>
            <span class="icon micon-qusetion-circle"></span>
        </div>
        <div class="action-buttons">
            <label>&nbsp;</label>
            <button class="btn btn-next next-step">Next</button>
        </div>
    </div>


</fieldset><!-- /END Step 2 - Mobile Operator content -->
