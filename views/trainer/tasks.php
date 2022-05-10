<?php if ($tasks): ?>
	<?php foreach ($tasks as $task): ?>
		<div class="<?php if($task['status'] == 1) echo 'unactive'; ?>">
			<div class="col-xs-3 pd-0 right">
				<?php if ($task['status'] == 0): ?>
					<a class="size-normal red" href="/trainer/deltask/<?php echo $task['id']; ?>"><i class="fa fa-close"></i></a>
					<p class="size-big"><?php echo date('H:i', $task['date']); ?></p>
				<?php else: ?>
					<p class="size-normal"><i class="fa fa-check"></i></p>
					<p class="size-big"><?php echo date('H:i', $task['date']); ?></p>
				<?php endif; ?>
			</div>
			<div class="col-xs-9 pd-0 left-pd-1">
				<?php if($task['status'] == 0): ?>
					<a class="block" href="/lesson/new/<?php echo $task['id']; ?>/0"><p class="inline size-extra"><?php echo $task['name']; ?></p> <i class="size-big fa fa-pencil-square-o"></i></a>
				<?php else: ?>
					<p class="size-extra"><?php echo $task['name']; ?></p>
				<?php endif; ?>
				<?php if(!empty($task['students'])): ?>
					<div class="bottom-mg-2">
						<?php if (count($task['students']) > 1): ?>
							<a href="" class="list-triger block up-case size-small bold"><i class="right-mg-half fa fa-caret-down"></i> <?php echo count($task['students']); ?> students</a>
							<div style="display: none;">
								<?php foreach ($task['students'] as $student): ?>
									<a href="/student/<?php echo $student; ?>" class="block top-mg-half page-link">
										<div class="inline avatar-min round cover right-mg-half" style="background-image: url(<?php echo $students_info[$student]['avatar']; ?>);"></div>
										<p class="inline size-normal bold">
											<?php echo $students_info[$student]['name']; ?> <?php echo $students_info[$student]['surname']; ?>
										</p>
									</a>
								<?php endforeach ?>
							</div>
						<?php else: ?>
							<a href="/student/<?php echo $task['students'][0]; ?>" class="block top-mg-half page-link">
								<div class="inline avatar-min round cover right-mg-half" style="background-image: url(<?php echo $students_info[$task['students'][0]]['avatar']; ?>);"></div>
								<p class="inline size-normal bold">
									<?php echo $students_info[$task['students'][0]]['name']; ?> <?php echo $students_info[$task['students'][0]]['surname']; ?>
								</p>
							</a>
						<?php endif; ?>
					</div>
				<?php else: ?>
					<div class="bottom-mg-2"></div>
				<?php endif; ?>
			</div>
		</div>
	<?php endforeach; ?>
<?php else: ?>
	<p class="up-case size-small red bottom-mg-2 center bold">No tasks</p>
<?php endif; ?>

<script type="text/javascript">
	$('.list-triger').on('click', function() {
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
</script>