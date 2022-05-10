<div class="col-xs-12">
	<?php if (!$empty): ?>
		<?php foreach ($videos as $video): ?>
			<div class="video col-xs-10 col-xs-offset-1 col-sm-6 col-sm-offset-0 bottom-mg-2">
				<div class="col-xs-12">
					<div class="video-preview cover" style="background-image: url(<?php echo $video['preview']; ?>);">
						<?php if ($user === 1): ?>
							<?php if($video['status']): ?>
								<?php if($video['status'] === 2): ?>
									<a class="done" href="/lesson/<?php echo $video['id']; ?>">
										<p class="size-video-icon center white"><i class="fa fa-check"></i></p>
										<p class="up-case white size-small bold center bottom-pd-1"><?php echo $video['status_text']; ?></p>
									</a>
								<?php else: ?>
									<a class="active" href="/lesson/<?php echo $video['id']; ?>">
										<p class="size-video-icon center white"><i class="fa fa-play"></i></p>
									</a>
								<?php endif; ?>
							<?php else: ?>
								<div class="locked">
									<p class="size-video-icon bold center gray"><i class="fa fa-lock"></i></p>
									<p class="up-case gray size-small bold center bottom-pd-1"><?php echo $video['status_text']; ?></p>
								</div>
							<?php endif; ?>
						<?php endif; ?>
					</div>
				</div>
				<div class="top-mg-1 col-xs-8">
					<p class="size-normal bold black"><?php echo $video['name']; ?></p>
				</div>
				<div class="col-xs-4 right top-mg-1">
					<?php if (!empty($video['promo'])): ?>
						<a class="black bold up-case size-small" href="<?php echo $video['promo']; ?>">
							<p>Promo <i class="fa fa-external-link black"></i></p>
						</a>
					<?php endif; ?>
				</div>
				<div class="col-xs-12">
					<p class="size-small black"><?php echo $video['about']; ?></p>
				</div>
			</div>
		<?php endforeach; ?>
	<?php else: ?>
		<p class="red center up-case size-normal">No lessons</p>
	<?php endif; ?>
</div>