<?php include ROOT . '/views/layouts/header_index.php'; ?>

	<div class="container-fluid" style="background-color: #eee;">
		<div class="row mg-0 slider">
			<div class="col-xs-12 pd-0 active cover" style="background-image: url(/template/images/no-image.jpg);">
				<div class="next cover"></div>
				<div class="auto-margin">
					<div class="col-xs-6">
						<a href="" class="to-left size-extra white"><i class="fa fa-chevron-left" aria-hidden="true"></i></a>
					</div>
					<div class="col-xs-6 right">
						<a href="" class="to-right size-extra white"><i class="fa fa-chevron-right" aria-hidden="true"></i></a>
					</div>
				</div>
			</div>
		</div>

		<div class="container">
			<div class="row top-mg-2">
				<div class="col-xs-10 col-xs-offset-1 col-md-6 col-md-offset-3 center bottom-mg-1">
					<p class="size-normal slider-text" style="font-family: 'Josefin Sans', sans-serif;">Nunc id tristique ex, bibendum ultricies felis. Nunc vel sollicitudin massa.</p>
				</div>
				<div class="center col-xs-8 col-xs-offset-2 col-md-4 col-md-offset-4 bottom-mg-1">
					<div class="control-btn top-pd-1 bottom-pd-1 col-xs-3 b-pd-hald" text="Nunc id tristique ex, bibendum ultricies felis. Nunc vel sollicitudin massa.">
						<div class="line">
							<div class="status" style="width: 0;"></div>
						</div>
					</div>

					<div class="control-btn top-pd-1 bottom-pd-1 col-xs-3 b-pd-hald" text="Fusce justo nisi, eleifend eu diam in, faucibus maximus tortor.">
						<div class="line">
							<div class="status" style="width: 0;"></div>
						</div>
					</div>

					<div class="control-btn top-pd-1 bottom-pd-1 col-xs-3 b-pd-hald" text="Nulla ut dolor vehicula, lobortis dui non, suscipit sem.">
						<div class="line">
							<div class="status" style="width: 0;"></div>
						</div>
					</div>

					<div class="control-btn top-pd-1 bottom-pd-1 col-xs-3 b-pd-hald" text="Nunc eu odio sed lectus luctus volutpat. Sed in lectus sapien.">
						<div class="line">
							<div class="status" style="width: 0;"></div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

	<div class="container-fluid">
		<div class="bar-cover special">
			<div class="bar-full" style="background-image: url(/template/images/no-image.jpg);">
				<div class="col-xs-10 col-xs-offset-1">
					<p style="font-size: 60px" class="title white center up-case bottom-mg-1">Lorem Ipsum</p>
					<p style="font-size: 18px" class="center white bottom-mg-2 text">
						Lorem ipsum dolor sit amet, consectetur adipiscing elit. Hoc non est positum in nostra actione. Duo Reges: constructio interrete. Equidem e Cn. Avaritiamne minuis?
					</p>
				</div>
			</div>
		</div>

		<div class="bar-cover special">
			<div class="bar-full" style="background-image: url(/template/images/no-image.jpg);">
				<div class="col-xs-10 col-xs-offset-1">
					<p style="font-size: 60px" class="title white center up-case bottom-mg-1">Lorem Ipsum</p>
					<p style="font-size: 18px" class="center white bottom-mg-2 text">
						Lorem ipsum dolor sit amet, consectetur adipiscing elit. Hoc non est positum in nostra actione. Duo Reges: constructio interrete. Equidem e Cn. Avaritiamne minuis?
					</p>
				</div>
			</div>
		</div>

		<div class="bar-cover special">
			<div class="bar-full" style="background-image: url(/template/images/no-image.jpg);">
				<div class="col-xs-10 col-xs-offset-1">
					<p style="font-size: 60px" class="title white center up-case bottom-mg-1">Lorem Ipsum</p>
					<p style="font-size: 18px" class="center white bottom-mg-2 text">
						Lorem ipsum dolor sit amet, consectetur adipiscing elit. Hoc non est positum in nostra actione. Duo Reges: constructio interrete. Equidem e Cn. Avaritiamne minuis?
					</p>
				</div>
			</div>
		</div>

		<div class="bars-dots">
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

	<div class="container-fluid">
		<div class="row mg-0">
			<div class="col-xs-12 col-sm-6 pd-0">
				<div class="square cover" style="background-image: url(/template/images/no-image.jpg);"></div>
			</div>
			<div class="col-xs-12 col-sm-6 pd-0">
				<div class="square cover" style="background-image: url(/template/images/no-image.jpg);"></div>
			</div>
		</div>
	</div>

	<script type="text/javascript">
		var time_vis;
		var interaction = 1;
		var slide_change;
		function autoplay() {
			var load = $('.control-btn.active').index();
			if (load == 3) {
				var next_slide = 0;
			} else {
				var next_slide = load+1;
			}
			stop_slide(load);
			change_slide(next_slide);
		}

		function change_slide (slide) {
			$('.control-btn:eq('+slide+')').addClass('active');
			$('.slider .next').css('background-image', $('.slider .active').css('background-image'));
			$('.slider .next').css('opacity', '1');
			// $('.slider .active').css('background-image', 'url(/template/images/man/slider/'+slide+'.jpg)');
			$('.slider .active').css('background-image', 'url(/template/images/no-image.jpg)');
			$('.slider .next').animate({ opacity: '0' }, 600, 'easeOutCubic');
			$('.slider-text').animate({ opacity: '0' }, 300, 'easeOutCubic', function() {
				$('.slider-text').html($('.control-btn.active').attr('text'));
				$('.slider-text').animate({ opacity: '1' }, 600, 'easeOutCubic');
			});
			time_vis = setInterval(function () {
				$('.control-btn.active .status').css('width', interaction+"%");
				interaction++;
			}, 80);
			slide_change = setTimeout(autoplay, 8000);
		}

		function stop_slide () {
			clearInterval(time_vis);
			interaction = 1;
			clearTimeout(slide_change);
			$('.control-btn.active .status').css('width', '0');
			$('.control-btn.active').removeClass('active');
		}

		$(window).load(function() {
			change_slide(0);
		});

		$('.control-btn').click(function(event) {
			if (!$(this).hasClass('active')) {
				var load = $(this).index();
				stop_slide(load);
				change_slide(load);
			}
		});

		$('.slider .to-left').click(function(event) {
			var load = $('.control-btn.active').index();
			if (load == 0) {
				var next_slide = 3;
			} else {
				var next_slide = load-1;
			}
			stop_slide(load);
			change_slide(next_slide);
			return false;
		});

		$('.slider .to-right').click(function(event) {
			var load = $('.control-btn.active').index();
			if (load == 3) {
				var next_slide = 0;
			} else {
				var next_slide = load+1;
			}
			stop_slide(load);
			change_slide(next_slide);
			return false;
		});

		$(window).on('load resize', function(event) {
			$('.auto-margin').each(function () {
				$(this).css('margin-top', ($(this).parent().height() - $(this).height())/2+'px');
			});
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
			$('.bar-full').each(function(index) {
				if ($(this).offset().top < ($(window).scrollTop()+($('.bar-full').height()*0.9)) && $(window).scrollTop() < ($(this).offset().top+($(this).height()*0.9))) {
					if (active != index && permision) {
						permision = 0;
						scroll_to_bar(index);
					}
				}
			});
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
	</script>

<?php include ROOT . '/views/layouts/footer_index.php'; ?>