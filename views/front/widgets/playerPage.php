<?php
/**
 * Created by PhpStorm.
 * User: Arsen
 * Date: 11/6/2015
 * Time: 3:20 PM
 *
 * @var $data \Football\Player
 * @var $title string
 */

use Ivliev\Imagefly\Imagefly;
use Carbon\Carbon;

?>

<div class="inner_content_wrapper">
    <div class="player-info">
        <div class="player-foto">
            <div class="player-bg">
                <div class="player-info-box">
                    <img src="<?= Imagefly::imagePath($data->getDefaultImage(), 'w140-q52') ?>" alt="player">

                </div>
            </div>
            <div class="player-info-footer">
                <p class="prof"><?= __($data->getPosition()->title()) ?></p>
                <img src="<?= $data->getPosition()->icon ?>" alt="player icon">
            </div>

        </div>
        <div class="info">

            <div class="number"><?=$data->getNumber()?></div>
            <h2>
                <?= __($data->getFirstName()) ?>
                <br />
                <?= __($data->getLastName()) ?>
            </h2>
            <div class="wr-p">
                <p><?= __('Position') ?>: <?= __($data->getPosition()->title()) ?></p>
                <p><?= __('Age') ?>: <?= $data->getAge() ?> <?= __('Years') ?></p>
                <p><?= __('Date of Birth') ?>: <?= $data->getWasBorn() ?></p>
                <p><?= __('Height') ?>: <?= $data->getHeight() ?> <?= __('cm') ?></p>
                <p><?= __('Weight') ?>: <?= $data->getWeight() ?> <?= __('kg') ?></p>
            </div>
        </div>
        <div class="clearfix"></div>
    </div>
    <div class="inner_content contener-white">

        <? if ($data->getArticle()): ?>
            <p class="fild-name"><?= __('Biography') ?></p>
            <p  class="wr-15px">

                <?= $data->getArticle()->desc ?>

            </p>
        <? endif ?>

<!--        <p class="fild-name">Последние сыгранные игры</p>-->
<!--        <div  class="static-table">-->
<!--            <table>-->
<!--                <tr>-->
<!--                    <th>Сезон</th>-->
<!--                    <th>Команда</th>-->
<!--                    <th>Турнир</th>-->
<!--                    <th>И</th>-->
<!--                    <th>Пр. г</th>-->
<!--                    <th>Пр</th>-->
<!--                    <th>Уд</th>-->
<!--                </tr>-->
<!--                <tr>-->
<!--                    <td>2015</td>-->
<!--                    <td>Бананц</td>-->
<!--                    <td>Больщая Лига</td>-->
<!--                    <td>1</td>-->
<!--                    <td>2</td>-->
<!--                    <td>-</td>-->
<!--                    <td>-</td>-->
<!--                </tr>-->
<!--                <tr>-->
<!--                    <td>2015</td>-->
<!--                    <td>Бананц</td>-->
<!--                    <td>Больщая Лига</td>-->
<!--                    <td>1</td>-->
<!--                    <td>2</td>-->
<!--                    <td>-</td>-->
<!--                    <td>-</td>-->
<!--                </tr>-->
<!--                <tr>-->
<!--                    <td>2015</td>-->
<!--                    <td>Бананц</td>-->
<!--                    <td>Больщая Лига</td>-->
<!--                    <td>1</td>-->
<!--                    <td>2</td>-->
<!--                    <td>-</td>-->
<!--                    <td>-</td>-->
<!--                </tr>-->
<!--                <tr>-->
<!--                    <td>2015</td>-->
<!--                    <td>Бананц</td>-->
<!--                    <td>Больщая Лига</td>-->
<!--                    <td>1</td>-->
<!--                    <td>2</td>-->
<!--                    <td>-</td>-->
<!--                    <td>-</td>-->
<!--                </tr>-->
<!--                <tr>-->
<!--                    <td>2015</td>-->
<!--                    <td>Бананц</td>-->
<!--                    <td>Больщая Лига</td>-->
<!--                    <td>1</td>-->
<!--                    <td>2</td>-->
<!--                    <td>-</td>-->
<!--                    <td>-</td>-->
<!--                </tr>-->
<!--                <tr>-->
<!--                    <td>2015</td>-->
<!--                    <td>Бананц</td>-->
<!--                    <td>Больщая Лига</td>-->
<!--                    <td>1</td>-->
<!--                    <td>2</td>-->
<!--                    <td>-</td>-->
<!--                    <td>-</td>-->
<!--                </tr>-->
<!--                <tr>-->
<!--                    <td>2015</td>-->
<!--                    <td>Бананц</td>-->
<!--                    <td>Больщая Лига</td>-->
<!--                    <td>1</td>-->
<!--                    <td>2</td>-->
<!--                    <td>-</td>-->
<!--                    <td>-</td>-->
<!--                </tr>-->
<!--                <tr>-->
<!--                    <td>2015</td>-->
<!--                    <td>Бананц</td>-->
<!--                    <td>Больщая Лига</td>-->
<!--                    <td>1</td>-->
<!--                    <td>2</td>-->
<!--                    <td>-</td>-->
<!--                    <td>-</td>-->
<!--                </tr>-->
<!--            </table>-->
<!--        </div>-->
<!--        <p class="fild-name">Статистика</p>-->
<!--        <div class="diagram">-->
<!--            <div>-->
<!--                <img src="images/statistica.png" alt="" />-->
<!--                <div>Голевые-->
<!--                    передачи</div>-->
<!--            </div>-->
<!--            <div>-->
<!--                <img src="images/statistica.png" alt="" />-->
<!--                <div>Голы-->
<!--                </div>-->
<!--            </div>-->
<!--            <div>-->
<!--                <img src="images/statistica.png" alt="" />-->
<!--                <div>Удары-->
<!--                </div>-->
<!--            </div>-->
<!--            <div>-->
<!--                <img src="images/statistica.png" alt="" />-->
<!--                <div>Голевые-->
<!--                    передачи</div>-->
<!---->
<!--            </div>-->
<!--            <div class="clearfix"></div>-->
<!--        </div>-->
<!---->
    </div>
<!--    <div class="videos">-->
<!--        <div class="wr-video">-->
<!--            <img alt="" src="images/video.jpg" />-->
<!--        </div>-->
<!--        <div class="wr-video">-->
<!--            <img alt="" src="images/video.jpg" />-->
<!--        </div>-->
<!--        <div class="wr-video">-->
<!--            <img alt="" src="images/video.jpg" />-->
<!--        </div>-->
<!--        <div class="wr-video">-->
<!--            <img alt="" src="images/video.jpg" />-->
<!--        </div>-->
<!--        <div class="wr-video">-->
<!--            <img alt="" src="images/video.jpg" />-->
<!--        </div>-->
<!--        <div class="wr-video">-->
<!--            <img alt="" src="images/video.jpg" />-->
<!--        </div>-->
<!--        <div class="clearfix"></div>-->
<!--        <div class="pagination">-->
<!--            <a class="pagination_next">&nbsp;</a>-->
<!--            <a class="pagination_prev">&nbsp;</a>-->
<!--            <ul>-->
<!--                <li class="pagination_active"><a href="#">1</a></li>-->
<!--                <li><a href="#">2</a></li>-->
<!--                <li><a href="#">3</a></li>-->
<!--                <li><a href="#">4</a></li>-->
<!--            </ul>-->
<!---->
<!---->
<!--        </div>-->
<!--        <div class="page-info">6 из 16</div>-->
<!--        <div class="clearfix"></div>-->
<!--    </div>-->
<!--    <div class="wr-news">-->
<!--        <div class="news_list clearfix">-->
<!---->
<!--            <div class="news_list_images">-->
<!--                <a href="#"> <img alt="news_list_images" src="images/news_list_images1.jpg"></a>-->
<!--            </div>-->
<!--            <div class="news_list_info">-->
<!--                <h3><a href="#">Амбардзум Карапетян получил красную карточку за оскорбление судьи!</a></h3>-->
<!--                <div class="news_list_middle">-->
<!--                    <span>17:46 Сегодня</span>-->
<!--                    <span class="news_list_watch">-->
<!--                                                <span><i class="watch_icon"></i> 1427</span>-->
<!--                                            </span>-->
<!--                </div>
<!--                <a href="#"><span>-->
<!--                                            Во время напрежённого развития событий в матче, Амбардзум Карапетян не выдержал и оскорбил судью Антонио Хорхе за не вено поставленный пенальти по мнению...-->
<!--                                        </span>-->
<!--                </a>-->
<!--            </div>-->
<!---->
<!--        </div>-->
<!--        <div class="news_list clearfix">-->
<!---->
<!--            <div class="news_list_images">-->
<!--                <a href="#"> <img alt="news_list_images" src="images/news_list_images1.jpg"></a>-->
<!--            </div>-->
<!--            <div class="news_list_info">-->
<!--                <h3><a href="#">Амбардзум Карапетян получил красную карточку за оскорбление судьи!</a></h3>-->
<!--                <div class="news_list_middle">-->
<!--                    <span>17:46 Сегодня</span>-->
<!--                    <span class="news_list_watch">-->
<!--                                                <span><i class="watch_icon"></i> 1427</span>-->
<!--                                            </span>-->
<!--                </div>
<!--                <a href="#"><span>-->
<!--                                            Во время напрежённого развития событий в матче, Амбардзум Карапетян не выдержал и оскорбил судью Антонио Хорхе за не вено поставленный пенальти по мнению...-->
<!--                                        </span>-->
<!--                </a>-->
<!--            </div>-->
<!---->
<!--        </div>-->
<!--        <div class="news_list clearfix">-->
<!---->
<!--            <div class="news_list_images">-->
<!--                <a href="#"> <img alt="news_list_images" src="images/news_list_images1.jpg"></a>-->
<!--            </div>-->
<!--            <div class="news_list_info">-->
<!--                <h3><a href="#">Амбардзум Карапетян получил красную карточку за оскорбление судьи!</a></h3>-->
<!--                <div class="news_list_middle">-->
<!--                    <span>17:46 Сегодня</span>-->
<!--                    <span class="news_list_watch">-->
<!--                                                <span><i class="watch_icon"></i> 1427</span>-->
<!--                                            </span>-->
<!--                </div>
<!--                <a href="#"><span>-->
<!--                                            Во время напрежённого развития событий в матче, Амбардзум Карапетян не выдержал и оскорбил судью Антонио Хорхе за не вено поставленный пенальти по мнению...-->
<!--                                        </span>-->
<!--                </a>-->
<!--            </div>-->
<!---->
<!--        </div>-->
<!--        <div class="news_list clearfix">-->
<!---->
<!--            <div class="news_list_images">-->
<!--                <a href="#"> <img alt="news_list_images" src="images/news_list_images1.jpg"></a>-->
<!--            </div>-->
<!--            <div class="news_list_info">-->
<!--                <h3><a href="#">Амбардзум Карапетян получил красную карточку за оскорбление судьи!</a></h3>-->
<!--                <div class="news_list_middle">-->
<!--                    <span>17:46 Сегодня</span>-->
<!--                    <span class="news_list_watch">-->
<!--                                                <span><i class="watch_icon"></i> 1427</span>-->
<!--                                            </span>-->
<!--                </div>
<!--                <a href="#"><span>-->
<!--                                            Во время напрежённого развития событий в матче, Амбардзум Карапетян не выдержал и оскорбил судью Антонио Хорхе за не вено поставленный пенальти по мнению...-->
<!--                                        </span>-->
<!--                </a>-->
<!--            </div>-->
<!---->
<!--        </div>-->
<!--        <div class="news_list clearfix">-->
<!---->
<!--            <div class="news_list_images">-->
<!--                <a href="#"> <img alt="news_list_images" src="images/news_list_images1.jpg"></a>-->
<!--            </div>-->
<!--            <div class="news_list_info">-->
<!--                <h3><a href="#">Амбардзум Карапетян получил красную карточку за оскорбление судьи!</a></h3>-->
<!--                <div class="news_list_middle">-->
<!--                    <span>17:46 Сегодня</span>-->
<!--                    <span class="news_list_watch">-->
<!--                                                <span><i class="watch_icon"></i> 1427</span>-->
<!--                                            </span>-->
<!--                </div>
<!--                <a href="#"><span>-->
<!--                                            Во время напрежённого развития событий в матче, Амбардзум Карапетян не выдержал и оскорбил судью Антонио Хорхе за не вено поставленный пенальти по мнению...-->
<!--                                        </span>-->
<!--                </a>-->
<!--            </div>-->
<!---->
<!--        </div>-->
<!--    </div>-->
</div>