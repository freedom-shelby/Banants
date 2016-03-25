<?php
/**
 * Created by Arsen.
 * User: Arsen
 * Date: 02.09.2015
 * Time: 15:41
 */
?>
<?//Theme::drawMenus('category')?>
<?Theme::drawHead()?>
<body>
    <div class="header">
        <div class="header_top clearfix">
            <div class="inner">
                <div class="logo_wrapper">
                    <a href="#">
                        <img src="/media/assets/images/logo.png" alt="logo" />
                    </a>
                </div><!-- logo_wrapper -->
                <div class="header_navigation">
                    <?Theme::drawMenus('top')?>

                    <!--                    <ul>-->
<!--                        <li><a class="icon"  href="#">ПРЕДЫДУЩИЕ МАТЧИ</a></li>-->
<!--                        <li><a class="statistic" href="#">СТАТИСТИКА КЛУБА</a></li>-->
<!--                        <li><a class="cal1" href="#">РАСПИСАНИЕ ИГР</a></li>-->
<!--                        <li><a class="prediction" href="#">ПРОГНОЗ НА СЕЗОН</a></li>-->
<!--                        <li><a class="video" href="#">ВИДЕО АРХИВ</a></li>-->
<!--                        <li><a class="photo" href="#">ФОТОГАЛЕРЕЯ</a></li>-->
<!--                        <li><a class="vacancies" href="#">ВАКАНСИИ</a></li>-->
<!--                    </ul>-->
                </div><!-- header_navigation -->
            </div><!-- inner -->
        </div><!-- header_top -->
        <div class="inner">
            <div class="header_right">
                <div class="header_bottom clearfix">
                    <div class="banners clearfix">
                        <div class="banner_team1">
                            <div class="team1_logo">
                                <img src="/media/assets/images/logo_team1.png" alt="logo_team1" />
                                <h4>ПЮНИК</h4>
                            </div>
                            <div class="banner_team1_text">
                                <p>
                                    <b>
                                        <span>2</span> <span>-</span>  <span>4</span>
                                    </b>
                                </p>
                                <p class="result"><b>1-2(0-3)</b></p>
                            </div>
                            <div class="main_logo">
                                <img src="/media/assets/images/logo_main.png" alt="logo_main" />
                            </div>
                        </div><!--banner_team1-->
                        <div class="banner_team2">
                            <div class="team1_logo">
                                <img src="/media/assets/images/logo_main.png" alt="logo_main" />
                            </div>
                            <div class="banner_team1_text">
                                <p><b>в 21</b></p>
                                <p><b>марта</b></p>
                                <p><b>16:30</b></p>
                            </div>
                            <div class="team2_logo">
                                <img src="/media/assets/images/team2_logo.png" alt="team2_logo" />
                                <h4>МИКА</h4>
                            </div>
                        </div><!--banner_team1-->
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
                <ul class="navigation_main" id="navigation_main" class="clearfix">
                    <li class="home"><a href="#"><img src="/media/assets/images/homeIcon.jpg" alt="homeIcon" /></a></li>
                    <li><a href="#">КЛУБ</a></li>
                    <li><a href="#">БАНАНЦ 1</a></li>
                    <li class="submenu_parent">
                        <a href="#">БАНАНЦ 2</a>
                        <ul class="submenu hidden">
                            <li>
                                <div class="submenu_top clearfix">
                                    <ul>
                                        <li><a href="#">НОВОСТИ</a></li>
                                        <li><a href="#">СОСТАВ</a></li>
                                        <li><a href="#">ТРЕНЕРСКИЙ ШТАБ</a></li>
                                    </ul>
                                    <ul>
                                        <li><a href="#">ТУРНИРНАЯ ТАБЛИЦА</a></li>
                                        <li><a href="#">РАСПИСАНИЕ ИГР</a></li>
                                        <li><a href="#">ФОТО ГАЛЕРЕЯ</a></li>
                                    </ul>
                                    <ul>
                                        <li><a href="#">ВИДЕО ГАЛЕРЕЯ</a></li>
                                    </ul>
                                </div><!-- submenu_top -->
                                <div class="submenu_bottom clearfix">
                                    <div class="submenu_bottom_col clearfix">
                                        <a href="#">
                                            <div class="submenu_bottom_col_images pictures_wrapper">
                                                <img src="/media/assets/images/submenu_pic1.jpg" alt="submenu_pic1">
                                            </div><!-- submenu_bottom_col_images -->
                                            <div class="submenu_bottom_col_info">
                                                <h3>НЕВЕРОЯТНЫЙ<br> СЕЙВ<br> ВРАТАРЯ</h3>
                                                <span>БАНАНЦ - ПЮНИК</span>
                                            </div><!-- images/menu_icon1.png_col_info -->
                                        </a>
                                    </div><!-- submenu_bottom_col -->
                                    <div class="submenu_bottom_col clearfix">
                                        <a href="#">
                                            <div class="submenu_bottom_col_images pictures_wrapper">
                                                <img src="/media/assets/images/submenu_pic1.jpg" alt="submenu_pic1">
                                            </div><!-- submenu_bottom_col_images -->
                                            <div class="submenu_bottom_col_info">
                                                <h3>НЕВЕРОЯТНЫЙ<br> СЕЙВ<br> ВРАТАРЯ</h3>
                                                <span>БАНАНЦ - ПЮНИК</span>
                                            </div><!-- images/menu_icon1.png_col_info -->
                                        </a>
                                    </div><!-- submenu_bottom_col -->
                                    <div class="submenu_bottom_col clearfix">
                                        <a href="#">
                                            <div class="submenu_bottom_col_images pictures_wrapper">
                                                <img src="/media/assets/images/submenu_pic1.jpg" alt="submenu_pic1">
                                            </div><!-- submenu_bottom_col_images -->
                                            <div class="submenu_bottom_col_info">
                                                <h3>НЕВЕРОЯТНЫЙ<br> СЕЙВ<br> ВРАТАРЯ</h3>
                                                <span>БАНАНЦ - ПЮНИК</span>
                                            </div><!-- images/menu_icon1.png_col_info -->
                                        </a>
                                    </div><!-- submenu_bottom_col -->
                                </div><!-- submenu_bottom -->
                            </li>
                        </ul>
                    </li>
                    <li class="submenu_parent"><a href="#">БАНАНЦ МОЛ.</a>
                        <ul class="submenu hidden">
                            <li>
                                <div class="submenu_top clearfix">
                                    <ul>
                                        <li><a href="#">НОВОСТИ</a></li>
                                        <li><a href="#">СОСТАВ</a></li>
                                        <li><a href="#">ТРЕНЕРСКИЙ ШТАБ</a></li>
                                    </ul>
                                    <ul>
                                        <li><a href="#">ТУРНИРНАЯ ТАБЛИЦА</a></li>
                                        <li><a href="#">РАСПИСАНИЕ ИГР</a></li>
                                        <li><a href="#">ФОТО ГАЛЕРЕЯ</a></li>
                                    </ul>
                                    <ul>
                                        <li><a href="#">ВИДЕО ГАЛЕРЕЯ</a></li>
                                    </ul>
                                </div><!-- submenu_top -->
                                <div class="submenu_bottom clearfix">
                                    <div class="submenu_bottom_col clearfix">
                                        <a href="#">
                                            <div class="submenu_bottom_col_images pictures_wrapper">
                                                <img src="/media/assets/images/submenu_pic1.jpg" alt="submenu_pic1">
                                            </div><!-- submenu_bottom_col_images -->
                                            <div class="submenu_bottom_col_info">
                                                <h3>НЕВЕРОЯТНЫЙ<br> СЕЙВ<br> ВРАТАРЯ</h3>
                                                <span>БАНАНЦ - ПЮНИК</span>
                                            </div><!-- images/menu_icon1.png_col_info -->
                                        </a>
                                    </div><!-- submenu_bottom_col -->
                                    <div class="submenu_bottom_col clearfix">
                                        <a href="#">
                                            <div class="submenu_bottom_col_images pictures_wrapper">
                                                <img src="/media/assets/images/submenu_pic1.jpg" alt="submenu_pic1">
                                            </div><!-- submenu_bottom_col_images -->
                                            <div class="submenu_bottom_col_info">
                                                <h3>НЕВЕРОЯТНЫЙ<br> СЕЙВ<br> ВРАТАРЯ</h3>
                                                <span>БАНАНЦ - ПЮНИК</span>
                                            </div><!-- images/menu_icon1.png_col_info -->
                                        </a>
                                    </div><!-- submenu_bottom_col -->
                                    <div class="submenu_bottom_col clearfix">
                                        <a href="#">
                                            <div class="submenu_bottom_col_images pictures_wrapper">
                                                <img src="/media/assets/images/submenu_pic1.jpg" alt="submenu_pic1">
                                            </div><!-- submenu_bottom_col_images -->
                                            <div class="submenu_bottom_col_info">
                                                <h3>НЕВЕРОЯТНЫЙ<br> СЕЙВ<br> ВРАТАРЯ</h3>
                                                <span>БАНАНЦ - ПЮНИК</span>
                                            </div><!-- images/menu_icon1.png_col_info -->
                                        </a>
                                    </div><!-- submenu_bottom_col -->
                                </div><!-- submenu_bottom -->
                            </li>
                        </ul>
                    </li>
                    <li><a href="#">АКАДЕМИЯ</a></li>
                    <li><a href="#">БОЛЕЛЬЩИКУ</a></li>
                </ul>
            </div><!-- navogation -->
        </div><!-- inner -->
    </div><!-- header -->

    <div class="leftbar clearfix">
<!--            --><?//Theme::drawWidgets('left')?>
    </div><!-- leftbar -->

    <?Theme::drawContent()?>

    <div class="right_bar">
        <div class="container_top_right">
<!--                --><?//Theme::drawWidgets('right')?>
        </div><!-- container_top_right -->
    </div> <!--right_bar-->

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
