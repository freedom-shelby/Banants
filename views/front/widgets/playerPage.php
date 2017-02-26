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
    <!--inner_content-->
    <div class="player-info">
        <div class="player-foto">
            <img src="<?= Imagefly::imagePath($data->getDefaultImage(), 'w140-q52') ?>" alt="player">
            <p class="prof"><?= __($data->getPosition()->title()) ?></p>
            <img src="<?= $data->getPosition()->icon ?>" alt="player icon">
        </div>
        <div class="info">

            <div class="number"><?=$data->getNumber()?></div>
            <h2>
                <?= __($data->getFirstName()) ?>
                <br />
                <?= __($data->getLastName()) ?>
            </h2>
            <div class="wr-p">
                <p>Амплуа: <?= __($data->getPosition()->title()) ?></p>
                <p>Возраст: <?= $data->getAge() ?> лет</p>
                <p>Дата рождения: <?= $data->getWasBorn() ?></p>
                <p>Рост: <?= $data->getHeight() ?> см</p>
                <p>Вес: <?= $data->getWeight() ?> кг</p>
            </div>
        </div>
        <div class="clearfix"></div>
    </div>
<!--    <div class="inner_content contener-white">-->
<!---->
<!--        <p class="fild-name">Биография</p>-->
<!--        <p  class="wr-15px">Давно выяснено, что при оценке дизайна и композиции читаемый текст мешает сосредоточиться.-->
<!--            Lorem Ipsum используют потому, что тот обеспечивает более или менее стандартное заполнение шаблона, а также реальное распределение букв и пробелов в абзацах,-->
<!--            которое не получается при простой дубликации "Здесь ваш текст.. Здесь ваш текст.. Здесь ваш текст.." Многие программы электронной вёрстки и редакторы HTML используют Lorem Ipsum в качестве текста по умолчанию.-->
<!--            <br /><br />-->
<!--            Kлючевым словам "lorem ipsum" сразу показывает, как много веб-страниц всё ещё дожидаются своего настоящего рождения. За прошедшие годы текст Lorem Ipsum получил много версий. Некоторые версии появились по ошибке, некоторые - намеренно (например, юмористические варианты).-->
<!--            Есть много вариантов Lorem Ipsum, но большинство из них имеет не всегда приемлемые модификации, например, юмористические вставки или слова, </p>-->
<!---->
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
<!--    </div>-->
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
<!--            </div><!-- news_list_images -->-->
<!--            <div class="news_list_info">-->
<!--                <h3><a href="#">Амбардзум Карапетян получил красную карточку за оскорбление судьи!</a></h3>-->
<!--                <div class="news_list_middle">-->
<!--                    <span>17:46 Сегодня</span>-->
<!--                    <span class="news_list_watch">-->
<!--                                                <span><i class="watch_icon"></i> 1427</span>-->
<!--                                            </span><!-- news_list_watch -->-->
<!--                </div><! news_list_middle -->-->
<!--                <a href="#"><span>-->
<!--                                            Во время напрежённого развития событий в матче, Амбардзум Карапетян не выдержал и оскорбил судью Антонио Хорхе за не вено поставленный пенальти по мнению...-->
<!--                                        </span>-->
<!--                </a>-->
<!--            </div><!-- news_list_info -->-->
<!---->
<!--        </div>-->
<!--        <div class="news_list clearfix">-->
<!---->
<!--            <div class="news_list_images">-->
<!--                <a href="#"> <img alt="news_list_images" src="images/news_list_images1.jpg"></a>-->
<!--            </div><!-- news_list_images -->-->
<!--            <div class="news_list_info">-->
<!--                <h3><a href="#">Амбардзум Карапетян получил красную карточку за оскорбление судьи!</a></h3>-->
<!--                <div class="news_list_middle">-->
<!--                    <span>17:46 Сегодня</span>-->
<!--                    <span class="news_list_watch">-->
<!--                                                <span><i class="watch_icon"></i> 1427</span>-->
<!--                                            </span><!-- news_list_watch -->-->
<!--                </div><! news_list_middle -->-->
<!--                <a href="#"><span>-->
<!--                                            Во время напрежённого развития событий в матче, Амбардзум Карапетян не выдержал и оскорбил судью Антонио Хорхе за не вено поставленный пенальти по мнению...-->
<!--                                        </span>-->
<!--                </a>-->
<!--            </div><!-- news_list_info -->-->
<!---->
<!--        </div>-->
<!--        <div class="news_list clearfix">-->
<!---->
<!--            <div class="news_list_images">-->
<!--                <a href="#"> <img alt="news_list_images" src="images/news_list_images1.jpg"></a>-->
<!--            </div><!-- news_list_images -->-->
<!--            <div class="news_list_info">-->
<!--                <h3><a href="#">Амбардзум Карапетян получил красную карточку за оскорбление судьи!</a></h3>-->
<!--                <div class="news_list_middle">-->
<!--                    <span>17:46 Сегодня</span>-->
<!--                    <span class="news_list_watch">-->
<!--                                                <span><i class="watch_icon"></i> 1427</span>-->
<!--                                            </span><!-- news_list_watch -->-->
<!--                </div><! news_list_middle -->-->
<!--                <a href="#"><span>-->
<!--                                            Во время напрежённого развития событий в матче, Амбардзум Карапетян не выдержал и оскорбил судью Антонио Хорхе за не вено поставленный пенальти по мнению...-->
<!--                                        </span>-->
<!--                </a>-->
<!--            </div><!-- news_list_info -->-->
<!---->
<!--        </div>-->
<!--        <div class="news_list clearfix">-->
<!---->
<!--            <div class="news_list_images">-->
<!--                <a href="#"> <img alt="news_list_images" src="images/news_list_images1.jpg"></a>-->
<!--            </div><!-- news_list_images -->-->
<!--            <div class="news_list_info">-->
<!--                <h3><a href="#">Амбардзум Карапетян получил красную карточку за оскорбление судьи!</a></h3>-->
<!--                <div class="news_list_middle">-->
<!--                    <span>17:46 Сегодня</span>-->
<!--                    <span class="news_list_watch">-->
<!--                                                <span><i class="watch_icon"></i> 1427</span>-->
<!--                                            </span><!-- news_list_watch -->-->
<!--                </div><! news_list_middle -->-->
<!--                <a href="#"><span>-->
<!--                                            Во время напрежённого развития событий в матче, Амбардзум Карапетян не выдержал и оскорбил судью Антонио Хорхе за не вено поставленный пенальти по мнению...-->
<!--                                        </span>-->
<!--                </a>-->
<!--            </div><!-- news_list_info -->-->
<!---->
<!--        </div>-->
<!--        <div class="news_list clearfix">-->
<!---->
<!--            <div class="news_list_images">-->
<!--                <a href="#"> <img alt="news_list_images" src="images/news_list_images1.jpg"></a>-->
<!--            </div><!-- news_list_images -->-->
<!--            <div class="news_list_info">-->
<!--                <h3><a href="#">Амбардзум Карапетян получил красную карточку за оскорбление судьи!</a></h3>-->
<!--                <div class="news_list_middle">-->
<!--                    <span>17:46 Сегодня</span>-->
<!--                    <span class="news_list_watch">-->
<!--                                                <span><i class="watch_icon"></i> 1427</span>-->
<!--                                            </span><!-- news_list_watch -->-->
<!--                </div><! news_list_middle -->-->
<!--                <a href="#"><span>-->
<!--                                            Во время напрежённого развития событий в матче, Амбардзум Карапетян не выдержал и оскорбил судью Антонио Хорхе за не вено поставленный пенальти по мнению...-->
<!--                                        </span>-->
<!--                </a>-->
<!--            </div><!-- news_list_info -->-->
<!---->
<!--        </div>-->
<!--    </div>-->
</div>