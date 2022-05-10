<?php include ROOT . '/views/layouts/header_explore.php'; ?>



 <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Main</title>
    <link rel="stylesheet" href="style.css ">
    <link rel="stylesheet" href="font-awesome/css/font-awesome.min.css">
</head>
<body>

<div class="menu">
    <div class="main-menu"><h1>you have already had main menu</h1></div>
    <div class="navbar">
        <ul>
            <li>
                <a href="#Categories">Categories <i class="fa fa-caret-down"></i></a>
                <div class="dropdown-menu">
                    <a href="#">lorem</a>
                    <a href="#">lorem</a>
                    <a href="#">lorem</a>
                    <a href="#">lorem</a>
                </div>
            </li>
            <li><a href="#Instructors">Instructors <i class="fa fa-caret-down"></i></a>
                <div class="dropdown-menu">
                    <a href="#">lorem</a>
                    <a href="#">lorem</a>
                    <a href="#">lorem</a>
                    <a href="#">lorem</a>
                </div>
            </li>
            <li><a href="#Events">Events <i class="fa fa-caret-down"></i></a>
                <div class="dropdown-menu">
                    <a href="#">lorem</a>
                    <a href="#">lorem</a>
                    <a href="#">lorem</a>
                    <a href="#">lorem</a>
                </div>
            </li>
            <li class="find">
                <i class="fa fa-search fa-2x"></i>
                <input type="text" class="closed">
            </li>
        </ul>
        <div class="nav-cart">
            <i class="fa fa-shopping-cart fa-3x"></i>6
            <div class="cart-dropdown-menu">
                <h3>You want to buy:</h3>
                <div class="pre-products">
                    <a href="/cart.php " class="pre-product">
                        <img src="img/когда%20здал%20дедлайн.png">
                        <i class="fa fa-close"></i>
                        <h2>Product name</h2>
                        <h3>Name Surname</h3>
                        <h4>Category</h4>
                        <h5>silver</h5>
                        <h3 class="pre-price">22$</h3>
                    </a>
                    <a href="product" class="pre-product">
                        <img src="img/когда%20здал%20дедлайн.png">
                        <i class="fa fa-close"></i>
                        <h2>Product name</h2>
                        <h3>Name Surname</h3>
                        <h4>Category</h4>
                        <h5>silver</h5>
                        <h3 class="pre-price">22$</h3>
                    </a>
                    <a href="product" class="pre-product">
                        <img src="img/когда%20здал%20дедлайн.png">
                        <i class="fa fa-close"></i>
                        <h2>Product name</h2>
                        <h3>Name Surname</h3>
                        <h4>Category</h4>
                        <h5>silver</h5>
                        <h3 class="pre-price">22$</h3>
                    </a>
                    <a href="product" class="pre-product">
                        <img src="img/когда%20здал%20дедлайн.png">
                        <i class="fa fa-close"></i>
                        <h2>Product name</h2>
                        <h3>Name Surname</h3>
                        <h3 class="pre-price">22$</h3>
                    </a>
                </div>
                <p>5 items <span class="pre-amount">$500</span></p>
                <button class="confirm">Confirm</button>
            </div>
        </div>
    </div>
</div>


<div id="Home" class="header">
    <div id="slideshow-wrap">
        <input type="radio" id="button-1" name="controls" checked="checked"/>
        <label for="button-1"></label>
        <input type="radio" id="button-2" name="controls"/>
        <label for="button-2"></label>
        <input type="radio" id="button-3" name="controls"/>
        <label for="button-3"></label>
        <label for="button-1" class="arrows" id="arrow-1"><i class="fa fa-caret-right fa-3x"></i></label>
        <label for="button-2" class="arrows" id="arrow-2"><i class="fa fa-caret-right fa-3x"></i></label>
        <label for="button-3" class="arrows" id="arrow-3"><i class="fa fa-caret-right fa-3x"></i></label>
        <div id="slideshow-inner">
            <ul>
                <li id="slide1">
                    <div class="slide">
                        <div class="slide-name">
                            <h1>Program Name </h1>
                            <h3>Category</h3>
                        </div>
                        <p class="slide-human">by <img class="slide-photo" src="img/когда%20здал%20дедлайн.png"> Name
                            Surname</p>
                        <p class="slide-level">level Super Star</p>
                    </div>
                </li>

                <li id="slide2">
                    <div class="slide">
                        Second slide
                    </div>
                </li>
                <li id="slide3">
                    <div class="slide">
                        Third slide
                    </div>
                </li>
            </ul>
        </div>
    </div>
</div>

<div class="content">
    <h3>latest programs</h3>
    <div class="latest-programs">
        <div class="latest-first-program">
            <div class="latest-program-name">
                <h1>Program Name </h1>
                <h3>Category</h3>
            </div>
            <p class="program-human">by <img class="slide-photo" src="img/когда%20здал%20дедлайн.png"> Name
                Surname</p>
        </div>
        <div class="latest-other-programs">
            <div class="latest-program">
                <div>
                    <h2>Program Name </h2>
                    <h4>Category</h4>
                </div>
            </div>
            <div class="latest-program">
                <div>
                    <h2>Program Name </h2>
                    <h4>Category</h4>
                </div>
            </div>
            <div class="latest-program">
                <div>
                    <h2>Program Name </h2>
                    <h4>Category</h4>
                </div>
            </div>
            <div class="latest-program">
                <div>
                    <h2>Program Name </h2>
                    <h4>Category</h4>
                </div>
            </div>
        </div>
    </div>

    <h3>Category</h3>
    <div class="carousel">
        <div id="carousel-right"><i class="fa fa-caret-right fa-3x"></i></div>
        <div id="carousel-left"><i class="fa fa-caret-left fa-3x"></i></div>
        <ul>
            <li class="carousel-item">
                <h4>Category</h4>
            </li>
            <li class="carousel-item">
                <h4>Category</h4>
            </li>
            <li class="carousel-item">
                <h4>Category</h4>
            </li>
            <li class="carousel-item">
                <h4>Category</h4>
            </li>
            <li class="carousel-item">
                <h4>Category</h4>
            </li>
            <li class="carousel-item">
                <h4>Category</h4>
            </li>
            <li class="carousel-item">
                <h4>Category</h4>
            </li>
        </ul>
    </div>

    <h3>Instructors</h3>
    <ul class="pre-instructors">
        <li class="pre-instructor">
            <img src="img/когда%20здал%20дедлайн.png">
            <div class="pre-trainer-info">
                <div>
                    <h2>Trainer Name</h2>
                    <h4>Category</h4>
                </div>
                <i class="fa fa-star fa-3x">3</i>
            </div>
        </li>
        <li class="pre-instructor">
            <img src="img/когда%20здал%20дедлайн.png">
            <div class="pre-trainer-info">
                <div>
                    <h2>Trainer Name</h2>
                    <h4>Category</h4>
                </div>
                <i class="fa fa-star fa-3x">3</i>
            </div>
        </li>
        <li class="pre-instructor">
            <img src="img/когда%20здал%20дедлайн.png">
            <div class="pre-trainer-info">
                <div>
                    <h2>Trainer Name</h2>
                    <h4>Category</h4>
                </div>
                <i class="fa fa-star fa-3x">3</i>
            </div>
        </li>
        <li class="pre-instructor">
            <img src="img/когда%20здал%20дедлайн.png">
            <div class="pre-trainer-info">
                <div>
                    <h2>Trainer Name</h2>
                    <h4>Category</h4>
                </div>
                <i class="fa fa-star fa-3x">3</i>
            </div>
        </li>
    </ul>

    <div class="pre-events-header">
        <h3>Events</h3>
        <a id="seeall-events" href="/views/explore/events.html">SEE ALL ></a>
    </div>
    <div class="pre-events">
        <div class="pre-event">
            <a href="/views/explore/event.html"> Event name</a>
            <h4>Place of the event</h4>
        </div>
        <div class="calendar">
            <i class="fa fa-caret-left fa-2x"></i>
            <div class="date">
                <h2>25.01</h2>
                <h4>Monday</h4>
            </div>
            <i class="fa fa-caret-right fa-2x"></i>
        </div>
    </div>
</div>

			
<?php include ROOT . '/views/layouts/footer.php'; ?>