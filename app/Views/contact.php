<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Hubungi kami</title>
</head>

<body>

	<h1>Contact Us</h1>
	<p>Hubungi kami melalui form berikut</p>

	<?php if (session()->getFlashdata('success')): ?>
		<p><strong><?= session()->getFlashdata('success') ?></strong></p>
	<?php endif; ?>

	<form action="/contact" method="post">
		<?= csrf_field() ?>
		
		<div>
			<label for="name">Name</label><br>
			<input type="text" name="name" id="name" placeholder="your name" 
				   value="<?= isset($input['name']) ? esc($input['name']) : '' ?>" required/>
			<?php if (isset($validation) && $validation->hasError('name')): ?>
				<br><small><em><?= $validation->getError('name') ?></em></small>
			<?php endif; ?>
		</div>
		<br>

		<div>
			<label for="email">Email</label><br>
			<input type="email" name="email" id="email" placeholder="your email address" 
				   value="<?= isset($input['email']) ? esc($input['email']) : '' ?>" required/>
			<?php if (isset($validation) && $validation->hasError('email')): ?>
				<br><small><em><?= $validation->getError('email') ?></em></small>
			<?php endif; ?>
		</div>
		<br>

		<div>
			<label for="message">Message</label><br>
			<textarea name="message" id="message" cols="30" rows="5" placeholder="write your message" required><?= isset($input['message']) ? esc($input['message']) : '' ?></textarea>
			<?php if (isset($validation) && $validation->hasError('message')): ?>
				<br><small><em><?= $validation->getError('message') ?></em></small>
			<?php endif; ?>
		</div>
		<br>

		<div>
			<input type="submit" value="Kirim">
			<input type="reset" value="Reset">
		</div>
	</form>

</body>

</html>