<?php
/**
 * Created by PhpStorm.
 * User: Arsen
 * Date: 11/6/2015
 * Time: 3:20 PM
 *
 * @var $item \Football\Tournaments\Types\DoubleRoundRobin
 */
?>

<div class="info-col">

<!--        --><?// foreach ($item->getDuels() as $team): ?>
<!--            --><?//= __($team->team()->text()) ?>
<!--        --><?// endforeach ?>

</div>

<div class="cup-page">
    <div class="info-col">
        <h1 class="col-title"><?= __($item->getFullName()) ?></h1>
        <div class="wr-group">
            <div class="group">
                <table>
                    <tr>
                        <td><img alt="" src="/media/assets/images/team_logo/Ararat-yerevan-logo.png" /> <?= __('Ararat') ?></td>
                        <td class="cef">1</td>
                        <td class="cef">1</td>
                        <td class="cef">2</td>
                    </tr>
                    <tr class="win">
                        <td><img alt="" src="/media/assets/images/logo.png" /> <?= __('Banants') ?></td>
                        <td class="cef">2</td>
                        <td class="cef">0</td>
                        <td class="cef">2</td>
                    </tr>
                </table>
            </div>
            <div class="group">
                <table>
                    <tr>
                        <td><img alt="" src="/media/assets/images/team_logo/Logo-Alashkert.png" /> <?= __('Alaskert') ?></td>
                        <td class="cef">1</td>
                        <td class="cef">0</td>
                        <td class="cef">1</td>
                    </tr>
                    <tr class="win">
                        <td><img alt="" src="/media/assets/images/team_logo/Pyunik-Logo.png" /> <?= __('Pyunik') ?></td>
                        <td class="cef">2</td>
                        <td class="cef">1</td>
                        <td class="cef">3</td>
                    </tr>
                </table>
            </div>
            <div class="group">
                <table>
                    <tr>
                        <td><img alt="" src="/media/assets/images/team_logo/gandzasar-kapan-logo.png" /> <?= __('Gandzasar') ?></td>
                        <td class="cef">3</td>
                        <td class="cef">-</td>
                        <td class="cef">-</td>
                    </tr>
                    <tr class="win">
                        <td><img alt="" src="/media/assets/images/team_logo/erebuni-logo.png" /> <?= __('Erebuni') ?></td>
                        <td class="cef">0</td>
                        <td class="cef">-</td>
                        <td class="cef">-</td>
                    </tr>
                </table>
            </div>
            <div class="group">
                <table>
                    <tr>
                        <td><img alt="" src="/media/assets/images/team_logo/Shirak-Logo.png" /> <?= __('Shirak') ?></td>
                        <td class="cef">1</td>
                        <td class="cef">-</td>
                        <td class="cef">-</td>
                    </tr>
                    <tr class="win">
                        <td><img alt="" src="/media/assets/images/team_logo/erebuni-logo.png" /> <?= __('Erebuni') ?></td>
                        <td class="cef">0</td>
                        <td class="cef">-</td>
                        <td class="cef">-</td>
                    </tr>
                </table>
            </div>
        </div>
        <div class="wr-group group2">
            <div class="group">
                <div>11.04.17  16:00</div>
                <table>
                    <tr>
                        <td><img alt="" src="/media/assets/images/team_logo/Pyunik-Logo.png" /> <?= __('Pyunik') ?></td>
                        <td class="cef">-</td>
                        <td class="cef">-</td>
                        <td class="cef">-</td>
                    </tr>
                    <tr class="win">
                        <td><img alt="" src="/media/assets/images/logo.png" /> <?= __('Banants') ?></td>
                        <td class="cef">-</td>
                        <td class="cef">-</td>
                        <td class="cef">-</td>
                    </tr>
                </table>
                <div class="under">25.04.17  16:00</div>
            </div>
            <div class="group">
                <div>12.04.17  16:00</div>
                <table>
                    <tr>
                        <td><img alt="" src="/media/assets/images/team_logo/gandzasar-kapan-logo.png" /> <?= __('Gandzasar') ?></td>
                        <td class="cef">-</td>
                        <td class="cef">-</td>
                        <td class="cef">-</td>
                    </tr>
                    <tr class="win">
                        <td><img alt="" src="/media/assets/images/team_logo/Shirak-Logo.png" /> <?= __('Shirak') ?></td>
                        <td class="cef">-</td>
                        <td class="cef">-</td>
                        <td class="cef">-</td>
                    </tr>
                </table>
                <div class="under">26.04.17  15:00</div>
            </div>
        </div>
        <div class="wr-group group3">
            <div class="group">
                <div>2.04.16  15:00</div>
                <table class="empty">
                    <tr>
                        <td>?</td>
                        <td class="cef">-</td>
                        <td class="cef">-</td>
                        <td class="cef">-</td>
                    </tr>
                    <tr>
                        <td>?</td>
                        <td class="cef">-</td>
                        <td class="cef">-</td>
                        <td class="cef">-</td>
                    </tr>
                </table>

            </div>

        </div>
        <div class="clearfix"></div>
    </div>

<!--    <div class="info-col">-->
<!--        <p class="col-title">Бомбардиры</p>-->
<!--        <div class="scorer">-->
<!--            <table>-->
<!--                <tr>-->
<!--                    <td><a href="#">01- Лаерсио Гомес Коста (Бананц)</a></td>-->
<!--                    <td>3 гола</td>-->
<!--                </tr>-->
<!--                <tr>-->
<!--                    <td>01- Лаерсио Гомес Коста (Бананц)</td>-->
<!--                    <td>3 гола</td>-->
<!--                </tr>-->
<!--                <tr>-->
<!--                    <td>01- Лаерсио Гомес Коста (Бананц)</td>-->
<!--                    <td>3 гола</td>-->
<!--                </tr>-->
<!--                <tr>-->
<!--                    <td>01- Лаерсио Гомес Коста (Бананц)</td>-->
<!--                    <td>3 гола</td>-->
<!--                </tr>-->
<!--                <tr>-->
<!--                    <td>01- Лаерсио Гомес Коста (Бананц)</td>-->
<!--                    <td>3 гола</td>-->
<!--                </tr><tr>-->
<!--                    <td>01- Лаерсио Гомес Коста (Бананц)</td>-->
<!--                    <td>3 гола</td>-->
<!--                </tr>-->
<!--                <tr>-->
<!--                    <td>01- Лаерсио Гомес Коста (Бананц)</td>-->
<!--                    <td>3 гола</td>-->
<!--                </tr>-->
<!---->
<!--            </table>-->
<!--        </div>-->
<!--    </div>-->

</div>