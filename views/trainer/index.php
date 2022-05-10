<?php include ROOT . '/views/layouts/header.php'; ?>

<div class="container-fluid">
	<div class="bg cover col-xs-12 pd-0" style="background-image: url(<?php echo $user_data['bg']; ?>);">
		<div class="bg-fade"></div>
	</div>
</div>
<div class="container">
	<div class="row">
		<div class="col-xs-12">
			<div class="col-xs-6 col-xs-offset-3 col-sm-4 col-sm-offset-4 col-md-3 col-md-offset-5 avatar-cover">
				<div class="avatar cover round" style="background-image: url(<?php echo $user_data['avatar']; ?>);"></div>
			</div>
		</div>

		<div class="col-1 col-xs-12 col-sm-8">
			<div id="main_data" class="bottom-mg-2 col-xs-12 white-block">
				<div class="col-xs-12">
					<?php if ($rating): ?>
						<!-- <p class="size-small bold red"><?php echo $rating; ?> star<?php if ($rating != 1) echo "s"; ?> trainer</p> -->
						<?php for ($i=1; $i < 6; $i++): ?>
							<?php if ($i <= intval($rating)): ?>
								<i style="line-height: 20px;" class="fa fa-star red<?php if ($i != 1) echo " left-mg-half"; ?>"></i>
							<?php else: ?>
								<i style="line-height: 20px;" class="fa fa-star-o gray left-mg-half"></i>
							<?php endif ?>
						<?php endfor ?>
					<?php endif ?>
					<br>
					<p class="inline size-extra black"><?php echo $user_data['name']; ?> <?php echo $user_data['surname']; ?></p>
					<?php if ($user === 2): ?>
						<a class="inline size-big up-case" href="/trainer/edit" title="Edit profile"><i class=" fa fa-edit"></i></a>
					<?php endif ?>
					<p class="size-normal bold gray"><?php echo $user_data['status']; ?></p>
					<?php if ($user === 1 && !$is_trainer): ?>
						<a href="/trainer/add/<?php echo $id; ?>" class="subscribe-btn block top-mg-1 size-normal bold up-case"><i class="fa fa-credit-card"></i> Subscribe for <?php echo $user_data['price']; ?>$</a>
					<?php endif; ?>
				</div>

				<div class="devider top-mg-1 bottom-mg-1 col-xs-12"></div>

				<div class="bottom-mg-1 fade-trigger col-xs-12">
					<p class="col-xs-11 pd-0 up-case size-small black">About me</p>
					<p class="right col-xs-1 pd-0 size-normal hidden-sm hidden-md hidden-lg"><i class="fade-arrow fa fa-chevron-right" aria-hidden="true"></i></p>
				</div>
				<div class="fade-content col-xs-12">
					<?php if (!empty($about)): ?>
						<p class="size-normal bottom-mg-half"><?php echo $about; ?></p>
					<?php else: ?>
						<p class="red bold up-case size-small center">No info</p>
					<?php endif; ?>
				</div>
			</div>

			<script type="text/javascript" src="/template/js/sly.min.js"></script>
			<div id="trainer_gallery" class="white-block bottom-mg-2 col-xs-12">
				<?php if ($photos): ?>
					<div class="col-xs-12 frame bottom-mg-1">
						<ul class="slidee">
							<?php foreach ($photos as $photo): ?>
								<li class="photo-cover" load="<?php echo $photo['id']; ?>">
									<div class="col-xs-12 pd-0" style="height: 100%;">
										<div load="<?php echo $photo['id']; ?>" class="open-photo cover" style="background-image: url(/upload/images/galleries/<?php echo $photo['id']; ?>_p.jpg);">
											<div class="col-xs-12 pd-0 photo-info hidden-xs">
												<p class="white col-xs-12 center size-normal bottom-mg-1"><?php echo $photo['about']; ?></p>
												<div class="col-xs-8 bottom-mg-1">
													<p class="white bold size-small"><?php echo date('d.m.Y', $photo['date']); ?></p>
												</div>
												<div class="col-xs-4 bottom-mg-1 right size-small">
													<?php if ($my_page): ?>
														<a href="" title="Delete" class="white del-photo size-small" load="<?php echo $photo['id']; ?>"><i class="fa fa-trash"></i></a>
													<?php endif ?>
												</div>
											</div>
										</div>
									</div>
									<div style="width: 30px;"></div>
								</li>
							<?php endforeach ?>
						</ul>
					</div>
				<?php endif ?>
				<?php if ($my_page): ?>
					<div class="col-xs-12 right top-pd-1">
						<a href="" class="upl right top-mg-1 size-small up-case"><i class="fa fa-upload"></i> Upload photo</a>
					</div>
				<?php endif ?>

				<div class="dark-bg photo-upl" style="z-index: 999; display: none;">
					<div class="contact-window center top-pd-1">
						<a href="" class="close-btn size-big"><i class="fa fa-times"></i></a>
						<form action="/trainer/photo/<?php echo $id; ?>" class="top-mg-4" enctype="multipart/form-data" method="post">
							<div class="col-xs-10 col-xs-offset-1 bottom-mg-2">
								<div class="input-mask">
									<p class="size-normal up-case bottom-mg-half bold center">Photo</p>
									<p class="size-small gray center top-mg-half">Press to select</p>
								</div>
								<input type="file" name="photo" class="input-hidden">
							</div>
							<div class="col-xs-10 col-xs-offset-1">
								<textarea style="width: 100%; height: 100px;" maxlength="128" placeholder="Description" name="about" class="bottom-mg-1 center black message-field"></textarea>
							</div>
							<input type="hidden" name="type" class="upl-type" value="">
							<input type="submit" name="submit" class="button size-small up-case white col-xs-4 col-xs-offset-4" value="Submit">
						</form>
					</div>
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

				var options = {
					horizontal: 1,
					itemNav: 'basic',
					speed: 300,
					mouseDragging: 1,
					touchDragging: 1,
					scrollBy: 1,
				};
				$('#trainer_gallery .frame').sly(options);

				$('#trainer_gallery .upl').click(upload_call);
				$('#trainer_gallery .close-btn').click(upload_hide);

				function upload_call() {
					$('.dark-bg.photo-upl').fadeIn(400);
					$('.contact-window').css({
						marginTop: '-200px',
						opacity: '1'
					});
					$('header').css('display', 'none');
					return false;
				}
				function upload_hide() {
					setTimeout(window_close_photo_upl, 500);
					$('.contact-window').css({
						marginTop: '-250px',
						opacity: '0'
					});
					return false;
				}
				function window_close_photo_upl() {
					$('.dark-bg.photo-upl').fadeOut(200, function() {
						$('.contact-window').css('margin-top', '-50px');
						$('.contact-result').css('display', 'none');
						$('.contact-form').fadeIn(0);
					});
					$('header').css('display', 'block');
					return false;
				}

				$('#trainer_gallery .del-photo').click(function(event) {
					var photo = $(this).attr('load');

					$.ajax({
						type: 'POST',
						url: '/trainer/del_photo/'+photo,
						dataType: 'html',
						success: function(data) {
							$(".photo-cover[load="+photo+"]").fadeOut('300', function() {
								$(this).remove();
							});
						}
					});
					return false;
				});

				$('#trainer_gallery .open-photo').click(function(event) {
					var photo = $(this).attr('load');

					$.ajax({
						type: 'POST',
						url: '/trainer/view_photo/'+photo,
						dataType: 'html',
						success: function(data) {
							$("#trainer_gallery").after(data);
							$('.dark-bg.photo-view').fadeIn(400);
							$('.dark-bg.photo-view img').load(function() {
								if ($('.dark-bg.photo-view .window').width() < $('.dark-bg.photo-view img').width()) {
									$('.dark-bg.photo-view img').css({
										width: '100%',
										height: 'auto'
									});
									set = true;
								}
							});
							$('body').css('overflow', 'hidden');
							$('header').css('display', 'none');
						}
					});
					return false;
				});
			</script>

			<div id="my_programs" class="white-block col-xs-12 bottom-mg-2">
				<div class="col-xs-12">
					<div class="bottom-pd-1">
						<p class="size-small up-case col-xs-6 pd-0">Created programs</p>
						<?php if($my_page): ?>
							<div class="col-xs-6 right pd-0">
								<a href="/explore/new" class="size-small up-case black bold"><p><i class="fa fa-pencil"></i> New program</p></a>
							</div>
						<?php endif; ?>
					</div>
				</div>

				<div class="devider col-xs-12 top-mg-1 bottom-mg-1"></div>

				<div class="col-xs-12">
					<?php if ($programs): ?>
						<?php $i = 0; ?>
						<?php foreach ($programs as $program): ?>
							<?php if ($i == 0): ?>
								<div class="col-xs-12"></div>
							<?php endif ?>
							<a href="/explore/program/<?php echo $program['id']; ?>" class="program col-xs-12 col-md-6">
								<div class="col-xs-4 bottom-mg-2">
									<div class="cover square bottom-mg-half" style="background-image: url(<?php echo $program['avatar']; ?>);"></div>
								</div>
								<div class="col-xs-8 bottom-mg-2">
									<p class="name size-big black bottom-mg-1"><?php echo $program['name']; ?></p>
									<p class="size-normal gray"><?php echo $program['short_about']; ?></p>
								</div>
							</a>
							<?php if ($i == 2): ?>
								<?php $i = 0; ?>
							<?php else: ?>
								<?php $i++; ?>
							<?php endif ?>
						<?php endforeach; ?>
					<?php else: ?>
						<p class="bottom-mg-2 center bold size-small up-case red">No programs</p>
					<?php endif; ?>
				</div>
			</div>

			<?php if($my_page): ?>
				<div id="personal" class="white-block col-xs-12 bottom-mg-2">
					<div class="col-xs-12">
						<div class="bottom-pd-1">
							<p class="size-small up-case col-xs-12 pd-0">Private lessons</p>
						</div>
					</div>

					<div class="devider col-xs-12 top-mg-1 bottom-mg-1"></div>

					<div class="col-xs-12">
						<div class="col-xs-12 left pd-0 bottom-mg-2">
							<div class="col-xs-12 pd-0 col-md-4 top-mg-1">
								<div class="select-style">
									<select id="personal_students" class="col-xs-12">
										<?php foreach ($students_info as $student): ?>
											<option value="<?php echo $student['id']; ?>"><?php echo $student['name'].' '.$student['surname']; ?></option>
										<?php endforeach ?>
									</select>
								</div>
							</div>
							<div class="col-xs-12 pd-0 col-md-4 col-md-offset-4 top-mg-1 right">
								<a id="ps_link" href="/lesson/new/0/<?php echo $students_info[0]['id']; ?>" class="size-small up-case bold black"><i class="fa fa-pencil"></i> Add private lesson</a>
							</div>
						</div>

						<div id="personal_videos" class="row">
							<!-- lessons here -->
						</div>
					</div>
				</div>

				<script type="text/javascript">
					$(document).ready(function() {
						$.ajax({
							type: "POST",
							url: "/trainer/personal/"+<?php echo $students_info[0]['id']; ?>,
							success: function (data) {
								$("#personal_videos").html(data);
							}
						});
					});
					
					$('#personal_students').on('change', function() {
						var student_load = $(this).val();
						$('#ps_link').attr('href', '/lesson/new/0/'+student_load);
						$.post("/trainer/personal/"+student_load, function (data) {
							$("#personal_videos").slideUp(400, function() {
								$("#personal_videos").html(data);
								$("#personal_videos").slideDown(400);
							});
						});
					});
				</script>
			<?php endif ?>

			<div id="blog" class="white-block col-xs-12 bottom-mg-2">
				<div class="col-xs-12 top-mg-1">
					<a href="" class="blogs-btn mw-triger size-small bold up-case red right-mg-2">
						<i class="size-normal fa fa-comments-o right-mg-half"></i>Blogs
					</a>
					<a href="" class="reviews-btn mw-triger size-small bold up-case right-mg-2">
						<i class="size-normal fa fa fa-star right-mg-half"></i>Reviews
					</a>
					<?php if ($my_page): ?>
						<a href="" class="private-btn mw-triger size-small bold up-case right-mg-2">
							<i class="size-normal fa fa-comment-o right-mg-half bottom-mg-half"></i>Private
						</a>
						<a href="" class="notes-btn mw-triger size-small bold up-case">
							<i class="size-normal fa fa-sticky-note-o right-mg-half"></i>Notes
						</a>
					<?php endif; ?>
				</div>

				<div class="devider col-xs-12 top-mg-1 bottom-mg-2"></div>

				<div id="blogs" class="col-xs-12 pd-0 messages-window">
					<?php if ($my_page): ?>
						<form method="POST" enctype="multipart/form-data" class="col-xs-12" action="/trainer/newblog">
							<div class="col-xs-8 pd-0">
								<textarea placeholder="Your message" name="message" class="private-message col-xs-12 pd-0 size-normal black"></textarea>
								<p class="col-xs-12 pd-0 size-normal top-mg-half gray" style="height: 30px;"><i class="fa fa-plus right-mg-half" aria-hidden="true"></i>Select images</p>
								<input type="file" name="images[]" multiple style="opacity: 0; margin-top: -30px; height: 30px;" class="col-xs-12 pd-0 images-select">
							</div>
							<input class="add-target pd-0 col-xs-3 col-xs-offset-1 size-small white up-case" type="submit" name="submit" value="Add">
						</form>
					<?php endif; ?>
					<div class="devider col-xs-12 top-mg-2 bottom-mg-1"></div>
					<?php if (!empty($blog)): ?>
						<?php foreach ($blog as $value): ?>
							<?php if (isset($value['trainer'])): ?>
									<a href="/trainer/<?php echo $value['trainer']; ?>" class="col-xs-8 page-link bottom-mg-1">
								<?php else: ?>
									<a href="/student/<?php echo $value['student']; ?>" class="col-xs-8 page-link bottom-mg-1">
								<?php endif; ?>
									<div class="inline avatar-min round cover left-mg-half" style="background-image: url(<?php echo $value['avatar']; ?>);"></div>
									<p class="inline size-normal bold left-mg-half">
										<?php echo $value['name']; ?> <?php echo $value['surname']; ?>
									</p>
								</a>
								<div class="col-xs-3 bottom-mg-1 right size-small gray">
									<p class="bold"><?php echo date('H:i', $value['date']); ?></p>
									<p><?php echo date('d.m.Y', $value['date']); ?></p>
								</div>
								<?php if (isset($value['trainer']) && $value['trainer'] == $id): ?>
									<a href="/trainer/delblog/<?php echo $value['id']; ?>" class="right col-xs-1 red size-normal"><i class="fa fa-close"></i></a>
								<?php endif ?>
								<div class="left-pd-2 col-xs-12 bottom-mg-2">
									<p class="message size-normal black bold bottom-mg-1"><?php echo $value['message']; ?></p>
									<div class="col-xs-12 pd-0 top-mg-1">
										<?php foreach ($value['images'] as $image): ?>
											<a target="_blank" href="/upload/images/blogs/<?php echo $image; ?>.jpg" class="inline right-mg-half" style="height: 100px;">
												<img src="/upload/images/blogs/<?php echo $image; ?>_p.jpg" height="100%" width="auto">
											</a>
										<?php endforeach ?>
									</div>
								</div>
						<?php endforeach; ?>
					<?php else: ?>
						<p class="size-small up-case red bold center">No new posts for the last time</p>
					<?php endif; ?>
				</div>

				<div id="reviews" style="display: none;" class="col-xs-12 pd-0 messages-window">
					<?php if (!$my_page && !Review::checkReview($student)): ?>
						<form method="POST" class="col-xs-12" action="/trainer/newreview/<?php echo $id; ?>">
							<div class="col-xs-12 col-sm-6">
								<textarea style="width: 100%;" placeholder="Your review" name="review" class="size-normal black"></textarea>
							</div>
							<div class="hidden-sm hidden-md hidden-lg top-mg-1 col-xs-12"></div>
							<div class="col-xs-6 col-sm-3">
								<div class="select-style">
									<select name="stars" class="size-normal black col-xs-12 pd-0">
										<option value="1">1 star</option>
										<option value="2">2 stars</option>
										<option value="3">3 stars</option>
										<option value="4">4 stars</option>
										<option value="5" selected>5 stars</option>
									</select>
								</div>
							</div>
							<div class="col-xs-6 col-sm-3">
								<input style="width: 100%;" class="size-small white up-case" type="submit" name="submit" value="Add">
							</div>
						</form>
						<div class="devider col-xs-12 top-mg-2 bottom-mg-1"></div>
					<?php endif; ?>
					<?php if (!empty($reviews)): ?>
						<?php foreach ($reviews as $value): ?>
							<a href="/student/<?php echo $value['student']; ?>" class="col-xs-8 page-link bottom-mg-1">
								<div class="inline avatar-min round cover left-mg-half" style="background-image: url(<?php echo $value['avatar']; ?>);"></div>
								<div class="inline">
									<p class="size-normal bold left-mg-half" style="line-height: 20px;">
										<?php echo $value['name']; ?> <?php echo $value['surname']; ?>
									</p>
									<div class="size-normal left-mg-half">
										<?php for ($i=1; $i < 6; $i++): ?>
											<?php if ($i <= intval($value['rating'])): ?>
												<i style="line-height: 20px;" class="fa fa-star red<?php if ($i != 1) echo " left-mg-half"; ?>"></i>
											<?php else: ?>
												<i style="line-height: 20px;" class="fa fa-star-o gray left-mg-half"></i>
											<?php endif ?>
										<?php endfor ?>
									</div>
								</div>
							</a>
							<div class="col-xs-3 bottom-mg-1 right size-small gray">
								<p class="bold"><?php echo date('H:i', $value['date']); ?></p>
								<p><?php echo date('d.m.Y', $value['date']); ?></p>
							</div>
							<?php if (!$my_page && $value['student'] == $student): ?>
								<a href="/trainer/delreview/<?php echo $value['id']; ?>" class="col-xs-1 red size-normal bottom-mg-1"><i class="fa fa-close"></i></a>
							<?php endif; ?>
							<?php if (!empty($value['review'])): ?>
								<div class="left-pd-2 col-xs-12 bottom-mg-2">
									<p class="size-normal black bold bottom-mg-1"><?php echo $value['review']; ?></p>
								</div>
							<?php endif ?>
						<?php endforeach; ?>
					<?php else: ?>
						<p class="size-small up-case red bold center">No reviews</p>
					<?php endif; ?>
				</div>

				<?php if ($my_page): ?>
					<div id="private" style="display: none;" class="col-xs-12 pd-0 messages-window">
						<form method="POST" enctype="multipart/form-data" class="col-xs-12" action="/trainer/newpriv">
							<div class="col-xs-12 col-md-7 bottom-mg-1 pd-0">
								<a href="" class="st-list-triger block up-case size-small bold"><i class="right-mg-half fa fa-caret-down"></i> Choose student</a>
								<div style="display: none;">
									<?php $i = 0; ?>
									<?php foreach ($students_info as $student): ?>
										<a href="/student/<?php echo $student['id']; ?>" class="col-xs-10 pd-0 top-mg-half page-link">
											<div class="inline avatar-min round cover right-mg-half" style="background-image: url(<?php echo $student['avatar']; ?>);"></div>
											<p class="inline size-normal bold">
												<?php echo $student['name']; ?> <?php echo $student['surname']; ?>
											</p>
										</a>
										<input class="student-to col-xs-2 pd-0" type="radio" name="student" value="<?php echo $student['id']; ?>" <?php if(!$i) echo "checked"; ?>>
										<?php $i++; ?>
									<?php endforeach ?>
								</div>
							</div>
							<div class="col-xs-12 col-md-5 bottom-mg-1 pd-0 right">
								<input type="checkbox" name="conf">
								<p class="size-small right-mg-half inline up-case bold bottom-pd-half">confirmation required</p>
							</div>
							<div class="col-xs-8 pd-0">
								<textarea placeholder="Your message" name="message" class="private-message col-xs-12 pd-0 size-normal black"></textarea>
								<p class="col-xs-12 pd-0 size-normal top-mg-half gray" style="height: 30px;"><i class="fa fa-plus right-mg-half" aria-hidden="true"></i>Select images</p>
								<input type="file" name="images[]" multiple style="opacity: 0; margin-top: -30px; height: 30px;" class="col-xs-12 pd-0 images-select">
							</div>
							<input class="add-target pd-0 col-xs-3 col-xs-offset-1 size-small white up-case" type="submit" name="submit" value="Add">
						</form>
						<div class="devider col-xs-12 top-mg-2 bottom-mg-1"></div>
						<?php if ($private): ?>
							<?php foreach ($private as $value): ?>
								<a href="/student/<?php echo $value['student']; ?>" class="col-xs-8 page-link bottom-mg-1">
									<?php if (!$value['from']): ?>
										<p class="inline right-mg-half size-normal gray">You sent to</p>
									<?php endif ?>
									<div class="inline avatar-min round cover left-mg-half" style="background-image: url(<?php echo $value['avatar']; ?>);"></div>
									<p class="inline size-normal bold left-mg-half">
										<?php echo $value['name']; ?> <?php echo $value['surname']; ?>
									</p>
									<?php if ($value['from']): ?>
										<p class="inline left-mg-half size-normal gray">sent to you</p>
									<?php endif ?>
								</a>
								<div class="col-xs-3 bottom-mg-1 right size-small gray">
									<p class="bold"><?php echo date('H:i', $value['date']); ?></p>
									<p><?php echo date('d.m.Y', $value['date']); ?></p>
								</div>
								<?php if ($my_page && !$value['from']): ?>
									<a href="/trainer/delpriv/<?php echo $value['id']; ?>" class="col-xs-1 red size-normal bottom-mg-1"><i class="fa fa-close"></i></a>
								<?php endif ?>
								<div class="left-pd-2 col-xs-12 bottom-mg-2">
									<p class="size-normal black bold bottom-mg-1"><?php echo $value['message']; ?></p>
									<div class="col-xs-12 pd-0 top-mg-1">
										<?php foreach ($value['images'] as $image): ?>
											<a target="_blank" href="/upload/images/private/<?php echo $image; ?>.jpg" class="inline right-mg-half" style="height: 100px;">
												<img src="/upload/images/private/<?php echo $image; ?>_p.jpg" height="100%" width="auto">
											</a>
										<?php endforeach ?>
									</div>
									<?php if ($value['type']): ?>
										<?php if($value['status'] == 1): ?>
											<div class="center col-xs-12 col-md-4 col-md-offset-8 gray size-small">
												<i class="fa fa-check inline"></i>
												<p class="up-case bold inline">Accepted</p>
											</div>
										<?php elseif($value['status'] == 2): ?>
											<div class="center col-xs-12 col-md-4 col-md-offset-8 size-small red">
												<i class="fa fa-close inline"></i>
												<p class="up-case bold inline">Denied</p>
											</div>
										<?php elseif($user == 2 && $value['from']): ?>
											<div class="center col-xs-6 col-sm-4 col-sm-offset-1 col-md-2 col-md-offset-8">
												<a load="<?php echo $value['id']; ?>" class="message-yes button size-small up-case white" href="">Yes</a>
											</div>
											<div class="center col-xs-6 col-sm-4 col-sm-offset-2 col-md-2 col-md-offset-0">
												<a load="<?php echo $value['id']; ?>" class="message-no button size-small up-case white" href="">No</a>
											</div>
										<?php else: ?>
											<div class="center col-xs-12 col-md-4 col-md-offset-8 size-small gray">
												<i class="fa fa-clock-o inline"></i>
												<p class="up-case bold inline">No response</p>
											</div>
										<?php endif; ?>
									<?php endif; ?>
									<?php if ($my_page && $value['from']): ?>
										<a href="" load="<?php echo $value['student']; ?>" class="reply-btn col-xs-12 right size-small gray bold up-case top-mg-1"><i class="fa fa-reply"></i> reply</a>
									<?php endif ?>
								</div>
							<?php endforeach; ?>
						<?php else: ?>
							<p class="size-small up-case red bold center">No messages for the last time</p>
						<?php endif; ?>
					</div>

					<div id="notes" style="display: none;" class="col-xs-12 messages-window">
						<form method="POST" enctype="multipart/form-data" class="col-xs-12" action="/trainer/newnote">
							<div class="col-xs-8 pd-0">
								<textarea placeholder="Your note" name="message" class="col-xs-12 pd-0 size-normal black"></textarea>
								<p class="col-xs-12 pd-0 size-normal top-mg-half gray" style="height: 30px;"><i class="fa fa-plus right-mg-half" aria-hidden="true"></i>Select images</p>
								<input type="file" name="images[]" multiple style="opacity: 0; margin-top: -30px; height: 30px;" class="col-xs-12 pd-0 images-select">
							</div>
							<input class="add-target pd-0 col-xs-3 col-xs-offset-1 size-small white up-case" type="submit" name="submit" value="Add">
						</form>
						<div class="devider col-xs-12 top-mg-2 bottom-mg-1"></div>
						<?php if ($notes): ?>
							<?php foreach ($notes as $value): ?>
								<div class="col-xs-3 bottom-mg-1 size-small gray">
									<p class="bold"><?php echo date('H:i', $value['date']); ?></p>
									<p><?php echo date('d.m.Y', $value['date']); ?></p>
								</div>
								<a href="/trainer/delnote/<?php echo $value['id']; ?>" class="right col-xs-1 col-xs-offset-8 red size-normal"><i class="fa fa-close"></i></a>
								<div class="col-xs-12 bottom-mg-2">
									<p class="message size-normal black bold bottom-mg-1"><?php echo $value['note']; ?></p>
									<div class="col-xs-12 pd-0 top-mg-1">
										<?php foreach ($value['images'] as $image): ?>
											<a target="_blank" href="/upload/images/notes/<?php echo $image; ?>.jpg" class="inline right-mg-half" style="height: 100px;">
												<img src="/upload/images/notes/<?php echo $image; ?>_p.jpg" height="100%" width="auto">
											</a>
										<?php endforeach ?>
									</div>
								</div>
							<?php endforeach; ?>
						<?php else: ?>
							<p class="size-small up-case red bold center">You haven't notes yet</p>
						<?php endif; ?>
					</div>
				<?php endif; ?>
			</div>

			<script type="text/javascript">
				$('input.images-select').on('change', function() {
					$(this).prev().html('<i class="fa fa-check right-mg-half" aria-hidden="true"></i>Images selected');
				});
				
				$('.reply-btn').click(function(event) {
					var student = $(this).attr('load');
					$('.student-to').attr('checked', false);
					$('.student-to[value='+student+']').prop("checked", true);
					$('.private-message').trigger('focus');
					return false;
				});
				$('.blogs-btn').on('click', function() {
					$('.messages-window').fadeOut(0, function() {
						$('#blogs').fadeIn('400', function() {
							col_1_height = $('.col-1').outerHeight(true);
						});
					});
					$('.mw-triger').removeClass('red');
					$(this).addClass('red');
					return false;
				});

				$('.reviews-btn').on('click', function() {
					$('.messages-window').fadeOut(0, function() {
						$('#reviews').fadeIn('400', function() {
							col_1_height = $('.col-1').outerHeight(true);
						});
					});
					$('.mw-triger').removeClass('red');
					$(this).addClass('red');
					return false;
				});

				$('.private-btn').on('click', function() {
					$('.messages-window').fadeOut(0, function() {
						$('#private').fadeIn('400', function() {
							col_1_height = $('.col-1').outerHeight(true);
						});
					});
					$('.mw-triger').removeClass('red');
					$(this).addClass('red');
					return false;
				});

				$('.notes-btn').on('click', function() {
					$('.messages-window').fadeOut(0, function() {
						$('#notes').fadeIn('400', function() {
							col_1_height = $('.col-1').outerHeight(true);
						});
					});
					$('.mw-triger').removeClass('red');
					$(this).addClass('red');
					return false;
				});

				$('.message-yes').on('click', function() {
					var message = $(this).attr('load');
					var obj = $(this);
					$.post("/trainer/callback/1/<?php echo $id; ?>/"+message, function (data) {
				        obj.parent().before('<div class="center col-xs-12 col-md-4 col-md-offset-8 gray size-small"><i class="fa fa-check inline"></i><p class="up-case bold inline">Accepted</p></div>');
				        obj.parent().next().detach();
				        obj.parent().detach();
				    });
				    return false;
				});

				$('.message-no').on('click', function() {
					var message = $(this).attr('load');
					var obj = $(this);
					$.post("/trainer/callback/2/<?php echo $id; ?>/"+message, function (data) {
				        obj.parent().prev().before().before('<div class="center col-xs-12 col-md-4 col-md-offset-8 size-small red"><i class="fa fa-close inline"></i><p class="up-case bold inline">Denied</p></div>');
				        obj.parent().prev().detach();
				        obj.parent().detach();
				    });
				    return false;
				});
			</script>
		</div>

		<div class="col-2 col-xs-12 col-sm-4">			
			<div id="sec_data" class="bottom-mg-2 col-xs-12 bottom-mg-2 white-block">
				<?php if($my_page): ?>
					<div class="col-xs-12 bottom-mg-1 top-mg-1 fade-trigger hidden-sm hidden-md hidden-lg">
						<p class="col-xs-11 pd-0 up-case size-small black">Trainers & Subscriptions</p>
						<p class="right col-xs-1 pd-0 size-normal"><i class="fade-arrow fa fa-chevron-right" aria-hidden="true"></i></p>
					</div>
					<div class="fade-content">
						<div class="col-xs-12">
							<div class="bottom-mg-1">
								<p class="up-case size-small black">Main students</p>
							</div>
							<?php if (isset($main_students[0])): ?>
								<?php foreach ($main_students as $main_student): ?>
									<a href="/student/<?php echo $main_student['id']; ?>" class="col-xs-12 page-link right bottom-mg-half">
										<p class="inline size-normal bold left-mg-half">
											<?php echo $main_student['name']; ?> <?php echo $main_student['surname']; ?>
										</p>
										<div class="inline avatar-min round cover left-mg-half" style="background-image: url(<?php echo $main_student['avatar']; ?>);"></div>
									</a>
								<?php endforeach; ?>
							<?php else: ?>
								<p class="red bold up-case size-small center">No students</p>
							<?php endif; ?>
						</div>

						<div class="devider col-xs-12 top-mg-1 bottom-mg-1"></div>

						<div class="col-xs-12">
							<div class="bottom-mg-1">
								<p class="up-case size-small black">Subscribers</p>
							</div>
							<?php if (isset($secondary_students[0])): ?>
								<?php foreach ($secondary_students as $secondary_student): ?>
									<a href="/student/<?php echo $secondary_student['id']; ?>" class="<?php if (!$my_page) echo "col-xs-12"; else echo "col-xs-11"; ?> page-link right bottom-mg-half inline">
										<p class="inline size-normal bold left-mg-half">
											<?php echo $secondary_student['name']; ?> <?php echo $secondary_student['surname']; ?>
										</p>
										<div class="inline avatar-min round cover left-mg-half" style="background-image: url(<?php echo $secondary_student['avatar']; ?>);"></div>
									</a>
									<?php if ($my_page): ?>
										<a href="trainer/del/<?php echo $secondary_student['id']; ?>" class="col-xs-1 pd-0 inline red size-normal page-link">
											<i class="fa fa-close"></i>
										</a>
									<?php endif ?>
								<?php endforeach; ?>
							<?php else: ?>
								<p class="red bold up-case size-small center">No students</p>
							<?php endif; ?>
						</div>
					</div>
				<?php else: ?>
					<p class="up-case size-small black bottom-mg-1">Contacts</p>
					<p class="size-normal bold right">
						<i class="fa fa-phone right-mg-half bottom-mg-half"></i> <?php echo $user_data['phone']; ?>
					</p>
					<p class="size-normal bold right">
						<i class="fa fa-envelope-o right-mg-half"></i> <?php echo $user_data['mail']; ?>
					</p>

					<p class="right top-mg-1">
						<?php if (!empty($user_data['fb'])): ?>
							<a href="https://fb.com/<?php echo $user_data['fb']; ?>" target="_blank" class="gray right-mg-half">
								<i class="fa fa-facebook size-normal bold"></i>
							</a>
						<?php endif ?>
						<?php if (!empty($user_data['instagram'])): ?>
							<a href="https://www.instagram.com/<?php echo $user_data['instagram']; ?>" target="_blank" class="left-mg-half gray right-mg-half">
								<i class="fa fa-instagram right-mg-half size-normal bold"></i>
							</a>
						<?php endif ?>
					</p>
				<?php endif; ?>
			</div>

			<?php if($my_page): ?>
				<div id="tasks" class="white-block col-xs-12 bottom-mg-2">
					<div class="col-xs-12 top-mg-1 bottom-mg-1 fade-trigger">
						<p class="up-case col-xs-11 pd-0 size-small black">Tasks</p>
						<p class="right col-xs-1 pd-0 size-normal hidden-sm hidden-md hidden-lg"><i class="fade-arrow fa fa-chevron-right" aria-hidden="true"></i></p>
					</div>
					<div class="fade-content">
						<div class="col-xs-12">
							<p class="inline up-case size-small bold gray">Date: </p>
							<input type="text" class="datepicker size-small left-pd-2 left-mg-half">
							<span><i class="fa fa-calendar gray unactive"></i></span>
							<div id="tasks_data" class="top-mg-2">
								<!-- tasks here -->
							</div>
						</div>
						<div class="devider col-xs-12 bottom-mg-1"></div>
						<div class="col-xs-12">
							<div class="col-xs-6 col-xs-offset-3">
								<a class="center new-task button size-small up-case white" href="">New task</a>
							</div>
							<div id="task_field" style="display: none;" class="col-xs-12 pd-0">
								<form method="POST" action="/trainer/newtask">
									<input class="size-normal black col-xs-12 bottom-mg-1 pd-0" type="text" name="name" maxlength="150" placeholder="Task name">
									<input type="hidden" name="day">
									<input class="size-normal black col-xs-12 bottom-mg-1 pd-0" type="text" name="time" maxlength="5" placeholder="Time (like 12:20)">

									<a href="" class="st-list-triger block up-case size-small bold"><i class="right-mg-half fa fa-caret-down"></i> Choose students</a>
									<div style="display: none;">
										<?php foreach ($students_info as $student): ?>
											<a href="/student/<?php echo $student['id']; ?>" class="col-xs-10 pd-0 top-mg-half page-link">
												<div class="inline avatar-min round cover right-mg-half" style="background-image: url(<?php echo $student['avatar']; ?>);"></div>
												<p class="inline size-normal bold">
													<?php echo $student['name']; ?> <?php echo $student['surname']; ?>
												</p>
											</a>
											<input class="col-xs-2 pd-0" type="checkbox" name="students[]" value="<?php echo $student['id']; ?>">
										<?php endforeach ?>
									</div>

									<input class="top-mg-2 add-task pd-0 col-xs-4 col-xs-offset-4 size-small white up-case" type="submit" name="submit" value="Add">
								</form>
							</div>
						</div>
					</div>
				</div>

				<div id="targets" class="white-block col-xs-12 bottom-mg-2">
					<div class="col-xs-12 top-mg-1 bottom-mg-1 fade-trigger">
						<p class="up-case col-xs-11 pd-0 size-small black">Targets</p>
						<p class="right col-xs-1 pd-0 size-normal hidden-sm hidden-md hidden-lg"><i class="fade-arrow fa fa-chevron-right" aria-hidden="true"></i></p>
					</div>
					<div class="fade-content">
						<div class="col-xs-12">
							<?php if($targets): ?>
								<?php foreach ($targets as $key => $value): ?>
									<div class="size-normal bottom-mg-half <?php if($value['done']) echo ' unactive'; ?>">
										<?php if($value['done']): ?>
											<i class="target-status left-mg-half fa fa-check"></i>
										<?php else: ?>
											<i class="target-status left-mg-half fa fa-caret-right"></i>
										<?php endif; ?>
										<span class="target-text left-mg-half"><?php echo $value['date']; ?> <span class="bold"><?php echo $value['target']; ?></span></span>
										<?php if(!$value['done']): ?>
											<a class="set-done gray" load="<?php echo $key; ?>" category="3" href=""><i class="left-mg-half fa fa-check"></i></a>
											<a class="edit-btn gray" load="<?php echo $key; ?>" category="3" href=""><i class="left-mg-half fa fa-pencil"></i></a>
										<?php endif; ?>
										<a class="del" load="<?php echo $key; ?>" category="3" href=""><i class="left-mg-half fa fa-close red"></i></a>
										<?php if(!$value['done']): ?>
											<form load="<?php echo $key; ?>" category="3" class="edit-form top-mg-1 col-xs-12 pd-0">
												<p class="inline up-case size-small bold gray">Date: </p>
												<input type="text" name="date" class="datepicker size-small left-pd-2 left-mg-half bottom-mg-1">
												<span><i class="fa fa-calendar gray unactive"></i></span>
												<input class="col-xs-8 pd-0 size-normal black" type="text" name="target" placeholder="Target" value="<?php echo $value['target']; ?>">
												<input class="edit-submit pd-0 col-xs-3 col-xs-offset-1 size-small white up-case" type="submit" name="submit" maxlength="150" value="Change">
											</form>
										<?php endif; ?>
									</div>
								<?php endforeach; ?>
							<?php else: ?>
								<p class="up-case red size-small center bold">No targets</p>
							<?php endif; ?>
						</div>
						
						<div class="devider col-xs-12 top-mg-1 bottom-mg-1"></div>

						<div class="col-xs-12">
							<form method="POST" class="col-xs-12 pd-0" action="/targets/new/2/<?php echo $id; ?>/3">
								<p class="inline up-case size-small bold gray">Date: </p>
								<input type="text" name="date" class="datepicker size-small left-pd-2 left-mg-half bottom-mg-1">
								<span><i class="fa fa-calendar gray unactive"></i></span>
								<input class="col-xs-8 pd-0 size-normal black" type="text" name="target" maxlength="150" placeholder="New target">
								<input class="add-target pd-0 col-xs-3 col-xs-offset-1 size-small white up-case" type="submit" name="submit" value="Add">
							</form>
						</div>
					</div>
				</div>
				<script type="text/javascript" src="/template/js/targets.js"></script>
				<script type="text/javascript">
					//datepicker init
					$(function() {
						$(".datepicker").datepicker();
						$(".datepicker").datepicker( "option", "dateFormat", "dd.mm.yy");
						var currentDate = new Date();  
						$(".datepicker").datepicker("setDate",currentDate);
					});
					
					$('.new-task').on('click', function() {
						$(this).parent().next().slideDown(400);
						$(this).parent().detach();
						return false;
					});

					$(window).load(function() {
						var day = $(".datepicker").datepicker().val();
						$('input[name=day]').val(day);
						$.ajax({
							method: "POST",
							url: "/trainer/tasks/<?php echo $id; ?>",
							data: {day: day},
							success: function (data) {
								$("#tasks_data").html(data);
							}
						});
					});

					$(".datepicker").datepicker({
						onSelect: function(dateText, inst) {
							var day = $(this).val();
							$('input[name=day]').val(day);
							$.ajax({
								method: "POST",
								url: "/trainer/tasks/<?php echo $id; ?>",
								data: {day: day},
								success: function (data) {
									$("#tasks_data").slideUp(200, function() {
										$("#tasks_data").html(data);
										$("#tasks_data").slideDown(400);
									});
								}
							});
						}
					});

					$('#targets .del').on('click', function() {
						var category = $(this).attr('category');
						var target = $(this).attr('load');
						var obj = $(this);
						$.post("/targets/del/2/<?php echo $id; ?>/"+category+"/"+target, function (data) {
							obj.parent().slideUp(200);
						});
						return false;
					});

					$('#targets .set-done').on('click', function() {
						var category = $(this).attr('category');
						var target = $(this).attr('load');
						var obj = $(this);
						$.post("/targets/done/2/<?php echo $id; ?>/"+category+"/"+target, function (data) {
							obj.parent().slideUp(200, function() {
								obj.parent().find('.target-status').removeClass('fa-caret-right');
								obj.parent().find('.target-status').addClass('fa-check');
								obj.parent().addClass('unactive');
								obj.parent().slideDown(400);
								obj.parent().find('.set-done, .edit-btn, .edit-form').detach();
							});
						});
						return false;
					});

					$('#targets .edit-submit').on('click', function() {
						var category = $(this).parent().attr('category');
						var target = $(this).parent().attr('load');
						var obj = $(this).parent();
						$.post("/targets/edit/2/<?php echo $id; ?>/"+category+"/"+target, obj.serialize(), function (data) {
							obj.parent().slideUp(200, function() {
								obj.hide();
								obj.parent().find('.target-text').html(obj.find('.col-xs-8').val());
								obj.parent().slideDown(400);
							});
						});
						return false;
					});
				</script>
			<?php endif; ?>
		</div>
	</div>
</div>

<script type="text/javascript">
	$('.st-list-triger').on('click', function() {
		if ($(this).next().is(':visible')) {
			$(this).find('i').removeClass('fa-caret-up');
			$(this).find('i').addClass('fa-caret-down');
			$(this).next().slideUp('200');
		} else {
			$(this).find('i').addClass('fa-caret-up');
			$(this).find('i').removeClass('fa-caret-down');
			$(this).next().slideDown('400');
		}
		return false;
	});

	$(document).ready(function() {
    	if ($(window).width() < 768) {
    		$('#main_data').after($('#sec_data'));
    		<?php if($my_page): ?>
    			$('#sec_data').after($('#blog'));
    			$('#tasks').after($('#targets'));
    		<?php endif ?>
    	}

    	<?php if (isset($_SESSION['slide_to']) && $_SESSION['slide_to']): ?>
    		<?php if ($_SESSION['slide_to'] === 1): ?>
				$('html, body').scrollTop($('#blogs').offset().top-120);
				<?php $_SESSION['slide_to'] = 0; ?>
		    <?php elseif($_SESSION['slide_to'] == 2): ?>
			    $('.messages-window').fadeOut(0, function() {
					$('#private').fadeIn(0, function() {
						col_1_height = $('.col-1').outerHeight(true);
					});
				});
				$('.mw-triger').removeClass('red');
				$('.private-btn').addClass('red');
		    	$('html, body').scrollTop($('#private').offset().top-120);
		    	<?php $_SESSION['slide_to'] = 0; ?>
		    <?php elseif($_SESSION['slide_to'] == 3): ?>
		    	$('.messages-window').fadeOut(0, function() {
					$('#reviews').fadeIn(0, function() {
						col_1_height = $('.col-1').outerHeight(true);
					});
				});
				$('.mw-triger').removeClass('red');
				$('.reviews-btn').addClass('red');
		    	$('html, body').scrollTop($('#reviews').offset().top-120);
		    	<?php $_SESSION['slide_to'] = 0; ?>
		    <?php elseif($_SESSION['slide_to'] == 4): ?>
		    	$('.messages-window').fadeOut(0, function() {
					$('#notes').fadeIn(0, function() {
						col_1_height = $('.col-1').outerHeight(true);
					});
				});
				$('.mw-triger').removeClass('red');
				$('.notes-btn').addClass('red');
		    	$('html, body').scrollTop($('#notes').offset().top-120);
		    	<?php $_SESSION['slide_to'] = 0; ?>
		    <?php endif; ?>
		<?php endif; ?>
    });
</script>
<script type="text/javascript" src="/template/js/design.js"></script>

<?php include ROOT . '/views/layouts/footer.php'; ?>