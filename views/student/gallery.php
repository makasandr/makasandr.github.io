<div id="gallery" class="col-xs-12 white-block bottom-mg-2" style="display: none;">
		<p class="col-xs-10">
			<span class="size-big bold">
				<?php if ($type == 1): ?>
					"Inspiration"
				<?php elseif ($type == 2): ?>
					"Achivments"
				<?php else: ?>
					"Work more"
				<?php endif ?>
			</span>
			<span class="size-normal"> photo gallery</span>
		</p>
		<a href="" class="col-xs-2 right gallery-close size-big"><i class="fa fa-times"></i></a>

		<div class="nano col-xs-12 bottom-mg-1">
			<div class="nano-content">
				<?php foreach ($photos as $photo): ?>
					<div load="<?php echo $photo['id']; ?>" class="photo-cover col-xs-12 col-sm-6 col-md-4 top-mg-1 bottom-mg-1">
						<div class="col-xs-12 pd-0">
							<div load="<?php echo $photo['id']; ?>" class="open-photo square cover" style="background-image: url(/upload/images/galleries/<?php echo $photo['id']; ?>_p.jpg);">
								<div class="col-xs-12 pd-0 photo-info hidden-xs">
									<p class="white col-xs-12 center size-normal bottom-mg-1"><?php echo $photo['about']; ?></p>
									<div class="col-xs-8 bottom-mg-1">
										<p class="white bold size-small"><?php echo date('d.m.Y', $photo['date']); ?></p>
										<?php if (isset($photo['trainer'])): ?>
											<a class="white bold size-small" href="/trainer/<?php echo $photo['trainer']; ?>"><?php echo $photo['name']; ?> <?php echo $photo['surname']; ?></a>
										<?php endif ?>
									</div>
									<div class="col-xs-4 bottom-mg-1 right<?php if (isset($photo['trainer'])) echo " top-pd-1"; ?>">
										<?php if ($user == 1 || ($user == 2 && (isset($photo['trainer']) && $photo['trainer'] == $trainer))): ?>
											<a href="/student/del_photo/<?php echo $photo['id']; ?>" class="white size-small"><i class="fa fa-times"></i></a>
										<?php endif ?>
									</div>
								</div>
							</div>
						</div>
						<div class="col-xs-12 pd-0 top-mg-1 bottom-mg-1 hidden-sm hidden-md hidden-lg">
							<p class="col-xs-12 center size-normal bottom-mg-1"><?php echo $photo['about']; ?></p>
							<div class="col-xs-8 bottom-mg-1">
								<p class="bold size-small"><?php echo date('d.m.Y', $photo['date']); ?></p>
								<?php if (isset($photo['trainer'])): ?>
									<a class="bold size-small" href="/trainer/<?php echo $photo['trainer']; ?>"><?php echo $photo['name']; ?> <?php echo $photo['surname']; ?></a>
								<?php endif ?>
							</div>
							<div class="col-xs-4 bottom-mg-1 right">
								<a href="" class="del-photo size-small" load="<?php echo $photo['id']; ?>"><i class="fa fa-times"></i></a>	
							</div>
						</div>
					</div>
				<?php endforeach ?>
			</div>
		</div>

		<p class="col-xs-6 size-small"><?php echo $count; ?> photo<?php if ($count != 1) echo "s"; ?></p>
		<a href="" class="upl <?php echo $type_abr; ?> col-xs-6 size-small right up-case"><i class="fa fa-upload"></i> Upload photo</a>
</div>
<script type="text/javascript">
	$(function() {
		$(".nano").nanoScroller();
	});

	$('.gallery-close').click(function(event) {
		$("#gallery").fadeOut('300', function() {
			$("#galleries").fadeIn(600);
			$("#gallery").remove();
		});
		return false;
	});

	$('#gallery .open-photo').click(function(event) {
		if (event.target !== this)
    	return;

		var photo = $(this).attr('load');
		$.ajax({
			type: 'POST',
			url: '/student/view_photo/'+photo,
			dataType: 'html',
			success: function(data) {
				$("#gallery").after(data);
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
				$('header').css('display', 'none');
				$('body').css('overflow', 'hidden');
			}
		});
		return false;
	});
</script>