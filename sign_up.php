<?php 

	require_once 'admin/connect.php';



?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title></title>

	<link rel="stylesheet" type="text/css" href="css/page.css">
	<link rel="stylesheet" type="text/css" href="css/header.css">
	<link rel="stylesheet" type="text/css" href="css/menu.css">
	<link rel="stylesheet" type="text/css" href="css/banner.css">
	<link rel="stylesheet" type="text/css" href="css/sign_up.css">
	<link rel="stylesheet" type="text/css" href="css/footer.css">

	<script src="https://kit.fontawesome.com/9741b0bef5.js" crossorigin="anonymous"></script>
</head>
<body>
	<div id="page">

		<?php 
			require_once 'header.php';
			require_once 'menu.php';
		?>

		<div id="container">
			<div class="sign_up">
				<div class="above">
					<h1>CREATE ACCOUNT</h1>
				</div>
				<div class="center">
					<form method="post" action="update_cart.php">
						<input type="text" name="name">
					</form>
				</div>
				<div class="below">

				</div>
			</div>
		</div>

		<?php require_once 'footer.php'; ?>

	</div>

</body>
</html>