<?php include ROOT . '/views/layouts/header_explore.php'; ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Program</title>
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
    <div class="event-head">
        <div class="head-event-name">
            <h1>Event Name </h1>
        </div>
        <div class="event-address">
            <h3>Lviv,Ukraine</h3>
            <h3>06.12.2019</h3>
        </div>
    </div>
</div>

<div class="content">
    <div class="event">
        <a class="event-video">
            <i class="fa fa-play fa-5x"></i>
        </a>
        <div class="event-info">
            <h1>Event Name</h1>
            <div class="event-address">
                <h3>Lviv,Ukraine</h3>
                <h3>06.12.2019</h3>
            </div>
            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc enim neque, maximus non ligula eget,
                imperdiet fringilla neque. Duis sed consectetur purus. Suspendisse viverra, mauris posuere consequat
                egestas, dui purus interdum justo, et malesuada velit sem et risus. Sed sit amet viverra est.</p>
            <div class="event-stars">
                <i class="fa fa-star fa-3x"></i>
                <i class="fa fa-star fa-3x"></i>
                <i class="fa fa-star fa-3x"></i>
                <i class="fa fa-star fa-3x"></i>
                <i class="fa fa-star fa-3x"></i>
            </div>
            <div class="event-buttons">
                <button>Get price list</button>
                <button>Add Event</button>
            </div>
        </div>
        <div class="other-event-info">
            <div class="event-about">
                <h3>About</h3>
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc enim neque, maximus non ligula eget,
                    imperdiet fringilla neque. Duis sed consectetur purus. Suspendisse viverra, mauris posuere consequat
                    egestas, dui purus interdum justo, et malesuada velit sem et risus. Sed sit amet viverra est.Lorem
                    ipsum dolor sit amet, consectetur adipiscing elit. Nunc enim neque, maximus non ligula eget,
                    imperdiet fringilla neque. Duis sed consectetur purus. Suspendisse viverra, mauris posuere consequat
                    egestas, dui purus interdum justo, et malesuada velit sem et risus. Sed sit amet viverra est.</p>
            </div>
            <div class="event-to-get">
                <h3>Whats you get</h3>
                <ol>
                    <li>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</li>
                    <li>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</li>
                    <li>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</li>
                    <li>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</li>
                    <li>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</li>
                </ol>
            </div>
        </div>

    </div>
</div>

<div class="content">
    <h3>Recommended</h3>
    <div class="carousel recommended">
        <div id="carousel-right"><i class="fa fa-caret-right fa-3x"></i></div>
        <div id="carousel-left"><i class="fa fa-caret-left fa-3x"></i></div>
        <ul>
            <li class="carousel-item first-item">
                <h4>Event name</h4>
                <h5>25.04.2018</h5>
            </li>
            <li class="carousel-item">
                <h4>Program name</h4>
                <h5>Category</h5>
            </li>
            <li class="carousel-item">
                <h4>Program name</h4>
                <h5>Category</h5>
            </li>
            <li class="carousel-item">
                <h4>Program name</h4>
                <h5>Category</h5>
            </li>
            <li class="carousel-item">
                <h4>Program name</h4>
                <h5>Category</h5>
            </li>
            <li class="carousel-item">
                <h4>Program name</h4>
                <h5>Category</h5>
            </li>
            <li class="carousel-item">
                <h4>Program name</h4>
                <h5>Category</h5>
            </li>
        </ul>
    </div>
</div>

<footer>
    <i class="fa fa-envelope fa-4x"></i>
    <h3>Feedback or comments</h3>
    <form class="thoughts">
        <input type="text" id="thoughts" placeholder="Please fell free to share your thoughts on this">
        <input type="submit" value="Explore">
    </form>
    <a href="help"><i class="fa fa-question-circle"></i> Help</a>
    <div class="social-links">
        <a><i class="fa fa-facebook fa-2x"></i></a>
        <a><i class="fa fa-twitter fa-2x"></i></a>
        <a><i class="fa fa-youtube fa-2x"></i></a>
        <a><i class="fa fa-instagram fa-2x"></i></a>
        <a><i class="fa fa-snapchat fa-2x"></i></a>
    </div>
</footer>
<script src="carousel.js"></script>
<script src="search.js"></script>
</body>
</html>