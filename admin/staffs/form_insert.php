<?php 
	session_start();
	if(empty($_SESSION['admin_id'])){
		header('location:../index.php');
		exit();
	}

	if($_SESSION['admin_level'] < 2){
		header('location:../admin_page.php');
		exit();
	}
	
	require_once '../form_validation/backend_check/page_get.php';
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title></title>

	<link rel="stylesheet" type="text/css" href="../css/layout.css">
	<link rel="stylesheet" type="text/css" href="../css/menu.css">
	<link rel="stylesheet" type="text/css" href="../css/dashboard.css">
	<link rel="stylesheet" type="text/css" href="../css/header.css">
	<link rel="stylesheet" type="text/css" href="../css/content.css">
	<link rel="stylesheet" type="text/css" href="../css/card.css">
	<link rel="stylesheet" type="text/css" href="../css/notification.css">
	<link rel="stylesheet" type="text/css" href="../css/form.css">
	<link rel="stylesheet" type="text/css" href="../css/footer.css">

	<style type="text/css">
		#dashboard {
			height: 100%;
		}
		.content {
			height: calc(100% - 50px - 67px);
		}
	</style>
</head>
<body>

<div id="layout">

	<?php require_once '../root/menu.php' ?>

	<div id="dashboard">

		<?php require_once '../root/header.php' ?>

		<div class="content">

			<div id="notification" style="margin-bottom: 20px; font-size: 20px;"></div>

			<div class="form">
				<div class="form-title">
					<h3 class="h3-format">Add a new staff</h3>
				</div>
				<div class="form-content">
					<form method="post" action="process_insert.php" enctype="multipart/form-data">
						<div class="form-input">
							<p>Avatar (Correct format: png, jpg, jpec, gif)</p>
							<input type="file" name="image" id="input_image" required style="width: 30%">
							<div id="image_error"></div>
						</div>
						<div class="form-input">
							<p>Name</p>
							<input type="text" name="name" id="input_name" required>
							<div id="name_error"></div>
						</div>
						<div class="form-input">
							<p>Phone number</p>
							<input type="number" name="phone_number" id="input_phone_number" required>
							<div id="phone_number_error"></div> 
						</div>
						<div class="form-input">
							<p>Date of birth</p>
							<input type="date" name="date_of_birth" id="input_date_of_birth" value="2022-01-30" required style="width: 20%">
							<div id="phone_number_error"></div> 
						</div>
						<div class="input-radio">
							<p>Gender</p>
							<input type="radio" id="male" name="gender" value="male" checked>
							<label for="male">Male</label>
							<input type="radio" id="female" name="gender" value="female">
							<label for="female">Female</label>
							<div id="gender_error"></div>
						</div>
						<div class="form-input">
							<p>Address</p>
							<input type="text" name="address" id="input_address" required> 
							<div id="address_error"></div>
						</div>
						<div class="form-input">
							<p>Started working at</p>
							<input type="date" name="started_working_at" id="input_started_working_at" value="2022-01-30" required style="width: 20%"> 
							<div id="started_working_at_error"></div>
						</div>
						<div class="form-input">
							<p>Working time a day (Hours)</p>
							<input type="number" name="working_time_a_day" id="input_working_time_a_day" required> 
							<div id="working_time_a_day_error"></div>
						</div>
						<div class="form-input">
							<p>Email</p>
							<input type="email" name="email" id="input_email" required>
							<div id="email_error"></div>
						</div>
						<div class="form-input">
							<p>Password</p>
							<input type="password" name="password" id="input_password" required>
							<div id="password_error"></div>
						</div>
						<div class="form-input">
							<p>Position</p>

							<?php 
								require_once '../connect.php';
								$sql = "select id, name from positions";
								$positions = mysqli_query($connect, $sql);
							?>

							<select name="position_id" required style="font-size: 16px">

								<?php foreach ($positions as $each): ?>
									
									<option value="<?php echo $each['id'] ?>">
										<?php echo $each['name'] ?>
									</option>

								<?php endforeach ?>

							</select>
							<div id="position_error"></div>
						</div>
						<input type="hidden" name="page" value="<?php echo $page ?>">
						<div class="create-button">
							<button type="submit" onclick="return check();">
								Create
							</button>
						</div>
					</form>
				</div>
			</div>
		</div>
			 
		<?php require_once '../root/footer.php' ?>

	</div>

</div>

	<script src="../form_validation/frontend_check/check_error.js"></script>
	<script src="../form_validation/frontend_check/image.js"></script>
	<script src="../form_validation/frontend_check/insert_image.js"></script>
	<script src="../form_validation/frontend_check/name.js"></script>
	<script src="../form_validation/frontend_check/phone_number.js"></script>
	<script src="../form_validation/frontend_check/address.js"></script>
	<script src="../form_validation/frontend_check/email.js"></script>
	
	<script type="text/javascript">
		function check() {
			let count = 0;
			const result_check = [
				check_insert_image(),
				check_name(),
				check_phone_number(),
				check_address(),
				check_email()
			];
			for(let i = 0; i < result_check.length; i++){
				if(result_check[i] === true){
					count++;
				}
			}
			return (count === result_check.length) ? true : false;
		}
	</script>

	<script src="https://kit.fontawesome.com/9741b0bef5.js" crossorigin="anonymous"></script>
	
	<?php 
		require_once '../root/notification.php';
		mysqli_close($connect);
	?>
	
</body>
</html>