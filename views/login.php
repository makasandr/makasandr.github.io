<?php include ROOT . '/views/layouts/header_login.php'; ?>

<div class="login cover">
	<div class="window top-pd-1">
		<a href="/main"><i class="size-normal fa fa-close close-btn red"></i></a>
		<div class="center">
			<img src="/template/images/login_logo.png" alt="Lionello Massimo">
		</div>

		<form class="center" action="/login" method="post">
		    <input class="size-normal black top-mg-4 center login-field" type="password" style="width: 270px;" placeholder="Just use your Magic Key" name="uin" value=""/>
		    <a href="" class="contact-open size-normal gray left-mg-half" style=""><i class="fa fa-key" aria-hidden="true"></i></a><br>
		    <?php if(isset($errors['uin'])): ?>
		    	<p class="top-mg-half red size-small bold">There is no such Magic Key</p>
		    <?php endif; ?>
		    <input class="left-mg-half size-small login-btn up-case top-mg-1" style="border: 2px solid #333; width: 100px; display: none;" type="submit" name="submit" value="Enter" />
		</form>
	</div>
</div>
<script>
	$('.login-field').on('input paste', function() {
		if ($(this).val().length) {
			$('.login-field').removeClass('top-mg-4');
			$('.login-field').addClass('top-mg-2');
			$('.login-btn').fadeIn(300);
		} else {
			$('.login-field').removeClass('top-mg-2');
			$('.login-field').addClass('top-mg-4');
			$('.login-btn').fadeOut(300);
		}
	});
</script>

<?php include ROOT . '/views/layouts/footer_login.php'; ?>