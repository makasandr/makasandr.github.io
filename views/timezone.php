<script type="text/javascript" src="/template/js/jstz.min.js"></script>
<script type="text/javascript" src="/template/js/jquery.js"></script>
<script>
    timezone = jstz.determine();
	$.post( "/timezone", {timezone: timezone.name()});
</script>