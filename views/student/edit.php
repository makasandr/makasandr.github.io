<?php include ROOT . '/views/layouts/header.php'; ?>

<div class="container">
	<form action="/student/edit" enctype="multipart/form-data" method="post">
		<div class="white-block col-xs-12 top-mg-2">
			<p class="size-extra top-mg-1 col-xs-12">Main data:</p>
			<div class="devider col-xs-12 top-mg-1"></div>
			<div class="col-xs-12 col-sm-6 top-mg-2">
				<p class="size-normal up-case bottom-mg-half">Your name</p>
				<input type="text" name="name" class="full-width" value="<?php echo $user_data['name']; ?>" required>
				<?php if (isset($errors['name'])): ?>
					<p class="size-small red up-case top-mg-half">Field can't be empty</p>
				<?php endif ?>

				<p class="size-normal up-case bottom-mg-half top-mg-2">Your surname</p>
				<input type="text" name="surname" class="full-width" value="<?php echo $user_data['surname']; ?>" required>
				<?php if (isset($errors['surname'])): ?>
					<p class="size-small red up-case top-mg-half">Field can't be empty</p>
				<?php endif ?>

				<p class="size-normal up-case bottom-mg-half top-mg-2">Your status</p>
				<input type="text" name="status" class="full-width" value="<?php echo $user_data['status']; ?>" >
			</div>

			<div class="col-xs-12 col-sm-6 col-sm-offset-0 top-mg-2">
				<p class="size-normal up-case bottom-mg-half">Your email</p>
				<input type="text" name="mail" class="full-width" value="<?php echo $user_data['mail']; ?>" required pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,3}$">
				<?php if (isset($errors['mail'])): ?>
					<p class="size-small red up-case top-mg-half">Field can't be empty</p>
				<?php endif ?>

				<p class="size-normal up-case bottom-mg-half top-mg-2">Your phone</p>
				<input type="text" name="phone" class="full-width" value="<?php echo $user_data['phone']; ?>" required pattern="^[0-9\-\+\s\(\)]*$">
				<?php if (isset($errors['phone'])): ?>
					<p class="size-small red up-case top-mg-half">Field can't be empty</p>
				<?php endif ?>

				<p class="size-normal up-case bottom-mg-half top-mg-2">Facebook ID</p>
				<input type="text" name="fb" class="full-width" value="<?php echo $user_data['fb']; ?>">

				<p class="size-normal up-case bottom-mg-half top-mg-2">Instagram ID</p>
				<input type="text" name="instagram" class="full-width" value="<?php echo $user_data['instagram']; ?>">
			</div>
		</div>

		<div class="white-block col-xs-12 top-mg-2">
			<p class="size-extra top-mg-1 col-xs-12">Photos:</p>
			<div class="devider col-xs-12 top-mg-1"></div>
			<div class="col-xs-12 col-sm-6 col-sm-offset-0 top-mg-2">
				<div class="input-mask">
					<p class="size-normal up-case bottom-mg-half bold center">Avatar</p>
					<p class="size-small gray center top-mg-half">Press to select (.jpg, max. 10mb)</p>
				</div>
				<input type="file" name="avatar" accept="image/jpeg" class="input-hidden">
			</div>

			<div class="col-xs-12 col-sm-6 col-sm-offset-0 top-mg-2">
				<div class="input-mask">
					<p class="size-normal up-case bottom-mg-half bold center">Background</p>
					<p class="size-small gray center top-mg-half">Press to select (.jpg, max. 10mb)</p>
				</div>
				<input type="file" name="bg" accept="image/jpeg" class="input-hidden">
			</div>
		</div>

		<div class="white-block col-xs-12 top-mg-2 bottom-mg-1">
			<p class="size-extra top-mg-1 col-xs-12">Tell us about yourself:</p>
			<div class="devider col-xs-12 top-mg-1"></div>
			<div class="col-xs-12 top-mg-2">
				<textarea name="about" class="full-width" style="height: 120px;"><?php echo $about; ?></textarea>
			</div>
		</div>

		<div class="top-mg-1 bottom-mg-2 col-xs-12">
			<input type="submit" name="submit" class="col-xs-12 col-sm-4 col-sm-offset-4 white up-case size-normal" value="Change">
			<?php if (isset($errors['submit'])): ?>
				<p class="size-small red up-case top-mg-half top-mg-half">Sorry, we are having some server issues</p>
			<?php endif ?>
		</div>
	</form>
</div>

<script type="text/javascript">
	$('.input-hidden').on('change', function() {
		$(this).prev().find('.size-small').html('File selected');
		if ($(this).prev().find('.size-small').hasClass('gray')) {
			$(this).prev().find('.size-small').removeClass('gray');
			$(this).prev().find('.size-small').addClass('red');
		}
	});
</script>

<?php include ROOT . '/views/layouts/footer.php'; ?>