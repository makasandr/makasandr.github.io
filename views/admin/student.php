<?php include ROOT . '/views/layouts/header.php'; ?>

<div class="container">
	<div class="row">
		<div class="top-mg-4 bottom-mg-1 col-xs-10 col-xs-offset-1 col-md-12 col-md-offset-0">
			<p class="up-case size-small black gray-line"><?php if(!$id) echo "Add student account"; else echo "Change student account" ?></p>
		</div>
		<form action="/admin/student<?php if($id) echo "/".$id; ?>" method="POST">
			<div class="col-xs-10 col-xs-offset-1 col-md-6 col-md-offset-0">
				<input class="col-xs-12 pd-0 size-normal black top-mg-2 bottom-mg-half" type="text" name="name" maxlength="150" placeholder="Name" value="<?php echo $data['name']; ?>">
				<?php if(isset($errors['name'])): ?>
					<p class="size-small up-case red bottom-mg-half">Field can't be empty</p>
				<?php endif; ?>

				<input class="col-xs-12 pd-0 size-normal black top-mg-2 bottom-mg-half" type="text" name="surname" maxlength="150" placeholder="Surname" value="<?php echo $data['surname']; ?>">
				<?php if(isset($errors['surname'])): ?>
					<p class="size-small up-case red bottom-mg-half">Field can't be empty</p>
				<?php endif; ?>

				<input class="col-xs-12 pd-0 size-normal black top-mg-2 bottom-mg-half" type="text" name="phone" maxlength="150" placeholder="Phone" value="<?php echo $data['phone']; ?>">
				<?php if(isset($errors['phone'])): ?>
					<p class="size-small up-case red bottom-mg-half">Field can't be empty</p>
				<?php endif; ?>
			</div>

			<div class="col-xs-10 col-xs-offset-1 col-md-6 col-md-offset-0">
				<input class="col-xs-12 pd-0 size-normal black top-mg-2 bottom-mg-half" type="text" name="mail" maxlength="150" placeholder="e-Mail" value="<?php echo $data['mail']; ?>">
				<?php if(isset($errors['mail'])): ?>
					<p class="size-small up-case red bottom-mg-half">Field can't be empty</p>
				<?php endif; ?>

				<input class="col-xs-12 pd-0 size-normal black top-mg-2 bottom-mg-<?php if(isset($errors['uin'])) echo "half"; else echo "1"; ?>" type="text" name="uin" maxlength="150" placeholder="UIN" value="<?php echo $data['uin']; ?>">
				<?php if(isset($errors['uin'])): ?>
					<p class="size-small up-case red bottom-mg-1">Field can't be empty or UIN already exist</p>
				<?php endif; ?>

				
				<p class="size-small bold bottom-mg-half">Main trainer:</p>
				<div class="select-style">
					<select name="main_trainer" class="col-xs-12 pd-0 trainer-select bold size-small">
						<?php foreach ($trainers as $value): ?>
							<option value="<?php echo $value['id']; ?>" <?php if($value['id'] == $data['main_trainer']) echo "selected"; ?>><?php echo $value['name']; ?> <?php echo $value['surname']; ?></option>
						<?php endforeach ?>
					</select>
				</div>
			</div>
			<input class="add-target top-mg-2 col-xs-10 col-xs-offset-1 col-md-4 col-md-offset-4 size-small white up-case" type="submit" name="submit" value="<?php if(!$id) echo "Add"; else echo "Change" ?>">
			<?php if (isset($errors['submit'])): ?>
				<p class="top-mg-1 col-xs-12 center size-small red bold">Error on server, please try again later.</p>
			<?php endif ?>
		</form>
		<div class="col-xs-12"></div>
	</div>
</div>

<?php include ROOT . '/views/layouts/footer.php'; ?>