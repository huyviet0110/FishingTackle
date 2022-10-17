<?php 
	session_start();
	require_once '../../admin/connect.php';

	if(isset($_COOKIE['remember'])){
		$token = $_COOKIE['remember'];
		$sql = "select * from customers where token = '$token'";
		$result = mysqli_query($connect, $sql);
		$result_num_rows = mysqli_num_rows($result);
		if($result_num_rows === 1){
			$each = mysqli_fetch_array($result);
			$_SESSION['id'] = $each['id'];
			$_SESSION['avatar'] = $each['avatar'];
			$_SESSION['name'] = $each['name'];
		}
	}

	if(!isset($_SESSION['id'])){
		header('location:../../sign_in.php');
		exit();
	}
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title></title>

	<link rel="stylesheet" type="text/css" href="../../admin/css/menu.css">
	<link rel="stylesheet" type="text/css" href="../../admin/css/dashboard.css">
	<link rel="stylesheet" type="text/css" href="../../admin/css/header.css">
	<link rel="stylesheet" type="text/css" href="../../admin/css/content.css">
	<link rel="stylesheet" type="text/css" href="../../admin/css/card.css">
	<link rel="stylesheet" type="text/css" href="../../admin/css/notification_crud.css">
	<link rel="stylesheet" type="text/css" href="../../admin/css/form.css">
	<link rel="stylesheet" type="text/css" href="../../admin/css/footer.css">

	<style type="text/css">
		.radio-button input[type='radio'] {
			outline: none;
			width: auto;
			margin: 0 0 20px 0;
		}
		.radio-button label[for='male'] {
			margin-right: 12px;
		}
	</style>

	<script src="https://kit.fontawesome.com/9741b0bef5.js" crossorigin="anonymous"></script>
</head>
<body>

	<?php require_once '../sidebar.php' ?>

	<div id="dashboard">

		<?php require_once '../header.php' ?>

		<div class="content">

			<div id="notification" style="margin-bottom: 20px; font-size: 20px;"></div>

			<div class="form">
				<div class="form-title">
					<h3 class="h3-format">Update personal information</h3>
				</div>
				<div class="form-content">
					<form method="post" action="process_update.php" enctype="multipart/form-data">
						<div class="form-input">
							<p>New avatar</p>
							<input type="file" name="avatar" id="input_avatar">
							<div id="avatar_error"></div>
						</div>

						<?php if(!empty($_SESSION['avatar'])){ ?>
							<div class="form-old-image">
								<p>Old avatar</p>
								<img src="avatars/<?php echo $_SESSION['avatar'] ?>" height="180px" width="180px" style="border: 1px solid white; border-radius: 50%;">
							</div>
						<?php } else { ?>
							<div class="form-old-image" style="height: 160px; padding-top: 20px;">
								<p>Old avatar</p>
								<i class="fa-solid fa-user" style="padding: 20px;font-size: 60px;border: 1px solid black; border-radius: 50%; margin-top: 10px;"></i>
							</div>
						<?php } ?>

						<div class="form-input">
							<p>Name</p>
							<input type="text" name="name" id="input_name" value="<?php echo $each['name'] ?>">
							<div id="name_error"></div>
						</div>

						<div class="form-input">
							<p>Date of birth</p>

							<?php 
								$date_of_birth = date_create($each['date_of_birth']);
								$date_of_birth = date_format($date_of_birth, "Y-m-d");
							?>

							<input type="date" name="date_of_birth" id="input_date_of_birth" value="<?php echo $date_of_birth ?>" style="width: 160px;">
							<div id="date_of_birth_error"></div>
						</div>

						<div class="form-input radio-button">
							<p>Gender</p>

							<?php 
								$gender_label = array('Male', 'Female');
								$gender_array = array('male', 'female');
								$gender = '';

								if($each['gender'] == 1){
									$gender = 'male';
								} else if($each['gender'] == 0){
									$gender = 'female';
								}
							?>

							<?php for ($i=0; $i < count($gender_array); $i++) { ?>
								<input type="radio" name="gender" id="<?php echo $gender_array[$i] ?>" value="<?php echo $gender_array[$i] ?>" 
									<?php if(strcmp($gender_array[$i], $gender) === 0) { ?>
										checked
									<?php } ?>
								> 
								<label for="<?php echo $gender_array[$i] ?>"><?php echo $gender_label[$i] ?></label>
							<?php } ?>
							<div id="gender_error"></div>
						</div>

						<div class="form-input">
							<p>Phone number</p>
							<input type="number" name="phone_number" id="input_phone_number" value="<?php echo $each['phone_number'] ?>"> 
							<div id="phone_number_error"></div>
						</div>

						<div class="form-input">
							<p>Address</p>
							<input type="text" name="address" id="input_address" value="<?php echo $each['address'] ?>"> 
							<div id="address_error"></div>
						</div>

						<div class="save-button">
							<button type="submit" onclick="return check();">
								Save Changes
							</button>
						</div>
					</form>
				</div>
			</div>
		</div>
		
		<div class="footer">
			<p>
				<strong>
					Copyright
					<i class="fa-regular fa-copyright"></i>
					2021-2022 
					<a href="../admin">FishingTackle.</a>
				</strong>
				All rights reserved
			</p>
		</div>

	</div>
	
	<script src="../../admin/form_validation/frontend_check/check_error.js"></script>
	<script src="../../admin/form_validation/frontend_check/name.js"></script>
	<script src="../../admin/form_validation/frontend_check/phone_number.js"></script>
	<script src="../../admin/form_validation/frontend_check/address.js"></script>

	<script type="text/javascript">
		function check() {
			let count = 0;
			const result_check = [
				check_name(),
				check_phone_number(), 
				check_address()
			];
			for(let i = 0; i < result_check.length; i++){
				if(result_check[i] === true){
					count++;
				}
			}
			return (count === result_check.length) ? true : false;
		}
	</script>

	<?php require_once '../../admin/root/notification.php' ?>

	<?php mysqli_close($connect) ?>

</body>
</html>