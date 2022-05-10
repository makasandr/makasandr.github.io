<?php include ROOT . '/views/layouts/header.php'; ?>

<div class="container top-pd-2">
	<div class="col-xs-12 col-sm-6 col-1">
		<div class="white-block col-xs-12 bottom-mg-2">
			<div class="col-xs-12">
				<p class="size-big bold black"><?php echo $lesson_data['name']; ?></p>
				<a href="/trainer/<?php echo $author['id']; ?>" class="size-small up-case bottom-mg-1 block">by <?php echo $author['name'].' '.$author['surname']; ?></a>
				<p class="size-normal bold"><?php echo $lesson_data['about']; ?></p>
			</div>
			
			<div class="devider col-xs-12 top-mg-1 bottom-mg-1"></div>

			<div class="col-xs-12">
				<?php if($tasks_data): ?>
					<p class="size-small up-case bottom-mg-1">Tasks list:</p>
					<?php $i = 1; ?>
					<?php foreach ($tasks as $task): ?>
						<?php if (!$task['secondary']): ?>
							<p class="size-normal bold"><?php echo $i; ?>. <?php echo $task['target']; ?></p>
							<?php $i++; ?>
						<?php endif; ?>
					<?php endforeach; ?>
					<div class="gray-line top-mg-1 bottom-mg-1"></div>
					<?php foreach ($tasks as $task): ?>
						<?php if ($task['secondary']): ?>
							<p class="size-normal bottom-mg-half"><?php echo $i; ?>. <?php echo $task['target']; ?></p>
							<?php $i++; ?>
						<?php endif; ?>
					<?php endforeach; ?>
				<?php endif; ?>
			</div>

			<div class="devider col-xs-12 top-mg-1 bottom-mg-1"></div>

			<div class="col-xs-12">
				<div class="hidden-sm hidden-xs">
					<p class="size-small up-case">What you will get:</p>
					<?php if($physical): ?>
						<div class="col-xs-12 col-md-4 pd-0 top-mg-half">
							<p class="size-big bottom-mg-half">Physical</p>
							<?php foreach ($physical as $value): ?>
								<a href="/explore/?tag=<?php echo $value; ?>" class="bottom-mg-half inline size-normal bold up-case white tag"><?php echo $value; ?></a>
							<?php endforeach ?>
						</div>
					<?php endif; ?>
					<?php if($muscle): ?>
						<div class="col-xs-12 col-md-4 pd-0 top-mg-half">
							<p class="size-big bottom-mg-half">Muscle</p>
							<?php foreach ($muscle as $value): ?>
								<a href="/explore/?tag=<?php echo $value; ?>" class="bottom-mg-half inline size-normal bold up-case white tag"><?php echo $value; ?></a>
							<?php endforeach ?>
						</div>
					<?php endif; ?>
					<?php if($skills): ?>
						<div class="col-xs-12 col-md-4 pd-0 top-mg-half">
							<p class="size-big bottom-mg-half">Skills</p>
							<?php foreach ($skills as $value): ?>
								<a href="/explore/?tag=<?php echo $value; ?>" class="bottom-mg-half inline size-normal bold up-case white tag"><?php echo $value; ?></a>
							<?php endforeach ?>
						</div>
					<?php endif; ?>
				</div>
			</div>
		</div>
	</div>
	<div class="col-xs-12 col-sm-6 col-2">
		<div class="white-block col-xs-12 bottom-mg-2">
			<div class="col-xs-12">
				<?php if($video): ?>
					<?php if (!$ldone): ?>
						<video width="100%">
						  <source src="<?php echo $video; ?>" type="video/mp4">
						  <p class="center bottom-mg-1 size-small up-case red bold top-mg-4">Player not supported</p>
						  <a class="center button size-small up-case white col-xs-10 col-xs-offset-1 col-md-6 col-md-offset-3" href="<?php echo $video; ?>">Download video</a>
						</video>
						<div id="video">
							<div class="video-cover">
								<div class="center-icon size-extra white center"><i class="fa fa-play"></i></div>
								<div class="right-bottom-icon size-big white right-pd-1 bottom-pd-half"><i class="fa fa-expand"></i></div>
								<div style="opacity: 0;" class="left-bottom-icon size-big white left-pd-1 bottom-pd-half"><i class="fa fa-pause"></i></div>
							</div>
						</div>
					<?php else: ?>
						<video width="100%" controls>
							<source src="<?php echo $video; ?>" type="video/mp4">
							<p class="center bottom-mg-1 size-small up-case red bold top-mg-4">Player not supported</p>
							<a class="center button size-small up-case white col-xs-10 col-xs-offset-1 col-md-6 col-md-offset-3" href="<?php echo $video; ?>">Download video</a>
						</video>
					<?php endif ?>
				<?php else: ?>
					<p class="top-mg-4 center size-big red up-case">No video</p>
				<?php endif; ?>
			</div>

			<div class="devider col-xs-12 top-mg-1 bottom-mg-1 hidden-md hidden-lg"></div>

			<div class="col-xs-12">
				<div class="hidden-md hidden-lg">
					<p class="size-small up-case">What you will get:</p>
					<?php if($physical): ?>
						<div class="col-xs-12 col-md-4 pd-0 top-mg-half">
							<p class="size-big bottom-mg-half">Physical</p>
							<?php foreach ($physical as $value): ?>
								<a href="/explore/?tag=<?php echo $value; ?>" class="bottom-mg-half inline size-normal bold up-case white tag"><?php echo $value; ?></a>
							<?php endforeach ?>
						</div>
					<?php endif; ?>
					<?php if($muscle): ?>
						<div class="col-xs-12 col-md-4 pd-0 top-mg-half">
							<p class="size-big bottom-mg-half">Muscle</p>
							<?php foreach ($muscle as $value): ?>
								<a href="/explore/?tag=<?php echo $value; ?>" class="bottom-mg-half inline size-normal bold up-case white tag"><?php echo $value; ?></a>
							<?php endforeach ?>
						</div>
					<?php endif; ?>
					<?php if($skills): ?>
						<div class="col-xs-12 col-md-4 pd-0 top-mg-half">
							<p class="size-big bottom-mg-half">Skills</p>
							<?php foreach ($skills as $value): ?>
								<a href="/explore/?tag=<?php echo $value; ?>" class="bottom-mg-half inline size-normal bold up-case white tag"><?php echo $value; ?></a>
							<?php endforeach ?>
						</div>
					<?php endif; ?>
				</div>
			</div>

			<div class="devider col-xs-12 top-mg-1 bottom-mg-1"></div>

			<div class="col-xs-12">
				<p class="size-small up-case bottom-mg-1">Comments</p>
				<form action="/lesson/add_comment/<?php echo $lesson; ?>" method="POST">
					<?php if ($user === 1): ?>
						<textarea placeholder="Your message" name="message" class="col-xs-8 pd-0 size-normal black"></textarea>
						<input class="add-target pd-0 col-xs-3 col-xs-offset-1 size-small white up-case" type="submit" name="submit" value="Add">
					<?php else: ?>
						<p class="size-small bottom-mg-half">Choose student:</p>
						<div class="select-style bottom-mg-1">
							<select name="student" id="students" class="col-xs-12">
								<?php foreach ($students_info as $student): ?>
									<option value="<?php echo $student['id']; ?>"><?php echo $student['name'].' '.$student['surname']; ?></option>
								<?php endforeach ?>
							</select>
						</div>
						<textarea placeholder="Your message" name="message" class="col-xs-8 pd-0 size-normal black"></textarea>
						<input class="add-target pd-0 col-xs-3 col-xs-offset-1 size-small white up-case" type="submit" name="submit" value="Add">
					<?php endif ?>
				</form>
			</div>

			<div class="devider col-xs-12 top-mg-1 bottom-mg-1"></div>

			<div class="col-xs-12 pd-0">
				<?php if ($user === 1): ?>
					<?php if ($comments): ?>
						<?php foreach ($comments as $value): ?>
							<a href="/<?php if ($value['type']) echo "trainer"; else echo "student";?>/<?php echo $value['user_id']; ?>" class="col-xs-9 page-link bottom-mg-1">
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
							<?php if (!$value['type']): ?>
								<div class="col-xs-1 right size-normal">
									<a href="/lesson/del_comment/<?php echo $value['id']; ?>"><i class="fa fa-times red"></i></a>
								</div>
							<?php endif ?>
						<?php endforeach; ?>
					<?php else: ?>
						<p class="size-small up-case red bold center">No messages</p>
					<?php endif; ?>
				<?php else: ?>
					<div id="comments_load"></div>
				<?php endif ?>
			</div>
		</div>
	</div>
</div>
<script type="text/javascript">
	<?php if ($user == 2): ?>
		var student = <?php echo $students_info[0]['id']; ?>;
		function load_comments() {
			$.ajax({
				type: 'POST',
				url: '/lesson/comments/'+<?php echo $lesson; ?>+'/'+student,
				dataType: 'html',
				success: function(data) {
					$('#comments_load').fadeOut(200, function() {
						$('#comments_load').html(data);
						$('#comments_load').fadeIn(400, function() {
							col_2_height = $('.col-2').outerHeight(true) - parseInt($('.col-2').css('padding-top'));
						});
					});
				}
			});
		}

		$(document).ready(function() {
			load_comments();
		});

		$('#students').change(function(event) {
			student = $(this).val();
			load_comments();
		});
	<?php endif ?>

	$('video').on('canplay', function() {
		$('.video-cover').css('height', $('video').height()+'px');
	});
	$(window).on('resize', function() {
		$('.video-cover').css('height', $('video').height()+'px');
	});

	$('.center-icon').on('click', function() {
		if($('video')[0].paused) {
			$('video')[0].play();
			if ($('.center-icon').css('opacity') == "1") {
				$('.video-cover').css('background-color', 'rgba(0,0,0,0)');
				$('.center-icon').css('opacity', '0');
				$('.left-bottom-icon').css('opacity', '1');
			}
		}
	});

	$('video').on('ended', function() {
		$('.center-icon i').removeClass('fa-play');
		$('.center-icon i').addClass('fa-refresh');
		$('.video-cover').css('background-color', 'rgba(0,0,0,.8)');
		$('.center-icon').css('opacity', '1');
		$('.left-bottom-icon').css('opacity', '0');
		$.ajax({
	    	method: "POST",
	    	url: "/lesson/done/<?php echo $lesson; ?>"
		});
	});

	$('.left-bottom-icon').on('click', function() {
	    if($('video')[0].paused) {
	        $('video')[0].play();
	        $('.left-bottom-icon i').removeClass('fa-play');
	        $('.left-bottom-icon i').addClass('fa-pause');
	    }
	    else {
	        $('video')[0].pause();
	        $('.left-bottom-icon i').removeClass('fa-pause');
	        $('.left-bottom-icon i').addClass('fa-play');
	    }
	    return false;
	});

	$('.right-bottom-icon').on('click', function() {
	    if($('video').hasClass('full-screen')) {
	        $('video').removeClass('full-screen');
	        $('video').css('height', 'auto');
	        $('.video-cover').removeClass('full-screen');
	        $('.right-bottom-icon i').removeClass('fa-compress');
	        $('.right-bottom-icon i').addClass('fa-expand');
	    }
	    else {
	        $('video').addClass('full-screen');
	        $('video').css('height', $(window).height()+'px');
	        $('.video-cover').addClass('full-screen');
	        $('.right-bottom-icon i').addClass('fa-compress');
	        $('.right-bottom-icon i').removeClass('fa-expand');
	    }
	    $('.video-cover').css('height', $('video').height()+'px');
	    return false;
	});
</script>
<script type="text/javascript" src="/template/js/design.js"></script>

<?php include ROOT . '/views/layouts/footer.php'; ?>