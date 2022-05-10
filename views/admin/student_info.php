<div id="student_info" class="col-xs-10 col-xs-offset-1 bottom-mg-1">
	<div class="gray-line bottom-pd-1 bottom-mg-1">
		<p class="col-xs-6 pd-0 size-small">E-mail</p>
		<p class="col-xs-6 pd-0 size-small bold right"><?php echo $info['mail']; ?></p>
	</div>
	<div class="gray-line bottom-pd-1 bottom-mg-1">
		<p class="col-xs-6 pd-0 size-small">Phone</p>
		<p class="col-xs-6 pd-0 size-small bold right"><?php echo $info['phone']; ?></p>
	</div>
	<div class="gray-line bottom-pd-1 bottom-mg-1">
		<p class="col-xs-6 pd-0 size-small">Level</p>
		<p class="col-xs-6 pd-0 size-small bold right"><?php echo Program::getLevelName($info['level']); ?></p>
	</div>
	<div class="gray-line bottom-pd-1 bottom-mg-1">
		<p class="col-xs-6 pd-0 size-small">Registration date</p>
		<p class="col-xs-6 pd-0 size-small bold right"><?php echo date('d.m.Y', $info['regdate']); ?></p>
	</div>
	<div class="gray-line bottom-pd-1 bottom-mg-1">
		<p class="col-xs-6 pd-0 size-small">Programs buyed</p>
		<p class="col-xs-6 pd-0 size-small right"><span class="bold"><?php echo $info['programs']; ?></span> for <span class="bold"><?php echo $info['programs_cost']; ?>$</span></p>
	</div>
	<?php if ($info['programs']): ?>
		<div class="gray-line bottom-pd-1 bottom-mg-1">
			<p class="col-xs-6 pd-0 size-small">Programs finished</p>
			<p class="col-xs-6 pd-0 size-small bold right"><?php echo $info['programs_finished']; ?> (<?php echo $info['finished_percent']; ?>%)</p>
		</div>
	<?php endif ?>
	<div class="gray-line bottom-pd-1 bottom-mg-1">
		<p class="col-xs-6 pd-0 size-small">Subscribes buyed</p>
		<p class="col-xs-6 pd-0 size-small right"><span class="bold"><?php echo $info['subscribes']; ?></span> for <span class="bold"><?php echo $info['subscribes_cost']; ?>$</span></p>
	</div>
	<div class="gray-line bottom-pd-1 bottom-mg-1">
		<p class="col-xs-6 pd-0 size-small">Private lessons done</p>
		<p class="col-xs-6 pd-0 size-small right"><span class="bold"><?php echo $info['private_done']; ?></span> from <span class="bold"><?php echo $info['private']; ?></span></p>
	</div>
	<p class="col-xs-12 pd-0 size-small">Trainers: <span class="bold"><?php echo $info['trainers_data']; ?></span></p>
</div>