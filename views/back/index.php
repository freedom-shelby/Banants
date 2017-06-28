<?
use Lang\Lang;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>FC Banants Admin Panel</title>

    <link href="/media/libs/bs3/css/bootstrap.min.css" rel="stylesheet">
    <link href="/media/back/css/bootstrap-datetimepicker.min.css" rel="stylesheet">
    <!--  Context Menu  -->
    <link href="/media/back/plugins/context-menu/dist/jquery.contextMenu.min.css" rel="stylesheet">
    <link href="/media/back/css/custom/back.style.css" rel="stylesheet">
    <link href="/media/libs/jquery-ui-1.11.4/jquery-ui.min.css" rel="stylesheet">
    <link href="/media/back/plugins/bootstrap-fileinput-master/css/fileinput.min.css" rel="stylesheet">

    <script src="/media/libs/jquery-1.12.0.min.js"></script>
    <script src="/media/libs/bs3/js/bootstrap.min.js"></script>
    <script src='/media/back/plugins/tinymce/tinymce.min.js'></script>
<!--    <script src="external/jquery/jquery.js"></script>-->
    <script src="/media/libs/jquery-ui-1.11.4/jquery-ui.min.js"></script>
    <!--    Скрипти для загрузки файлов-->
    <script src='/media/back/plugins/bootstrap-fileinput-master/js/plugins/canvas-to-blob.min.js'></script>
    <script src='/media/back/plugins/bootstrap-fileinput-master/js/fileinput.min.js'></script>
    <script src='/media/back/plugins/bootstrap-fileinput-master/js/fileinput_locale_LANG.js'></script>

    <script src='/media/back/plugins/jquery.mjs.nestedSortable.js'></script>
    <!--  Context Menu  -->
    <script src='/media/back/plugins/context-menu/dist/jquery.contextMenu.min.js'></script>
    <script src='/media/back/plugins/context-menu/dist/jquery.ui.position.min.js'></script>

    <script src='/media/back/plugins/moment.min.js'></script>
    <script src='/media/back/plugins/bootstrap-datetimepicker.js'></script>
</head>
<body>
<div id="main" data-base-url="<?=  App::baseUrl() ?>" data-current-lang-iso="<?=  Lang::instance()->getCurrentLang()['iso'] ?>" data-uri-ext="<?=  App::URI_EXT ?>" data-redirect="">
    <nav class="navbar navbar-fixed-top navbar-inverse" role="navigation">
        <div class="container">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="<?= \Helpers\Uri::makeRouteUri('back.home') ?>">FC Banants</a>
            </div>
            <div id="navbar" class="collapse navbar-collapse">
                <ul class="nav navbar-nav">
                    <li class="dropdown">
                        <a aria-expanded="false" role="button" data-toggle="dropdown" class="dropdown-toggle" href="#">Articles <span class="caret"></span></a>
                        <ul role="menu" class="dropdown-menu">
                            <li><a href="<?= Helpers\Uri::makeRouteUri('back.articles.list') ?>">Standart</a></li>
                            <li><a href="<?= Helpers\Uri::makeRouteUri('back.articles.frontpage') ?>">Front Page</a></li>
<!--                            <li><a href="--><?//=\Helpers\Uri::makeRouteUri('back.articles.about') ?><!--">About</a></li>-->
<!--                            <li><a href="--><?//=\Helpers\Uri::makeRouteUri('back.articles.contacts') ?><!--">Contact</a></li>-->
<!--                            <li><a href="--><?//=\Helpers\Uri::makeRouteUri('back.articles.faq') ?><!--">FAQ</a></li>-->
                        </ul>
                    </li>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Categories <span class="caret"></span></a>
                        <ul class="dropdown-menu" role="menu">
                            <li><a href="<?= Helpers\Uri::makeRouteUri('back.articles.add') ?>">Add</a></li>
                            <li><a href="<?= Helpers\Uri::makeRouteUri('back.categories.list') ?>">List</a></li>
                        </ul>
                    </li>
                    <li class="dropdown">
                        <a aria-expanded="false" role="button" data-toggle="dropdown" class="dropdown-toggle" href="#">Menus <span class="caret"></span></a>
                        <ul role="menu" class="dropdown-menu">
                            <?foreach(MenuModel::all() as $item): ?>
                                <li><a href="<?= Helpers\Uri::makeUri('Admin/Menus/List').'/'.$item->id . App::URI_EXT ?>"><?= $item->title ?></a></li>
                            <?endforeach ?>
                        </ul>
                    </li>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Galleries <span class="caret"></span></a>
                        <ul class="dropdown-menu" role="menu">
                            <li class="dropdown-submenu">
                                <a tabindex="-1" href="#">Photo</a>
                                <ul class="dropdown-menu">
                                    <li><a tabindex="-1" href="<?= Helpers\Uri::makeRouteUri('back.photos.add') ?>">Add Photo</a></li>
                                    <li><a href="<?= Helpers\Uri::makeRouteUri('back.photos.list') ?>">List Photos</a></li>
                                    <li><a href="<?= Helpers\Uri::makeRouteUri('back.photo.gallery.add') ?>">Add Photo Gallery</a></li>
                                    <li><a href="<?= Helpers\Uri::makeRouteUri('back.photo.gallery.list') ?>">List Photo Galleries</a></li>
                                </ul>
                            </li>
                            <li class="divider"></li>
                            <li class="dropdown-submenu">
                                <a tabindex="-1" href="#">Video</a>
                                <ul class="dropdown-menu">
                                    <li><a tabindex="-1" href="<?= Helpers\Uri::makeRouteUri('back.video.add') ?>">Add Video</a></li>
                                    <li><a tabindex="-1" href="<?= Helpers\Uri::makeRouteUri('back.video.list') ?>">List Videos</a></li>
<!--                                    <li><a href="#">Second level</a></li>-->
<!--                                    <li class="dropdown-submenu">-->
<!--                                        <a href="#">More..</a>-->
<!--                                        <ul class="dropdown-menu">-->
<!--                                            <li><a href="#">3rd level</a></li>-->
<!--                                        </ul>-->
<!--                                    </li>-->
                                </ul>
                            </li>
                        </ul>
                    </li>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Football <span class="caret"></span></a>
                        <ul class="dropdown-menu" role="menu">
                            <li class="dropdown-submenu">
                                <a tabindex="-1" href="#">League</a>
                                <ul class="dropdown-menu">
                                    <li><a tabindex="-1" href="<?= Helpers\Uri::makeRouteUri('back.league.add') ?>">Add League</a></li>
                                    <li><a href="<?= Helpers\Uri::makeRouteUri('back.league.list') ?>">List League</a></li>
                                </ul>
                            </li>
                            <li class="divider"></li>
                            <li class="dropdown-submenu">
                                <a tabindex="-1" href="#">Team</a>
                                <ul class="dropdown-menu">
                                    <li><a tabindex="-1" href="<?= Helpers\Uri::makeRouteUri('back.team.add') ?>">Add Team</a></li>
                                    <li><a tabindex="-1" href="<?= Helpers\Uri::makeRouteUri('back.team.list.all') ?>">List Team</a></li>
                                </ul>
                            <li class="dropdown-submenu">
                                <a tabindex="-1" href="#">Tournament</a>
                                <ul class="dropdown-menu">
                                    <li><a tabindex="-1" href="<?= Helpers\Uri::makeRouteUri('back.tournament.add') ?>">Add Tournament</a></li>
                                    <li><a tabindex="-1" href="<?= Helpers\Uri::makeRouteUri('back.tournament.list') ?>">List Tournament</a></li>
<!--                                    <li><a href="#">Second level</a></li>-->
<!--                                    <li class="dropdown-submenu">-->
<!--                                        <a href="#">More..</a>-->
<!--                                        <ul class="dropdown-menu">-->
<!--                                            <li><a href="#">3rd level</a></li>-->
<!--                                        </ul>-->
<!--                                    </li>-->
                                </ul>
                            </li>
                        </ul>
                    </li>
                    <li class="dropdown">
                        <a aria-expanded="false" role="button" data-toggle="dropdown" class="dropdown-toggle" href="#">Players <span class="caret"></span></a>
                        <ul role="menu" class="dropdown-menu">
                            <? foreach(TeamModel::orderBy('id')->whereIs_own(1)->get() as $item): ?>
                                <li><a href="<?= Helpers\Uri::makeUriFromId('Admin/Team/List/'.$item->id) ?>"><?= $item->article()->title ?></a></li>
                            <? endforeach ?>
                        </ul>
                    </li>
                    <li class="dropdown">
                        <a aria-expanded="false" role="button" data-toggle="dropdown" class="dropdown-toggle" href="#">Personnel <span class="caret"></span></a>
                        <ul role="menu" class="dropdown-menu">
                            <li class="dropdown-submenu">
                                <a tabindex="-1" href="#">Specialization</a>
                                <ul class="dropdown-menu">
                                    <li><a tabindex="-1" href="<?= Helpers\Uri::makeRouteUri('back.specializations.add') ?>">Add Specialization</a></li>
                                    <li><a href="<?= Helpers\Uri::makeRouteUri('back.specializations.list') ?>">List Specialization</a></li>
                                </ul>
                            </li>

                            <? foreach(PersonnelTypeModel::all() as $item): ?>
                                <li><a href="<?= Helpers\Uri::makeUriFromId('Admin/Personnel/List/'.$item->id) ?>"><?= $item->name ?></a></li>
                            <? endforeach ?>

                        </ul>
                    </li>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">I18n <span class="caret"></span></a>
                        <ul class="dropdown-menu" role="menu">
                            <li class="dropdown-submenu">
                                <a tabindex="-1" href="#">Entity Translation</a>
                                <ul class="dropdown-menu">
                                    <li><a href="<?= Helpers\Uri::makeRouteUri('back.entities.add') ?>">Add</a></li>
                                    <li><a href="<?= Helpers\Uri::makeRouteUri('back.entities.list') ?>">List</a></li>
                                </ul>
                            </li>
                            <li class="divider"></li>
                            <li class="dropdown-submenu">
                                <a tabindex="-1" href="#">Languages</a>
                                <ul class="dropdown-menu">
                                    <li><a href="<?= Helpers\Uri::makeRouteUri('back.languages.add') ?>">Add</a></li>
                                    <li><a href="<?= Helpers\Uri::makeRouteUri('back.languages.list') ?>">List</a></li>
                                </ul>
                            </li>
                        </ul>
                    </li>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Quiz <span class="caret"></span></a>
                        <ul class="dropdown-menu" role="menu">
                            <li><a href="<?= Helpers\Uri::makeRouteUri('back.quiz.add') ?>">Add</a></li>
                            <li><a href="<?= Helpers\Uri::makeRouteUri('back.quiz.list') ?>">List</a></li>
                            <li><a href="<?= Helpers\Uri::makeRouteUri('back.quiz.current') ?>">Current</a></li>
                        </ul>
                    </li>
                    <li><a href="<?= Helpers\Uri::makeRouteUri('back.settings') ?>">Settings</a></li>
                </ul>
    <!--            <ul class="nav navbar-nav navbar-right">-->
    <!--                <li>-->
    <!--                    <a href="--><?//=Helpers\Uri::makeRouteUri('auth.logout') ?><!--">Logout <span class="glyphicon glyphicon-log-out" aria-hidden="true"></span></a>-->
    <!--                </li>-->
    <!--            </ul>-->
            </div><!-- /.nav-collapse -->
        </div><!-- /.container -->
    </nav><!-- /.navbar -->

    <div class="container wrapp">
        <div id="messages">
            <?=  Message::instance()->flash_all(); ?>
        </div>
        <div class="row row-offcanvas row-offcanvas-right">
            <? if(!empty($content)): ?>
                <?= $content ?>
            <? endif ?>
        </div><!--/row-->

        <hr>

        <footer>
            <p>&copy; HorizonDVP 2016</p>
        </footer>

    </div><!--/.container-->
</div><!-- #main -->
<div class="loader"><!-- Loader --></div>

<script src="/media/back/js/custom/back.scripts.js"></script>

</body>
</html>