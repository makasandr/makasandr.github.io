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
		<?php if ($value['type']): ?>
			<div class="col-xs-1 right size-normal">
				<a href="/lesson/del_comment/<?php echo $value['id']; ?>"><i class="fa fa-times red"></i></a>
			</div>
		<?php endif ?>
	<?php endforeach; ?>
<?php else: ?>
	<p class="size-small up-case red bold center">No messages</p>
<?php endif; ?>