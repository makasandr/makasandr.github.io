<?php include ROOT . '/views/layouts/header.php'; ?>

<div class="container">
	<div class="white-block col-xs-12 top-mg-1 bottom-mg-2">
		<div class="top-mg-1 col-xs-12 col-sm-4">
			<div class="cover square bottom-mg-1" style="background-image: url(<?php echo $avatar; ?>);"></div>
			<div class="center">
				<div class="bottom-mg-2">
					<p class="inline size-normal right-mg-half">by</p>
					<a href="/trainer/<?php echo $trainer_info['id']; ?>" class="page-link bottom-mg-2">
						<div class="inline avatar-min round cover right-mg-half" style="background-image: url(<?php echo $trainer_info['avatar']; ?>);"></div>
						<p class="inline size-normal bold">
							<?php echo $trainer_info['name']; ?> <?php echo $trainer_info['surname']; ?>
						</p>
					</a>
				</div>
				<?php if ($user === 2 && !empty($students_list)): ?>
					<p class="size-small up-case black bottom-mg-half">Recomend program:</p>
					<div class="select-style inline">
						<select class="recomend bold size-small">
							<option value="0">SELECT STUDENT</option>
							<?php foreach ($students_list as $value): ?>
								<option value="<?php echo $value['id']; ?>"><?php echo $value['name']; ?> <?php echo $value['surname']; ?></option>
							<?php endforeach; ?>
						</select>
					</div>
					<p style="display: none;" class="recomend-res size-small bold red up-case top-mg-half">
						<!-- result of recomendation -->
					</p>
				<?php endif; ?>
				<?php if ($user === 2 && $my_program): ?>
					<a class="block size-small bold up-case red top-mg-1" href="/explore/del/<?php echo $program_id; ?>" title="Delete program"><i class=" fa fa-close"></i> delete</a>
				<?php endif; ?>
			</div>
		</div>

		<div class="top-mg-1 col-xs-12 col-sm-8 col-sm-offset-0 col-md-8">
			<div class="col-xs-12">
				<p class="size-extra black inline"><?php echo $program['name']; ?></p>
				<?php if ($user === 2 && $my_program): ?>
					<a class="inline size-big up-case" href="/explore/edit/<?php echo $program_id; ?>" title="Edit program"><i class=" fa fa-edit"></i></a>
				<?php endif; ?>
				<p class="size-normal bold gray">
					<?php echo $levels[$program['level']]; ?>
					<?php if ($user === 1 && intval($my_level) < intval($program['level'])): ?>
						<span class="red left-mg-half"><i class="fa fa-exclamation-triangle"></i> Your level is too low for this program.</span>
						<?php $my_program = 1; ?>
					<?php endif; ?>
				</p>
			</div>
			<div class="devider col-xs-12 top-mg-1 bottom-mg-1"></div>
			<div class="col-xs-12">
				<p class="size-normal black bottom-mg-4"><?php echo $program['about']; ?></p>
				<div class="page-link">
					<div class="col-xs-4">
						<?php if (!empty($program['promo'])): ?>
							<a href="<?php echo $program['promo']; ?>" class="size-normal up-case bold hidden-xs hidden-sm">Watch promo video<i class="fa fa-external-link left-mg-half"></i></a>
							<a href="<?php echo $program['promo']; ?>" class="size-normal up-case bold hidden-md hidden-lg">promo<i class="fa fa-external-link left-mg-half"></i></a>
						<?php endif ?>
					</div>
					<p class="size-normal bottom-mg-half <?php if (!$my_program && $user === 1) echo "col-xs-4"; else echo "col-xs-8"; ?> right"><span class="bold"><?php echo count($program['lessons']); ?> lessons</span> for <span class="bold"><?php echo $program['cost']; ?>$</span></p>
				</div>
				<?php if(!$my_program && $user === 1): ?>
					<a class="col-xs-4 center button size-small up-case white" href="/explore/add/<?php echo $program_id; ?>">Buy</a>
				<?php endif; ?>
			</div>

			<?php if ($program['lessons']): ?>
				<div class="devider col-xs-12 top-mg-1 bottom-mg-1"></div>
				<div class="col-xs-12">
					<p class="size-small up-case">What you will get:</p>
					<?php if($physical): ?>
						<div class="col-xs-10 col-xs-offset-1 col-md-4 col-md-offset-0 top-mg-1">
							<p class="size-big bottom-mg-half">Physical</p>
							<?php foreach ($physical as $value): ?>
								<a href="/explore/?tag=<?php echo $value; ?>" class="bottom-mg-half inline size-normal bold up-case white tag"><?php echo $value; ?></a>
							<?php endforeach ?>
						</div>
					<?php endif; ?>
					<?php if($muscle): ?>
						<div class="col-xs-10 col-xs-offset-1 col-md-4 col-md-offset-0 top-mg-1">
							<p class="size-big bottom-mg-half">Muscle</p>
							<?php foreach ($muscle as $value): ?>
								<a href="/explore/?tag=<?php echo $value; ?>" class="bottom-mg-half inline size-normal bold up-case white tag"><?php echo $value; ?></a>
							<?php endforeach ?>
						</div>
					<?php endif; ?>
					<?php if($skills): ?>
						<div class="col-xs-10 col-xs-offset-1 col-md-4 col-md-offset-0 top-mg-1">
							<p class="size-big bottom-mg-half">Skills</p>
							<?php foreach ($skills as $value): ?>
								<a href="/explore/?tag=<?php echo $value; ?>" class="bottom-mg-half inline size-normal bold up-case white tag"><?php echo $value; ?></a>
							<?php endforeach ?>
						</div>
					<?php endif; ?>
				</div>
			<?php endif ?>
			<div class="devider col-xs-12 top-mg-1 bottom-mg-1"></div>
			<?php if ($user === 1): ?>
				<div class="col-xs-12">
					<form action="/explore/add_comment/<?php echo $program_id; ?>" method="POST">
						<textarea placeholder="Your message" name="message" class="col-xs-8 pd-0 size-normal black"></textarea>
						<input class="add-target pd-0 col-xs-3 col-xs-offset-1 size-small white up-case" type="submit" name="submit" value="Add">
					</form>
				</div>
				<div class="devider col-xs-12 top-mg-1 bottom-mg-1"></div>
			<?php endif ?>
			<div class="col-xs-12">
				<?php if ($comments): ?>
					<?php foreach ($comments as $value): ?>
						<a href="/student/<?php echo $value['user_id']; ?>" class="col-xs-9 page-link bottom-mg-1">
							<div class="inline avatar-min round cover left-mg-half" style="background-image: url(<?php echo $value['avatar']; ?>);"></div>
							<p class="inline size-normal bold left-mg-half">
								<?php echo $value['name']; ?> <?php echo $value['surname']; ?>
							</p>
						</a>
						<div class="col-xs-3 bottom-mg-1 right size-small gray">
							<p class="bold"><?php echo date('H:i', $value['date']); ?></p>
							<p><?php echo date('d.m.Y', $value['date']); ?></p>
						</div>
						<div class="left-pd-2 col-xs-11 bottom-mg-2">
							<p class="size-normal black bold bottom-mg-1"><?php echo $value['message']; ?></p>
						</div>
						<?php if ($user === 1): ?>
							<?php if ($value['user_id'] == $id): ?>
								<div class="col-xs-1 right size-normal">
									<a href="/explore/del_comment/<?php echo $value['id']; ?>"><i class="fa fa-times red"></i></a>
								</div>
							<?php endif ?>
						<?php endif ?>
					<?php endforeach; ?>
				<?php else: ?>
					<p class="size-small up-case red bold center">No messages</p>
				<?php endif; ?>
			</div>
		</div>
	</div>
</div>
<script type="text/javascript">
	$('.recomend').on('change', function() {
		if ($('.recomend').val() != "0") {
			var student = $('.recomend').val();
			$.ajax({
		    	method: "POST",
		    	url: "/explore/recomend/<?php echo $program_id; ?>/"+student,
		    	success: function (data) {
		    		$(".recomend-res").fadeOut(200, function() {
		    			$(".recomend-res").html(data);
		    			$(".recomend-res").fadeIn(400);
		    		});
			    }
			});
		}
	});
</script>

<div class="container">
	<div class="white-block col-xs-12 bottom-mg-2">
		<div class="col-xs-12 top-mg-1">
			<p class="size-small up-case col-xs-6 pd-0">Lessons</p>
			<?php if($user === 2 && $my_program): ?>
				<div class="col-xs-6 right pd-0">
					<a href="/lesson/new_p/<?php echo $program_id; ?>" class="size-small up-case black bold"><p><i class="fa fa-pencil"></i> Add lesson</p></a>
				</div>
			<?php endif; ?>
		</div>

		<div class="devider col-xs-12 top-mg-1 bottom-mg-2"></div>

		<div class="col-xs-12">
			<?php if ($program['lessons']): ?>
				<?php $i = 0; ?>
				<?php foreach ($lessons_data as $video): ?>
					<?php if ($i == 0): ?>
						<div class="col-xs-12"></div>
					<?php endif ?>
					<div class="video pd-0 col-xs-12 col-sm-6 col-sm-offset-0 col-md-4 bottom-mg-2">
						<div class="col-xs-12">
							<div class="video-preview cover" style="background-image: url(<?php echo $video['preview']; ?>);">
								<?php if($user === 2 && $my_program): ?>
									<a class="done" href="/lesson/<?php echo $video['id']; ?>">
										<p class="size-video-icon center white"><i class="fa fa-play"></i></p>
										<p class="up-case white size-small bold center bottom-pd-1"></p>
									</a>
								<?php elseif (!empty($video['promo'])): ?>
									<a class="done" href="<?php echo $video['promo']; ?>">
										<p class="size-video-icon center white"><i class="fa fa-play"></i></p>
										<p class="up-case white size-small bold center bottom-pd-1">Watch promo</p>
									</a>
								<?php endif; ?>
							</div>
						</div>
						<div class="top-mg-1 col-xs-8">
							<p class="size-normal bold black"><?php echo $video['name']; ?></p>
						</div>
						<div class="col-xs-4 right top-mg-1">
							<?php if($user === 2 && $my_program): ?>
								<a title="Edit" href="/lesson/edit_p/<?php echo $video['id']; ?>" class="right-mg-half size-normal"><i class="fa fa-pencil"></i></a>
								<a title="Delete" href="/lesson/del/<?php echo $video['id']; ?>" class="red size-normal"><i class="fa fa-close"></i></a>
							<?php endif; ?>
						</div>
						<div class="col-xs-12">
							<p class="size-small black"><?php echo $video['about']; ?></p>
						</div>
					</div>
					<?php if ($i == 2): ?>
						<?php $i = 0; ?>
					<?php else: ?>
						<?php $i++; ?>
					<?php endif ?>
				<?php endforeach; ?>
			<?php else: ?>
				<p class="red center up-case size-normal">No lessons</p>
			<?php endif; ?>
		</div>
	</div>
</div>
</div>

<?php include ROOT . '/views/layouts/footer.php'; ?>