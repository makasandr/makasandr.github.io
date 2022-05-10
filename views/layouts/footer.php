</div>
<div class="footer-space" style="position: relative; z-index: -1;"></div>
<div class="container-fluid footer-part index">
	<div class="container footer-inside">
		<div class="row">
			<div class="col-xs-12 center top-mg-2"><i style="font-size: 28px" class="gray fa fa-envelope" aria-hidden="true"></i></div>
			<p class="col-xs-12 top-mg-1 up-case size-small center" style="letter-spacing: 2px;">Feedback or comments</p>
			<input type="text" class="hidden-xs feadback top-mg-2 bottom-mg-2 col-xs-10 col-xs-offset-1 col-sm-6 col-sm-offset-3 col-md-4 col-md-offset-4 center bottom-pd-1" style="font-size: 11px; background: transparent;" placeholder="PLEASE FEEL FREE TO SHARE YOUR THOUGHTS ON THIS">
			<div class="col-xs-12">
			<input type="text" class="hidden-sm hidden-md hidden-lg feadback top-mg-2 bottom-mg-2 col-xs-10 col-xs-offset-1 col-sm-6 col-sm-offset-3 col-md-4 col-md-offset-4 center bottom-pd-1" style="font-size: 11px; background: transparent;" placeholder="FEEL FREE TO SHARE YOUR THOUGHTS">
			<div class="col-xs-12 feadback-btn bottom-mg-2" style="display: none;">
				<input type="submit" class="size-small white up-case" style="display: block; margin: auto; width: 100px;" value="Send">
			</div>
			<div class="col-xs-12">
				<!-- <div class="col-xs-12 col-sm-4 center bottom-mg-1">
					<a href="/login" class="size-small up-case gray"><div class="right-mg-half step-in"></div>Step in</a>
				</div> -->
				<div class="col-xs-12">
					<p class="size-small gray bold up-case button center footer-btn" style="display: block; margin: 0 auto 15px; width: 100px;">Explore</p>
				</div>
				<div class="col-xs-12 center bottom-mg-1">
					<a href="/help" class="size-small up-case gray"><i class="right-mg-half size-normal fa fa-question-circle" aria-hidden="true"></i> Help</a>
				</div>
			</div>
			<div class="size-big center col-xs-12 pd-0 top-mg-half top-pd-1">
				<div class="hidden-xs">
					<a class="gray left-pd-1 right-pd-1 href=""><i class="right-mg-half fa fa-facebook"></i></a>
					<a class="gray left-pd-1 right-pd-1 href=""><i class="right-mg-half fa fa-twitter"></i></a>
					<a class="gray left-pd-1 right-pd-1 href=""><i class="right-mg-half fa fa-youtube-play"></i></a>
					<a class="gray left-pd-1 right-pd-1 href=""><i class="right-mg-half fa fa-instagram"></i></a>
					<a class="gray left-pd-1 right-pd-1 href=""><i class="right-mg-half fa fa-snapchat"></i></a>
				</div>
				<div class="hidden-sm hidden-md hidden-lg">
					<a class="gray left-pd-1 right-pd-half href=""><i class="size-small right-mg-half fa fa-facebook"></i></a>
					<a class="gray left-pd-1 right-pd-half href=""><i class="size-small right-mg-half fa fa-twitter"></i></a>
					<a class="gray left-pd-1 right-pd-half href=""><i class="size-small right-mg-half fa fa-youtube-play"></i></a>
					<a class="gray left-pd-1 right-pd-half href=""><i class="size-small right-mg-half fa fa-instagram"></i></a>
					<a class="gray left-pd-1 right-pd-half href=""><i class="size-small right-mg-half fa fa-snapchat"></i></a>
				</div>
			</div>
		</div>
	</div>
</div>
<footer class="container-fluid top-pd-2">
		<div class="row" style="margin: 0;">
			<div class="col-xs-12">
				<div class="col-xs-12 bottom-mg-1">
					<p class="inline col-xs-12 size-small gray center" style="opacity: .7;">
						© 2017 Lionello Massimo. All rights reserved.
					</p>
				</div>
			</div>
		</div>
</footer>

<script>
	$(window).load(function() {
		$('.footer-space').css('height', $('.footer-part').height()+'px');
	});

	$('.feadback').on('input paste', function() {
		if ($(this).val().length) {
			$('.feadback-btn').fadeIn(300, function() {
				$('.footer-space').css('height', $('.footer-part').height()+'px');
			});
		} else {
			$('.feadback-btn').fadeOut(300, function() {
				$('.footer-space').css('height', $('.footer-part').height()+'px');
			});
		}
	});

	

	//preloader
	$(window).on('load', function() {
		$('#preloader img').fadeOut('fast', function() {
			$('body').css({'overflow':'visible'});
			sizes_sets();
		});
		$('#preloader').delay(250).fadeOut('slow', function() {
			$('footer').fadeIn(400);
		});
	});

	//contacts form
    $('.contact-open').on('click', function() {
        $('.dark-bg-mail').fadeIn(400);
        $('.contact-window').css({
            marginTop: '-200px',
            opacity: '1'
        });
        return false;
    });
    $('.contact-close').on('click', function() {
        setTimeout(window_close, 500);
        $('.contact-window').css({
            marginTop: '-250px',
            opacity: '0'
        });
        return false;
    });
    function window_close() {
        $('.dark-bg-mail').fadeOut(200, function() {
            $('.contact-window').css('margin-top', '-50px');
            $('.contact-result').css('display', 'none');
            $('.contact-form').fadeIn(0);
        });
    }

    $('.contact-submit').on('click', function() {
        $.ajax({
            type: "POST",
            url: "/mail",
            data: {contact: $('.contact-data').val(), social: $('.social-data').val(), message: $('.message-field').val()},
            success: function (data) {
                $('.contact-form').fadeOut('200', function() {
                    $('.contact-result-message').html(data);
                    $('.contact-result').fadeIn(400);
                });
            }
        });
        return false;
    });

	//easy scroll to target
	$('a[href^="#"]').click(function() {
		var the_id = $(this).attr("href");
		$('html, body').animate({
			scrollTop:$(the_id).offset().top-120
		}, 1000, 'easeOutCubic');
		return false;
	});

	//navigation
	$('.menu').on('click', function() {
		if ($('nav').is(':visible')) nav_close();
		else nav_open();
	});

	function nav_open() {
		$('nav').slideDown('400');
		$('.menu a').addClass('red');
	}
	function nav_close() {
		$('nav').slideUp('200');
		$('.menu a').removeClass('red');
	}
</script>

</body>
</html>