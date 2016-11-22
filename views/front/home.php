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
            </div>
            <div class="header_navigation">

                <?//Theme::drawMenu('top')//todo:unused?>

            </div>
        </div>
    </div>
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

            </div>
        </div>

        <div class="navigation clearfix">

            <?Theme::drawMenu('category')?>

        </div>

        </div>
    </div>


    <?= $content ?: ''?>


<div class="footer">

    <?//Theme::drawMenu('bottom')?>

</div>
</body>
</html>
