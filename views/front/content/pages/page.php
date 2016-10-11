<?php
/**
 * Created by PhpStorm.
 * User: Arsen
 * Date: 11/6/2015
 * Time: 3:20 PM
 */
?>
<div class="container ">
    <div class="inner clearfix">
        <div class="container_wrapper clearfix">
            <div class="leftbar">
                <div class="left_bar_menu">

                    <?Theme::drawSubMenu('subCategory')?>

                </div> <!---->

                <?if(!is_null(Theme::drawWidgets('right'))):?>
                    <?Theme::drawWidgets('left')?>
                <?endif?>

            </div>
            <div class="inner_content_wrapper">
                <div class="inner_content">

                </div>	<!--inner_content-->

                <div class="inner_content_buttom">
                    <div class="carousel_slider_wrapper_wrapper clearfix">
                        <div class="carousel_slider_wrapper clearfix">
                            <div class="carousel_slider">
                                <div class="carousel_slider_item">
                                    <a href="#">
                                        <div class="carousel_slider_images">
                                            <img src="/media/assets/images/carousel_slider_images1.jpg" alt="carousel_images" />
                                        </div><!-- carousel_slider_images -->
                                        <div class="carousel_slider_info">
                                            <span>Շատ համակարգչային տպագրական...</span>
                                        </div>
                                    </a>
                                </div><!-- carousel_slider_item -->
                                <div class="carousel_slider_item">
                                    <a href="#">
                                        <div class="carousel_slider_images">
                                            <img src="/media/assets/images/carousel_slider_images2.jpg" alt="carousel_images" />
                                        </div><!-- carousel_slider_images -->
                                        <div class="carousel_slider_info">
                                            <span>Ինտերնետային էջերի օգտագործում են...</span>
                                        </div>
                                    </a>
                                </div><!-- carousel_slider_item -->
                                <div class="carousel_slider_item">
                                    <a href="#">
                                        <div class="carousel_slider_images">
                                            <img src="/media/assets/images/carousel_slider_images3.jpg" alt="carousel_images" />
                                        </div><!-- carousel_slider_images -->
                                        <div class="carousel_slider_info">
                                            <span>Բաշխում է բառերը քիչ թե շատ իրականի </span>
                                        </div>
                                    </a>
                                </div><!-- carousel_slider_item -->
                                <div class="carousel_slider_item">
                                    <a href="#">
                                        <div class="carousel_slider_images">
                                            <img src="/media/assets/images/carousel_slider_images1.jpg" alt="carousel_images" />
                                        </div><!-- carousel_slider_images -->
                                        <div class="carousel_slider_info">
                                            <span>Շատ համակարգչային տպագրական...</span>
                                        </div>
                                    </a>
                                </div><!-- carousel_slider_item -->
                                <div class="carousel_slider_item">
                                    <a href="#">
                                        <div class="carousel_slider_images">
                                            <img src="/media/assets/images/carousel_slider_images2.jpg" alt="carousel_images" />
                                        </div><!-- carousel_slider_images -->
                                        <div class="carousel_slider_info">
                                            <span>Ինտերնետային էջերի օգտագործում են...</span>
                                        </div>
                                    </a>
                                </div><!-- carousel_slider_item -->
                                <div class="carousel_slider_item">
                                    <a href="#">
                                        <div class="carousel_slider_images">
                                            <img src="/media/assets/images/carousel_slider_images3.jpg" alt="carousel_images" />
                                        </div><!-- carousel_slider_images -->
                                        <div class="carousel_slider_info">
                                            <span>Բաշխում է բառերը քիչ թե շատ իրականի </span>
                                        </div>
                                    </a>
                                </div><!-- carousel_slider_item -->
                            </div><!-- carousel_slider -->
                            <span class="all_news_link"><a href="#">Դիտել բոլոր նորությունները</a></span>
                        </div><!-- carousel_slider_wrapper -->
                        <div class="slider_wrapper_adver content_top_banner">
                            <a href="#">
                                <img src="/media/assets/images/carousel_slider_item_adver.jpg">
                            </a>
                        </div>	<!--slider_wrapper_adver-->
                    </div> <!--carousel_slider_wrapper_wrapper-->
                    <div class="container_top_banner discount_banner">
                        <a href="#">
                            <img src="/media/assets/images/discount_bannerjpg.jpg">
                        </a>
                    </div>
                </div> <!--inner_content_buttom-->
            </div><!--inner_content_wrapper-->

            <?if(!is_null(Theme::drawWidgets('right'))):?>
                <div class="right_bar">
                    <div class="container_top_right">
                        <?Theme::drawWidgets('right')?>
                    </div><!-- container_top_right -->
                </div> <!--right_bar-->
            <?endif?>

        </div><!-- container_wrapper -->
    </div><!-- inner -->
</div><!-- container -->