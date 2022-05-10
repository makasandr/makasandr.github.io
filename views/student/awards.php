<div class="dark-bg awards-view" style="display: none; z-index: 999;">
	<div class="window">
		<div class="col-xs-12 pd-0 award-bg">
			<div class="col-xs-12 award-img" style="height: 50%; background-image: url(/template/images/awards/<?php echo $awards[$award]['type']; ?>.png)"></div>
			<div class="award-content">
				<div class="col-xs-10 col-xs-offset-1 col-sm-6 col-sm-offset-3 col-md-4 col-md-offset-4">
					<p class="col-xs-12 center pd-0 size-normal bold"><?php echo $awards[$award]['message']; ?></p>
				</div>
				<div class="col-xs-10 col-xs-offset-1 top-mg-1 bottom-mg-1" style="border-bottom: 1px solid #ccc;"></div>
				<div class="col-xs-10 col-xs-offset-1">
					<div class="col-xs-9 pd-0">
						<a href="/trainer/<?php echo $awards[$award]['trainer']; ?>" class="left col-xs-12 page-link bottom-mg-1">
							<div class="inline avatar-min round cover left-mg-half" style="background-image: url(<?php echo $awards[$award]['avatar']; ?>);"></div>
							<p class="inline size-normal bold left-mg-half">
								<?php echo $awards[$award]['name']; ?> <?php echo $awards[$award]['surname']; ?>
							</p>
						</a>
					</div>
					<div class="col-xs-3 pd-0 right">
						<div class="size-small gray">
							<p class="bold"><?php echo date('H:i', $awards[$award]['date']); ?></p>
							<p><?php echo date('d.m.Y', $awards[$award]['date']); ?></p>
						</div>
					</div>
				</div>
			</div>
			<a href="" class="close-btn size-big"><i class="fa fa-times"></i></a>
		</div>
	</div>
	<div class="col-xs-12 top-pd-1 awards-list">
		<div class="col-xs-12 frame bottom-mg-1">
			<ul class="slidee">
				<?php foreach ($awards as $value): ?>
					<li class="award-open<?php if($award == $value['id']) echo " active"; ?>" load="<?php echo $value['id']; ?>">
						<div class="col-xs-12 pd-0" style="height: 100%;">
							<div class="square" style="background-image: url(/template/images/awards/<?php echo $value['type']; ?>.png);" title="<?php echo $value['message']; ?>"></div>
						</div>
					</li>
				<?php endforeach ?>
			</ul>
		</div>
	</div>
</div>
<script>
	$('.dark-bg.awards-view .close-btn').click(function(event) {
		$('.dark-bg.awards-view').fadeOut(200, function() {
			$('body').css('overflow', 'auto');
			$('header').css('display', 'block');
			$(this).remove();
		});
		return false;
	});

	$('.dark-bg.awards-view').click(function(event) {
		if (event.target !== this)
    	return;

		$('.dark-bg.awards-view').fadeOut(200, function() {
			$('body').css('overflow', 'auto');
			$(this).remove();
		});
		return false;
	});

	$('.dark-bg.awards-view .window').click(function(event) {
		return false;
	});

	$('.award-open').click(function(event) {
		if (!$(this).hasClass('active')) {
			var award = $(this).attr('load');
			$.ajax({
				type: 'POST',
				url: '/student/awards/<?php echo $student; ?>/'+award,
				dataType: 'html',
				success: function(data) {
					$('.awards-view').wrapAll('<div>').parent().html(data); 
					$('.dark-bg.awards-view').fadeIn(0);
				}
			});
			return false;
		}
	});

	var options = {
		horizontal: 1,
		itemNav: 'basic',
		speed: 300,
		mouseDragging: 1,
		touchDragging: 1,
		scrollBy: 1,
	};
	$('.awards-list .frame').css('opacity', '0');
	setTimeout("$('.awards-list .frame').sly(options); $('.awards-list .frame').css('opacity', '1');", 500);
</script>