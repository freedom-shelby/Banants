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

        <? foreach ($item->getDuels() as $team): ?>
            <?= __($team->team()->text()) ?>
        <? endforeach ?>


</div>

<div class="cup-page">
    <div class="info-col">
        <h1 class="col-title"><?= __($item->getFullName()) ?></h1>
        <div class="wr-group">
            <div class="group">
                <table>
                    <tr>
                        <td><img alt="" src="images/team1.jpg" /> Арарат</td>
                        <td class="cef">0</td>
                        <td class="cef">0</td>
                        <td class="cef">0</td>
                    </tr>
                    <tr class="win">
                        <td><img alt="" src="images/team1.jpg" /> Арарат</td>
                        <td class="cef">3</td>
                        <td class="cef">2</td>
                        <td class="cef">1</td>
                    </tr>
                </table>
            </div>
            <div class="group">
                <table>
                    <tr>
                        <td><img alt="" src="images/team1.jpg" /> Арарат</td>
                        <td class="cef">0</td>
                        <td class="cef">0</td>
                        <td class="cef">0</td>
                    </tr>
                    <tr class="win">
                        <td><img alt="" src="images/team1.jpg" /> Арарат</td>
                        <td class="cef">3</td>
                        <td class="cef">2</td>
                        <td class="cef">1</td>
                    </tr>
                </table>
            </div>
            <div class="group">
                <table>
                    <tr>
                        <td><img alt="" src="images/team1.jpg" /> Арарат</td>
                        <td class="cef">0</td>
                        <td class="cef">0</td>
                        <td class="cef">0</td>
                    </tr>
                    <tr class="win">
                        <td><img alt="" src="images/team1.jpg" /> Арарат</td>
                        <td class="cef">3</td>
                        <td class="cef">2</td>
                        <td class="cef">1</td>
                    </tr>
                </table>
            </div>
            <div class="group">
                <table>
                    <tr>
                        <td><img alt="" src="images/team1.jpg" /> Арарат</td>
                        <td class="cef">0</td>
                        <td class="cef">0</td>
                        <td class="cef">0</td>
                    </tr>
                    <tr class="win">
                        <td><img alt="" src="images/team1.jpg" /><span>Гандзасар-<br />
                                                Капан</span></td>
                        <td class="cef">3</td>
                        <td class="cef">2</td>
                        <td class="cef">1</td>
                    </tr>
                </table>
            </div>
        </div>
        <div class="wr-group group2">
            <div class="group">
                <div>2.04.16  15:00</div>
                <table>
                    <tr>
                        <td><img alt="" src="images/team1.jpg" /> Арарат</td>
                        <td class="cef">0</td>
                        <td class="cef">0</td>
                        <td class="cef">0</td>
                    </tr>
                    <tr class="win">
                        <td><img alt="" src="images/team1.jpg" /> Арарат</td>
                        <td class="cef">3</td>
                        <td class="cef">2</td>
                        <td class="cef">1</td>
                    </tr>
                </table>
                <div class="under">15.03.16  14:00</div>
            </div>
            <div class="group">
                <div>2.04.16  15:00</div>
                <table>
                    <tr>
                        <td><img alt="" src="images/team1.jpg" /> Арарат</td>
                        <td class="cef">0</td>
                        <td class="cef">0</td>
                        <td class="cef">0</td>
                    </tr>
                    <tr class="win">
                        <td><img alt="" src="images/team1.jpg" /> Алашкерт</td>
                        <td class="cef">3</td>
                        <td class="cef">2</td>
                        <td class="cef">1</td>
                    </tr>
                </table>
                <div class="under">15.03.16  14:00</div>
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
    <div class="info-col">
        <p class="col-title">Бомбардиры</p>
        <div class="scorer">
            <table>
                <tr>
                    <td><a href="#">01- Лаерсио Гомес Коста (Бананц)</a></td>
                    <td>3 гола</td>
                </tr>
                <tr>
                    <td>01- Лаерсио Гомес Коста (Бананц)</td>
                    <td>3 гола</td>
                </tr>
                <tr>
                    <td>01- Лаерсио Гомес Коста (Бананц)</td>
                    <td>3 гола</td>
                </tr>
                <tr>
                    <td>01- Лаерсио Гомес Коста (Бананц)</td>
                    <td>3 гола</td>
                </tr>
                <tr>
                    <td>01- Лаерсио Гомес Коста (Бананц)</td>
                    <td>3 гола</td>
                </tr><tr>
                    <td>01- Лаерсио Гомес Коста (Бананц)</td>
                    <td>3 гола</td>
                </tr>
                <tr>
                    <td>01- Лаерсио Гомес Коста (Бананц)</td>
                    <td>3 гола</td>
                </tr>

            </table>
        </div>
    </div>
</div>