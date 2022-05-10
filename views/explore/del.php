<?php include ROOT . '/views/layouts/header.php'; ?>

<div class="container">
	<div class="white-block col-xs-12 bottom-mg-2 top-mg-2">
		<form action="/explore/del/<?php echo $program_id; ?>" method="POST">
			<p class="col-xs-10 col-xs-offset-1 size-big black center bottom-mg-2 top-mg-4">Do you want to delete program "<?php echo $program_data['name']; ?>"?</p>
			<div class="bottom-mg-1 col-xs-10 col-xs-offset-1 col-sm-4 col-sm-offset-2">
				<input class="block col-xs-10 col-xs-offset-1 col-md-4 col-md-offset-4 size-big white up-case" type="submit" name="submit" value="Yes">
			</div>
			<div class="bottom-mg-2 col-xs-10 col-xs-offset-1 col-sm-4 col-sm-offset-0">
				<input class="block col-xs-10 col-xs-offset-1 col-md-4 col-md-offset-4 size-big white up-case" type="submit" name="deny" value="No">
			</div>
		</form>
	</div>
</div>

<script>
	//
</script>

<?php include ROOT . '/views/layouts/footer.php'; ?>