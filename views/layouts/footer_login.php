<script type="text/javascript">
	//contacts form
    $('.contact-open').on('click', function() {
        $('.dark-bg').fadeIn(400);
        $('.contact-window').css({
            marginTop: '-150px',
            opacity: '1'
        });
        return false;
    });
    $('.contact-close').on('click', function() {
        setTimeout(window_close, 500);
        $('.contact-window').css({
            marginTop: '-250px',
            opacity: '0'
        });
        return false;
    });
    function window_close() {
        $('.dark-bg').fadeOut(200, function() {
            $('.contact-window').css('margin-top', '-50px');
            $('.contact-result').css('display', 'none');
            $('.contact-form').fadeIn(0);
        });
    }

    $('.contact-submit').on('click', function() {
        $.ajax({
            type: "POST",
            url: "/mail",
            data: {contact: $('.contact-data').val(), social: $('.social-data').val(), message: $('.message-field').val()},
            success: function (data) {
                $('.contact-form').fadeOut('200', function() {
                    $('.contact-result-message').html(data);
                    $('.contact-result').fadeIn(400);
                });
            }
        });
        return false;
    });
</script>

</body>
</html>