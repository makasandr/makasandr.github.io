<div class="col-xs-12">
	<?php if (!$empty && !empty($videos)): ?>
		<?php foreach ($videos as $video): ?>
			<div class="video col-xs-10 col-xs-offset-1 col-sm-6 col-sm-offset-0 bottom-mg-2">
				<div class="col-xs-12">
					<div class="video-preview cover" style="background-image: url(<?php echo $video['preview']; ?>);">
						<?php if($video['status']): ?>
							<a class="done" href="/lesson/<?php echo $video['id']; ?>">
								<p class="size-video-icon center white"><i class="fa fa-check"></i></p>
								<p class="up-case white size-small bold center bottom-pd-1">Passed</p>
							</a>
						<?php else: ?>
							<a class="none" href="/lesson/<?php echo $video['id']; ?>"></a>
						<?php endif; ?>
					</div>
				</div>
				<div class="top-mg-1 col-xs-8">
					<p class="size-normal bold black"><?php echo $video['name']; ?></p>
				</div>
				<div class="col-xs-4 right top-mg-1">
					<a title="Edit" href="/lesson/edit/<?php echo $video['id']; ?>" class="right-mg-half size-normal"><i class="fa fa-pencil"></i></a>
					<a title="Delete" href="/lesson/del/<?php echo $video['id']; ?>" class="red size-normal"><i class="fa fa-close"></i></a>
				</div>
				<div class="col-xs-12">
					<p class="size-small black"><?php echo $video['about']; ?></p>
				</div>
			</div>
		<?php endforeach; ?>
	<?php else: ?>
		<p class="red center up-case size-normal">No private lessons</p>
	<?php endif; ?>
</div>