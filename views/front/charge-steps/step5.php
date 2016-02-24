<?php
/**
 * Created by SURO.
 * User: Suren
 * Date: 11/19/2015
 * Time: 12:38 PM
 */
?>
<fieldset id="5" class="select-payment ">


    <div class="details-block <?if($txnError):?>hide<?endif?>">
        <p class="details-title ">
            <span class="icon micon-success" ></span>
            Transaction Confirmation
        </p>

        <div class="details-conetnt">
            <p class="details-item-title">Recipient Details</p>

            <div class="details-row">
                <span class="name">Recipient Mobile:</span>
                <span class="value"><?=$number?></span>
            </div>
            <div class="details-row">
                <span class="name">Operator:</span>
                <span class="value"><?=$operator?></span>
            </div>
            <div class="details-row">
                <span class="name">Package:</span>
                <span class="value"><?=$package?> <?=$currency?></span>
            </div>
            <div class="details-row">
                <span class="name">Amount Paid:</span>
                <span class="value"><?=$currency?> <?=$package+($package*10/100)?></span>
            </div>
            <div class="details-row">
                <span class="name">Transaction ID:</span>
                <span class="value"><?=rand(100000,999999)?></span>
            </div>
        </div>
    </div>

    <!-- styles for transaction failed / remove .hide class for see content-->
    <div class="details-block failed <?if(!$txnError):?>hide<?endif?>">
        <p class="details-title ">
            <span class="icon micon-failure-1" ></span>
            Transaction Failed
        </p>

        <div class="details-conetnt">
            <p class="details-item-title"><?=$errorMessage?><br/>Please check details below and try again</p>
            <p class="note">NOTE YOU WERE NOT BILLED - NO PAYMENT MADE </p>

            <div class="details-row transaction-details">
                Transaction Details
            </div>
            <div class="details-row text-failed">
                <span class="name">Recipient Mobile:</span>
                <span class="value"><?=$number?></span>
            </div>
            <div class="details-row">
                <span class="name">Operator:</span>
                <span class="value"><?=$operator?></span>
            </div>
            <div class="details-row">
                <span class="name">Package:</span>
                <span class="value"><?=$package?> <?=$currency?></span>
            </div>
            <div class="details-row text-failed">
                <span class="name">Amount Paid:</span>
                <span class="value"><?=$currency?> <?=$package+($package*10/100)?></span>
            </div>
            <div class="details-row">
                <span class="name">Transaction ID:</span>
                <span class="value"><?=rand(100000,999999)?></span>
            </div>

            <div class="action-buttons">
                <button class="btn btn-new-topup">ANOTHER TOPUP</button>
            </div>
        </div>
    </div>



</fieldset><!-- /END Step 5 - Payment & Confirmation -->
