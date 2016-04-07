<div class="container">
    <div class="inner clearfix">
        <div class="container_wrapper clearfix">
            <div class="container_top clearfix">
                <div class="container_top_left">
                    <div class="container_top_header clearfix">

                        <?Theme::drawWidgetByType('Anons')?>

                        <div class="container_top_aside">
<!--                            <div class="video_wrapper">-->
<!--                                <a class="various fancybox.iframe" href="http://www.youtube.com/embed/L9szn1QQfas?autoplay=1"><img src="http://img.youtube.com/vi/L9szn1QQfas/3.jpg" alt="video_image"></a>-->
<!--                                <span>Роман Асхабадзе вывел Бананц на первое место в лиге Армении </span>-->
<!--                            </div>-->

                            <?Theme::drawWidgetByType('TopVideo')?>
                            <?Theme::drawWidgetByType('TopNews')?>

                        </div><!-- container_top_aside -->
                    </div><!-- container_top_header -->

                    <?Theme::drawWidgetByType('ContentPanoramaBanner')?>

                </div><!-- container_top_left -->
                <div class="container_top_right">

                    <?Theme::drawWidgetByType('TournamentTable')?>
                    <?Theme::drawWidgetByType('BestPlayer')?>

                </div><!-- container_top_right -->
            </div><!-- container_top -->
            <div class="container_middle clearfix">
                <div class="leftbar clearfix">

                    <?Theme::drawWidgetByType('Snipers')?>
                    <?Theme::drawWidgetByType('PhotoGallery')?>
                    <?Theme::drawWidgetByType('Quizzes')?>

                </div><!-- leftbar -->
                <div class="content">
                    <div class="content_top clearfix">
                        <div class="content_top_left">

                            <?Theme::drawWidgetByType('RandomNews')?>
                            <?Theme::drawWidgetByType('ContentBanner')?>
                            <?Theme::drawWidgetByType('MainNews')?>

                        </div><!-- content_top_left -->
                        <div class="content_top_right">

                            <?Theme::drawWidgetByType('LastMatchesAnons')?>

                            <!-- content_top_right_info_blog_wrapper -->
                            <div class="content_top_right_banners">

                                <?Theme::drawWidgetByType('RightBanner')?>
                                <?Theme::drawWidgetByType('SecondaryRightBanner')?>

                            </div><!-- content_top_right_banners -->
                        </div><!-- content_top_right -->
                    </div><!-- content_top -->
                    <div class="content_middle clearfix">

                        <?Theme::drawWidgetByType('VideoGallery')?>

                        <div class="content_middle_right clearfix">

                            <?Theme::drawWidgetByType('AcademyAnons')?>

                        </div><!-- content_middle_right -->
                    </div><!-- content_middle -->
                </div><!-- content -->
            </div><!-- container_middle -->
            <div class="container_bottom clearfix">

                <?Theme::drawWidgetByType('BottomBanner')?>

            </div><!--container_bottom-->
        </div><!-- container_wrapper -->
    </div><!-- inner -->
</div>