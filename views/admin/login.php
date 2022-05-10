<?php include ROOT . '/views/layouts/header_login.php'; ?>

<div class="login admin cover">
	<div class="window top-pd-4">
		<p class="size-extra gray center top-mg-1"><i class="fa fa-lock"></i></p>
		<p class="size-big up-case red bold center">Administrator panel</p>
		<p class="size-normal bold black center bottom-mg-1">Please enter by admin password</p>

		<form class="center" action="/admin/login" method="post">
		    <input class="size-normal black" type="password" name="pass" value=""/>
		    <input class="left-mg-half size-small white up-case" type="submit" name="submit" value="Enter" />
		    <?php if(isset($errors['pass'])): ?>
		    	<p class="top-mg-1 red size-small bold">Password incorrect!</p>
		    <?php endif; ?>
		</form>
	</div>
</div>

<?php include ROOT . '/views/layouts/footer_login.php'; ?>