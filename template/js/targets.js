//edit target
$('#targets .edit-btn').on('click', function() {
	if (!$(this).parent().find('.edit-form').is(':visible')) {
		$(this).parent().find('.edit-form').slideDown('400');
	} else {
		$(this).parent().find('.edit-form').slideUp('200');
	}
	return false;
});