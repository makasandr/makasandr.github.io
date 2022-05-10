<?php include ROOT . '/views/layouts/header.php'; ?>

<div class="container">
	<div class="white-block col-xs-12 top-mg-2 bottom-mg-2">
		<div class="col-xs-12">
			<p class="up-case size-small black bold">Edit program "<?php echo $program_data['name']; ?>"</p>
		</div>
		<div class="devider col-xs-12 top-mg-1 bottom-mg-2"></div>
		<form action="/explore/edit/<?php echo $program_id; ?>" method="POST" enctype="multipart/form-data">
			<div class="bottom-mg-2 col-xs-12 col-sm-7">
				<p class="size-big black bottom-mg-half">Name of program:</p>
				<input class="col-xs-12 pd-0 size-normal black bottom-mg-2" type="text" name="name" maxlength="150" placeholder="max. 150 symbols" value="<?php echo $program_data['name']; ?>">
				<p class="size-big black bottom-mg-half">Information about program:</p>
				<textarea placeholder="" name="about" rows="4" class="auto col-xs-12 pd-0 size-normal black"><?php echo $program_data['name']; ?></textarea>
				<div class="col-xs-12 pd-0 top-mg-2">
					<div class="input-mask">
						<p class="size-normal up-case bottom-mg-half bold center">New avatar of program</p>
						<p class="size-small gray center top-mg-half">Press to select (.jpg)</p>
					</div>
					<input type="file" name="avatar" accept="image/jpeg" class="input-hidden">
				</div>
			</div>
			<div class="bottom-mg-2 col-xs-12 col-sm-5 col-sm-offset-0">
				<p class="size-big black bottom-mg-half">Link to promo video:</p>
				<input class="col-xs-12 pd-0 size-normal black bottom-mg-2" type="text" name="promo" maxlength="255" value="<?php echo $program_data['promo']; ?>">
				<p class="size-big black bottom-mg-half">Cost in dollars:</p>
				<input name="cost" class="col-xs-12 pd-0 size-normal black bottom-mg-2" type="number" step="0.01" min="0" max="9999" maxlength="150" placeholder="" value="<?php echo $program_data['cost'] ?>">
				<p class="size-big black bottom-mg-half">Select a level:</p>
				<div class="select-style bottom-mg-2">
					<select name="level" class="col-xs-12 pd-0 level-select bold up-case size-small">
						<option value="1"<?php if ($program_data['level'] == "1") echo " selected"; ?>><?php echo $levels[1] ?></option>
						<option value="2"<?php if ($program_data['level'] == "2") echo " selected"; ?>><?php echo $levels[2] ?></option>
						<option value="3"<?php if ($program_data['level'] == "3") echo " selected"; ?>><?php echo $levels[3] ?></option>
						<option value="4"<?php if ($program_data['level'] == "4") echo " selected"; ?>><?php echo $levels[4] ?></option>
						<option value="5"<?php if ($program_data['level'] == "5") echo " selected"; ?>><?php echo $levels[5] ?></option>
					</select>
				</div>
			</div>
		</form>
	</div>
	<div class="col-xs-12 bottom-mg-2">
		<input class="add-target col-xs-10 col-xs-offset-1 col-md-4 col-md-offset-4 size-big white up-case" type="submit" name="submit" value="Change">
		<?php if ($error): ?>
			<p class="top-mg-1 col-xs-12 center size-small red bold">Error on server, please try again later.</p>
		<?php endif ?>
	</div>
</div>

<script>
	$('.input-hidden').on('change', function() {
		$(this).prev().find('.size-small').html('File selected');
		if ($(this).prev().find('.size-small').hasClass('gray')) {
			$(this).prev().find('.size-small').removeClass('gray');
			$(this).prev().find('.size-small').addClass('red');
		}
	});
</script>

<?php include ROOT . '/views/layouts/footer.php'; ?>