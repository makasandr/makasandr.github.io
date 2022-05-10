<?php if($trainers): ?>
	<?php $i = 1; ?>
	<?php foreach ($trainers as $value): ?>
		<div load="<?php echo $value['id']; ?>" class="load-tr-info bottom-mg-1 top-mg-1 col-xs-12">
			<p class="col-xs-1 pd-0 top-mg-1"><?php echo $i; ?></p>
			<div class="col-xs-3 col-sm-2 pd-0">
				<div class="round cover avatar-mid" style="background-image: url(<?php echo $value['avatar']; ?>);"></div>
			</div>
			<div class="col-xs-7 col-sm-8 pd-0 top-mg-half">
				<p class="size-normal bold">
					<?php echo $value['name']; ?> <?php echo $value['surname']; ?>
				</p>
				<?php if ($_POST['order'] == 3): ?>
					<p class="size-small">
						<?php if ($value['rating']): ?>
							<?php for ($i=1; $i < 6; $i++): ?>
								<?php if ($i <= intval($value['rating'])): ?>
									<i style="line-height: 20px;" class="fa fa-star red<?php if ($i != 1) echo " left-mg-half"; ?>"></i>
								<?php else: ?>
									<i style="line-height: 20px;" class="fa fa-star-o gray left-mg-half"></i>
								<?php endif ?>
							<?php endfor ?>
						<?php else: ?>
							no rating
						<?php endif ?>
					</p>
				<?php endif ?>
				<?php if ($_POST['order'] == 2): ?>
					<p class="size-small gray">
						<?php echo date('d.m.Y', $value['regdate']); ?>
					</p>
				<?php endif ?>
				<?php if ($_POST['order'] == 1): ?>
					<p class="size-small gray">
						<?php echo $value['total']; ?>$
					</p>
				<?php endif ?>
			</div>
			<div class="col-xs-1 pd-0 top-mg-half right">
				<a title="Edit" href="/admin/trainer/<?php echo $value['id']; ?>" class="size-normal"><i class="fa fa-pencil"></i></a>
				<p title="Info" class="size-normal"><i class="fa fa-info-circle"></i></p>
			</div>
		</div>
		<?php $i++; ?>
	<?php endforeach ?>
	<script>
		$('#trainers .load-tr-info').click(function(event) {
			$('#trainer_info').remove();
			var trainer = $(this).attr('load');

			$.ajax({
				type: 'POST',
				url: '/admin/trainer_info/'+trainer,
				dataType: 'html',
				success: function(data) {
					$(".load-tr-info[load="+trainer+"]").after(data);
				}
			});
		});
	</script>
<?php else: ?>
	<p class="top-mg-2 size-normal up-case red bold center">No trainers</p>
<?php endif ?>