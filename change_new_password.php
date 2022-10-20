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

	if(empty($_GET['token'])){
		header('location:sign_in.php');
		exit();
	}

	$token = $_GET['token'];

	$sql = "select customer_id, created_at from forgot_password
			where token = '$token'";
	$result = mysqli_query($connect, $sql);
	if(mysqli_num_rows($result) === 1){
		require_once 'calculate_expired_time.php';
	} else if(mysqli_num_rows($result) === 0){
		header('location:sign_in.php');
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
					<h1>CHANGE NEW PASSWORD</h1>
					<?php require_once 'notification.php' ?>
				</div>
				<div class="center">
					<form method="post" action="process_change_new_password.php">

						<label for="input_password">New password</label>
						<br>
						<input type="password" name="password" id="input_password">
						<br>

						<label for="input_password">Confirm new password</label>
						<br>
						<input type="password" name="confirm_password" id="input_confirm_password">
						<br>

						<input type="hidden" name="token" value="<?php echo $token ?>">

						<button>SUBMIT</button>
					</form>
				</div>
			</div>
		</div>

		<?php require_once 'footer.php' ?>

	</div>

</body>
</html>