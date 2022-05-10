<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
        <meta name="description" content="">
        <meta name="author" content="">
        <title><?php echo $title; ?></title>
        <link href="/template/css/bootstrap.min.css" rel="stylesheet">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <link href="/template/css/animate.css" rel="stylesheet">
        <link href="/template/css/preloader.css" rel="stylesheet"> 
        <link href="/template/css/main.css" rel="stylesheet">
        <link href="/template/css/datepicker.css" rel="stylesheet">
        <link rel="shortcut icon" href="/template/images/icon.ico">

        <script type="text/javascript" src="/template/js/jquery.js"></script>
        <script type="text/javascript" src="/template/js/bootstrap.min.js"></script>
        <script type="text/javascript" src="/template/js/jquery.easing.js"></script>
        <script type="text/javascript" src="/template/js/datepicker.js"></script>
        <script type="text/javascript" src="/template/js/jquery.mobile.js"></script>
        <script type="text/javascript" src="/template/js/onsrc.js"></script>
    </head>

    <body class="out">
        <div id="preloader">
            <img src="/template/images/preloader.png" alt="">
        </div>
        
        <header>
            <div class="top-nav">
                <div class="container-fluid pd-0">
                    <div class="logo-line">
                        <div class="container">
                            <div class="menu left-pd-1">
                                <a><img class="back" src="/template/images/menu_hover.png"><img  class="front" src="/template/images/menu.png"></a>
                            </div>
                            <div class="logo">
                                <a href="/">
                                    <img class="lm" src="/template/images/logo.png" alt="LionelloMassimo">
                                    <img class="slogan" src="/template/images/under_logo.png" alt="LionelloMassimo">
                                </a>
                            </div>
                            <div class="exit right-pd-1">
                                <a href="" class="contact-open">
                                    <i class="size-big fa fa-envelope-o"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                    <nav class="row menu-line">
                        <div class="container">
                            <ul class="col-xs-10 col-xs-offset-1">
                                <li class="center top-mg-half bottom-mg-1 col-xs-12 col-sm-4 col-md-2"><a class="up-case bold size-small" href="/man">Man</a></li>
                                <li class="center top-mg-half bottom-mg-1 col-xs-12 col-sm-4 col-md-2"><a class="up-case bold size-small" href="/woman">Woman</a></li>
                                <li class="center top-mg-half bottom-mg-1 col-xs-12 col-sm-4 col-md-2"><a class="up-case bold size-small" href="/bg">Boys & Girls</a></li>
                                <li class="center top-mg-half bottom-mg-1 col-xs-12 col-sm-4 col-md-2"><a class="up-case bold size-small" href="/special">Special</a></li>
                                <li class="center top-mg-half bottom-mg-1 col-xs-12 col-sm-4 col-md-2"><a class="up-case bold size-small" href="/about">About</a></li>
                                <li class="center top-mg-half bottom-mg-1 col-xs-12 col-sm-4 col-md-2"><a class="up-case bold size-small" href="/login">Step in</a></li>
                            </ul>
                        </div>
                    </nav>
                </div>
            </div>

            <div class="dark-bg" style="display: none;">
                <div class="contact-window center top-pd-2">
                <a href=""><i class="size-big fa fa-close contact-close close-btn red"></i></a>
                    <div class="contact-form top-pd-1">
                        <i class="bottom-mg-1 size-extra center fa fa-envelope-o bottom-mg-half col-xs-12"></i>
                        <input type="text" placeholder="Your e-mail*" class="contact-data bottom-mg-1 center up-case black col-xs-10 col-xs-offset-1">
                        <input type="text" placeholder="Social link or phone number" class="social-data bottom-mg-1 center up-case black contact-field col-xs-10 col-xs-offset-1">
                        <textarea placeholder="Message" class="bottom-mg-1 center up-case black message-field col-xs-10 col-xs-offset-1" style="height: 50px;"></textarea>
                        <p class="center size-small col-xs-12 gray" style="opacity: .5;">Become a member of our <span class="bold">LMFamily</span><br>and get your first complimentary lesson.</p>
                        <div class="col-xs-12 top-mg-1">
                            <a href="" class="contact-submit size-normal up-case button-wm small-btn">Contact me</a>
                        </div>
                    </div>

                    <div class="contact-result" style="display: none;">
                        <p class="top-mg-2 bottom-mg-4 contact-result-message size-normal bold center"></p>
                        <input type="submit" class="contact-close button size-small up-case white col-xs-4 col-xs-offset-4" value="OK">
                    </div>
                </div>
            </div>
            
        </header>
        <div class="body-content">