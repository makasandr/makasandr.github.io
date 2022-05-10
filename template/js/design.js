var col_1_left;
var col_1_top;
var col_1_width;
var col_1_height;
var col_2_left;
var col_2_top;
var col_2_width;
var col_2_height;
function sizes_sets() {
	col_1_left = $('.col-1').offset().left;
	col_1_top = $('.col-1').offset().top;
	col_1_width = $('.col-1').outerWidth(true);
	col_1_height = $('.col-1').outerHeight(true);
	col_2_left = $('.col-2').offset().left;
	col_2_top = $('.col-2').offset().top;
	col_2_width = $('.col-2').outerWidth(true);
	col_2_height = $('.col-2').outerHeight(true);
};

$(window).on('scroll resize load', function(event) {
	if ($(window).width() > 768) {
		var pos = 1;
		if (col_1_height > col_2_height) {
			if ($(window).scrollTop() > (col_2_top+col_2_height-$(window).height())) var pos = 2;
			if ($(window).scrollTop() > (col_1_top+col_1_height-$(window).height())) var pos = 4;
			if ($(window).scrollTop() < col_2_top) var pos = 1;
			if ($(window).height() > col_2_height) {
				if (($(window).scrollTop() + 80) > col_2_top) var pos = 3;
				if ($(window).scrollTop() > (col_1_top+col_1_height-col_2_height-80)) var pos = 4;
			}

			if (pos == 2) {
				$('.col-2').addClass('fixed');
				$('.col-2').css({
					'left': (col_2_left)+'px',
					'width': col_2_width+'px',
					'padding-top': 0
				});
			} else if (pos == 3) {
				$('.col-2').addClass('fixed');
				$('.col-2').addClass('top');
				$('.col-2').css({
					'left': (col_2_left)+'px',
					'width': col_2_width+'px',
					'padding-top': 0
				});
			} else if (pos == 4) {
				if ($('.col-2').hasClass('fixed')) {
    				$('.col-2').removeClass('fixed');
    				$('.col-2').css({
    					'left': 0,
    					'padding-top': ($('.col-1').outerHeight()-$('.col-2').outerHeight())+'px'
    				});
    			}
			} else {
				if ($('.col-2').hasClass('fixed')) {
    				$('.col-2').removeClass('fixed');
    				$('.col-2').css({
    					'left': 0,
    					'padding-top': 0
    				});
    			}
			}
		} else {
			if ($(window).scrollTop() > (col_1_top+col_1_height-$(window).height())) var pos = 2;
			if ($(window).scrollTop() > (col_2_top+col_2_height-$(window).height())) var pos = 4;
			if ($(window).scrollTop() < col_1_top) var pos = 1;
			if ($(window).height() > col_1_height) {
				if (($(window).scrollTop() + 80) > col_1_top) var pos = 3;
				if ($(window).scrollTop() > (col_2_top+col_2_height-col_1_height-80)) var pos = 4;
			}

			if (pos == 2) {
				$('.col-1').addClass('fixed');
				$('.col-1').css({
					'left': col_1_left+'px',
					'width': col_1_width+'px',
					'padding-top': 0
				});
				$('.col-2').css('margin-left',  col_2_left-col_1_left+'px');
			} else if (pos == 3) {
				$('.col-1').addClass('fixed');
				$('.col-1').addClass('top');
				$('.col-1').css({
					'left': (col_1_left)+'px',
					'width': col_1_width+'px',
					'padding-top': 0
				});
				$('.col-2').css('margin-left',  col_2_left-col_1_left+'px');
			} else if (pos == 4) {
				if ($('.col-1').hasClass('fixed')) {
    				$('.col-1').removeClass('fixed');
    				$('.col-1').css({
    					'left': 0,
    					'padding-top': ($('.col-2').outerHeight()-$('.col-1').outerHeight())+'px'
    				});
    				$('.col-2').css('margin-left',  0);
    			}
			} else {
				if ($('.col-1').hasClass('fixed')) {
    				$('.col-1').removeClass('fixed');
    				$('.col-1').css({
    					'left': 0,
    					'padding-top': 0
    				});
    				$('.col-2').css('margin-left',  0);
    			}
			}
		}
	}
});

$('.fade-trigger').click(function(event) {
	$(this).find('.fade-arrow').toggleClass('on');
	$('.fade-content:eq('+$('.fade-trigger').index(this)+')').slideToggle(200);
});