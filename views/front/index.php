<?php
/**
 * Created by Arsen.
 * User: Arsen
 * Date: 02.09.2015
 * Time: 15:41
 */
?>
<!DOCTYPE html>
<html lang="<?=Langs::instance()->getCurrentLang()['iso']?>">
<head>
    <meta charset="UTF-8">
    <title>FC Banants</title>
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="">

    <link rel="stylesheet" href="/media/front/css/normalize.css" />
    <link rel="stylesheet" href="/media/front/css/owl.carousel.css" />
    <link rel="stylesheet" href="/media/front/css/style.css" />

    <script src="/media/front/js/jquery.js"></script>
    <script src="/media/front/js/owl.carousel.min.js"></script>
    <script src="/media/front/js/masonry.min.js"></script>
    <script src="/media/front/js/imagesloaded.js"></script>
    <script src="/media/front/js/custom/scripts.js"></script>
    <script src="/media/front/js/jquery.fancybox.pack.js"></script>
</head>
<body>
    <div class="header">
        <div class="header_top clearfix">
            <div class="inner">
                <div class="logo_wrapper">
                    <a href="#">
                        <img src="/media/front/images/logo.png" alt="logo" />
                    </a>
                </div><!-- logo_wrapper -->
                <div class="header_navigation">
                    <ul>
                        <li><a href="#"><img src="/media/front/images/menu_icon1.png" alt="menu_icon" /> ПРЕДЫДУЩИЕ МАТЧИ</a></li>
                        <li><a href="#"><img src="/media/front/images/menu_icon2.png" alt="menu_icon" /> СТАТИСТИКА КЛУБА</a></li>
                        <li><a href="#"><img src="/media/front/images/menu_icon3.png" alt="menu_icon" /> РАСПИСАНИЕ ИГР</a></li>
                        <li><a href="#"><img src="/media/front/images/menu_icon4.png" alt="menu_icon" /> ПРОГНОЗ НА СЕЗОН</a></li>
                        <li><a href="#"><img src="/media/front/images/menu_icon5.png" alt="menu_icon" /> ИДЕО АРХИВ</a></li>
                        <li class="header_navigation_active"><a href="#"><img src="/media/front/images/menu_icon6.png" alt="menu_icon" /> ФОТОГАЛЕРЕЯ</a></li>
                        <li><a href="#"><img src="/media/front/images/menu_icon7.png" alt="menu_icon" /> ВАКАНСИИ</a></li>
                    </ul>
                </div><!-- header_navigation -->
            </div><!-- inner -->
        </div><!-- header_top -->
        <div class="inner">
            <div class="header_right">
                <div class="header_bottom clearfix">
                    <div class="banners clearfix">
                        <div class="banner_pyunik">
                            <div class="pyunik_logo">
                                <img src="/media/front/images/logo_pyunik.png" alt="logo_pyunik" />
                                <h4>ПЮНИК</h4>
                            </div>
                            <div class="banner_pyunik_text">
                                <p><b>2 - 4</b></p>
                                <p class="result"><b>1-2(0-3)</b></p>
                            </div>
                            <div class="main_logo">
                                <img src="/media/front/images/logo_main.png" alt="logo_main" />
                            </div>
                        </div><!--banner_pyunik-->
                        <div class="banner_mika">
                            <div class="pyunik_logo">
                                <img src="/media/front/images/logo_main.png" alt="logo_main" />
                            </div>
                            <div class="banner_pyunik_text">
                                <p><b>в 21</b></p>
                                <p><b>марта</b></p>
                                <p><b>16:30</b></p>
                            </div>
                            <div class="mika_logo">
                                <img src="/media/front/images/mika_logo.png" alt="mika_logo" />
                                <h4>МИКА</h4>
                            </div>
                        </div><!--banner_pyunik-->
                    </div><!-- banners -->
                    <div class="header_info">
						<span>
							Игра пройдёт в г.Ереван на стадионе Бананца в четверг.<br> Трансляцию можно посмотреть на канале Армения в 19:40.
							<br> Призы, как и обычно будут для тех кто придёт на матч.
						</span>
                        <form action="#" method="post">
                            <input name="search" type="text" placeholder="ПОИСК ПО САЙТУ"/>
                            <input type="submit" />
                        </form>
                    </div><!-- header_info -->
                </div><!-- header_bottom -->
            </div><!-- header_right -->
            <div class="navigation clearfix">
                <ul class="navigation_maim" id="navigation_maim" class="clearfix">
                    <li class="home"><a href="#"><img src="/media/front/images/homeIcon.jpg" alt="homeIcon" /></a></li>
                    <li><a href="#">КЛУБ</a></li>
                    <li><a href="#">БАНАНЦ 1</a></li>
                    <li>
                        <a href="#">БАНАНЦ 2</a>
                        <ul id="submenu" class="submenu hidden clearfix">
                            <li>
                                <div class="submenu_top clearfix">
                                    <ul class="submenu_top_ul clearfix">
                                        <li><a href="#">НОВОСТИ</a></li>
                                        <li><a href="#">СОСТАВ</a></li>
                                        <li><a href="#">ТРЕНЕРСКИЙ ШТАБ</a></li>
                                    </ul>
                                    <ul>
                                        <li><a href="#">ТУРНИРНАЯ ТАБЛИЦА</a></li>
                                        <li><a href="#">РАСПИСАНИЕ ИГР</a></li>
                                        <li class="photoGallery_link">ФОТО ГАЛЕРЕЯ<a href="#"></a></li>
                                    </ul>
                                    <ul>
                                        <li><a href="#">ВИДЕО ГАЛЕРЕЯ</a></li>
                                    </ul>
                                </div><!-- submenu_top -->
                                <div><!--submenu_bottom-->


                                </div><!--submenu_bottom-->
                                <div class="submenu_bottom">
                                    <div class="submenu_bottom_col">
                                        <div class="submenu_bottom_col_images">
                                            <img src="" alt="">
                                        </div><!-- submenu_bottom_col_images -->
                                        <div class="submenu_bottom_col_info">
                                            <h3><a href="#"></a></h3>
                                            <span><a href="#"></a></span>
                                        </div><!-- submenu_bottom_col_info -->
                                    </div><!-- submenu_bottom_col -->
                                </div><!-- submenu_bottom -->
                            </li>
                        </ul>
                    </li>


                    <li><a href="#">БАНАНЦ МОЛ.</a></li>
                    <li><a href="#">АКАДЕМИЯ</a></li>
                    <li><a href="#">БОЛЕЛЬЩИКУ</a></li>
                </ul>
            </div><!-- navogation -->


        </div><!-- inner -->
    </div><!-- header -->

    <?if(!empty($content)):?>
        <?=$content?>
    <?endif?>

    <div class="footer">
        <div class="inner clearfix">
            <div class="footer_col">
                <div class="footer_col_title">
                    <h3>Клуб</h3>
                </div>
                <ul>
                    <li><a href="#">История</a></li>
                    <li><a href="#">Достижения</a></li>
                    <li><a href="#">Президент</a></li>
                    <li><a href="#">Сотрудники</a></li>
                </ul>
            </div>
            <div class="footer_col">
                <div class="footer_col_title">
                    <h3>Новости</h3>
                </div>
                <ul>
                    <li><a href="#">РА чемпионат</a></li>
                    <li><a href="#">РА кубок</a></li>
                    <li><a href="#">Евролига</a></li>
                    <li><a href="#">Архив</a></li>
                </ul>
            </div>
            <div class="footer_col">
                <div class="footer_col_title">
                    <h3>Премьер-лига</h3>
                </div>
                <ul>
                    <li><a href="#">Игроки</a></li>
                    <li><a href="#">Тренеры</a></li>
                    <li><a href="#">График</a></li>
                    <li><a href="#">Результаты</a></li>
                </ul>
            </div>
            <div class="footer_col">
                <div class="footer_col_title">
                    <h3>Первая лига</h3>
                </div>
                <ul>
                    <li><a href="#">Игроки</a></li>
                    <li><a href="#">Тренеры</a></li>
                    <li><a href="#">График</a></li>
                    <li><a href="#">Результаты</a></li>
                </ul>
            </div>
            <div class="footer_col">
                <div class="footer_col_title">
                    <h3>РА кубок</h3>
                </div>
                <ul>
                    <li><a href="#">Кубок  2014/2015</a></li>
                    <li><a href="#">График</a></li>
                    <li><a href="#">Результаты</a></li>
                    <li><a href="#">Бананц''–кубок</a></li>
                    <li><a href="#">РА обладатели кубков</a></li>

                </ul>
            </div>
            <div class="footer_col">
                <div class="footer_col_title">
                    <h3>юношеский футбол</h3>
                </div>
                <ul>
                    <li><a href="#">Чемпионат</a></li>
                    <li><a href="#">Достижения</a></li>
                    <li><a href="#">Поступление</a></li>
                    <li><a href="#">Тренеры</a></li>
                    <li><a href="#">Программы</a></li>
                </ul>
            </div>
        </div><!-- inner -->
    </div><!-- footer -->
</body>
</html>
