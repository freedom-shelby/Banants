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

<div class="inner_content_wrapper coaches">
    <div class="inner_content team_members_1">
        <div class="team_wrapper coaches clearfix">
            <div class="team_wrapper_body clearfix">
                <div id="item_tabs">
                    <div id="item_tabs_list1">
<!--                        <div class="team_item">-->
<!--                            <div class="team_item_header">-->
<!--                                <div class="team_item_header_top"></div>-->
<!--                                <div class="team_item_header_bottom"></div>-->
<!--                            </div>-->
<!--                            <div class="team_item_images pictures_wrapper">-->
<!--                                <img class="flag_icon" src="/uploads/images/flags/flag-armenia.jpg" alt="flag" />-->
<!--                                <div class="manager_wrapper">-->
<!--                                    <img src="--><?//=Imagefly::imagePath('/uploads/images/Coaches/premier/Aram_Voskanyan.png', 'w140-q52')?><!--" alt="player" />-->
<!--                                </div>-->
<!--                            </div>-->
<!--                            <div class="team_item_title">-->
<!--                                <h3>--><?//=__('Aram')?><!-- --><?//=__('Voskanyan')?><!--</h3>-->
<!--                            </div>-->
<!--                            <div class="team_item_bottom">-->
<!--                                <div class="team_item_footer_top"></div>-->
<!--                                <div class="team_item_footer_bottom"></div>-->
<!--                                <div class="team_item_footer_desc">-->
<!--                                    <h4>--><?//=__('Head coach')?><!--</h4>-->
<!--                                </div>-->
<!--                            </div>-->
<!--                        </div>-->
                        <div class="team_item">
                            <div class="team_item_images pictures_wrapper">
                                <img class="flag_icon" src="/uploads/images/flags/flag-armenia.jpg" alt="flag" />
                                <div class="manager_wrapper">
                                    <img src="<?=Imagefly::imagePath('/uploads/images/Coaches/premier/Aram_Voskanyan.png', 'w140-q52')?>" alt="player" />
                                </div>
                            </div>
                            <div class="team_item_title">
                                <h3><?=__('Aram')?> <?=__('Voskanyan')?></h3>
                            </div>
                            <div class="team_item_bottom">
                                <h4><?=__('Head Coach')?></h4>
                            </div>
                        </div>
                        <div class="team_item">
                            <div class="team_item_images pictures_wrapper">
                                <img class="flag_icon" src="/uploads/images/flags/flag-armenia.jpg" alt="flag" />
                                <div class="manager_wrapper">
                                    <img src="<?=Imagefly::imagePath('/uploads/images/Coaches/march_17/Ara_Nigoyan.png', 'w140-q52')?>" alt="player" />
                                </div>
                            </div>
                            <div class="team_item_title">
                                <h3><?=__('Ara')?> <?=__('Nigoyan')?></h3>
                            </div>
                            <div class="team_item_bottom">
                                <h4><?=__('Coach')?></h4>
                            </div>
                        </div>
                        <div class="team_item">
                            <div class="team_item_images pictures_wrapper">
                                <img class="flag_icon" src="/uploads/images/flags/flag-armenia.jpg" alt="flag" />
                                <div class="manager_wrapper">
                                    <img src="<?=Imagefly::imagePath('/uploads/images/Coaches/march_17/Aram_Hakobyan.png', 'w140-q52')?>" alt="player" />
                                </div>
                            </div>
                            <div class="team_item_title">
                                <h3><?=__('Aram')?> <?=__('Hakobyan')?></h3>
                            </div>
                            <div class="team_item_bottom">
                                <h4><?=__('Coach')?></h4>
                            </div>
                        </div>
                        <div class="team_item">
                            <div class="team_item_images pictures_wrapper">
                                <img class="flag_icon" src="/uploads/images/flags/flag-armenia.jpg" alt="flag" />
                                <div class="manager_wrapper">
                                    <img src="<?=Imagefly::imagePath('/uploads/images/Coaches/march_17/Manuk_Sargsyan.png', 'w140-q52')?>" alt="player" />
                                </div>
                            </div>
                            <div class="team_item_title">
                                <h3><?=__('Manuk')?> <?=__('Sargsyan')?></h3>
                            </div>
                            <div class="team_item_bottom">
                                <h4><?=__('Coach analyst')?></h4>
                            </div>
                        </div>
                        <div class="team_item">
                            <div class="team_item_images pictures_wrapper">
                                <img class="flag_icon" src="/uploads/images/flags/flag-armenia.jpg" alt="flag" />
                                <div class="manager_wrapper">
                                    <img src="<?=Imagefly::imagePath('/uploads/images/Coaches/march_17/tigran_aslanyan.png', 'w140-q52')?>" alt="player" />
                                </div>
                            </div>
                            <div class="team_item_title">
                                <h3><?=__('Tigran')?> <?=__('Aslanyan')?></h3>
                            </div>
                            <div class="team_item_bottom">
                                <h4><?=__('Coach')?></h4>
                            </div>
                        </div>
<!--                        <div class="team_item">-->
<!--                            <div class="team_item_images pictures_wrapper">-->
<!--                                <img class="flag_icon" src="/uploads/images/flags/flag-armenia.jpg" alt="flag" />-->
<!--                                <div class="manager_wrapper">-->
<!--                                    <img src="--><?//=Imagefly::imagePath('/uploads/images/Coaches/banants_2/Vahe_Gevorgyan.png', 'w140-q52')?><!--" alt="player" />-->
<!--                                </div>-->
<!--                            </div>-->
<!--                            <div class="team_item_title">-->
<!--                                <h3>--><?//=__('Vahe')?><!-- --><?//=__('Gevorgyan')?><!--</h3>-->
<!--                            </div>-->
<!--                            <div class="team_item_bottom">-->
<!--                                <h4>--><?//=__('Coach')?><!--</h4>-->
<!--                            </div>-->
<!--                        </div>-->
<!--                        <div class="team_item">-->
<!--                            <div class="team_item_images pictures_wrapper">-->
<!--                                <img class="flag_icon" src="/uploads/images/flags/flag-armenia.jpg" alt="flag" />-->
<!--                                <div class="manager_wrapper">-->
<!--                                    <img src="--><?//=Imagefly::imagePath('/uploads/images/Coaches/banants_2/Artur_Hovhannisyan.png', 'w140-q52')?><!--" alt="player" />-->
<!--                                </div>-->
<!--                            </div>-->
<!--                            <div class="team_item_title">-->
<!--                                <h3>--><?//=__('Artur')?><!-- --><?//=__('Hovhannisyan')?><!--</h3>-->
<!--                            </div>-->
<!--                            <div class="team_item_bottom">-->
<!--                                <h4>--><?//=__('Physical trainer')?><!--</h4>-->
<!--                            </div>-->
<!--                        </div>-->
<!--                        <div class="team_item">-->
<!--                            <div class="team_item_images pictures_wrapper">-->
<!--                                <img class="flag_icon" src="/uploads/images/flags/flag-armenia.jpg" alt="flag" />-->
<!--                                <div class="manager_wrapper">-->
<!--                                    <img src="--><?//=Imagefly::imagePath('/uploads/images/Coaches/banants_2/Vladimir_Vardanyan.png', 'w140-q52')?><!--" alt="player" />-->
<!--                                </div>-->
<!--                            </div>-->
<!--                            <div class="team_item_title">-->
<!--                                <h3>--><?//=__('Vladimir')?><!-- --><?//=__('Vardanyan')?><!--</h3>-->
<!--                            </div>-->
<!--                            <div class="team_item_bottom">-->
<!--                                <h4>--><?//=__('Goalkeeper coach')?><!--</h4>-->
<!--                            </div>-->
<!--                        </div>-->
                        <div class="team_item">
                            <div class="team_item_images pictures_wrapper">
                                <img class="flag_icon" src="/uploads/images/flags/flag-armenia.jpg" alt="flag" />
                                <div class="manager_wrapper">
                                    <img src="<?=Imagefly::imagePath('/uploads/images/Coaches/premier/Karen_Stepanyan.png', 'w140-q52')?>" alt="player" />
                                </div>
                            </div>
                            <div class="team_item_title">
                                <h3><?=__('Karen')?> <?=__('Stepanyan')?></h3>
                            </div>
                            <div class="team_item_bottom">
                                <h4><?=__('Doctor')?></h4>
                            </div>
                        </div>
                        <div class="team_item">
                            <div class="team_item_images pictures_wrapper">
                                <img class="flag_icon" src="/uploads/images/flags/flag-armenia.jpg" alt="flag" />
                                <div class="manager_wrapper">
                                    <img src="<?=Imagefly::imagePath('/uploads/images/Coaches/premier/Eduard_Gevorgyan.png', 'w140-q52')?>" alt="player" />
                                </div>
                            </div>
                            <div class="team_item_title">
                                <h3><?=__('Eduard')?> <?=__('Gevorgyan')?></h3>
                            </div>
                            <div class="team_item_bottom">
                                <h4><?=__('Massage therapist')?></h4>
                            </div>
                        </div>
                        <div class="team_item">
                            <div class="team_item_images pictures_wrapper">
                                <img class="flag_icon" src="/uploads/images/flags/flag-armenia.jpg" alt="flag" />
                                <div class="manager_wrapper">
                                    <img src="<?=Imagefly::imagePath('/uploads/images/Coaches/premier/Arman_Exikyan.png', 'w140-q52')?>" alt="player" />
                                </div>
                            </div>
                            <div class="team_item_title">
                                <h3><?=__('Arman')?> <?=__('Exikyan')?></h3>
                            </div>
                            <div class="team_item_bottom">
                                <h4><?=__('Massage therapist')?></h4>
                            </div>
                        </div>
                        <div class="team_item">
                            <div class="team_item_images pictures_wrapper">
                                <img class="flag_icon" src="/uploads/images/flags/flag-armenia.jpg" alt="flag" />
                                <div class="manager_wrapper">
                                    <img src="<?=Imagefly::imagePath('/uploads/images/Coaches/premier/Davit_Shaxbagyan.png', 'w140-q52')?>" alt="player" />
                                </div>
                            </div>
                            <div class="team_item_title">
                                <h3><?=__('Davit')?> <?=__('Shaxbagyan')?></h3>
                            </div>
                            <div class="team_item_bottom">
                                <h4><?=__('Team chief')?></h4>
                            </div>
                        </div>
                        <div class="team_item">
                            <div class="team_item_images pictures_wrapper">
                                <img class="flag_icon" src="/uploads/images/flags/flag-armenia.jpg" alt="flag" />
                                <div class="manager_wrapper">
                                    <img src="<?=Imagefly::imagePath('/uploads/images/Coaches/premier/Harutyun_Jangchyan.png', 'w140-q52')?>" alt="player" />
                                </div>
                            </div>
                            <div class="team_item_title">
                                <h3><?=__('Harutyun')?> <?=__('Jangchyan')?></h3>
                            </div>
                            <div class="team_item_bottom">
                                <h4><?=__('Administrator')?></h4>
                            </div>
                        </div>
<!--                        <div class="team_item">-->
<!--                            <div class="team_item_images pictures_wrapper">-->
<!--                                <img class="flag_icon" src="/uploads/images/flags/flag-armenia.jpg" alt="flag" />-->
<!--                                <div class="manager_wrapper">-->
<!--                                    <img src="<?=Imagefly::imagePath('/uploads/images/Coaches/premier/Harutyun_Jangchyan.png', 'w140-q52')?>" alt="player" />-->
<!--                                </div>-->
<!--                            </div>-->
<!--                            <div class="team_item_title">-->
<!--                                <h3>--><?//=('Harutyun')?><!-- --><?//=__('Jangchyan')?><!--</h3>-->
<!--                            </div>-->
<!--                            <div class="team_item_bottom">-->
<!--                                <h4>--><?//=__('')?><!--</h4>-->
<!--                            </div>-->
<!--                        </div>-->
                    </div><!--item_tabs_list1-->
                </div><!--item_tabs-->
            </div>
        </div>
    </div>	<!--inner_content-->
</div>