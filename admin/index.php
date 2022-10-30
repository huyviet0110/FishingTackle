<?php 
	session_start();
	require_once 'connect.php';

	if(empty($_SESSION['admin_id'])){
		if(!empty($_COOKIE['admin_remember'])){
			$token = $_COOKIE['admin_remember'];
			$sql = "select 
						admins.id, 
						admins.avatar, 
						admins.name, 
						positions.level					
					from admins
					join positions on positions.id = admins.position_id
					where admins.token = '$token'";
			$result = mysqli_query($connect, $sql);
			$result_num_rows = mysqli_num_rows($result);
			if($result_num_rows === 1){
				$each = mysqli_fetch_array($result);
				$_SESSION['admin_id'] = $each['id'];
				$_SESSION['admin_avatar'] = $each['avatar'];
				$_SESSION['admin_name'] = $each['name'];
				$_SESSION['admin_level'] = $each['level'];
			}
		}
	}

	if(!empty($_SESSION['admin_id'])){
		header('location:admin_page.php');
		exit();
	}
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title></title>

	<link rel="stylesheet" type="text/css" href="../css/page.css">
	<link rel="stylesheet" type="text/css" href="../css/header.css">
	<link rel="stylesheet" type="text/css" href="../css/menu.css">
	<link rel="stylesheet" type="text/css" href="../css/banner.css">
	<link rel="stylesheet" type="text/css" href="../css/signing.css">
	<link rel="stylesheet" type="text/css" href="../css/notification.css">
	<link rel="stylesheet" type="text/css" href="../css/footer.css">

	<script src="https://kit.fontawesome.com/9741b0bef5.js" crossorigin="anonymous"></script>
</head>
<body>
	<div id="page">

		<div id="header">
			<div class="above">
				<div class="left">
					<form>
						<div>
							<a href="../">
								BACK TO HOME
							</a>
						</div>
					</form>
				</div>
				<div class="right">
					<ul>
						<li>
							<a href="#" style="margin-left: 30px">
								ADMIN SIGN IN PAGE
							</a>
						</li>
					</ul>
				</div>
			</div>

			<div class="below">
				<div class="center" style="font-family: sans-serif; text-transform: uppercase;">
					<p>Sign in to use admin features</p>
				</div>
			</div>
		</div>

		<div id="menu">
			<div class="left" >
				<a href="index.php">
					<img src="../logo/logo.png">
				</a>
			</div>

			<div class="right">

			</div>
		</div>

		<?php mysqli_close($connect) ?>

		<div id="container">
			<div class="signing">
				<div class="above">
					<h1>SIGN IN</h1>
					
					<div id="notification">
						<div class="error">
							<?php 
								if (!empty($_SESSION['error'])) {
									echo $_SESSION['error'];
									unset($_SESSION['error']);
								}
							?>
						</div>
						<div class="success">
							<?php 
								if (!empty($_SESSION['success'])) {
									echo $_SESSION['success'];
									unset($_SESSION['success']);
								}
							?>
						</div>
					</div>
				</div>
				<div class="center">
					<form method="post" action="process_sign_in.php">

						<label for="input_email">Email</label>
						<br>
						<input type="email" name="email" id="input_email">
						<br>

						<label for="input_password">Password</label>
						<br>
						<input type="password" name="password" id="input_password">
						<br>

						<button>SIGN IN</button>
						<a href="forgot_password.php">Forgot your password?</a>
					</form>
				</div>
			</div>
		</div>

		<div id="footer">
			<div class="above">
				<div class="footer-content">
					<img src="../logo/logo_2.png">
				</div>
				<div class="footer-content">
					<h4>NEWSLETTER</h4><br>
					<p style="font-style: italic;">Subscribe for exclusive offers, special events and a good tall fish tale or two.</p>
					<br>
					<form method="post" action="#">
						<input type="email" name="email" placeholder="Email">
						<button>SIGN UP</button>
					</form>
				</div>
				<div class="footer-content">
					<h4>LINKS</h4><br>
					<p>Shop</p>
					<p>About Us</p>
					<p>Shipping</p>
					<p>Terms</p>
					<p>Privacy</p>
					<p>Returns</p>
				</div>
				<div class="footer-content">
					<h4>GET IN TOUCH</h4><br>
					<span>Contact us </span>
					<a href="#" style="text-decoration: underline;">info@huyviet.com</a><br><br>
					<i class="fa-brands fa-instagram"></i>
					<i class="fa-brands fa-facebook-f"></i>
					<i class="fa-brands fa-pinterest-p"></i><br><br>
					<img src="../logo/logo_2.png">
				</div>
			</div>

			<div class="below">
				<p style="color: #a8a476;">Accepted Payments</p>
				<i class="fa-brands fa-cc-amex"></i>
				<i class="fa-brands fa-cc-discover"></i>
				<i class="fa-brands fa-cc-mastercard"></i>
				<i class="fa-brands fa-paypal"></i>
				<i class="fa-brands fa-cc-visa"></i>
				<br>
				<p>
					<i class="fa-regular fa-copyright" style="color: #a8a476; font-size: 16px;"></i>
					<span>2022, </span>
					<a href="index.php">FishingTackle</a>
					<span> | Site by</span> 
					<a href="#">Huy Viet</a>
				</p>
			</div>
		</div>

	</div>

</body>
</html>