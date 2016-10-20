<?php
/**
 * Created by PhpStorm.
 * User: Arsen
 * Date: 11/6/2015
 * Time: 3:20 PM
 *
 * @var $items array[round][EventModel]
 */

use Ivliev\Imagefly\Imagefly;
use Carbon\Carbon;

?>

<ul class="bxslider" id="bxslider">

    <? foreach ($items as $key => $item): ?>
        <li>
            <div class="results">
                <p class="number"><?= __('Round') . ' ' . $key ?></p>

                <? foreach ($item as $event): ?>
                    <div class="match-col">
                        <div class="nxsh1"></div>
                        <div class="result-match">
                            <p class="date-match"><?= Carbon::parse($event->played_at)->format('d\\/m\\/Y H:i') ?></p>
                            <a href="#">
                                <span class="name"><?= __($event->home()->team()->text()) ?></span>
                                <img src="<?= Imagefly::imagePath($event->home()->team()->defaultImage()->path, 'w65-q65') ?>" alt="">
                            </a>
                            <a href="" class="result"><?= $event->home()->score ?> - <?= $event->away()->score ?></a>
                            <a href="#">
                                <img src="<?= Imagefly::imagePath($event->away()->team()->defaultImage()->path, 'w65-q65') ?>" alt="">
                                <span class="name"><?= __($event->away()->team()->text()) ?></span>
                            </a>
                        </div>
                        <div class="result-bottom"><a href="#">
                                <img src="<?= Imagefly::imagePath($tournament->getDefaultImage()->path, 'w36-q36') ?>" alt="1 Liga">
                                <span><?= __($tournament->getName()) ?></span></a>
                            <a href="#"><?= __('Round') . ' ' . $event->round ?></a>
                        </div>
                        <div class="more"><a href="#"><?= __("More") ?></a></div>
                    </div>
                <? endforeach ?>

            </div>
        </li>
    <? endforeach ?>
</ul>

<script>
    $(document).ready(function () {
        $(document).find('#bxslider').bxSlider({
            mode: 'vertical',
            startSlide: '<?= $tournament->getCurrentRound() - 1 ?>',
            pagerSelector : '#pager'
        });
    });
</script>