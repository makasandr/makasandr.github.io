<?php include ROOT . '/views/layouts/header.php'; ?>
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
        <a id="seeall-events" href="seeAll">SEE ALL ></a>
    </div>
    <div class="pre-events">
        <div class="pre-event">
            <h2>Event Name</h2>
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
<div class="container">
	<div class="row">
		<?php if(empty($programs_data)): ?>
			<p class="top-mg-4 size-big up-case gray center col-xs-12">Cart empty</p>
		<?php else: ?>
			<form action="/explore/cart" method="POST">
				<p class="col-xs-10 col-xs-offset-1 size-extra black bottom-mg-2 top-mg-4">You want to buy:</p>
				<?php foreach ($programs_data as $program): ?>
					<div class="row bottom-mg-1">
						<a href="/explore/program/<?php echo $program['id']; ?>" class="col-xs-10 col-xs-offset-1">
							<div class="inline col-xs-4 col-sm-2 col-md-1">
								<div class="cover square" style="background-image: url(<?php echo $program['avatar']; ?>);"></div>
							</div>
							<div class="inline col-xs-8 col-sm-10 col-md-11">
								<div class="col-xs-12 top-mg-1 hidden-xs"></div>
								<p class="col-xs-12 col-sm-8 size-normal black bold"><?php echo $program['name']; ?></p>
								<div class="col-xs-12 top-mg-2 hidden-sm hidden-md hidden-lg"></div>
								<p class="col-xs-12 col-sm-4 size-normal right black"><?php echo $program['cost']; ?>$</p>
							</div>
						</a>
						<p class="gray-line top-mg-1 col-xs-8 col-xs-offset-2"></p>
					</div>
				<?php endforeach ?>
				<p class="size-big gray right col-xs-10 col-xs-offset-1">Total: <?php echo $total; ?>$</p>
				<input class="top-mg-2 block col-xs-10 col-xs-offset-1 col-md-4 col-md-offset-4 size-big white up-case" type="submit" name="submit" value="Confirm">
			</form>
		<?php endif; ?>
	</div>
	<div class="row">
		<div class="col-xs-12 bottom-mg-4"></div>
	</div>
</div>

<script>
	//
</script>


<?php include ROOT . '/views/layouts/footer.php'; ?>