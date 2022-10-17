<?php 
	session_start();
	require_once 'admin/connect.php';
	
	if(empty($_SESSION['id'])){
		if(!empty($_COOKIE['remember'])){
			$token = $_COOKIE['remember'];
			$sql = "select id, avatar, name from customers
					where token = '$token'";
			$result = mysqli_query($connect, $sql);
			$result_num_rows = mysqli_num_rows($result);
			if($result_num_rows === 1){
				$each = mysqli_fetch_array($result);
				$_SESSION['id'] = $each['id'];
				$_SESSION['avatar'] = $each['avatar'];
				$_SESSION['name'] = $each['name'];
			}
		}
	}

	if(!empty($_SESSION['id'])){
		header('location:users');
		exit();
	}
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
	<link rel="stylesheet" type="text/css" href="css/signing.css">
	<link rel="stylesheet" type="text/css" href="css/notification.css">
	<link rel="stylesheet" type="text/css" href="css/footer.css">

	<script src="https://kit.fontawesome.com/9741b0bef5.js" crossorigin="anonymous"></script>
</head>
<body>
	<div id="page">

		<?php 
			require_once 'header.php';
			require_once 'menu.php';
		?>

		<?php mysqli_close($connect) ?>

		<div id="container">
			<div class="signing">
				<div class="above">
					<h1>CREATE ACCOUNT</h1>
					<?php require_once 'notification.php' ?>
				</div>
				<div class="center">
					<form method="post" action="process_sign_up.php">
						
						<label for="input_name">Name</label>
						<br>
						<input type="text" name="name" id="input_name">
						<br>

						<label for="input_date_of_birth">Date of birth</label>
						<br>
						<input type="date" name="date_of_birth" id="input_date_of_birth">
						<br>

						<label>GENDER</label>
						<br>
						<input type="radio" name="gender" id="male" value="male" checked>
						<label for="male">Male</label>
						<input type="radio" name="gender" id="female" value="female">
						<label for="female">Female</label>
						<br>

						<label for="input_phone_number">Phone number</label>
						<br>
						<input type="number" name="phone_number" id="input_phone_number">
						<br>

						<label for="input_address">Address</label>
						<br>
						<input type="text" name="address" id="input_address">
						<br>

						<label for="input_email">Email</label>
						<br>
						<input type="email" name="email" id="input_email">
						<br>

						<label for="input_password">Password</label>
						<br>
						<input type="password" name="password" id="input_password">
						<br>

						<button>CREATE</button>
					</form>
				</div>
			</div>
		</div>

		<?php require_once 'footer.php' ?>

	</div>

</body>
</html>