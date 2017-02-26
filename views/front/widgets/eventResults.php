<?php
/**
 * Created by PhpStorm.
 * User: Arsen
 * Date: 11/6/2015
 * Time: 3:20 PM
 *
 * @var $data EventModel
 * @var $title string
 */

use Ivliev\Imagefly\Imagefly;
use Carbon\Carbon;

?>

<div class="results">
    <div class="match-col">
        <div class="nxsh1"></div>
        <div class="result-match">
            <p class="date-match"><?= Carbon::parse($data->played_at)->format('d\\/m\\/Y H:i') ?></p>
            <a href="#">
                <span class="name"><?= __($data->home()->team()->text()) ?></span>
                <img src="<?= Imagefly::imagePath($data->home()->team()->defaultImage()->path, 'w65-q65') ?>" alt="">
            </a>
            <a href="" class="result"><?= $data->home()->score ?> - <?= $data->away()->score ?></a>
            <a href="#">
                <img src="<?= Imagefly::imagePath($data->away()->team()->defaultImage()->path, 'w65-q65') ?>" alt="">
                <span class="name"><?= __($data->away()->team()->text()) ?></span>
            </a>
        </div>
        <div class="result-bottom"><a href="#">
                <img src="<?= Imagefly::imagePath($data->tournament()->defaultImage()->path, 'w36-q36') ?>" alt="1 Liga">
                <span><?= __($data->tournament()->name()) ?></span></a>
            <a href="#"><?= __('Round') . ' ' . $data->round ?></a>
        </div>
    </div>

</div>