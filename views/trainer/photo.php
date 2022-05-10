<div class="dark-bg photo-view" style="display: none; z-index: 999;">
	<div class="window">
		<div class="col-xs-12 pd-0 photo-bg">
			<div style="width: 0; height: 100%; display: inline-block; vertical-align: middle;"></div><img style="width: auto; height: 100%; display: inline-block; vertical-align: middle;" src="/upload/images/galleries/<?php echo $photo['id']; ?>.jpg" alt="">
			<div class="navigation">
				<div style="display: inline-block; vertical-align: middle; height: 100%;"></div>
				<?php if ($prev): ?>
					<a href="" load="<?php echo $prev ?>" class="prev-btn white size-extra fa"></a>
				<?php endif ?>
				<?php if ($next): ?>
					<a href="" load="<?php echo $next ?>" class="next-btn white size-extra fa"></a>
				<?php endif ?>
			</div>
			<a href="" class="close-btn white size-big"><i class="fa fa-times"></i></a>
		</div>
	</div>
	<div class="col-xs-12 top-pd-1 photo-info">
		<p class="col-xs-12 size-normal bottom-mg-1"><?php echo $photo['about']; ?></p>
		<div class="col-xs-6 bottom-mg-1">
			<p class="bold size-small"><?php echo date('d.m.Y', $photo['date']); ?></p>
		</div>
		<div class="col-xs-6 bottom-mg-1 right size-small">
			<?php if ($my_page): ?>
				<a href="" class="del-photo size-small up-case" load="<?php echo $photo['id']; ?>"><i class="fa fa fa-trash"></i> Delete photo</a>
			<?php endif ?>
		</div>
	</div>
</div>
<script>
	$('.dark-bg.photo-view .close-btn, .dark-bg.photo-view').click(function(event) {
		$('.dark-bg.photo-view').fadeOut(200, function() {
			$('body').css('overflow', 'auto');
			$('header').css('display', 'block');
			$(this).remove();
		});
		return false;
	});

	$('.dark-bg.photo-view .window').click(function(event) {
		return false;
	});

	$('.dark-bg.photo-view .prev-btn, .dark-bg.photo-view .next-btn').click(function(event) {
		var photo = $(this).attr('load');
		$.ajax({
			type: 'POST',
			url: '/trainer/view_photo/'+photo,
			dataType: 'html',
			success: function(data) {
				$('.dark-bg.photo-view').remove();
				$("#trainer_gallery").after(data);
				$('.dark-bg.photo-view').fadeIn(0);
				$('.dark-bg.photo-view img').load(function() {
					if ($('.dark-bg.photo-view .window').width() < $('.dark-bg.photo-view img').width()) {
						$('.dark-bg.photo-view img').css({
							width: '100%',
							height: 'auto'
						});
						set = true;
					}
				});
			}
		});
		return false;
	});

	$('.dark-bg.photo-view .del-photo').click(function(event) {
		var photo = $(this).attr('load');

		$.ajax({
			type: 'POST',
			url: '/trainer/del_photo/'+photo,
			dataType: 'html',
			success: function(data) {
				$('.dark-bg.photo-view').fadeOut(200, function() {
					$('body').css('overflow', 'auto');
					$(".photo-cover[load="+photo+"]").fadeOut('300', function() {
						$(this).remove();
					});
					$(this).remove();
				});
			}
		});
		return false;
	});
</script>