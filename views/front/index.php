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
                        <li><a href="#"><img src="/media/front/images/menu_icon1.png" alt="menu_icon" /> Նախորդ Խաղեր</a></li>
                        <li><a href="#"><img src="/media/front/images/menu_icon2.png" alt="menu_icon" /> Ակումբի Վիճակագրություն</a></li>
                        <li><a href="#"><img src="/media/front/images/menu_icon3.png" alt="menu_icon" /> Խաղերի Ժամանակացույց</a></li>
                        <li><a href="#"><img src="/media/front/images/menu_icon4.png" alt="menu_icon" /> Կանխատեսում սեզոնի համար</a></li>
                        <li><a href="#"><img src="/media/front/images/menu_icon5.png" alt="menu_icon" /> Վիդեո Արխիվ</a></li>
                        <li class="header_navigation_active"><a href="#"><img src="/media/front/images/menu_icon6.png" alt="menu_icon" /> ՖՈՏՈԳալերիա</a></li>
                        <li><a href="#"><img src="/media/front/images/menu_icon7.png" alt="menu_icon" /> Աշխատատեղեր</a></li>
                    </ul>
                </div><!-- header_navigation -->
            </div><!-- inner -->
        </div><!-- header_top -->
        <div class="inner">
            <div class="header_right">
                <div class="header_bottom clearfix">
                    <div class="banners clearfix">
                        <div class="banner">
                            <a href="#">
                                <img src="/media/front/images/banner_top1.png" alt="banner_top" />
                            </a>
                        </div><!-- banner -->
                        <div class="banner">
                            <a href="#">
                                <img src="/media/front/images/banner_top2.png" alt="banner_top" />
                            </a>
                        </div><!-- banner -->
                    </div><!-- banners -->
                    <div class="header_info">
                            <span>
                                Խաղը տեղի կունենա հինգշաբթի. Երեւանում Բանանցի մարզադաշտում:<br> հեռարձակումը կարող
                                եք դիտել Արեմենիա հեռուստալիքով ժամը՝ 19:40:<br> Մրցանակներ կլինեն բոլոր ակտիվ մասնակիցների համար:
                            </span>
                        <form action="#" method="post">
                            <input name="search" type="text" placeholder="Փնտրել" />
                            <input type="submit" />
                        </form>
                    </div><!-- header_info -->
                </div><!-- header_bottom -->
            </div><!-- header_right -->
        </div><!-- inner -->
    </div><!-- header -->

    <?if(!empty($content)):?>
        <?=$content?>
    <?endif?>

    <div class="footer">
        <div class="inner clearfix">
            <div class="footer_col">
                <h3>Ակումբ</h3>
                <ul>
                    <a href="#"><li>Պատմություն</li></a>
                    <a href="#"><li>Ձեռքբերումներ</li></a>
                    <a href="#"><li>Նախագահ</li></a>
                    <a href="#"><li>Աշխատակիցներ</li></a>
                </ul>
            </div>
            <div class="footer_col">
                <h3>Նորություններ</h3>
                <ul>
                    <a href="#"><li>Հայաստանի առաջ.</li></a>
                    <a href="#"><li>ՀԱ գավաթ</li></a>
                    <a href="#"><li>Եվրոլիգա</li></a>
                    <a href="#"><li>Արխիվ</li></a>
                </ul>
            </div>
            <div class="footer_col">
                <h3>Բարձրագույն առաջ.</h3>
                <ul>
                    <a href="#"><li>Խաղացողներ</li></a>
                    <a href="#"><li>Մարզիչներ</li></a>
                    <a href="#"><li>Գրաֆիկ</li></a>
                    <a href="#"><li>Արդյունքներ</li></a>
                </ul>
            </div>
            <div class="footer_col">
                <h3>Առաջին Խումբ</h3>
                <ul>
                    <a href="#"><li>Խաղացողներ</li></a>
                    <a href="#"><li>Մարզիչներ</li></a>
                    <a href="#"><li>Գրաֆիկ</li></a>
                    <a href="#"><li>Արդյունքներ</li></a>
                </ul>
            </div>
            <div class="footer_col">
                <h3>ՀԱ Գավաթ</h3>
                <ul>
                    <a href="#"><li>Գավաթ 2014/2015</li></a>
                    <a href="#"><li>Գրաֆիկ</li></a>
                    <a href="#"><li>Բանանց -Գավաթ</li></a>
                    <a href="#"><li>ՀԱ Գավաթի հաղթողներ</li></a>
                </ul>
            </div>
            <div class="footer_col">
                <h3>Պատանեկան Ֆուտբոլ</h3>
                <ul>
                    <a href="#"><li>Առաջնություն</li></a>
                    <a href="#"><li>Ձեռքբերումներ</li></a>
                    <a href="#"><li>Մարզիչներ</li></a>
                    <a href="#"><li>Ծրագրեր</li></a>
                </ul>
            </div>
        </div><!-- inner -->
    </div><!-- footer -->
</body>
</html>
