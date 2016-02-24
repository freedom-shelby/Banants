<?php
/**
 * Created by Rob.
 * User: Rob
 * Date: 02.09.2015
 * Time: 15:41
 */
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="media/favicon.ico">

    <title>Topup</title>

    <!-- Bootstrap core CSS -->
    <link href="media/libs/bootstrap-3.3.5/css/bootstrap.css" rel="stylesheet">

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

    <!-- Custom styles for this template -->
    <link href="media/css/common-styles.css" rel="stylesheet">
    <link rel="stylesheet" href="media/fonts/micons/styles.css">

    <link href="media/css/media-queries.css" rel="stylesheet">

</head>
<body>
<div class="header">
    <div class="container">

        <div class="navbar-header pull-right"><!-- for mobile staff-->
            <div  class="navbar-toggle collapsed ">
                <div class="row">
                    <div class="col-xs-12 no-padding">
                        <ul class="pull-right mobile-login open-button">
                            <li>
                                <button type="button" class="navbar-collapse-open navbar-toggle collapsed blue" data-toggle="collapse" data-target="#navbar" aria-controls="navbar">
                                    <span class="sr-only">Toggle navigation</span>
                                    <span class="icon-bar"></span>
                                    <span class="icon-bar"></span>
                                    <span class="icon-bar"></span>
                                </button>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div><!-- /for mobile staff-->

        <div class="header-logo pull-left">
            <img src="media/images/logo.png" alt="Topup Logo" border="0" />
        </div><!-- /Header Logo block-->

        <div class="navbar-collapse-nav pull-right">
            <div class="overflow_full_bg">
                <div class="mobile-container">
                    <button type="button" class="navbar-collapse-close">
                        close button for mobile, don't remove
                    </button>
                    <div class="row top-menu">
                        <ul class="nav navbar-nav pull-right dropdown">
                            <li <?if(\Router::getCurrentRoute()->getName() == 'front.home'):?>class="active"<?endif?>><a href="<?=\Helpers\Uri::makeRouteUri('front.home')?>">Home</a></li>
                            <li <?if(\Router::getCurrentRoute()->getName() == 'front.about'):?>class="active"<?endif?>><a href="<?=\Helpers\Uri::makeRouteUri('front.about')?>"> About</a></li>
                            <li <?if(\Router::getCurrentRoute()->getName() == 'front.howToTopUp'):?>class="active"<?endif?>><a href="<?=\Helpers\Uri::makeRouteUri('front.howToTopUp')?>">How to topup</a></li>
                            <li <?if(\Router::getCurrentRoute()->getName() == 'front.news'):?>class="active"<?endif?>><a href="<?=\Helpers\Uri::makeRouteUri('front.news')?>">News & Promotions</a></li>
                            <li <?if(\Router::getCurrentRoute()->getName() == 'front.faq'):?>class="active"<?endif?>><a href="<?=\Helpers\Uri::makeRouteUri('front.faq')?>">Help/FAQ</a></li>
                        </ul>
                    </div><!-- /.top-menu -->
                </div><!-- /.mobile-container -->
            </div><!-- /.overflow_full_bg -->
        </div><!-- /.navbar-collapse collapse -->
    </div><!-- /.container -->
</div><!-- /.header -->

<?//=$content?: ''?>

    <div class="topup-now-block">
        <div class="container">
            <div class="row">
                <div class="col-xs-4 text-center">
                    <span class="icon micon-instant"></span>
                    <span class="txt">Instant</span>
                </div>
                <div class="col-xs-4 text-center">
                    <span class="icon micon-international"></span>
                    <span class="txt">International</span>
                </div>
                <div class="col-xs-4 text-center">
                    <span class="icon micon-secure"></span>
                    <span class="txt">Secure</span>
                </div>
            </div>
            <?if(\Router::getCurrentRoute()->getName() == 'front.home'):?>
            <div class="row">
                <div class="col-xs-4 col-xs-offset-4 text-center">
                    <button class="btn btn-transparent scrollToTopUp">topup now!</button>
                </div>
            </div>
            <?endif?>
        </div>
    </div>





<div class="container footer-contaent">
        <!-- FOOTER -->
    <div class="footer">

        <div class="row footer-menu">
            <div class="logo col-lg-3 col-xs-3">
                <a href="#" title=""><img src="../../media/images/logo-footer.png" border="0" alt="" /></a>
            </div>
            <div class="col-lg-9 col-xs-9 footer-menu-block">
                <ul class="footer-nav">
                    <li class="block-1">
                        About <span class="icon micon-arrow-bottom-icon pull-right"></span>
                        <ul class="sub">
                            <li><a href="#">The Company</a></li>
                            <li><a href="#">Contact Us</a></li>
                        </ul>
                    </li>
                    <li  class="block-2">
                        LEGAL STUFF <span class="icon micon-arrow-bottom-icon pull-right"></span>
                        <ul class="sub">
                            <li><a href="#">Privacy / Security Policy</a></li>
                            <li><a href="#">Terms and Conditions </a></li>
                        </ul>
                    </li>
                    <li class="block-3">
                        OPPORTUNITIES <span class="icon micon-arrow-bottom-icon pull-right"></span>
                        <ul class="sub">
                            <li><a href="#">Affiliate / Reseller </a></li>
                            <li><a href="#">Join Topup.me</a></li>
                        </ul>
                    </li>
                    <li class="block-4">
                        GET SOCIAL <span class="icon micon-arrow-bottom-icon pull-right"></span>
                        <ul class="sub">
                            <li class="social-icons">
                                <a href="http://facebook.com"><span class="icon micon-fb-icon"></span></a>
                                <a href="#"><span class="icon micon-tw-icon"></span></a>
                                <a href="#"><span class="icon micon-g-icon"></span></a>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>

        <div class="row copyright">
            <div class="pull-right"> &copy; 2015 Topup.me. All rights reserved. </div>
            <div>Site owned and operated by COMPANY NAME, ISRAEL </div>
        </div>
    </div>

</div><!-- /.container -->
<div class="popup-block loader">
    <img src="/media/images/loader.gif">
</div>

    <!-- Bootstrap core JavaScript -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="/media/libs/jquery-1.11.3.min.js"></script>
    <script src="/media/libs/jquery-ui/jquery-ui.min.js"></script>
    <script src="/media/libs/bootstrap-3.3.5/js/bootstrap.min.js"></script>
    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <script src="/media/libs/ie10-viewport-bug-workaround.js"></script>
    <script type="text/javascript" src="/media/libs/jquery.ddslick.js"></script>
    <script src="/media/js/common-sctipts.js"></script>
<!--    <script src="/media/js/activation-form-steps.js"></script>-->
    <script src="/media/js/charger.js"></script>

</body>
</html>
