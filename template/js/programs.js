//programs select menu
$('#program_name i').on('mouseenter', function() {
	if (!$('#programs').is(':visible')) programs_open();
});
$('#program_name').on('click', function() {
	if ($('#programs').is(':visible')) programs_close();
	else programs_open();
});
$('#programs').on('mouseleave', function() {
	if ($('#programs').is(':visible')) programs_close();
});

function programs_open() {
	$('#programs').slideDown('400');
	$('#program_name i').addClass('red');
}
function programs_close() {
	$('#programs').slideUp('200');
	$('#program_name i').removeClass('red');
}