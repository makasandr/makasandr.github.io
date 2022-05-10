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
        <link href="/template/css/inside.css" rel="stylesheet">
        <link href="/template/css/datepicker.css" rel="stylesheet">
        <link href="/template/css/nanoscroller.css" rel="stylesheet">
        <link rel="shortcut icon" href="/template/images/icon.ico">
        <link rel="stylesheet" href="/template/js/responsiveslides.css">
         <link rel="stylesheet" href="/template/css/style.css ">
    <link rel="stylesheet" href="/template/font-awesome/css/font-awesome.min.css">

        <script type="text/javascript" src="/template/js/jquery.js"></script>
        <script type="text/javascript" src="/template/js/bootstrap.min.js"></script>
        <script type="text/javascript" src="/template/js/jquery.easing.js"></script>
        <script type="text/javascript" src="/template/js/jquery.nanoscroller.js"></script>
        <script type="text/javascript" src="/template/js/datepicker.js"></script>
        <script type="text/javascript" src="/template/js/moment.min.js"></script>
        <script src="/template/js/responsiveslides.min.js"></script>

    </head>

    <body>
        <div id="preloader">
            <img src="/template/images/preloader.png" alt="">
        </div>
        
         <header>
            <div class="nav-line container-fluid">
                <div class="container">
                    <div class="row top-mg-1">
                        <div class="col-xs-8 col-xs-offset-2 col-sm-2 col-sm-offset-0 center logo hidden-sm">
                            <a href="<?php if(isset($admin)) echo "/admin"; ?>/login">
                                <img src="/template/images/logo.png" alt="LionelloMassimo">
                            </a>
                        </div>
                        <div class="hidden-xs col-sm-11 col-md-9">
                            <?php if (isset($user)): ?>
                                <?php if($user === 1): ?>
                                    <ul class="col-xs-12">
                                        <li class="center col-sm-2"><a class="up-case bold size-small" href="/student">My page</a></li>
                                        <li class="center col-sm-2"><a class="up-case bold size-small" href="/trainer/<?php echo $user_data['main_trainer']; ?>">Main trainer</a></li>
                                        <li class="center col-sm-2"><a class="up-case bold size-small" href="<?php if ($title != "My page") echo "/student"; ?>#program_name">Programs</a></li>
                                        <!-- <li class="center col-sm-2"><a class="up-case bold size-small" href="/explore">Explore</a></li> -->
                                        <li class="center col-sm-2"><a class="up-case bold size-small" href="<?php if ($title != "My page") echo "/student"; ?>#galleries">Galleries</a></li>
                                        <li class="center col-sm-2"><a class="up-case bold size-small" href="<?php if ($title != "My page") echo "/student"; ?>#messages">Messages</a></li>
                                    </ul>
                                <?php elseif($user === 2): ?>
                                    <ul>
                                        <li class="center col-sm-2"><a class="up-case bold size-small" href="/trainer">My page</a></li>
                                        <li class="center col-sm-2"><a class="up-case bold size-small" href="<?php if ($title != "My page") echo "/trainer"; ?>#my_programs">Programs</a></li>
                                        <li class="center col-sm-2"><a class="up-case bold size-small explore-button" href="/explore">Explore</a></li>
                                        <li class="center col-sm-2"><a class="up-case bold size-small" href="<?php if ($title != "My page") echo "/trainer"; ?>#tasks">Tasks&Targets</a></li>
                                        <li class="center col-sm-2"><a class="up-case bold size-small" href="<?php if ($title != "My page") echo "/trainer"; ?>#trainer_gallery">Gallery</a></li>
                                        <li class="center col-sm-2"><a class="up-case bold size-small" href="<?php if ($title != "My page") echo "/trainer"; ?>#blog">Blog</a></li>
                                    </ul>
                                <?php endif; ?>
                            <?php else: ?>
                                <ul>
                                    <li class="center col-sm-4"><a class="up-case bold size-small" href="/admin">Statistics</a></li>
                                    <li class="center col-sm-4"><a class="up-case bold size-small" href="/admin/student">Add student</a></li>
                                    <li class="center col-sm-4"><a class="up-case bold size-small" href="/admin/trainer">Add trainer</a></li>
                                </ul>
                            <?php endif; ?>
                        </div>
                        <div class="col-xs-1 hidden-xs">
                            <div class="col-xs-12 pd-0 right">
                                <a href="<?php if(isset($admin)) echo "/admin"; ?>/logout">
                                    <i class="size-normal hidden-xs fa fa-sign-out"></i>
                                    <i style="margin-top: -3px;" class="size-big hidden-sm hidden-md hidden-lg fa fa-sign-out"></i>
                                </a>
                            </div>
                        </div>
                        <div class="col-xs-2 hidden-sm hidden-md hidden-lg">
                            <div class="menu col-xs-12 pd-0 right">
                                <a><img class="back" src="/template/images/menu_hover.png"><img  class="front" src="/template/images/menu.png"></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php if (isset($user)): ?>
                <?php if($user === 1): ?>
                    <nav class="row menu-line">
                        <ul class="col-xs-12">
                            <li class="center top-mg-1 bottom-mg-1 col-xs-12"><a class="up-case bold size-small" href="/student">My page</a></li>
                            <li class="center top-mg-1 bottom-mg-1 col-xs-12"><a class="up-case bold size-small" href="/trainer/<?php echo $user_data['main_trainer']; ?>">Main trainer</a></li>
                            <li class="center top-mg-1 bottom-mg-1 col-xs-12"><a class="up-case bold size-small" href="<?php if ($title != "My page") echo "/student"; ?>#program_name">Programs</a></li>
                            <li class="center top-mg-1 bottom-mg-1 col-xs-12"><a class="up-case explore-button bold size-small" href="/explore">Explore</a></li>
                            <li class="center top-mg-1 bottom-mg-1 col-xs-12"><a class="up-case bold size-small" href="<?php if ($title != "My page") echo "/student"; ?>#galleries">Galleries</a></li>
                            <li class="center top-mg-1 bottom-mg-1 col-xs-12"><a class="up-case bold size-small" href="<?php if ($title != "My page") echo "/student"; ?>#messages">Messages</a></li>
                            <li class="center top-mg-1 bottom-mg-1 col-xs-12"><a class="up-case bold size-small" href="/logout">Exit</a></li>
                        </ul>
                    </nav>
                <?php elseif($user === 2): ?>
                    <nav class="row menu-line">
                        <ul>
                            <li class="center top-mg-1 bottom-mg-1 col-xs-12"><a class="up-case bold size-small" href="/trainer">My page</a></li>
                            <li class="center top-mg-1 bottom-mg-1 col-xs-12"><a class="up-case bold size-small" href="<?php if ($title != "My page") echo "/trainer"; ?>#my_programs">Programs</a></li>
                            <li class="center top-mg-1 bottom-mg-1 col-xs-12"><a class="up-case bold size-small explore-button" href="/explore">Explore</a></li>
                            <li class="center top-mg-1 bottom-mg-1 col-xs-12"><a class="up-case bold size-small" href="<?php if ($title != "My page") echo "/trainer"; ?>#tasks">Tasks&Targets</a></li>
                            <li class="center top-mg-1 bottom-mg-1 col-xs-12"><a class="up-case bold size-small" href="<?php if ($title != "My page") echo "/trainer"; ?>#reviews">Reviews</a></li>
                            <li class="center top-mg-1 bottom-mg-1 col-xs-12"><a class="up-case bold size-small" href="<?php if ($title != "My page") echo "/trainer"; ?>#blog">Blog</a></li>
                            <li class="center top-mg-1 bottom-mg-1 col-xs-12"><a class="up-case bold size-small" href="/logout">Exit</a></li>
                        </ul>
                    </nav>
                <?php endif; ?>
            <?php else: ?>
                <nav class="row menu-line">
                    <ul>
                        <li class="center top-mg-1 bottom-mg-1 col-xs-12"><a class="up-case bold size-small" href="/admin">Statistics</a></li>
                        <li class="center top-mg-1 bottom-mg-1 col-xs-12"><a class="up-case bold size-small" href="/admin/student">Add student</a></li>
                        <li class="center top-mg-1 bottom-mg-1 col-xs-12"><a class="up-case bold size-small" href="/admin/trainer">Add trainer</a></li>
                        <li class="center top-mg-1 bottom-mg-1 col-xs-12"><a class="up-case bold size-small" href="/admin/logout">Exit</a></li>
                    </ul>
                </nav>
            <?php endif; ?>

            <div class="dark-bg-mail" style="display: none;">
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