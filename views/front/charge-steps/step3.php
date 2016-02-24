<?php
/**
 * Created by SURO.
 * User: Suren
 * Date: 11/19/2015
 * Time: 12:37 PM
 */
?>
<!-- Step 3 - Package content -->
<fieldset id="3" class="select-package" data-operator="<?=$operatorId?>">

    <div class="package-form-block">
        <div class="package-title">Choose a package (<span class="selected-operator"><?=$operator?></span>) </div>
        <div class="package-subtitle">Most Popular Packages (4 of <span class="count-of-packages"></span>) </div>

        <div class="package-block" id="packages">

            <div class="short-block">
                <div class="package-row">
                    <?foreach($packages[0] as $pack):?>
                    <div class="item" title="<?=$pack['product'],' ',$currency?>" prise="<?=$pack['product']?>">
                        <span class="package-name"><?=$pack['product'],' ',$currency?></span>
                    </div>
                    <?endforeach?>
                </div>
            </div>
            <?if(sizeof($packages) > 1):?>
            <div class="full-block">
                <div class="info-block">
                    <p class="pull-left">Hover over for details</p>
                    <p id="show-all-packages" class="pull-right">Click to see all packages <span class="icon micon-arrow-bottom-icon"></span></p>
                </div>

                <div class="all-packages">
                    <?for($i = 0; $i < sizeof($packages); $i++):?>
                    <div class="package-row">
                        <?foreach($packages[$i] as $pack):?>
                        <div class="item" title="<?=$pack['product'],' ',$currency?>" prise="<?=$pack['product']?>">
                            <span class="package-name"><?=$pack['product'],' ',$currency?></span>
                        </div>
                        <?endforeach?>
                    </div>
                    <?endfor?>

                </div>
            </div>
            <?endif?>

        </div>

    </div>
    <div class="action-buttons">
        <button class="btn btn-next next-step">Next</button>
    </div>


</fieldset><!-- /END Step 3 - Package content -->
