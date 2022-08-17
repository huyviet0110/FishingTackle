<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title></title>
</head>
<body>
	<?php include 'header_main.php' ?>

	<h1>CREATE ACCOUNT</h1>

	<form method="post" action="process_sign_up.php">
		FIRST NAME
		<input type="text" name="first_name">
		<br>
		LAST NAME
		<input type="text" name="last_name">
		<br>
		EMAIL
		<input type="email" name="email">
		<br>
		PASSWORD
		<input type="password" name="password">
		<br>
		<button>CREATE</button>
	</form>

	<?php include 'footer_main.php' ?>
</body>
</html>