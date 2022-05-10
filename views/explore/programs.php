<?php if($programs): ?>
	<?php foreach ($programs as $program): ?>
		<div class="program col-xs-12 col-sm-6 col-md-4">
			<a href="/explore/program/<?php echo $program['id']; ?>" class="col-xs-12">
				<div class="col-xs-4 bottom-mg-2">
					<div class="cover square bottom-mg-half" style="background-image: url(<?php echo $program['avatar']; ?>);"></div>
					<p class="size-small gray center"><?php echo $levels[$program['level']] ?></p>
				</div>
				<div class="col-xs-8 bottom-mg-2">
					<p class="name size-big black bottom-mg-1"><?php echo $program['name']; ?></p>
					<p class="size-normal gray"><?php echo $program['short_about']; ?></p>
				</div>
			</a>
		</div>
	<?php endforeach; ?>
<?php else: ?>
	<p class="size-small up-case bold red center">No programs</p>
<?php endif; ?>