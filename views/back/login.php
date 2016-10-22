<?php
/**
 * Created by Arsen.
 * User: Arsen
 * Date: 02.09.2015
 * Time: 15:41
 */

use Helpers\Uri;

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />

    <title>FC Banants Admin Login</title>
    <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="/media/libs/bs3/css/bootstrap.min.css">
    <link rel="stylesheet" href="/media/back/css/custom/login.css">
    <link href='http://fonts.googleapis.com/css?family=Varela+Round' rel='stylesheet' type='text/css'>
    <script src="//code.jquery.com/jquery-1.12.4.min.js"></script>
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.13.1/jquery.validate.min.js"></script>
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="text-center">
                <div class="header">login</div>
                <div class="login-form-1">
                    <form id="login-form" class="text-left">
                        <div class="login-form-main-message"></div>
                        <div class="main-login-form">
                            <div class="login-group">
                                <div class="form-group">
                                    <label for="email" class="sr-only">Username</label>
                                    <input type="text" class="form-control" id="email" name="email" placeholder="email">
                                </div>
                                <div class="form-group">
                                    <label for="password" class="sr-only">Password</label>
                                    <input type="password" class="form-control" id="password" name="password" placeholder="password">
                                </div>
                                <div class="form-group login-group-checkbox">
                                    <input type="checkbox" id="remember" name="remember">
                                    <label for="remember">remember</label>
                                </div>
                            </div>
                            <button type="submit" class="login-button"><i class="fa fa-chevron-right"></i></button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script src="/media/back/js/custom/login.js"></script>
</body>
</html>