<?php
/**
 * Created by PhpStorm.
 * User: Arsen
 * Date: 11/6/2015
 * Time: 3:20 PM
 */
?>

<!--<div class="widget widget-with-tabs">-->
<!--    <div class="widget-header">-->
<!--        <div class="widget-tabs">-->
<!---->
<!--            --><?// foreach ($items as $key => $item): ?>
<!--                <div class="tab---><?//= ++$key ?><!-- --><?//= ($key == 1) ? ' active' : ''?><!--"><div>-->
<!--                        <span>--><?//= __($item->getName()) ?><!--</span>-->
<!--                    </div>-->
<!--                </div>-->
<!--            --><?// endforeach ?>
<!---->
<!--        </div>-->
<!--    </div>-->
<!--    <div class="widget-body">-->
<!--        <div class="widget-tabs-body">-->
<!---->
<!--            --><?// foreach ($items as $key => $item): ?>
<!--                <div class="tab---><?//= ++$key ?><!-- --><?//= ($key == 1) ? ' active' : ''?><!--">-->
<!---->
<!--                    --><?//= $item->renderBasicWidget()?>
<!---->
<!--                </div>-->
<!--            --><?// endforeach ?>
<!---->
<!--        </div>-->
<!--    </div>-->
<!--    <div class="widget-footer">-->
<!--        <div class="widget-pagination">-->
<!--            <div class="owl-controls clickable">-->
<!--                <div class="owl-pagination">-->
<!---->
<!--                    --><?// foreach ($items as $item): ?>
<!--                        <div class="owl-page circle">-->
<!--                            <span class=""></span>-->
<!--                        </div>-->
<!--                    --><?// endforeach ?>
<!---->
<!--                </div>-->
<!---->
<!--            </div>-->
<!--        </div>-->
<!--    </div>-->
<!--</div>-->

<div class="info-col">
    <p class="col-title">Чемпионат Армении по футболу-2015/2016 гг. Первая лига</p>
    <div class="inner_content contener-white">
        <p class="fild-name">Турнирная таблица</p>
        <div class="static-table tournir-table">
            <table>
                <tbody>
                <tr>
                    <th></th>
                    <th>И</th>
                    <th>В</th>
                    <th>Н</th>
                    <th>П</th>
                    <th>ЗГ</th>
                    <th>ПГ</th>
                    <th>О</th>
                </tr>
                <tr>
                    <td class="name"><span>1</span>   <?= __('Shirak') ?></td>
                    <td>8</td>
                    <td>5</td>
                    <td>2</td>
                    <td>1</td>
                    <td>9</td>
                    <td>4</td>
                    <td>17</td>
                </tr>
                <tr>
                    <td class="name"><span>1</span>   <?= __('Alashkert') ?></td>
                    <td>8</td>
                    <td>4</td>
                    <td>3</td>
                    <td>4</td>
                    <td>13</td>
                    <td>6</td>
                    <td>15</td>
                </tr>
                <tr>
                    <td class="name"><span>1</span>   <?= __('Banants') ?></td>
                    <td>8</td>
                    <td>4</td>
                    <td>0</td>
                    <td>4</td>
                    <td>9</td>
                    <td>10</td>
                    <td>12</td>
                </tr>
                <tr>
                    <td class="name"><span>1</span>   <?= __('Gandzasar-kapan') ?></td>
                    <td>8</td>
                    <td>3</td>
                    <td>1</td>
                    <td>4</td>
                    <td>6</td>
                    <td>10</td>
                    <td>10</td>
                </tr>
                <tr>
                    <td class="name"><span>1</span>   <?= __('Pyunik') ?></td>
                    <td>8</td>
                    <td>2</td>
                    <td>3</td>
                    <td>3</td>
                    <td>7</td>
                    <td>7</td>
                    <td>9</td>
                </tr>
                <tr>
                    <td class="name"><span>1</span>   <?= __('Ararat') ?></td>
                    <td>8</td>
                    <td>1</td>
                    <td>1</td>
                    <td>6</td>
                    <td>3</td>
                    <td>10</td>
                    <td>4</td>
                </tr>
                </tbody></table>
        </div>
        <p class="col-title">Туры</p>

        <div id="pager" class="tours">

        </div>
    </div>
</div>