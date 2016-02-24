<?php
/**
 * Created by SUR-SER.
 * User: SURO
 * Date: 22.11.2015
 * Time: 2:25
 */
?>
<?foreach($items as $i):?>
    <li>
        <span class="operator-logo">
            <img width="39px" height="33px" src="https://fm.transfer-to.com/logo_operator/logo-<?=$i['id']?>-1.png">
        </span>
        <span><?=$i['operator']?></span>
    </li>
<?endforeach?>

