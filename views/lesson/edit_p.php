<?php include ROOT . '/views/layouts/header.php'; ?>

<div class="container">
	<div class="white-block col-xs-12 top-mg-2 bottom-mg-2">
		<div class="col-xs-12">
			<p class="up-case size-small black bold">Edit lesson "<?php echo $lesson_data['name']; ?>"</p>
		</div>
		<div class="devider col-xs-12 top-mg-1 bottom-mg-2"></div>
		<form action="/lesson/edit_p/<?php echo $lesson_id; ?>" method="POST" enctype="multipart/form-data">
			<div class="bottom-mg-2 col-xs-12 col-sm-7">
				<p class="size-big black bottom-mg-half">Name of lesson:</p>
				<input class="col-xs-12 pd-0 size-normal black bottom-mg-2" type="text" name="name" maxlength="150" placeholder="max. 150 symbols" value="<?php echo $lesson_data['name']; ?>">
				<p class="size-big black bottom-mg-half">Information about lesson:</p>
				<textarea placeholder="" name="about" rows="4" class="auto col-xs-12 pd-0 size-normal black bottom-mg-2"><?php echo $lesson_data['about']; ?></textarea>
				<p class="size-big black bottom-mg-half">Tasks:</p>
				<?php foreach ($tasks_view as $key => $value): ?>
					<input class="col-xs-8 pd-0 size-normal black bottom-mg-1" type="text" name="tasks[]" maxlength="150" placeholder="max. 150 symbols" value="<?php echo $value['task']; ?>">
					<div class="col-xs-4">
						<input type="checkbox" name="secondary_<?php echo $key; ?>" class="top-mg-0" <?php if(!$value['primary']) echo 'checked'; ?>><p class="left-mg-half inline size-small up-case black bottom-pd-half">secondary</p>
					</div>
				<?php endforeach ?>
				<div class="col-xs-12">
					<a href="" class="size-big black add-task"><i class="fa fa-plus right-mg-half gray"></i>Add task</a>
				</div>
			</div>
			<div class="bottom-mg-2 col-xs-12 col-sm-5 col-sm-offset-0">
				<p class="size-big black bottom-mg-half">Link to promo video:</p>
				<input class="col-xs-12 pd-0 size-normal black bottom-mg-2" type="text" name="promo" maxlength="255" value="<?php echo $lesson_data['promo']; ?>">
				<p class="size-big black bottom-mg-half">Tags</p>
				<p class="size-normal up-case black bottom-mg-half">Physical:</p>
				<input class="col-xs-12 pd-0 size-normal black bottom-mg-2" type="text" name="physical" placeholder="separate by commas" value="<?php echo $physical_view; ?>">
				<p class="size-normal up-case black bottom-mg-half">Muscle:</p>
				<input class="col-xs-12 pd-0 size-normal black bottom-mg-2" type="text" name="muscle" placeholder="separate by commas" value="<?php echo $muscle_view; ?>">
				<p class="size-normal up-case black bottom-mg-half">Skills:</p>
				<input class="col-xs-12 pd-0 size-normal black bottom-mg-2" type="text" name="skills" placeholder="separate by commas" value="<?php echo $skills_view; ?>">

				<div class="col-xs-12 pd-0 bottom-mg-2">
					<div class="input-mask">
						<p class="size-normal up-case bottom-mg-half bold center">Cover image</p>
						<p class="size-small gray center top-mg-half">Press to select (.jpg)</p>
					</div>
					<input type="file" name="cover" accept="image/jpeg" class="input-hidden">
				</div>

				<div class="col-xs-12 pd-0 bottom-mg-2">
					<div class="input-mask">
						<p class="size-normal up-case bottom-mg-half bold center">Video</p>
						<p class="size-small gray center top-mg-half">Press to select (.mp4)</p>
					</div>
					<input type="file" name="video" accept="video/mp4" class="input-hidden">
				</div>
			</div>
		</form>
	</div>
	<div class="col-xs-12 bottom-mg-2">
		<input class="add-target col-xs-10 col-xs-offset-1 col-md-4 col-md-offset-4 size-big white up-case" type="submit" name="submit" value="Edit">
		<?php if (isset($errors['submit'])): ?>
			<p class="top-mg-1 col-xs-12 center size-small red bold">Error on server, please try again later.</p>
		<?php endif ?>
		<?php if (isset($errors['upload'])): ?>
			<p class="top-mg-1 col-xs-12 center size-small red bold">Error when uploading files, please check files or try again later.</p>
		<?php endif ?>
	</div>
</div>

<script>
	$('.add-task').click(function(event) {
		$(this).parent().before('<input class="col-xs-8 pd-0 size-normal black bottom-mg-1" type="text" name="tasks[]" maxlength="150" placeholder="max. 150 symbols"><div class="col-xs-4"><input type="checkbox" name="secondary_'+$('.top-mg-0').length+'" class="top-mg-0"><p class="left-mg-half inline size-small up-case black bottom-pd-half">secondary</p></div>');
		return false;
	});

	$('.input-hidden').on('change', function() {
		$(this).prev().find('.size-small').html('File selected');
		if ($(this).prev().find('.size-small').hasClass('gray')) {
			$(this).prev().find('.size-small').removeClass('gray');
			$(this).prev().find('.size-small').addClass('red');
		}
	});
</script>

<?php include ROOT . '/views/layouts/footer.php'; ?>