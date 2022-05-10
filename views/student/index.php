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
					<div class="col-xs-12 pd-0 col-md-8 bottom-mg-1">
						<p class="inline size-extra black"><?php echo $user_data['name']; ?> <?php echo $user_data['surname']; ?></p>
						<?php if ($user === 1): ?>
							<a class="inline size-big up-case" href="/student/edit" title="Edit profile"><i class=" fa fa-edit"></i></a>
						<?php endif ?>
						<p class="size-normal bold gray"><?php echo $user_data['status']; ?></p>
					</div>
					<?php if (!$my_page): ?>
						<div class="col-xs-12 pd-0 col-md-4 right bottom-mg-1">
							<a id="ps_link" href="/lesson/new/0/<?php echo $id; ?>" class="size-big up-case bold black"><i class="fa fa-pencil"></i></a>
						</div>
					<?php endif ?>
				</div>

				<div class="devider col-xs-12"></div>

				<div class="top-mg-1 col-xs-12 bottom-mg-1">
					<p class="up-case size-small black">Progress line</p>
				</div>
				<div class="col-xs-12 bottom-mg-1">
					<div class="progress-line col-xs-5">
						<div class="done"<?php if ($progress < $top_progress) echo ' style="width: '.round(100*$progress_line).'%;"'; ?>></div>
						<p class="size-normal white left-mg-1"><?php echo Program::getLevelName($user_data['level']); ?></p>
					</div>
					<div class="progress-next col-xs-5">
						<?php if($user_data['level'] == 5): ?>
							<div class="done"></div>
						<?php else: ?>
							<div class="border inline"></div>
							<p class="size-normal white inline">
								<?php echo Program::getLevelName(intval($user_data['level'])+1); ?>
								<?php if ($user === 2 && $main_trainer && $progress >= $top_progress): ?>
									<a class="left-mg-half white" href="/student/raise/<?php echo $id; ?>" title="Raise level"><i class="fa fa-check"></i></a>
								<?php endif; ?>
							</p>
						<?php endif; ?>
					</div>
					<div class="progress-info col-xs-2 pd-0">
						<p class="size-normal white center">
							<?php if($user_data['level'] == 5): ?>
								<?php echo $progress; ?>
							<?php else: ?>
								<?php echo $progress; ?>/<?php echo $top_progress; ?>
							<?php endif; ?>
						</p>
					</div>
				</div>

				<div class="devider col-xs-12"></div>

				<div class="col-xs-12 bottom-mg-1 top-mg-1 fade-trigger">
					<p class="col-xs-11 pd-0 up-case size-small black">About me</p>
					<p class="right col-xs-1 pd-0 size-normal hidden-sm hidden-md hidden-lg"><i class="fade-arrow fa fa-chevron-right" aria-hidden="true"></i></p>
				</div>
				<div class="col-xs-12 fade-content">
					<?php if (!empty($about)): ?>
						<p class="size-normal bottom-mg-half"><?php echo $about; ?></p>
					<?php else: ?>
						<p class="red bold up-case size-small center">No info</p>
					<?php endif; ?>
				</div>
			</div>


			<?php if($my_page): ?>
				<div class="col-xs-12 bottom-mg-2 white-block">
					<p id="program_name" class="center size-extra black">
						<span>Personal program</span><br>
						<i class="fa fa-angle-down"></i>
					</p>

					<div id="programs">
						<div class="col-xs-12">
							<div class="col-xs-12 bottom-mg-1">
								<p class="up-case size-small black">Select a program</p>
							</div>

							<div load="0" class="program col-xs-12 col-sm-6">
								<div class="col-xs-4 bottom-mg-2">
									<div class="cover square bottom-mg-half" style="background-image: url(<?php echo $user_data['avatar']; ?>);"></div>
									<p class="size-normal center">
										<span class="bold"><?php echo $personal_program_data['done']; ?>/<?php echo $personal_program_data['total']; ?></span> done
									</p>
								</div>
								<div class="col-xs-8 bottom-mg-2">
									<p class="name size-big black bottom-mg-1">Personal program</p>
									<p class="size-normal">Personal lessons with trainers which you subscribed for</p>
								</div>
							</div>

							<?php if ($programs): ?>
								<?php foreach ($programs as $program): ?>
									<div load="<?php echo $program['id']; ?>" class="program col-xs-12 col-sm-6">
										<div class="col-xs-4 bottom-mg-2">
											<div class="cover square bottom-mg-half" style="background-image: url(<?php echo $program['avatar']; ?>);"></div>
											<p class="size-normal center">
												<span class="bold"><?php echo $program['done']; ?>/<?php echo $program['total']; ?></span> done
											</p>
										</div>
										<div class="col-xs-8 bottom-mg-2">
											<p class="name size-big black bottom-mg-1"><?php echo $program['name']; ?></p>
											<p class="size-normal"><?php echo $program['short_about']; ?></p>
										</div>
									</div>
								<?php endforeach; ?>
							<?php endif; ?>

							<!-- <div class="col-xs-12 pd-0">
								<div class="col-xs-10 col-xs-offset-1 col-md-6 col-md-offset-0 top-mg-2 center">
									<a href="/explore/recomended" class="button up-case size-normal bold white">
										Recomended programs 
										<span class="red round-label center left-mg-half"><?php echo $recomended; ?></span>
									</a>
								</div>
								<div class="col-xs-10 col-xs-offset-1 col-md-6 col-md-offset-0 top-mg-2 bottom-mg-2 center">
									<a href="/explore" class="button up-case size-normal bold white">Explore</a>
								</div>
							</div> -->
						</div>
					</div>

					<div class="devider top-mg-1 bottom-mg-2 col-xs-12"></div>

					<div id="program" class="">
						<!-- lessons here -->
					</div>
				</div>
				<script type="text/javascript" src="/template/js/programs.js"></script>
				<script type="text/javascript">
					$(document).ready(function() {
					    $.ajax({
					    	type: "POST",
					    	url: "/student/videos/"+<?php echo $id; ?>+"/"+0,
					    	success: function (data) {
						        $("#program").html(data);
						    }
						});
					});
					
					$('.program').on('click', function() {
						var program = $(this).attr('load');
						var program_name = $(this).find('.name').html();
						$.post("/student/videos/"+<?php echo $id; ?>+"/"+program, function (data) {
					        $("#program_name span").animate({ opacity: '0' }, 400, 'easeOutCubic');
					        $("#program").slideUp(400, function() {
					        	$("#program").html(data);
					        	$("#program_name span").html(program_name);
					        	$("#program_name span").animate({ opacity: '1' }, 400, 'easeOutCubic');
					        	$("#program").slideDown(400);
					        });
					    });
					});
				</script>
			<?php endif; ?>


			<div id="galleries" class="col-xs-12 white-block bottom-mg-2">
				<div class="col-xs-12 col-sm-4 col-sm-offset-0 bottom-mg-2 top-mg-2">
					<?php if($ins_count): ?>
						<div class="col-xs-12 pd-0">
							<div class="prv ins square cover" style="background-image: url(/upload/images/galleries/<?php echo $last_ins; ?>_p.jpg);">
								<div class="col-xs-12 info-line">
									<p class="white size-small right bold col-xs-6 col-xs-offset-6 pd-0"><?php echo $ins_count; ?> photo<?php if ($ins_count != 1) echo "s"; ?></p>
								</div>
							</div>
						</div>
					<?php else: ?>
						<p class="center gray size-big top-mg-2 bottom-mg-2 top-mg-2">"Inspiration" gallery is empty</p>
					<?php endif; ?>
					<p class="size-small top-mg-half up-case bold up-case col-xs-6 pd-0">Inspiration</p>
					<a href="" class="upl ins col-xs-6 pd-0 right top-mg-half size-small up-case"><i class="fa fa-upload"></i></a>
				</div>

				<div class="col-xs-12 col-sm-4 bottom-mg-2 top-mg-2">
					<?php if($ach_count): ?>
						<div class="col-xs-12 pd-0">
							<div class="prv ach square cover" style="background-image: url(/upload/images/galleries/<?php echo $last_ach; ?>_p.jpg);">
								<div class="col-xs-12 info-line">
									<p class="white size-small right bold col-xs-6 col-xs-offset-6 pd-0"><?php echo $ach_count; ?> photo<?php if ($ach_count != 1) echo "s"; ?></p>
								</div>
							</div>
						</div>
					<?php else: ?>
						<p class="center gray size-big top-mg-2 bottom-mg-2">"Achivments" gallery is empty</p>
					<?php endif; ?>
					<p class=" top-mg-half bold size-small up-case col-xs-6 pd-0">Achivments</p>
					<a href="" class="upl ach col-xs-6 pd-0 right top-mg-half size-small up-case"><i class="fa fa-upload"></i></a>
				</div>

				<div class="col-xs-12 col-sm-4 bottom-mg-2 top-mg-2">
					<?php if($wm_count): ?>
						<div class="col-xs-12 pd-0">
							<div class="prv wm square cover" style="background-image: url(/upload/images/galleries/<?php echo $last_wm; ?>_p.jpg);">
								<div class="col-xs-12 info-line">
									<p class="white size-small right bold col-xs-6 col-xs-6 pd-0"><?php echo $wm_count; ?> photo<?php if ($wm_count != 1) echo "s"; ?></p>
								</div>
							</div>
						</div>
					<?php else: ?>
						<p class="center gray size-big top-mg-2 bottom-mg-2">"Work more" gallery is empty</p>
					<?php endif; ?>
					<p class="top-mg-half bold size-small up-case col-xs-6 pd-0">Work more</p>
					<a href="" class="upl wm col-xs-6 pd-0 right top-mg-half size-small up-case"><i class="fa fa-upload"></i></a>
				</div>
			</div>

			<div id="messages" class="col-xs-12 white-block bottom-mg-2">
				<div class="left-pd-3 col-xs-12 top-mg-1">
					<a href="" class="right-mg-2 private-btn size-small bold up-case red">
						<i class="size-normal fa fa-comment-o right-mg-half bottom-mg-half"></i>Private
					</a>
					<?php if ($my_page): ?>
						<a href="" class="right-mg-2 blogs-btn size-small bold up-case">
							<i class="size-normal fa fa-comments-o right-mg-half"></i>News
						</a>
						<a href="" class="notes-btn size-small bold up-case">
							<i class="size-normal fa fa-sticky-note-o right-mg-half"></i>Notes
						</a>
					<?php endif; ?>
				</div>

				<div class="devider col-xs-12 top-mg-1 bottom-mg-2"></div>

				<div id="private" class="col-xs-12">
					<?php if ($my_page): ?>
						<form method="POST" enctype="multipart/form-data" class="col-xs-12" action="/student/newpriv">
							<div class="col-xs-12 col-md-7 bottom-mg-1 pd-0">
								<a href="" class="st-list-triger block up-case size-small bold"><i class="right-mg-half fa fa-caret-down"></i> Choose trainer</a>
								<div style="display: none;">
									<a href="/trainer/<?php echo $main_trainer_data['id']; ?>" class="col-xs-10 pd-0 top-mg-half page-link">
										<div class="inline avatar-min round cover right-mg-half" style="background-image: url(<?php echo $main_trainer_data['avatar']; ?>);"></div>
										<p class="inline size-normal bold">
											<?php echo $main_trainer_data['name']; ?> <?php echo $main_trainer_data['surname']; ?>
										</p>
									</a>
									<input class="col-xs-2 pd-0 trainer-to" type="radio" name="trainer" value="<?php echo $main_trainer_data['id']; ?>" checked>
									<?php foreach ($trainers_data as $trainer): ?>
										<a href="/trainer/<?php echo $trainer['id']; ?>" class="col-xs-10 pd-0 top-mg-half page-link">
											<div class="inline avatar-min round cover right-mg-half" style="background-image: url(<?php echo $trainer['avatar']; ?>);"></div>
											<p class="inline size-normal bold">
												<?php echo $trainer['name']; ?> <?php echo $trainer['surname']; ?>
											</p>
										</a>
										<input class="col-xs-2 pd-0 trainer-to" type="radio" name="trainer" value="<?php echo $trainer['id']; ?>">
										<div class="col-xs-12 bottom-mg-1 pd-0 right-pd-1 right">
											<input type="checkbox" name="conf">
											<p class="size-small right-mg-half inline up-case bold bottom-pd-half">confirmation required</p>
										</div>
									<?php endforeach ?>
								</div>
							</div>
							<div class="col-xs-8 pd-0">
								<textarea placeholder="Your message" name="message" class="private-message col-xs-12 pd-0 size-normal black"></textarea>
								<p class="col-xs-12 pd-0 size-normal top-mg-half gray" style="height: 30px;"><i class="fa fa-plus right-mg-half" aria-hidden="true"></i>Select images</p>
								<input type="file" name="images[]" multiple style="opacity: 0; margin-top: -30px; height: 30px;" class="col-xs-12 pd-0 images-select">
							</div>
							<input class="add-target pd-0 col-xs-3 col-xs-offset-1 size-small white up-case" type="submit" name="submit" value="Add">
						</form>
						<div class="devider col-xs-12 top-mg-2 bottom-mg-1"></div>
					<?php endif ?>
					<?php if ($private): ?>
						<?php foreach ($private as $value): ?>
							<?php if ($value['from']): ?>
								<div style="background-color: #eee" class="col-xs-12 pd-0 top-pd-2 bottom-mg-2">
							<?php endif ?>
							<?php if ($value['from']): ?>
								<a href="/trainer/<?php echo $value['trainer']; ?>" class="col-xs-8 page-link bottom-mg-1">
									<div class="inline avatar-min round cover left-mg-half" style="background-image: url(<?php echo $value['avatar']; ?>);"></div>
									<p class="inline size-normal bold left-mg-half">
										<?php echo $value['name']; ?> <?php echo $value['surname']; ?>
									</p>
								</a>
								<div class="col-xs-3 bottom-mg-1 right size-small gray">
									<p class="bold"><?php echo date('H:i', $value['date']); ?></p>
									<p><?php echo date('d.m.Y', $value['date']); ?></p>
								</div>
								<?php if ($my_page && $value['from']): ?>
									<a href="/student/delpriv/<?php echo $value['id']; ?>" class="col-xs-1 red size-normal bottom-mg-1"><i class="fa fa-close"></i></a>
								<?php endif ?>
							<?php else: ?>
								<?php if ($my_page && $value['from']): ?>
									<a href="/student/delpriv/<?php echo $value['id']; ?>" class="col-xs-1 red size-normal bottom-mg-1"><i class="fa fa-close"></i></a>
								<?php endif ?>
								<div class="col-xs-3 bottom-mg-1 size-small gray">
									<p class="bold"><?php echo date('H:i', $value['date']); ?></p>
									<p><?php echo date('d.m.Y', $value['date']); ?></p>
								</div>
								<a href="/trainer/<?php echo $value['trainer']; ?>" class="col-xs-8 page-link bottom-mg-1 right">
									<div class="inline avatar-min round cover left-mg-half" style="background-image: url(<?php echo $value['avatar']; ?>);"></div>
									<p class="inline size-normal bold left-mg-half">
										<?php echo $value['name']; ?> <?php echo $value['surname']; ?>
									</p>
								</a>
							<?php endif; ?>
							<div class="left-pd-2 col-xs-12 bottom-mg-2">
								<p class="size-normal black bold bottom-mg-1"><?php echo $value['message']; ?></p>
								<div class="col-xs-12 pd-0 top-mg-1">
									<?php foreach ($value['images'] as $image): ?>
										<a target="_blank" href="/upload/images/private/<?php echo $image; ?>.jpg" class="inline right-mg-half" style="height: 100px;">
											<img src="/upload/images/private/<?php echo $image; ?>_p.jpg" height="100%" width="auto">
										</a>
									<?php endforeach ?>
								</div>
								<?php if ($my_page && !$value['from']): ?>
									<a href="" load="<?php echo $value['trainer']; ?>" class="reply-btn col-xs-12 size-small gray bold up-case top-mg-1"><i class="fa fa-reply"></i> reply</a>
								<?php endif ?>
								<?php if ($value['type']): ?>
									<?php if($value['status'] == 1): ?>
										<div class="right col-xs-12 col-md-4 col-md-offset-8 gray size-small">
											<i class="fa fa-check inline"></i>
											<p class="up-case bold inline">Accepted</p>
										</div>
									<?php elseif($value['status'] == 2): ?>
										<div class="right col-xs-12 col-md-4 col-md-offset-8 size-small red">
											<i class="fa fa-close inline"></i>
											<p class="up-case bold inline">Denied</p>
										</div>
									<?php elseif($user == 1 && !$value['from']): ?>
										<div class="right col-xs-6 col-sm-4 col-sm-offset-1 col-md-2 col-md-offset-8">
											<a load="<?php echo $value['id']; ?>" class="message-yes button size-small up-case white" href="">Yes</a>
										</div>
										<div class="right col-xs-6 col-sm-4 col-sm-offset-2 col-md-2 col-md-offset-0">
											<a load="<?php echo $value['id']; ?>" class="message-no button size-small up-case white" href="">No</a>
										</div>
									<?php else: ?>
										<div class="right col-xs-12 col-md-4 col-md-offset-8 size-small gray">
											<i class="fa fa-clock-o inline"></i>
											<p class="up-case bold inline">No response</p>
										</div>
									<?php endif; ?>
								<?php endif; ?>
							</div>
							<?php if ($value['from']): ?>
								</div>
							<?php endif ?>
						<?php endforeach; ?>
					<?php else: ?>
						<p class="size-small up-case red bold center">No messages</p>
					<?php endif; ?>
				</div>
				<?php if($my_page): ?>
					<div id="blogs" style="display: none;" class="col-xs-12">
						<form method="POST" enctype="multipart/form-data" class="col-xs-12" action="/student/newblog">
							<div class="col-xs-8 pd-0">
								<textarea placeholder="Your message" name="message" class="private-message col-xs-12 pd-0 size-normal black"></textarea>
								<p class="col-xs-12 pd-0 size-normal top-mg-half gray" style="height: 30px;"><i class="fa fa-plus right-mg-half" aria-hidden="true"></i>Select images</p>
								<input type="file" name="images[]" multiple style="opacity: 0; margin-top: -30px; height: 30px;" class="col-xs-12 pd-0 images-select">
							</div>
							<input class="add-target pd-0 col-xs-3 col-xs-offset-1 size-small white up-case" type="submit" name="submit" value="Add">
						</form>
						<div class="devider col-xs-12 top-mg-2 bottom-mg-1"></div>
						<?php if ($blogs): ?>
							<?php foreach ($blogs as $value): ?>
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
								<?php if (isset($value['student']) && $value['student'] == $id): ?>
									<a href="/student/delblog/<?php echo $value['id']; ?>" class="right col-xs-1 red size-normal"><i class="fa fa-close"></i></a>
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

					<div id="notes" style="display: none;" class="col-xs-12">
						<form method="POST" enctype="multipart/form-data" class="col-xs-12" action="/student/newnote">
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
								<a href="/student/delnote/<?php echo $value['id']; ?>" class="right col-xs-1 col-xs-offset-8 red size-normal"><i class="fa fa-close"></i></a>
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
					var trainer = $(this).attr('load');
					$('.trainer-to').attr('checked', false);
					$('.trainer-to[value='+trainer+']').prop("checked", true);
					$('.private-message').trigger('focus');
					return false;
				});
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

				<?php if($my_page): ?>
					$('.blogs-btn').on('click', function() {
						if ($('#private').is(':visible')) {
							$('#private').fadeOut('200', function() {
								$('#blogs').fadeIn('400', function() {
									col_1_height = $('.col-1').outerHeight(true);
								});
							});
							$(this).addClass('red');
							$('.private-btn').removeClass('red');
						}
						if ($('#notes').is(':visible')) {
							$('#notes').fadeOut('200', function() {
								$('#blogs').fadeIn('400', function() {
									col_1_height = $('.col-1').outerHeight(true);
								});
							});
							$(this).addClass('red');
							$('.notes-btn').removeClass('red');
						}
					    return false;
					});

					$('.notes-btn').on('click', function() {
						if ($('#blogs').is(':visible')) {
							$('#blogs').fadeOut('200', function() {
								$('#notes').fadeIn('400', function() {
									col_1_height = $('.col-1').outerHeight(true);
								});
							});
							$(this).addClass('red');
							$('.blogs-btn').removeClass('red');
						}
						if ($('#private').is(':visible')) {
							$('#private').fadeOut('200', function() {
								$('#notes').fadeIn('400', function() {
									col_1_height = $('.col-1').outerHeight(true);
								});
							});
							$(this).addClass('red');
							$('.private-btn').removeClass('red');
						}
					    return false;
					});
				<?php endif; ?>
				
				$('.private-btn').on('click', function() {
					<?php if($my_page): ?>
						if ($('#blogs').is(':visible')) {
							$('#blogs').fadeOut('200', function() {
								$('#private').fadeIn('400', function() {
									col_1_height = $('.col-1').outerHeight(true);
								});
							});
							$(this).addClass('red');
							$('.blogs-btn').removeClass('red');
						}
						if ($('#notes').is(':visible')) {
							$('#notes').fadeOut('200', function() {
								$('#private').fadeIn('400', function() {
									col_1_height = $('.col-1').outerHeight(true);
								});
							});
							$(this).addClass('red');
							$('.notes-btn').removeClass('red');
						}
					<?php endif; ?>
				    return false;
				});

				$('.message-yes').on('click', function() {
					var message = $(this).attr('load');
					var obj = $(this);
					$.post("/student/callback/1/<?php echo $id; ?>/"+message, function (data) {
				        obj.parent().before('<div class="center col-xs-12 col-md-4 col-md-offset-8 gray size-small"><i class="fa fa-check inline"></i><p class="up-case bold inline">Accepted</p></div>');
				        obj.parent().next().detach();
				        obj.parent().detach();
				    });
				    return false;
				});

				$('.message-no').on('click', function() {
					var message = $(this).attr('load');
					var obj = $(this);
					$.post("/student/callback/2/<?php echo $id; ?>/"+message, function (data) {
				        obj.parent().prev().before().before('<div class="center col-xs-12 col-md-4 col-md-offset-8 size-small red"><i class="fa fa-close inline"></i><p class="up-case bold inline">Denied</p></div>');
				        obj.parent().prev().detach();
				        obj.parent().detach();
				    });
				    return false;
				});
			</script>
		</div>

		<div class="col-2 col-xs-12 col-sm-4">
			<div id="awards_preview" class="bottom-mg-2 col-xs-12 white-block">
				<div class="col-xs-12 bottom-mg-1">
					<p class="up-case size-small black col-xs-6 pd-0">Student awards</p>
					<?php if ($user == 2): ?>
						<a href="" class="add-award-call up-case size-small black col-xs-6 pd-0 right"><i class="fa fa-trophy right-mg-half" aria-hidden="true"></i>Reward student</a>
					<?php endif ?>
				</div>
				<div class="col-xs-12">
					<?php if ($awards): ?>
						<?php foreach ($awards as $value): ?>
							<div class="col-xs-4 award-link" load="<?php echo $value['id']; ?>">
								<div class="square active" style="background-image: url(/template/images/awards/<?php echo $value['type']; ?>.png);" title="<?php echo $value['message']; ?>"></div>
							</div>
						<?php endforeach ?>
					<?php else: ?>
						<p class="size-small up-case red center col-xs-12">No awards yet</p>
					<?php endif ?>
				</div>
				<?php if ($awards): ?>
					<div class="col-xs-12 top-mg-1 bottom-mg-1 devider"></div>
					<div class="col-xs-12">
						<a href="" class="center col-xs-12 award-link size-small up-case bold" load="0">Show all awards</a>
					</div>
				<?php endif ?>
			</div>

			<div id="sec_data" class="bottom-mg-2 col-xs-12 white-block">
				<?php if($my_page): ?>
					<div class="col-xs-12 bottom-mg-1 top-mg-1 fade-trigger hidden-sm hidden-md hidden-lg">
						<p class="col-xs-11 pd-0 up-case size-small black">Trainers & Subscriptions</p>
						<p class="right col-xs-1 pd-0 size-normal"><i class="fade-arrow fa fa-chevron-right" aria-hidden="true"></i></p>
					</div>
					<div class="fade-content">
						<div class="col-xs-12 bottom-mg-1">
							<p class="up-case size-small black">Main trainer</p>
						</div>
						<a href="/trainer/<?php echo $main_trainer_data['id']; ?>" class="col-xs-12 bottom-mg-1 center page-link right">
							<p class="inline size-normal bold left-mg-half">
								<?php echo $main_trainer_data['name']; ?> <?php echo $main_trainer_data['surname']; ?>
							</p>
							<div class="inline avatar-min round cover left-mg-half" style="background-image: url(<?php echo $main_trainer_data['avatar']; ?>);"></div>
						</a>

						<div class="devider col-xs-12"></div>

						<div class="col-xs-12 top-mg-1 bottom-mg-1">
							<p class="up-case size-small black">Subscribed for</p>
						</div>
						<?php if (isset($trainers_data[0])): ?>
							<?php foreach ($trainers_data as $trainer_data): ?>
								<a href="/trainer/<?php echo $trainer_data['id']; ?>" class="col-xs-12 page-link right bottom-mg-half">
									<p class="inline size-normal bold left-mg-half">
										<?php echo $trainer_data['name']; ?> <?php echo $trainer_data['surname']; ?>
									</p>
									<div class="inline avatar-min round cover left-mg-half" style="background-image: url(<?php echo $trainer_data['avatar']; ?>);"></div>
								</a>
							<?php endforeach; ?>
						<?php else: ?>
							<p class="red bold up-case size-small center">No trainers</p>
						<?php endif; ?>
					</div>
				<?php else: ?>
					<div class="col-xs-12">
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
					</div>
				<?php endif; ?>
			</div>

			<div id="targets" class="col-xs-12 white-block bottom-mg-2">
				<div class="col-xs-12 top-mg-1 bottom-mg-1 fade-trigger">
					<p class="up-case col-xs-11 pd-0 size-small black">Targets</p>
					<p class="right col-xs-1 pd-0 size-normal hidden-sm hidden-md hidden-lg"><i class="fade-arrow fa fa-chevron-right" aria-hidden="true"></i></p>
				</div>
				<div class="fade-content">
					<div class="col-xs-12">
						<p class="size-extra black bottom-mg-1">Physical</p>
						<?php if($targets['physical']): ?>
							<?php foreach ($targets['physical'] as $key => $value): ?>
								<?php if ($my_page || $main_trainer): ?>
									<div class="size-normal bottom-mg-half <?php if($value['done']) echo ' unactive'; ?>">
										<?php if($value['done']): ?>
											<i class="target-status left-mg-half fa fa-check"></i>
										<?php else: ?>
											<i class="target-status left-mg-half fa fa-caret-right"></i>
										<?php endif; ?>
										<span class="target-text left-mg-half"><?php echo $value['date']; ?> <span class="bold"><?php echo $value['target']; ?></span></span>
										<?php if(!$value['done']): ?>
											<a class="set-done gray" load="<?php echo $key; ?>" category="1" href=""><i class="left-mg-half fa fa-check"></i></a>
											<a class="edit-btn gray" load="<?php echo $key; ?>" category="1" href=""><i class="left-mg-half fa fa-pencil"></i></a>
										<?php endif; ?>
										<a class="del" load="<?php echo $key; ?>" category="1" href=""><i class="left-mg-half fa fa-close red"></i></a>
										<?php if(!$value['done']): ?>
											<form load="<?php echo $key; ?>" category="1" class="edit-form top-mg-1 col-xs-12 pd-0">
												<p class="inline up-case size-small bold gray">Date: </p>
												<input type="text" name="date" class="datepicker size-small left-pd-2 left-mg-half bottom-mg-1">
												<span><i class="fa fa-calendar gray unactive"></i></span>
												<input class="col-xs-8 pd-0 size-normal black" type="text" name="target" placeholder="Target" value="<?php echo $value['target']; ?>">
												<input class="edit-submit pd-0 col-xs-3 col-xs-offset-1 size-small white up-case" type="submit" name="submit" maxlength="150" value="Change">
											</form>
										<?php endif; ?>
									</div>
								<?php else: ?>
									<p class="size-normal bottom-mg-half<?php if($value['done']) echo ' unactive'; ?>">
										<?php if($value['done']): ?>
											<i class="left-mg-half fa fa-check"></i>
										<?php else: ?>
											<i class="left-mg-half fa fa-caret-right"></i>
										<?php endif; ?>
										<span class="left-mg-half"><?php echo $value['date']; ?> <span class="bold"><?php echo $value['target']; ?></span></span>
									</p>
								<?php endif; ?>
							<?php endforeach; ?>
						<?php else: ?>
							<p class="up-case red size-small center bold">No targets</p>
						<?php endif; ?>
						<?php if ($my_page || $main_trainer): ?>
							<form method="POST" class="top-mg-1 col-xs-12 pd-0" action="/targets/new/1/<?php echo $id; ?>/1">
								<p class="inline up-case size-small bold gray">Date: </p>
								<input type="text" name="date" class="datepicker size-small left-pd-2 left-mg-half bottom-mg-1">
								<span><i class="fa fa-calendar gray unactive"></i></span>
								<input class="col-xs-8 pd-0 size-normal black" type="text" name="target" maxlength="150" placeholder="New target">
								<input class="add-target pd-0 col-xs-3 col-xs-offset-1 size-small white up-case" type="submit" name="submit" value="Add">
							</form>
						<?php endif; ?>
					</div>

					<div class="devider col-xs-12 top-mg-1 bottom-mg-1"></div>

					<div class="col-xs-12">
						<p class="size-extra black bottom-mg-1">Personal</p>
						<?php if($targets['personal']): ?>
							<?php foreach ($targets['personal'] as $key => $value): ?>
								<?php if ($my_page || $main_trainer): ?>
									<div class="size-normal bottom-mg-half <?php if($value['done']) echo ' unactive'; ?>">
										<?php if($value['done']): ?>
											<i class="target-status left-mg-half fa fa-check"></i>
										<?php else: ?>
											<i class="target-status left-mg-half fa fa-caret-right"></i>
										<?php endif; ?>
										<span class="target-text left-mg-half"><?php echo $value['date']; ?> <span class="bold"><?php echo $value['target']; ?></span></span>
										<?php if(!$value['done']): ?>
											<a class="set-done gray" load="<?php echo $key; ?>" category="2" href=""><i class="left-mg-half fa fa-check"></i></a>
											<a class="edit-btn gray" load="<?php echo $key; ?>" category="2" href=""><i class="left-mg-half fa fa-pencil"></i></a>
										<?php endif; ?>
										<a class="del" load="<?php echo $key; ?>" category="2" href=""><i class="left-mg-half fa fa-close red"></i></a>
										<?php if(!$value['done']): ?>
											<form load="<?php echo $key; ?>" category="2" class="edit-form top-mg-1 col-xs-12 pd-0">
												<p class="inline up-case size-small bold gray">Date: </p>
												<input type="text" name="date" class="datepicker size-small left-pd-2 left-mg-half bottom-mg-1">
												<span><i class="fa fa-calendar gray unactive"></i></span>
												<input class="col-xs-8 pd-0 size-normal black" type="text" name="target" placeholder="Target" value="<?php echo $value['target']; ?>">
												<input class="edit-submit pd-0 col-xs-3 col-xs-offset-1 size-small white up-case" type="submit" name="submit" maxlength="150" value="Change">
											</form>
										<?php endif; ?>
									</div>
								<?php else: ?>
									<p class="size-normal bottom-mg-half<?php if($value['done']) echo ' unactive'; ?>">
										<?php if($value['done']): ?>
											<i class="left-mg-half fa fa-check"></i>
										<?php else: ?>
											<i class="left-mg-half fa fa-caret-right"></i>
										<?php endif; ?>
										<span class="left-mg-half"><?php echo $value['date']; ?> <span class="bold"><?php echo $value['target']; ?></span></span>
									</p>
								<?php endif; ?>
							<?php endforeach; ?>
						<?php else: ?>
							<p class="up-case red size-small center bold">No targets</p>
						<?php endif; ?>
						<?php if ($my_page || $main_trainer): ?>
							<form method="POST" class="top-mg-1 col-xs-12 pd-0" action="/targets/new/1/<?php echo $id; ?>/2">
								<p class="inline up-case size-small bold gray">Date: </p>
								<input type="text" name="date" class="datepicker size-small left-pd-2 left-mg-half bottom-mg-1">
								<span><i class="fa fa-calendar gray unactive"></i></span>
								<input class="col-xs-8 pd-0 size-normal black" type="text" name="target" maxlength="150" placeholder="New target">
								<input class="add-target pd-0 col-xs-3 col-xs-offset-1 size-small white up-case" type="submit" name="submit" value="Add">
							</form>
						<?php endif; ?>
					</div>

					<div class="devider col-xs-12 top-mg-1 bottom-mg-1"></div>

					<div class="col-xs-12">
						<p class="size-extra black bottom-mg-1">Other</p>
						<?php if($targets['other']): ?>
							<?php foreach ($targets['other'] as $key => $value): ?>
								<?php if ($my_page || $main_trainer): ?>
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
								<?php else: ?>
									<p class="size-normal bottom-mg-half<?php if($value['done']) echo ' unactive'; ?>">
										<?php if($value['done']): ?>
											<i class="left-mg-half fa fa-check"></i>
										<?php else: ?>
											<i class="left-mg-half fa fa-caret-right"></i>
										<?php endif; ?>
										<span class="left-mg-half"><?php echo $value['date']; ?> <span class="bold"><?php echo $value['target']; ?></span></span>
									</p>
								<?php endif; ?>
							<?php endforeach; ?>
						<?php else: ?>
							<p class="up-case red size-small center bold">No targets</p>
						<?php endif; ?>
						<?php if ($my_page || $main_trainer): ?>
							<form method="POST" class="top-mg-1 col-xs-12 pd-0" action="/targets/new/1/<?php echo $id; ?>/3">
								<p class="inline up-case size-small bold gray">Date: </p>
								<input type="text" name="date" class="datepicker size-small left-pd-2 left-mg-half bottom-mg-1">
								<span><i class="fa fa-calendar gray unactive"></i></span>
								<input class="col-xs-8 pd-0 size-normal black" type="text" name="target" maxlength="150" placeholder="New target">
								<input class="add-target pd-0 col-xs-3 col-xs-offset-1 size-small white up-case" type="submit" name="submit" value="Add">
							</form>
						<?php endif; ?>
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

				$('#targets .del').on('click', function() {
					var category = $(this).attr('category');
					var target = $(this).attr('load');
					var obj = $(this);
					$.post("/targets/del/1/<?php echo $id; ?>/"+category+"/"+target, function (data) {
				        obj.parent().slideUp(200);
				    });
				    return false;
				});

				$('#targets .set-done').on('click', function() {
					var category = $(this).attr('category');
					var target = $(this).attr('load');
					var obj = $(this);
					$.post("/targets/done/1/<?php echo $id; ?>/"+category+"/"+target, function (data) {
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
					$.post("/targets/edit/1/<?php echo $id; ?>/"+category+"/"+target, obj.serialize(), function (data) {
				        obj.parent().slideUp(200, function() {
				        	obj.hide();
				        	obj.parent().find('.target-text').html(obj.find('.col-xs-8').val());
				        	obj.parent().slideDown(400);
				        });
				    });
				    return false;
				});
			</script>
		</div>
	</div>
</div>

<div class="dark-bg photo-upl" style="z-index: 999; display: none;">
	<div class="contact-window center top-pd-1">
		<a href="" class="close-btn size-big"><i class="fa fa-times"></i></a>
		<form action="/student/photo/<?php echo $id; ?>" class="top-mg-4" enctype="multipart/form-data" method="post">
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

<div class="dark-bg add-award" style="z-index: 999; display: none;">
	<div class="contact-window center top-pd-1">
		<a href="" class="close-btn size-big"><i class="fa fa-times"></i></a>
		<form action="/student/add_award/<?php echo $id; ?>" class="top-mg-2" method="post">
			<div class="col-xs-12 award-types">
				<div class="col-xs-3 bottom-mg-1">
					<div class="square active" style="background-image: url(/template/images/awards/1.png);"></div>
				</div>
				<div class="col-xs-3 bottom-mg-1">
					<div class="square" style="background-image: url(/template/images/awards/2.png);"></div>
				</div>
				<div class="col-xs-3 bottom-mg-1">
					<div class="square" style="background-image: url(/template/images/awards/3.png);"></div>
				</div>
				<div class="col-xs-3 bottom-mg-1">
					<div class="square" style="background-image: url(/template/images/awards/4.png);"></div>
				</div>
				<div class="col-xs-3 bottom-mg-1">
					<div class="square" style="background-image: url(/template/images/awards/5.png);"></div>
				</div>
				<div class="col-xs-3 bottom-mg-1">
					<div class="square" style="background-image: url(/template/images/awards/6.png);"></div>
				</div>
				<div class="col-xs-3 bottom-mg-1">
					<div class="square" style="background-image: url(/template/images/awards/7.png);"></div>
				</div>
				<div class="col-xs-3 bottom-mg-1">
					<div class="square" style="background-image: url(/template/images/awards/8.png);"></div>
				</div>
			</div>
			<div class="col-xs-10 col-xs-offset-1 top-mg-2">
				<textarea style="width: 100%; height: 70px;" maxlength="128" placeholder="Description" name="message" class="bottom-mg-1 center black message-field"></textarea>
			</div>
			<input type="hidden" name="type" class="award-type" value="1">
            <input type="submit" name="submit" class="button size-small up-case white col-xs-4 col-xs-offset-4" value="Reward">
		</form>
	</div>
</div>
<script type="text/javascript" src="/template/js/sly.min.js"></script>
<script type="text/javascript">
	$('.input-hidden').on('change', function() {
		$(this).prev().find('.size-small').html('File selected');
		if ($(this).prev().find('.size-small').hasClass('gray')) {
			$(this).prev().find('.size-small').removeClass('gray');
			$(this).prev().find('.size-small').addClass('red');
		}
	});

	$('#galleries .prv').click(function(event) {
		if ($(this).hasClass('ins')) var type = 1;
		else if ($(this).hasClass('ach')) var type = 2;
		else var type = 3;

		$.ajax({
			type: 'POST',
			url: '/student/gallery/<?php echo $id ?>/'+type,
			dataType: 'html',
			success: function(data) {
				$("#galleries").fadeOut('300', function() {
					$("#galleries").after(data);
					$("#gallery .upl").bind('click', upload_call);
					$("#gallery").fadeIn(600);
				});
			}
		});
	});

	$('#galleries .upl').click(upload_call);
	$('.photo-upl .close-btn').click(upload_hide);

	function upload_call() {
		if ($(this).hasClass('ins')) var type = 1;
		else if ($(this).hasClass('ach')) var type = 2;
		else  var type = 3;
		$('.upl-type').val(type);
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
            $('header').css('display', 'block');
        });
        return false;
    }


    $('#awards_preview .add-award-call').click(add_award_call);
	$('.add-award .close-btn').click(add_award_hide);

	function add_award_call() {
		$('.dark-bg.add-award').fadeIn(400);
        $('.contact-window').css({
            marginTop: '-200px',
            opacity: '1'
        });
        $('header').css('display', 'none');
		return false;
	}
	function add_award_hide() {
		setTimeout(window_close_add_award, 500);
        $('.contact-window').css({
            marginTop: '-250px',
            opacity: '0'
        });
		return false;
	}
    function window_close_add_award() {
        $('.dark-bg.add-award').fadeOut(200, function() {
            $('.contact-window').css('margin-top', '-50px');
            $('.contact-result').css('display', 'none');
            $('.contact-form').fadeIn(0);
            $('header').css('display', 'block');
        });
        return false;
    }

    $('.award-types .square').click(function(event) {
    	if (!$(this).hasClass('active')) {
    		$('.award-types .square.active').removeClass('active');
    		$(this).addClass('active');
    		$('.award-type').attr('value', $('.award-types .square').index(this) + 1);
    	}
    });

    $('#awards_preview .award-link').click(function(event) {
		var award = $(this).attr('load');
		$.ajax({
			type: 'POST',
			url: '/student/awards/<?php echo $id; ?>/'+award,
			dataType: 'html',
			success: function(data) {
				$("#awards_preview").after(data);
				$('.dark-bg.awards-view').fadeIn(400);
				$('header').css('display', 'none');
				$('body').css('overflow', 'hidden');
			}
		});
		return false;
	});

    $(document).ready(function() {
    	if ($(window).width() < 768) {
    		$('#main_data').after($('#awards_preview'));
    		$('#awards_preview').after($('#sec_data'));
    		$('#sec_data').after($('#messages'));
    	}

    	<?php if (isset($_SESSION['slide_to']) && $_SESSION['slide_to']): ?>
    		<?php if ($_SESSION['slide_to'] == 1): ?>
    			$('#private').fadeOut(0, function() {
					$('#blogs').fadeIn(0, function() {
						col_1_height = $('.col-1').outerHeight(true);
					});
				});
				$('.blogs-btn').addClass('red');
				$('.private-btn').removeClass('red');
				$('html, body').scrollTop($('#blogs').offset().top-120);
				<?php $_SESSION['slide_to'] = 0; ?>
		    <?php elseif($_SESSION['slide_to'] == 2): ?>
		    	$('html, body').scrollTop($('#private').offset().top-120);
		    	<?php $_SESSION['slide_to'] = 0; ?>
		    <?php elseif($_SESSION['slide_to'] == 3): ?>
		    	$('#private').fadeOut(0, function() {
					$('#notes').fadeIn(0, function() {
						col_1_height = $('.col-1').outerHeight(true);
					});
				});
				$('.notes-btn').addClass('red');
				$('.private-btn').removeClass('red');
				$('html, body').scrollTop($('#notes').offset().top-120);
				<?php $_SESSION['slide_to'] = 0; ?>
		    <?php endif; ?>
		<?php endif; ?>
    });
</script>
<script type="text/javascript" src="/template/js/design.js"></script>

<?php include ROOT . '/views/layouts/footer.php'; ?>