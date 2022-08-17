<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title></title>
</head>
<body>
	<?php include 'header_main.php' ?>

	<h1>SIGN IN</h1>

	<form method="post" action="process_sign_in.php">
		EMAIL
		<input type="email" name="email">
		<br>
		PASSWORD
		<input type="password" name="password">
		<br>
		<a href="forgot_password.php">
			Forgot your password?
		</a>
		<br>
		<button>SIGN IN</button>
		<button>SIGN UP</button>
	</form>

	<?php include 'footer_main.php' ?>
</body>
</html>