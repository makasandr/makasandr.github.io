<?php include ROOT . '/views/layouts/header_login.php'; ?>

<div id="step_in">
	<img class="logo" src="/template/images/logo_white.png" alt="">
	<div class="steps_in">
		<img class="img1" src="/template/images/steps/step1.png" alt="">
		<img class="img2" src="/template/images/steps/step2.png" alt="">
		<img class="img3" src="/template/images/steps/step3.png" alt="">
		<img class="img4" src="/template/images/steps/step4.png" alt="">
		<img class="img5" src="/template/images/steps/step5.png" alt="">
	</div>
	<a href="/main" class="up-case white size-big">Step inside</a>
</div>

<script>
	$('a').hover(function() {
		$('.img1').fadeIn(100, function() {
			$('.img2').fadeIn(100, function() {
				$('.img3').fadeIn(100, function() {
					$('.img4').fadeIn(100, function() {
						$('.img5').fadeIn(100);
					});
				});
			});
		});
	}, function() {
		$('.steps_in img').stop(false, true);
		$('.steps_in img').fadeOut(200);
	});

	$('a').click(function(event) {
		if ($(window).width() < 768) {
			event.preventDefault();
			setTimeout(redirect, 500, $(this).attr('href'));
		} else {
			return;
		}
	});

	function redirect(href) {
		window.location.href = href;
	}
</script>

<?php include ROOT . '/views/layouts/footer_login.php'; ?>