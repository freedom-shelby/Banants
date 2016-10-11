<?php
/**
 *
 * Created by PhpStorm.
 * User: Arsen
 * Date: 11/6/2015
 * Time: 3:20 PM
 */

use Helpers\Uri;
use Ivliev\Imagefly\Imagefly;

//todo: Надо включить сортировку
?>

<div class="inner_content_wrapper">
    <div class="inner_content">
        <div class="team_wrapper clearfix">
            <div class="team_wrapper_top">
                <h3><?=$title?></h3>
                <span>

                </span>
            </div><!-- team_wrapper_top -->
            <div class="team_wrapper_body clearfix">
                <div id="item_tabs">
<!--                    <ul>-->
<!--                        <li><a href="#item_tabs_list1">--><?//=__('Players')?><!--</a></li>-->
<!--                        <li><a href="#item_tabs_list1">--><?//=__('Goalkeepers')?><!--</a></li>-->
<!--                        <li><a href="#item_tabs_list1">--><?//=__('Defenders')?><!--</a></li>-->
<!--                        <li><a href="#item_tabs_list1">--><?//=__('Midfielders')?><!--</a></li>-->
<!--                        <li><a href="#item_tabs_list1">--><?//=__('Forwards')?><!--</a></li>-->
<!--                    </ul>-->
                    <div id="item_tabs_list1" class="item_tabs_list">

                        <?foreach ($items as $item):?>
                            <div class="team_item">
                                <div class="team_item_images pictures_wrapper">
                                    <img class="flag_icon" src="<?=$item->getCountry()->flag?>" alt="flag">
                                    <div class="player_number"><?=$item->getNumber()?></div>
                                    <div class="player_wrapper">
                                        <img src="<?=Imagefly::imagePath($item->getDefaultImage(), 'w140-q52')?>" alt="player">
                                    </div>
                                </div>
                                <div class="team_item_title">
                                    <h3><?=__($item->getFullName())?></h3>
                                </div>
                                <div class="team_item_bottom">
                                    <h4><?=__($item->getPosition()->title())?></h4>
                                    <img src="<?=$item->getPosition()->icon?>" alt="goalkeeper icon">
                                </div>
                            </div>
                        <?endforeach ?>

                    </div>
                    <!--<div id="item_tabs_list2" class="item_tabs_list ui-tabs-panel ui-widget-content ui-corner-bottom" aria-labelledby="ui-id-2" role="tabpanel" aria-expanded="false" aria-hidden="true" style="display: none;">
                        <div class="team_item">
                            <div class="team_item_images pictures_wrapper">
                                <img class="flag_icon" src="/uploads/images/flags/flag-armenia.jpg" alt="flag">
                                <div class="player_number">1</div>
                                <img src="/media/assets/images/player1.jpg" alt="player">
                            </div>
                            <div class="team_item_title">
                                <h3>Сурен Алоян</h3>
                            </div>
                            <div class="team_item_bottom">
                                <h4>Вратарь</h4>
                                <img src="/media/assets/images/player_position_icon3.png" alt="goalkeeper icon">
                            </div>
                        </div>
                        <div class="team_item">
                            <div class="team_item_images pictures_wrapper">
                                <img class="flag_icon" src="/uploads/images/flags/flag-armenia.jpg" alt="flag">
                                <div class="player_number">2</div>
                                <img src="/media/assets/images/player1.jpg" alt="player">
                            </div>
                            <div class="team_item_title">
                                <h3>Сурен Алоян</h3>
                            </div>
                            <div class="team_item_bottom">
                                <h4>Вратарь</h4>
                                <img src="/media/assets/images/player_position_icon3.png" alt="goalkeeper icon">
                            </div>
                        </div>
                        <div class="team_item">
                            <div class="team_item_images pictures_wrapper">
                                <img class="flag_icon" src="/uploads/images/flags/flag-armenia.jpg" alt="flag">
                                <div class="player_number">3</div>
                                <img src="/media/assets/images/player1.jpg" alt="player">
                            </div>
                            <div class="team_item_title">
                                <h3>Сурен Алоян</h3>
                            </div>
                            <div class="team_item_bottom">
                                <h4>Вратарь</h4>
                                <img src="/media/assets/images/player_position_icon3.png" alt="goalkeeper icon">
                            </div>
                        </div>
                        <div class="team_item">
                            <div class="team_item_images pictures_wrapper">
                                <img class="flag_icon" src="/uploads/images/flags/flag-armenia.jpg" alt="flag">
                                <div class="player_number">4</div>
                                <img src="/media/assets/images/player1.jpg" alt="player">
                            </div>
                            <div class="team_item_title">
                                <h3>Сурен Алоян</h3>
                            </div>
                            <div class="team_item_bottom">
                                <h4>Вратарь</h4>
                                <img src="/media/assets/images/player_position_icon3.png" alt="goalkeeper icon">
                            </div>
                        </div>
                    </div>
                    <div id="item_tabs_list3" class="item_tabs_list ui-tabs-panel ui-widget-content ui-corner-bottom" aria-labelledby="ui-id-3" role="tabpanel" aria-expanded="false" aria-hidden="true" style="display: none;">
                        <div class="team_item">
                            <div class="team_item_images pictures_wrapper">
                                <img class="flag_icon" src="/uploads/images/flags/flag-armenia.jpg" alt="flag">
                                <div class="player_number">1</div>
                                <img src="/media/assets/images/player1.jpg" alt="player">
                            </div>
                            <div class="team_item_title">
                                <h3>Сурен Алоян</h3>
                            </div>
                            <div class="team_item_bottom">
                                <h4>Вратарь</h4>
                                <img src="/media/assets/images/player_position_icon3.png" alt="goalkeeper icon">
                            </div>
                        </div>
                        <div class="team_item">
                            <div class="team_item_images pictures_wrapper">
                                <img class="flag_icon" src="/uploads/images/flags/flag-armenia.jpg" alt="flag">
                                <div class="player_number">2</div>
                                <img src="/media/assets/images/player1.jpg" alt="player">
                            </div>
                            <div class="team_item_title">
                                <h3>Сурен Алоян</h3>
                            </div>
                            <div class="team_item_bottom">
                                <h4>Вратарь</h4>
                                <img src="/media/assets/images/player_position_icon3.png" alt="goalkeeper icon">
                            </div>
                        </div>
                    </div>
                    <div id="item_tabs_list4" class="item_tabs_list ui-tabs-panel ui-widget-content ui-corner-bottom" aria-labelledby="ui-id-4" role="tabpanel" aria-expanded="false" aria-hidden="true" style="display: none;">
                        <div class="team_item">
                            <div class="team_item_images pictures_wrapper">
                                <img class="flag_icon" src="/uploads/images/flags/flag-armenia.jpg" alt="flag">
                                <div class="player_number">1</div>
                                <img src="/media/assets/images/player1.jpg" alt="player">
                            </div>
                            <div class="team_item_title">
                                <h3>Сурен Алоян</h3>
                            </div>
                            <div class="team_item_bottom">
                                <h4>Вратарь</h4>
                                <img src="/media/assets/images/player_position_icon3.png" alt="goalkeeper icon">
                            </div>
                        </div>
                        <div class="team_item">
                            <div class="team_item_images pictures_wrapper">
                                <img class="flag_icon" src="/uploads/images/flags/flag-armenia.jpg" alt="flag">
                                <div class="player_number">2</div>
                                <img src="/media/assets/images/player1.jpg" alt="player">
                            </div>
                            <div class="team_item_title">
                                <h3>Сурен Алоян</h3>
                            </div>
                            <div class="team_item_bottom">
                                <h4>Вратарь</h4>
                                <img src="/media/assets/images/player_position_icon3.png" alt="goalkeeper icon">
                            </div>
                        </div>
                        <div class="team_item">
                            <div class="team_item_images pictures_wrapper">
                                <img class="flag_icon" src="/uploads/images/flags/flag-armenia.jpg" alt="flag">
                                <div class="player_number">3</div>
                                <img src="/media/assets/images/player1.jpg" alt="player">
                            </div>
                            <div class="team_item_title">
                                <h3>Сурен Алоян</h3>
                            </div>
                            <div class="team_item_bottom">
                                <h4>Вратарь</h4>
                                <img src="/media/assets/images/player_position_icon3.png" alt="goalkeeper icon">
                            </div>
                        </div>
                        <div class="team_item">
                            <div class="team_item_images pictures_wrapper">
                                <img class="flag_icon" src="/uploads/images/flags/flag-armenia.jpg" alt="flag">
                                <div class="player_number">4</div>
                                <img src="/media/assets/images/player1.jpg" alt="player">
                            </div>
                            <div class="team_item_title">
                                <h3>Сурен Алоян</h3>
                            </div>
                            <div class="team_item_bottom">
                                <h4>Вратарь</h4>
                                <img src="/media/assets/images/player_position_icon3.png" alt="goalkeeper icon">
                            </div>
                        </div>
                    </div>
                    <div id="item_tabs_list5" class="item_tabs_list ui-tabs-panel ui-widget-content ui-corner-bottom" aria-labelledby="ui-id-5" role="tabpanel" aria-expanded="false" aria-hidden="true" style="display: none;">
                        <div class="team_item">
                            <div class="team_item_images pictures_wrapper">
                                <img class="flag_icon" src="/uploads/images/flags/flag-armenia.jpg" alt="flag">
                                <div class="player_number">1</div>
                                <img src="/media/assets/images/player1.jpg" alt="player">
                            </div>
                            <div class="team_item_title">
                                <h3>Сурен Алоян</h3>
                            </div>
                            <div class="team_item_bottom">
                                <h4>Вратарь</h4>
                                <img src="/media/assets/images/player_position_icon3.png" alt="goalkeeper icon">
                            </div>
                        </div>
                        <div class="team_item">
                            <div class="team_item_images pictures_wrapper">
                                <img class="flag_icon" src="/uploads/images/flags/flag-armenia.jpg" alt="flag">
                                <div class="player_number">2</div>
                                <img src="/media/assets/images/player1.jpg" alt="player">
                            </div>
                            <div class="team_item_title">
                                <h3>Сурен Алоян</h3>
                            </div>
                            <div class="team_item_bottom">
                                <h4>Вратарь</h4>
                                <img src="/media/assets/images/player_position_icon3.png" alt="goalkeeper icon">
                            </div>
                        </div>
                        <div class="team_item">
                            <div class="team_item_images pictures_wrapper">
                                <img class="flag_icon" src="/uploads/images/flags/flag-armenia.jpg" alt="flag">
                                <div class="player_number">3</div>
                                <img src="/media/assets/images/player1.jpg" alt="player">
                            </div>
                            <div class="team_item_title">
                                <h3>Сурен Алоян</h3>
                            </div>
                            <div class="team_item_bottom">
                                <h4>Вратарь</h4>
                                <img src="/media/assets/images/player_position_icon3.png" alt="goalkeeper icon">
                            </div>
                        </div>
                    </div>
                    <div id="item_tabs_list6" class="item_tabs_list ui-tabs-panel ui-widget-content ui-corner-bottom" aria-labelledby="ui-id-6" role="tabpanel" aria-expanded="false" aria-hidden="true" style="display: none;">
                        <div class="team_item">
                            <div class="team_item_images pictures_wrapper">
                                <img class="flag_icon" src="/uploads/images/flags/flag-armenia.jpg" alt="flag">
                                <div class="player_number">1</div>
                                <img src="/media/assets/images/player1.jpg" alt="player">
                            </div>
                            <div class="team_item_title">
                                <h3>Сурен Алоян</h3>
                            </div>
                            <div class="team_item_bottom">
                                <h4>Вратарь</h4>
                                <img src="/media/assets/images/player_position_icon3.png" alt="goalkeeper icon">
                            </div>
                        </div>
                        <div class="team_item">
                            <div class="team_item_images pictures_wrapper">
                                <img class="flag_icon" src="/uploads/images/flags/flag-armenia.jpg" alt="flag">
                                <div class="player_number">2</div>
                                <img src="/media/assets/images/player1.jpg" alt="player">
                            </div>
                            <div class="team_item_title">
                                <h3>Сурен Алоян</h3>
                            </div>
                            <div class="team_item_bottom">
                                <h4>Вратарь</h4>
                                <img src="/media/assets/images/player_position_icon3.png" alt="goalkeeper icon">
                            </div>
                        </div>
                        <div class="team_item">
                            <div class="team_item_images pictures_wrapper">
                                <img class="flag_icon" src="/uploads/images/flags/flag-armenia.jpg" alt="flag">
                                <div class="player_number">3</div>
                                <img src="/media/assets/images/player1.jpg" alt="player">
                            </div>
                            <div class="team_item_title">
                                <h3>Сурен Алоян</h3>
                            </div>
                            <div class="team_item_bottom">
                                <h4>Вратарь</h4>
                                <img src="/media/assets/images/player_position_icon3.png" alt="goalkeeper icon">
                            </div>
                        </div>
                        <div class="team_item">
                            <div class="team_item_images pictures_wrapper">
                                <img class="flag_icon" src="/uploads/images/flags/flag-armenia.jpg" alt="flag">
                                <div class="player_number">4</div>
                                <img src="/media/assets/images/player1.jpg" alt="player">
                            </div>
                            <div class="team_item_title">
                                <h3>Сурен Алоян</h3>
                            </div>
                            <div class="team_item_bottom">
                                <h4>Вратарь</h4>
                                <img src="/media/assets/images/player_position_icon3.png" alt="goalkeeper icon">
                            </div>
                        </div>
                    </div>-->
                </div>
            </div>
        </div>
    </div>
</div>