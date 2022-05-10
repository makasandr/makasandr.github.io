<?php include ROOT . '/views/layouts/header_index.php'; ?>

	<div class="container-fluid">
		<video class="hidden-xs" width="100%" muted>
			<source src="/template/videos/index.mp4" type="video/mp4">
			<p class="center bottom-mg-1 size-small up-case red bold top-mg-4">Player not supported</p>
		</video>
		<img class="hidden-sm hidden-md hidden-lg" src="/template/images/main_top.jpg" width="100%" height="auto" alt="">
	</div>
	<script type="text/javascript">
		$('video').on('canplay ended', function() {
			$('video')[0].play();
		});
	</script>

	<div class="container">
		<div class="row bottom-mg-4">
			<div class="col-xs-10 col-xs-offset-1 col-md-12 col-md-offset-0">
				<div class="top-mg-2 bottom-mg-4 hidden-xs">
					<p class="col-xs-12 col-md-4 top-mg-2 size-extra black center" style="font-family: 'Waiting for the Sunrise', cursive;">It's all about the way how you feel.</p>
					<p class="col-xs-12 col-md-4 top-mg-2 size-extra black center" style="font-family: 'Cinzel', serif;">We make it personal.</p>
					<p class="col-xs-12 col-md-4 top-mg-2 size-extra black center" style="font-size: 44px; font-family: 'Mr Dafoe', cursive;">Lifestyle in every step.</p>
				</div>
				<div class="top-mg-2 bottom-mg-4 hidden-sm hidden-md hidden-lg">
					<p class="col-xs-12 col-md-4 top-mg-1 size-big black center" style="font-family: 'Cinzel', serif;">Online art-dance video tutorial.<br>We make it personal.</p>
				</div>
				<div class="col-xs-12">
					<a href="/login" class="bold top-mg-2 center button-wm small-btn size-normal up-case" style="width: 100px;">Step in</a>
				</div>
				<!-- <p class="size-small bold gray top-mg-half center"></p> -->
			</div>
		</div>
	</div>

	<div class="container-fluid">
		<div class="hidden-xs hidden-sm">
			<div class="bar-cover">
				<a href="/man" class="bar-full" style="background-image: url(/template/images/man.jpg);">
					<div>
						<p style="font-size: 60px" class="title white center up-case bottom-mg-1"> - Man -</p>
						<p style="font-size: 18px" class="center white bottom-mg-2 text">
							A Mans manners are mirror in which he shows his portrait, lead with a passion and build your personal style during your art-dance-sport lessons.
						</p>
						<p class="size-big white btn-im up-case">Discover now</p>
					</div>
				</a>
			</div>

			<div class="bar-cover woman">
				<a href="/woman" class="bar-full" style="background-image: url(/template/images/woman.jpg);">
					<div>
						<p style="font-size: 60px" class="title white center up-case bottom-mg-1"> - Woman -</p>
						<p style="font-size: 18px" class="center white bottom-mg-2 text">
							Dance is all about beauty and elegance. And beauty it is not how to being noticed it's about remembered. Make step forward, express yourself in beautiful way.
						</p>
						<p class="size-big white btn-im up-case">Step forward</p>
					</div>
				</a>
			</div>

			<div class="bar-cover">
				<a href="/bg" class="bar-full" style="background-image: url(/template/images/bg.jpg);">
					<div>
						<p style="font-size: 60px; max-width: 562px; margin-left: 200px;" class="title white center up-case bottom-mg-1"> - Boys & Girls -</p>
						<p style="font-size: 18px" class="center white bottom-mg-2 text">
							Dance It's fun, easy and cool, it's how to stay original and respectful in different situations also it's build self-confidence and responsibility and those habits is for successful people. Enjoy your life, be successful, dance every day.
						</p>
						<p class="size-big white btn-im up-case">More info</p>
					</div>
				</a>
			</div>

			<div class="bars-dots hidden-sm hidden-xs">
				<p class="size-small bottom-mg-half">
					<i class="white fa fa-circle-o" aria-hidden="true"></i>
					<i class="white fa fa-circle active" aria-hidden="true"></i>
				</p>
				<p class="size-small bottom-mg-half">
					<i class="white fa fa-circle-o" aria-hidden="true"></i>
					<i class="white fa fa-circle" aria-hidden="true"></i>
				</p>
				<p class="size-small bottom-mg-half">
					<i class="white fa fa-circle-o" aria-hidden="true"></i>
					<i class="white fa fa-circle" aria-hidden="true"></i>
				</p>
			</div>
		</div>
	</div>

	<div class="container">
		<div class="hidden-md hidden-lg row">
			<div class="col-xs-12">
				<a href="/man" class="col-xs-12 bottom-mg-2 bar-cover" style="background-image: url(/template/images/man.jpg);">
					<p class="size-extra white up-case center mobile">Man</p>
				</a>
				<a href="/woman" class="col-xs-12 bottom-mg-2 bar-cover" style="background-image: url(/template/images/woman.jpg);">
					<p class="size-extra white up-case center mobile">Woman</p>
				</a>
				<a href="/bg" class="col-xs-12 bar-cover" style="background-image: url(/template/images/bg.jpg);">
					<p class="size-extra white up-case center mobile">Boys & Girls</p>
				</a>
			</div>
		</div>
	</div>

	<div class="container-fluid top-pd-3" style="background-color: rgb(248,248,248);">
		<div class="container">
			<div class="row">
				<div class="col-xs-10 col-xs-offset-1 col-sm-12 col-sm-offset-0">
					<p class="inline size-extra black center" style="width: 100%; font-family: 'Cinzel', serif;">you can’t get out of it</p>
				</div>
			</div>
			<div id="about" class="row images-line">
				<div class="col-xs-8 col-xs-offset-2 bottom-mg-2"></div>
				<div class="col-xs-6 col-md-3 pd-0">
					<img src="/template/images/man/block-6/1.jpg" alt="">
				</div>
				<div class="col-xs-6 col-md-3 pd-0">
					<img src="/template/images/man/block-6/2.jpg" alt="">
				</div>
				<div class="col-xs-6 col-md-3 pd-0">
					<img src="/template/images/man/block-6/3.jpg" alt="">
				</div>
				<div class="col-xs-6 col-md-3 pd-0">
					<img src="/template/images/man/block-6/4.jpg" alt="">
				</div>

				<div class="images-link-md hidden-xs hidden-sm">
					<a href="/special" class="white" style="font-family: 'Mr Dafoe', cursive; font-size: 36px">Special offer</a>
				</div>

				<div class="images-link-xs contact-open hidden-md hidden-lg">
					<div class="p-cover">
						<a href="/special" class="top-pd-3 black left-pd-1 right-pd-2 center bold" style="font-family: 'Waiting for the Sunrise', cursive; line-height: 36px; font-size: 36px; display: block;">Special offer</a>
						<a href="/special" class="top-pd-half black left-pd-1 right-pd-2 size-small up-case center bold" style=" display: block; text-decoration: underline;">Explore</a>
					</div>
				</div>
			</div>

			<div class="row bottom-mg-2">
				<div class="col-xs-10 col-xs-offset-1 col-md-12 col-md-offset-0">
					<p class="size-big black top-mg-3 left-pd-2" style="font-family: 'Josefin Sans', sans-serif;">You may think that you can get through life without having to dance, but I can guarantee you that’s not really possible. You’re going to have to get out on the dance floor eventually. At some point you’ll end up getting dragged out to a club by some friends. Eventually you will go to a house party. Not only that, throughout your life there will be countless weddings to attend. There will be dancing at all these events, so you may as well accept that dancing is inevitable and be prepared so as to bust out some sweet moves on the floor.</p>
				</div>
			</div>
		</div>
	</div>

	<div class="container">
		<div id="reasons" class="about-links row">
			<p class="size-extra center col-xs-12 top-mg-2 bottom-mg-2 up-case black" style="font-family: 'Cinzel', serif;">3 reasons why <img src="/template/images/logo.png" style="position: relative; top: -7.5px; max-width: 100%;" alt=""></p>
			<div class="col-xs-10 bottom-mg-1 col-xs-offset-1 col-sm-4 col-sm-offset-0">
				<div class="col-xs-12 pd-0">
					<div class="cover comunity square" style="background-image: url(/template/images/benefit_1.jpg);"></div>
				</div>
			</div>
			<div class="hidden-sm hidden-md hidden-lg">
				<div style="position: relative; margin-top: -130px;" class="col-xs-12 mobile-info-link">
					<p style="font-size: 28px; text-shadow: 0px 0px 8px rgba(0, 0, 0, 1); font-family: 'Cinzel', serif;" class="col-xs-12 center up-case bold white">We are family</p>
					<div class="col-xs-12 top-mg-1">
						<p class="size-normal bold up-case center black" style="display: block; width: 100px; margin: auto; padding: 3px; background: white;">more</p>
					</div>
				</div>
				<div class="col-xs-10 col-xs-offset-1 bottom-mg-2 mobile-info" style="display: none;">
					<p style="font-size: 28px;" class="col-xs-12 center bold top-mg-1 up-case" style="   font-family: 'Cinzel', serif;">We are family</p>
					<p class="col-xs-12 size-normal top-mg-1 bottom-mg-1
					" style="font-family: 'Josefin Sans', sans-serif;">We are taken care of our clients, we working hard to create for you an <span class="bold">atmosphere</span> where you can feel <span class="bold">passion and love</span>, <span class="bold">support and motivation</span>. Were you can <span class="bold">get inspiration</span> from each other and <span class="bold">achieving goals</span> together. We creat for you the mood that happen between <span class="bold">family</span> members That’s why we are more then community, <span class="bold">we are family</span>. Became a part of our family:</p>
					<ul class="size-normal bold left-pd-2 bottom-mg-1 fa-ul col-xs-12" style="font-family: 'Josefin Sans', sans-serif;">
						<li><i class="red fa-li fa fa-square size-small"></i>Make connections</li>
						<li><i class="red fa-li fa fa-square size-small"></i>Share your passion</li>
						<li><i class="red fa-li fa fa-square size-small"></i>Get inspired and motivated</li>
						<li><i class="red fa-li fa fa-square size-small"></i>Find events and travel</li>
						<li><i class="red fa-li fa fa-square size-small"></i>Enjoy your life. Dance every day</li>
					</ul>
					<div class="col-xs-12 left-pd-1">
					<a href="" class="contact-open size-small up-case gray" style="border-bottom: 1px solid #333; padding-bottom: 2px;">become a member</a>
				</div>
				</div>
			</div>

			<div class="col-xs-10 bottom-mg-1 col-xs-offset-1 col-sm-4 col-sm-offset-0">
				<div class="col-xs-12 pd-0">
					<div class="cover about square" style="background-image: url(/template/images/about_2.jpg);"></div>
				</div>
			</div>
			<div class="hidden-sm hidden-md hidden-lg">
				<div style="position: relative; margin-top: -130px;" class="col-xs-12 mobile-info-link">
					<p style="font-size: 28px; text-shadow: 0px 0px 8px rgba(0, 0, 0, 1); font-family: 'Cinzel', serif;" class="col-xs-12 center up-case bold white">Best coach</p>
					<div class="col-xs-12 top-mg-1">
						<p class="size-normal bold up-case center black" style="display: block; width: 100px; margin: auto; padding: 3px; background: white;">more</p>
					</div>
				</div>
				<div class="col-xs-10 col-xs-offset-1 bottom-mg-4 mobile-info" style="display: none;font-family: 'Cinzel', serif;">
					<p style="font-size: 28px;" class="col-xs-12 center bold top-mg-1 up-case">Best coach</p>
					<p class="col-xs-12 size-normal top-mg-1 center black" style="font-family: 'Josefin Sans', sans-serif;">
						"Dance is a language of life 
						It helps you to understand your real desire and wise that keeps you in harmony. it a language of expression and art of "human being" that important to be shared between people in understandable and intelligent way."<br>
						<span style="display: block;" class="top-mg-1">- Lionello Massimo</span>
					</p>
					<p class="col-xs-12">
						<a href="/about" class="bold top-mg-1 center button-wm about-me small-btn size-normal up-case">Read more</a>
					</p>
				</div>
			</div>

			<div class="col-xs-10 bottom-mg-1 col-xs-offset-1 col-sm-4 col-sm-offset-0">
				<div class="col-xs-12 pd-0">
					<div class="cover benefit square" style="background-image: url(/template/images/comunity_2.jpg);"></div>
				</div>
			</div>
			<div class="hidden-sm hidden-md hidden-lg">
				<div style="position: relative; margin-top: -130px;" class="col-xs-12 mobile-info-link">
					<p style="font-size: 28px; text-shadow: 0px 0px 8px rgba(0, 0, 0, 1); font-family: 'Cinzel', serif;" class="col-xs-12 center up-case bold white">5 stars product</p>
					<div class="col-xs-12 top-mg-1">
						<p class="size-normal bold up-case center black" style="display: block; width: 100px; margin: auto; padding: 3px; background: white;">more</p>
					</div>
				</div>
				<div class="col-xs-10 col-xs-offset-1 bottom-mg-2 mobile-info" style="display: none;">
					<p style="font-size: 28px; font-family: 'Cinzel', serif;" class="col-xs-12 center bold top-mg-1 up-case">5 stars product</p>
					<p class="col-xs-12 size-normal top-mg-1 bottom-mg-1
					" style="font-family: 'Josefin Sans', sans-serif;">We were used all our dance <span class="bold">experience and knowledge</span> in collecting and systematization information from all over the world in order to create a <span class="bold">art-dance-sport program</span> for you, that will keep your dance classes <span class="bold">easy, cool, fun</span> and satisfied your <span class="bold">personal needs</span> in same time. And yes ! We are special because:</p>
					<ul class="size-normal bold left-pd-2 bottom-mg-1 fa-ul col-xs-12" style="font-family: 'Josefin Sans', sans-serif;">
						<li><i class="red fa-li fa fa-square size-small"></i>High video quality</li>
						<li><i class="red fa-li fa fa-square size-small"></i>Uniqe modern educational system</li>
						<li><i class="red fa-li fa fa-square size-small"></i>Dance lesson in any time 24/7</li>
						<li><i class="red fa-li fa fa-square size-small"></i>In Any place of the world</li>
						<li><i class="red fa-li fa fa-square size-small"></i>Have your personal programe</li>
						<li><i class="red fa-li fa fa-square size-small"></i>Study with instructors or without</li>
						<li><i class="red fa-li fa fa-square size-small"></i>Servise support 24/7</li>
					</ul>
					<div class="col-xs-12 left-pd-1">
						<a href="" class="contact-open size-small up-case gray" style="border-bottom: 1px solid #333; padding-bottom: 2px;">contact us</a>
					</div>
				</div>
			</div>
		</div>

		<div class="hidden-xs about-info row bottom-mg-4">
			<div class="col-xs-10 col-xs-offset-1 col-sm-4 col-sm-offset-0 comunity about-info-bar">
				<p style="font-size: 28px;" class="col-xs-12 center up-case bold top-mg-1">We are family</p>
				<p class="col-xs-12 size-normal top-mg-1 bottom-mg-1
				" style="font-family: 'Josefin Sans', sans-serif;">We are taken care of our clients, we working hard to create for you an <span class="bold">atmosphere</span> where you can feel <span class="bold">passion and love</span>, <span class="bold">support and motivation</span>. Were you can <span class="bold">get inspiration</span> from each other and <span class="bold">achieving goals</span> together. We creat for you the mood that happen between <span class="bold">family</span> members That’s why we are more then community, <span class="bold">we are family</span>. Become a member of our family:</p>
				<ul class="size-normal bold left-pd-2 bottom-mg-1 fa-ul col-xs-12" style="font-family: 'Josefin Sans', sans-serif;">
					<li><i class="red fa-li fa fa-square size-small"></i>Make connections</li>
					<li><i class="red fa-li fa fa-square size-small"></i>Share your passion</li>
					<li><i class="red fa-li fa fa-square size-small"></i>Get inspired and motivated</li>
					<li><i class="red fa-li fa fa-square size-small"></i>Find events and travel</li>
					<li><i class="red fa-li fa fa-square size-small"></i>Enjoy your life. Dance every day</li>
				</ul>
				<div class="col-xs-12 left-pd-1">
					<a href="" class="contact-open size-small up-case gray" style="border-bottom: 1px solid #333; padding-bottom: 2px;">become a member</a>
				</div>
			</div>
			<div class="col-xs-10 col-xs-offset-1 col-sm-4 col-sm-offset-4 about-info-bar about">
				<p style="font-size: 28px;" class="col-xs-12 center bold top-mg-1 up-case">Best coach</p>
				<p class="col-xs-12 size-normal top-mg-1 center black" style="font-family: 'Josefin Sans', sans-serif;">
					"Dance is a language of life 
					It helps you to understand your real desire and wise that keeps you in harmony. it a language of expression and art of "human being" that important to be shared between people in understandable and intelligent way."<br>
					<span style="display: block;" class="top-mg-1">- Lionello Massimo</span>
				</p>
				<p class="col-xs-12">
					<a href="/about" class="bold top-mg-1 center button-wm about-me small-btn size-normal up-case">Read more</a>
				</p>
			</div>
			<div class="col-xs-10 col-xs-offset-1 col-sm-4 col-sm-offset-8 about-info-bar benefit">
				<p style="font-size: 28px;" class="col-xs-12 center bold top-mg-1 up-case">5 stars product</p>
				<p class="col-xs-12 size-normal top-mg-1 bottom-mg-1
				" style="font-family: 'Josefin Sans', sans-serif;">We were used all our dance <span class="bold">experience and knowledge</span> in collecting and systematization information from all over the world in order to create a <span class="bold">art-dance-sport program</span> for you, that will keep your dance classes <span class="bold">easy, cool, fun</span> and satisfied your <span class="bold">personal needs</span> in same time. And yes ! We are special because:</p>
				<ul class="size-normal bold left-pd-2 bottom-mg-1 fa-ul col-xs-12" style="font-family: 'Josefin Sans', sans-serif;">
					<li><i class="red fa-li fa fa-square size-small"></i>High video quality</li>
					<li><i class="red fa-li fa fa-square size-small"></i>Uniqe modern educational system</li>
					<li><i class="red fa-li fa fa-square size-small"></i>Dance lesson in any time 24/7</li>
					<li><i class="red fa-li fa fa-square size-small"></i>In Any place of the world</li>
					<li><i class="red fa-li fa fa-square size-small"></i>Have your personal programe</li>
					<li><i class="red fa-li fa fa-square size-small"></i>Study with instructors or without</li>
					<li><i class="red fa-li fa fa-square size-small"></i>Servise support 24/7</li>
				</ul>

				<div class="col-xs-12 left-pd-1">
					<a href="" class="contact-open size-small up-case gray" style="border-bottom: 1px solid #333; padding-bottom: 2px;">contact us</a>
				</div>
			</div>
		</div>
	</div>
	<script type="text/javascript">
		$('.about-links .cover').mouseenter(function() {
			if ($(this).hasClass('comunity')) var item = "comunity";
			else if ($(this).hasClass('about')) var item = "about";
			else var item = "benefit";
			$('.about-links .cover.active').removeClass('active');
			$(this).addClass('active');
			$('.about-info-bar.active').removeClass('active');
			$('.about-info-bar.'+item).addClass('active');
		});

		$('.about-links .mobile-info-link').click(function(event) {
			var link = $(this);
			var content = $(this).next();

			$('.mobile-info-link').css('display', 'block');
			link.css('display', 'none');
			$('.mobile-info').css('display', 'none');
			content.css('display', 'block');

			$('.about-links .cover.active').removeClass('active');
			$(this).parent().prev().find('.cover').addClass('active');

			$(window).scrollTop($(this).parent().prev().offset().top-80);
		});

		$(window).on('load scroll', function(event) {
			if ($(window).scrollTop() > ($('.bar-full:eq(0)').offset().top-($(window).height()/2)) && $(window).scrollTop() < ($('.bar-full:eq(2)').offset().top+($(window).height()/2))) {
				$('.bars-dots').css('opacity', '1');
			} else {
				$('.bars-dots').css('opacity', '0');
			}
		});

		$(window).on('load resize', function() {
			$('.bar-full').css('height', $(window).height()+'px');
			$('.bar-full div').css('padding-top', ($(window).height()/2-150)+'px');
		});

		var active = -1;
		var permision = 1;
		$(window).on('scroll', function() {
			if ($(window).width() > 991) {
				$('.bar-full').each(function(index) {
					if ($(this).offset().top < ($(window).scrollTop()+($('.bar-full').height()*0.9)) && $(window).scrollTop() < ($(this).offset().top+($(this).height()*0.9))) {
						if (active != index && permision) {
							permision = 0;
							scroll_to_bar(index);
						}
					}
				});
			}
		});

		function scroll_to_bar(index) {
			$('html, body').animate({
				scrollTop:$('.bar-full:eq('+index+')').offset().top
			}, 1000, 'easeOutCubic', function() {
				permision = 1;
			});
			active = index;
			$('.fa-circle').removeClass('active');
			$('.fa-circle:eq('+active+')').addClass('active');
		}

		$(window).bind('mousewheel DOMMouseScroll', function(event){
		    if (permision == 0) {
		    	return false;
		    }
		});

		$(window).on('load resize', function() {
			if ($(window).width() < 768) {
				$('.images-link-xs').css('height', ($('.images-line').height()-30)+'px');
			}
		});

		$(".button-wm").not('.contact-submit').click(function(event) {
			if ($(window).width() < 768) {
				setTimeout(redirect, 500, $(this).attr('href'));
				return false;
			} else {
				return;
			}
		});

		function redirect(href) {
			window.location.href = href;
		}
	</script>

<?php include ROOT . '/views/layouts/footer_index.php'; ?>