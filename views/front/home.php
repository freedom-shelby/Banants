<?php
/**
 * Created by Arsen.
 * User: Arsen
 * Date: 02.09.2015
 * Time: 15:41
 */
?>
<?Theme::drawHead()?>
<body>
<div class="header">
    <div class="header_top clearfix">
        <div class="inner">
            <div class="logo_wrapper">
                <a href="/">
                    <img src="/media/assets/images/logo.png" alt="logo" />
                </a>
            </div><!-- logo_wrapper -->
            <div class="header_navigation">

                    <?Theme::drawMenu('top')?>

            </div><!-- header_navigation -->
        </div><!-- inner -->
    </div><!-- header_top -->
    <div class="inner">
        <div class="header_right">
            <div class="header_bottom clearfix">
                <div class="banners clearfix">
                    <div class="banner_team1">
                        <div class="team1_logo">
                            <img src="/media/assets/images/logo_main.png" alt="logo_main" />
                        </div>
                        <div class="banner_team1_text">
                            <p>
                                <b>
                                    <span>2</span> <span>-</span>  <span>2</span>
                                </b>
                            </p>
                            <p class="result"><b>0-0(3-0)</b></p>
                        </div>
                        <div class="main_logo">
                            <img src="/media/assets/images/team_logo/fc-ararat-yerevan.png" alt="logo_team1" />
                            <h4>АРАРАТ</h4>
                        </div>
                    </div><!--banner_team1-->
                    <div class="banner_team2">
                        <div class="team1_logo">
                            <img src="/media/assets/images/team_logo/FC_Shirak_Logo.png" alt="team2_logo" />
                            <h4>ШИРАК</h4>
                        </div>
                        <div class="banner_team1_text">

                            <span>в 26 марта</span>
                            <span style="margin-top: 10px; display: block">15:00</span>

                        </div>
                        <div class="team2_logo">
                            <img src="/media/assets/images/logo_main.png" alt="logo_main" />
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

            <?Theme::drawMenu('category')?>

        </div><!-- navogation -->

        </div><!-- inner -->
    </div><!-- header -->


    <?= $content ?: ''?>


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
