<div class="container">
    <div class="inner clearfix">
        <div class="container_wrapper clearfix">
            <div class="container_top clearfix">
                <div class="container_top_left">
                    <div class="container_top_header clearfix">

                        <div class="home-anons">
                            <? Theme::drawWidgetByType('Anons') ?>
                        </div>

                        <div class="container_top_aside">

                            <? //Theme::drawWidgetByType('TopVideo') ?>
                            <? //Theme::drawWidgetByType('TopNews') ?>

                        </div>
                    </div>

                    <? //Theme::drawWidgetByType('ContentPanoramaBanner') ?>

                </div>
                <div class="container_top_right">

                    <? Theme::drawWidgetByType('TournamentTable') ?>
                    <? Theme::drawWidgetByType('BestPlayer') ?>

                </div>
            </div>
            <div class="container_middle clearfix">
                <div class="leftbar clearfix">

                    <? Theme::drawWidgetByType('Snipers') ?>
                    <? Theme::drawWidgetByType('PhotoGallery') ?>
                    <? Theme::drawWidgetByType('Quizzes') ?>

                </div>
                <div class="content">
                    <div class="content_top clearfix">
                        <div class="content_top_left">
                            <div class="header">
                                <h1 class="col-title"><?= __('Last News') ?></h1>
                            </div>

                            <? //Theme::drawWidgetByType('RandomNews') ?>
                            <? //Theme::drawWidgetByType('ContentBanner') ?>
                            <? Theme::drawWidgetByType('MainNews') ?>

                        </div>
                        <div class="content_top_right">

                            <? Theme::drawWidgetByType('LastMatchesAnons') ?>

                            <div class="content_top_right_banners">

                                <? Theme::drawWidgetByType('RightBanner') ?>
                                <? Theme::drawWidgetByType('SecondaryRightBanner') ?>

                            </div>
                        </div>
                    </div>
                    <div class="content_middle clearfix">

                        <? Theme::drawWidgetByType('VideoGallery') ?>

                        <div class="content_middle_right clearfix">

                            <? Theme::drawWidgetByType('AcademyAnons') ?>

                        </div>
                    </div>
                </div>
            </div>
            <div class="container_bottom clearfix">

                <? Theme::drawWidgetByType('BottomBanner') ?>

            </div>
        </div>
    </div>
</div>