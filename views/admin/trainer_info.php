<div id="trainer_info" class="col-xs-10 col-xs-offset-1 bottom-mg-1">
	<div class="gray-line bottom-pd-1 bottom-mg-1">
		<p class="col-xs-6 pd-0 size-small">E-mail</p>
		<p class="col-xs-6 pd-0 size-small bold right"><?php echo $info['mail']; ?></p>
	</div>
	<div class="gray-line bottom-pd-1 bottom-mg-1">
		<p class="col-xs-6 pd-0 size-small">Phone</p>
		<p class="col-xs-6 pd-0 size-small bold right"><?php echo $info['phone']; ?></p>
	</div>
	<div class="gray-line bottom-pd-1 bottom-mg-1">
		<p class="col-xs-6 pd-0 size-small">Registration date</p>
		<p class="col-xs-6 pd-0 size-small bold right"><?php echo date('d.m.Y', $info['regdate']); ?></p>
	</div>
	<div class="gray-line bottom-pd-1 bottom-mg-1">
		<p class="col-xs-6 pd-0 size-small">Rating</p>
		<p class="col-xs-6 pd-0 size-small right"><span class="bold"><?php echo $info['rating']; ?> star<?php if ($info['rating'] != 1) echo "s"; ?></span> in <span class="bold"><?php echo $info['reviews'] ?> review<?php if ($info['reviews'] != 1) echo "s"; ?></span></p>
	</div>
	<div class="gray-line bottom-pd-1 bottom-mg-1">
		<p class="col-xs-6 pd-0 size-small">Programs created</p>
		<p class="col-xs-6 pd-0 size-small right bold"><?php echo $info['created']; ?></p>
	</div>
	<?php if ($info['created']): ?>
		<div class="gray-line bottom-pd-1 bottom-mg-1">
			<p class="col-xs-6 pd-0 size-small">Programs sold</p>
			<p class="col-xs-6 pd-0 size-small right"><span class="bold"><?php echo $info['programs']; ?></span> for <span class="bold"><?php echo $info['programs_cost']; ?>$</span></p>
		</div>
	<?php endif ?>
	<div class="gray-line bottom-pd-1 bottom-mg-1">
		<p class="col-xs-6 pd-0 size-small">Subscribes sold</p>
		<p class="col-xs-6 pd-0 size-small right"><span class="bold"><?php echo $info['subscribes']; ?></span> for <span class="bold"><?php echo $info['subscribes_cost']; ?>$</span></p>
	</div>
	<div class="gray-line bottom-pd-1 bottom-mg-1">
		<p class="col-xs-6 pd-0 size-small">Messages in blog</p>
		<p class="col-xs-6 pd-0 size-small bold right"><?php echo $info['blog']; ?></p>
	</div>
	<p class="col-xs-12 pd-0 size-small bottom-pd-1">Students: <span class="bold"><?php echo $info['students']; ?></span></p>
	<p class="col-xs-12 pd-0 size-small">Active subscribes: <span class="bold"><?php echo $info['active_subscribes']; ?></span></p>
</div>