<?php
/**
 * Created by Arsen.
 * User: Arsen
 * Date: 02.09.2015
 * Time: 15:41
 */

use Helpers\Uri;

?>

<?Theme::drawHead()?>

<body class="<?=Lang\Lang::instance()->getCurrentLang()['iso']?>">
<div class="header">
    <div class="header_top clearfix">
        <div class="inner">
            <div class="logo_wrapper">
                <a href="<?=Uri::makeUriFromId('/')?>">
                    <img src="/media/assets/images/logo.png" alt="logo" />
                    <div>
                        <h1><?=__('BANANTS')?></h1>
                        <h2><?=__('FOOTBALL CLUB')?></h2>
                    </div>
                </a>
            </div><!-- logo_wrapper -->
            <div class="header_navigation">

                <?//Theme::drawMenu('top')//todo:unused?>

            </div><!-- header_navigation -->
        </div><!-- inner -->
    </div><!-- header_top -->
    <div class="inner">
        <div class="header_right">
            <div class="header_bottom clearfix">
                <div class="banners clearfix">

                    <?//Theme::drawWidgetByType('LastMatch')?>
                    <?//Theme::drawWidgetByType('NextMatch')?>
                    <?//Theme::drawWidgetByType('NextMatchInfo')?>
                    <?Theme::drawWidgets('top')?>

                </div>

                <div class="language-select">
                    <select name="language" id="language">

                        <?foreach(Lang\Lang::instance()->getLangs() as $lang):?>
                            <option lang="<?=$lang['iso']?>" value="<?= Lang\Lang::instance()->isPrimary($lang['iso']) ? Router::getCurrentRoute()->getWhiteUri() : '/'.$lang['iso'] . Router::getCurrentRoute()->getWhiteUri()?>" <?=($lang['iso'] == Lang\Lang::instance()->getCurrentLang()['iso']) ? 'selected' : ''?>><?=$lang['name']?></option>
                        <?endforeach?>

                    </select>
<!--                        <a lang="fr" hreflang="fr" href="--><?//= Lang\Lang::instance()->isPrimary($lang['iso']) ? Router::getCurrentRoute()->getWhiteUri() : '/'.$lang['iso'] . Router::getCurrentRoute()->getWhiteUri()?><!--">--><?//=$lang['iso']?><!--</a>-->
                </div>

            </div><!-- header_bottom -->
        </div><!-- header_right -->

        <div class="navigation clearfix">

            <?Theme::drawMenu('category')?>

        </div><!-- navigation -->

        </div><!-- inner -->
    </div><!-- header -->


    <?= $content ?: ''?>


<div class="footer">

<!--    --><?//Theme::drawMenu('bottom')?>

<!--    <div class="inner clearfix">-->
<!--        <div class="footer_col">-->
<!--            <div class="footer_col_title">-->
<!--                <h3>Клуб</h3>-->
<!--            </div>-->
<!--            <ul>-->
<!--                <li><a href="#">История</a></li>-->
<!--                <li><a href="#">Достижения</a></li>-->
<!--                <li><a href="#">Президент</a></li>-->
<!--                <li><a href="#">Сотрудники</a></li>-->
<!--            </ul>-->
<!--        </div>-->
<!--        <div class="footer_col">-->
<!--            <div class="footer_col_title">-->
<!--                <h3>Новости</h3>-->
<!--            </div>-->
<!--            <ul>-->
<!--                <li><a href="#">РА чемпионат</a></li>-->
<!--                <li><a href="#">РА кубок</a></li>-->
<!--                <li><a href="#">Евролига</a></li>-->
<!--                <li><a href="#">Архив</a></li>-->
<!--            </ul>-->
<!--        </div>-->
<!--        <div class="footer_col">-->
<!--            <div class="footer_col_title">-->
<!--                <h3>Премьер-лига</h3>-->
<!--            </div>-->
<!--            <ul>-->
<!--                <li><a href="#">Игроки</a></li>-->
<!--                <li><a href="#">Тренеры</a></li>-->
<!--                <li><a href="#">График</a></li>-->
<!--                <li><a href="#">Результаты</a></li>-->
<!--            </ul>-->
<!--        </div>-->
<!--        <div class="footer_col">-->
<!--            <div class="footer_col_title">-->
<!--                <h3>Первая лига</h3>-->
<!--            </div>-->
<!--            <ul>-->
<!--                <li><a href="#">Игроки</a></li>-->
<!--                <li><a href="#">Тренеры</a></li>-->
<!--                <li><a href="#">График</a></li>-->
<!--                <li><a href="#">Результаты</a></li>-->
<!--            </ul>-->
<!--        </div>-->
<!--        <div class="footer_col">-->
<!--            <div class="footer_col_title">-->
<!--                <h3>РА кубок</h3>-->
<!--            </div>-->
<!--            <ul>-->
<!--                <li><a href="#">Кубок  2014/2015</a></li>-->
<!--                <li><a href="#">График</a></li>-->
<!--                <li><a href="#">Результаты</a></li>-->
<!--                <li><a href="#">Бананц''–кубок</a></li>-->
<!--                <li><a href="#">РА обладатели кубков</a></li>-->
<!---->
<!--            </ul>-->
<!--        </div>-->
<!--        <div class="footer_col">-->
<!--            <div class="footer_col_title">-->
<!--                <h3>юношеский футбол</h3>-->
<!--            </div>-->
<!--            <ul>-->
<!--                <li><a href="#">Чемпионат</a></li>-->
<!--                <li><a href="#">Достижения</a></li>-->
<!--                <li><a href="#">Поступление</a></li>-->
<!--                <li><a href="#">Тренеры</a></li>-->
<!--                <li><a href="#">Программы</a></li>-->
<!--            </ul>-->
<!--        </div>-->
<!--    </div>-->
</div><!-- footer -->
</body>
</html>
