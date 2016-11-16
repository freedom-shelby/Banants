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

                    <?Theme::drawWidgets('top')?>

                </div><!-- banners -->

                <div class="language-select">
                    <select name="language" id="language">

                        <?foreach(Lang\Lang::instance()->getLangs() as $lang):?>
                            <option lang="<?=$lang['iso']?>" value="<?= Lang\Lang::instance()->isPrimary($lang['iso']) ? Router::getCurrentRoute()->getWhiteUri() : '/'.$lang['iso'] . Router::getCurrentRoute()->getWhiteUri()?>" <?=($lang['iso'] == Lang\Lang::instance()->getCurrentLang()['iso']) ? 'selected' : ''?>><?=$lang['name']?></option>
                        <?endforeach?>

                    </select>
                </div>

            </div><!-- header_bottom -->
        </div><!-- header_right -->

        <div class="navigation clearfix">

            <?Theme::drawMenu('category')?>

        </div><!-- navigation -->

        </div><!-- inner -->
    </div><!-- header -->


    <div class="container">
        <div class="inner clearfix">
            <div class="container_wrapper clearfix">
                <div class="leftbar clearfix">

                    <?Theme::drawSubMenu('subCategory')?>
                    <?Theme::drawWidgets('left')?>

                </div><!-- leftbar -->
                <div id="content">

                    <?Theme::drawContent()?>
                    <?Theme::drawWidgets('content')?>

                </div>
                <div class="right_bar">
                    <div class="container_top_right">

                        <?Theme::drawWidgets('right')?>

                    </div><!-- container_top_right -->
                </div> <!--right_bar-->

                <div class="container_bottom clearfix">

                    <?Theme::drawWidgets('bottom')?>

                </div>
            </div><!-- container_wrapper -->
        </div><!-- inner -->
    </div><!-- container -->

    <script>
        (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
                (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
            m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
        })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

        ga('create', 'UA-86502245-1', 'auto');
        ga('send', 'pageview');
    </script>
</body>
</html>
