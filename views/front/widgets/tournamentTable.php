<?php
/**
 * Created by PhpStorm.
 * User: Rob
 * Date: 11/6/2015
 * Time: 3:20 PM
 */

//todo: Здес надо 4 табов
?>

<div class="widget widget-with-tabs">
    <div class="widget-header">
        <div class="widget-tabs">
<!--            <div class="tab1"><div><span>text1</span></div></div>-->
            <div class="tab1 active"><div><span><?=__('Premier League')?></span></div></div>
            <div class="tab2"><div><span><?=__('First League')?></span></div></div>
<!--            <div class="tab4"><div><span>text4</span></div></div>-->
        </div>
    </div>
    <div class="widget-body">
        <div class="widget-tabs-body">
<!--            <div class="tab1">tab desc1</div>-->
            <div class="tab1 active">
                <table class="score-table-widget">
                    <tbody>
                        <tr>
                            <th></th>
                            <th><?=__('GP')?></th>
                            <th><?=__('PTS')?></th>
                        </tr>
                        <tr>
                            <td><a class="team" href="#"><?=__('Alashkert')?></a></td>
                            <td><span>23</span></td>
                            <td><span>46</span></td>
                        </tr>
                        <tr>
                            <td><a class="team" href="#"><?=__('Pyunik')?></a></td>
                            <td><span>23</span></td>
                            <td><span>39</span></td>
                        </tr>
                        <tr>
                            <td><a class="team" href="#"><?=__('Shirak')?></a></td>
                            <td><span>23</span></td>
                            <td><span>39</span></td>
                        </tr>
                        <tr>
                            <td><a class="team" href="#"><?=__('Gandzasar-Kapan')?></a></td>
                            <td><span>23</span></td>
                            <td><span>34</span></td>
                        </tr>
                        <tr>
                            <td><a class="team" href="#"><?=__('Ararat')?></a></td>
                            <td><span>23</span></td>
                            <td><span>33</span></td>
                        </tr>
                        <tr>
                            <td><a class="team" href="#"><?=__('Mika')?></a></td>
                            <td><span>23</span></td>
                            <td><span>29</span></td>
                        </tr>
                        <tr class="active">
                            <td><a class="team" href="#"><?=__('Banants')?></a></td>
                            <td><span>23</span></td>
                            <td><span>26</span></td>
                        </tr>
                        <tr>
                            <td><a class="team" href="#"><?=__('Ulisses')?></a></td>
                            <td><span>23</span></td>
                            <td><span>2</span></td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="tab2">
                <table class="score-table-widget">
                    <tbody>
                        <tr>
                            <th></th>
                            <th><?=__('GP')?></th>
                            <th><?=__('PTS')?></th>
                        </tr>
                        <tr>
                            <td><a class="team" href="#"><?=__('Alashkert-2')?></a></td>
                            <td><span>23</span></td>
                            <td><span>56</span></td>
                        </tr>
                        <tr>
                            <td><a class="team" href="#"><?=__('Mika-2')?></a></td>
                            <td><span>23</span></td>
                            <td><span>42</span></td>
                        </tr>
                        <tr class="active">
                            <td><a class="team" href="#"><?=__('Banants-2')?></a></td>
                            <td><span>23</span></td>
                            <td><span>38</span></td>
                        </tr>
                        <tr>
                            <td><a class="team" href="#"><?=__('Pyunik-2')?></a></td>
                            <td><span>23</span></td>
                            <td><span>35</span></td>
                        </tr>
                        <tr>
                            <td><a class="team" href="#"><?=__('Shirak-2')?></a></td>
                            <td><span>23</span></td>
                            <td><span>35</span></td>
                        </tr>
                        <tr>
                            <td><a class="team" href="#"><?=__('Ararat-2')?></a></td>
                            <td><span>23</span></td>
                            <td><span>35</span></td>
                        </tr>
                        <tr>
                            <td><a class="team" href="#"><?=__('Gandzasar-Kapan-2')?></a></td>
                            <td><span>23</span></td>
                            <td><span>13</span></td>
                        </tr>
                        <tr>
                            <td><a class="team" href="#"><?=__('Ulisses-2')?></a></td>
                            <td><span>23</span></td>
                            <td><span>11</span></td>
                        </tr>
                    </tbody>
                </table>
            </div>
<!--            <div class="tab4">tab desc4</div>-->
        </div>
    </div>
    <div class="widget-footer">
        <div class="widget-pagination">
            <div class="owl-controls clickable">
                <div class="owl-pagination">
                    <div class="owl-page circle">
                        <span class=""></span>
                    </div>
                    <div class="owl-page circle">
                        <span class=""></span>
                    </div>
<!--                    <div class="owl-page circle">-->
<!--                        <span class=""></span>-->
<!--                    </div>-->
<!--                    <div class="owl-page circle">-->
<!--                        <span class=""></span>-->
<!--                    </div>-->
                </div>
<!--                <div class="owl-buttons">-->
<!--                    <div class="owl-prev wgt-prev"></div>-->
<!--                    <div class="owl-next wgt-next"></div>-->
<!--                </div>-->
            </div>
        </div>

    </div>
</div><!-- tournament_table -->