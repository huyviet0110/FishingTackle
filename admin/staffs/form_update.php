<?php 
	
	$table_name = 'admins';
	require_once 'get_data_from_id.php';
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
					<h3 class="h3-format">Update this staff</h3>
				</div>
				<div class="form-content">
					<form method="post" action="process_update.php" enctype="multipart/form-data">

						<input type="hidden" name="id" value="<?php echo $each['id'] ?>">
						<input type="hidden" name="page" value="<?php echo $page ?>">

						<div class="form-input">
							<p>New image</p>
							<input type="file" name="image" id="input_image">
							<div id="image_error"></div>
						</div>

						<div class="form-old-image">
							<p>Old image</p>
							<img src="images/<?php echo $each['avatar'] ?>" height="180px" required>
						</div>

						<div class="form-input">
							<p>Name</p>
							<input type="text" name="name" id="input_name" value="<?php echo $each['name'] ?>" required>
							<div id="name_error"></div>
						</div>

						<div class="form-input">
							<p>Date of birth</p>

							<?php 
								$date_of_birth = date_create($each['date_of_birth']);
								$date_of_birth = date_format($date_of_birth, "Y-m-d");
							?>

							<input type="date" name="date_of_birth" id="input_date_of_birth" value="<?php echo $date_of_birth ?>" required style="width: 20%">
							<div id="date_of_birth_error"></div>
						</div>

						<div class="input-radio">
							<p>Gender</p>

							<?php 
								$gender_label = array('Male', 'Female');
								$gender_value = array('male', 'female');
								$gender = '';
								if($each['gender'] == 1){
									$gender = 'male';
								} else {
									$gender = 'female';
								}
							?>

							<?php for ($i=0; $i < count($gender_value); $i++) { ?>

								<input type="radio" id="<?php echo $gender_value[$i] ?>" name="gender" value="<?php echo $gender_value[$i] ?>"
									
									<?php if(strcmp($gender_value[$i], $gender) === 0) { ?>

										checked

									<?php } ?>

								>

								<label for="<?php echo $gender_value[$i] ?>">
									<?php echo $gender_label[$i] ?>
								</label>

							<?php } ?>

							<div id="gender_error"></div>
						</div>

						<div class="form-input">
							<p>Phone number</p>
							<input type="number" name="phone_number" id="input_phone_number" value="<?php echo $each['phone_number'] ?>" required> 
							<div id="phone_number_error"></div>
						</div>

						<div class="form-input">
							<p>Address</p>
							<input type="text" name="address" id="input_address" value="<?php echo $each['address'] ?>" required> 
							<div id="address_error"></div>
						</div>

						<div class="form-input">
							<p>Started working at</p>

							<?php 
								$started_working_at = date_create($each['started_working_at']);
								$started_working_at = date_format($started_working_at, "Y-m-d");
							?>

							<input type="date" name="started_working_at" id="input_started_working_at" value="<?php echo $started_working_at ?>" required style="width: 20%"> 
							<div id="started_working_at_error"></div>
						</div>

						<div class="form-input">
							<p>Working time a day</p>
							<input type="number" name="working_time_a_day" id="input_working_time_a_day" value="<?php echo $each['working_time_a_day'] ?>" required> 
							<div id="working_time_a_day_error"></div>
						</div>

						<div class="form-input">
							<p>Email</p>
							<input type="email" name="email" id="input_email" value="<?php echo $each['email'] ?>" required> 
							<div id="email_error"></div>
						</div>

						<div class="form-input">
							<p>Password</p>
							<input type="password" name="password" id="input_password" value="<?php echo $each['password'] ?>" required> 
							<div id="password_error"></div>
						</div>

						<div class="form-input">
							<p>Position</p>
							<select name="position_id" required style="font-size: 16px;">

								<?php foreach ($positions as $each_position): ?>
									
									<option value="<?php echo $each_position['id'] ?>"

										<?php if($each_position['id'] === $each['position_id']) { ?>

											selected

										<?php } ?>

									>

										<?php echo $each_position['name'] ?>

									</option>

								<?php endforeach ?>

							</select>
							<div id="password_error"></div>
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
		
		<?php require_once '../root/footer.php' ?>

	</div>

</div>
	
	<script src="../form_validation/frontend_check/check_error.js"></script>
	<script src="../form_validation/frontend_check/image.js"></script>
	<script src="../form_validation/frontend_check/update_image.js"></script>
	<script src="../form_validation/frontend_check/name.js"></script>
	<script src="../form_validation/frontend_check/description.js"></script>
	<script src="../form_validation/frontend_check/phone_number.js"></script>
	<script src="../form_validation/frontend_check/address.js"></script>
	<script src="../form_validation/frontend_check/email.js"></script>

	<script type="text/javascript">
		function check() {
			let count = 0;
			const result_check = [
				check_update_image(),
				check_name(), 
				check_description(), 
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
	<?php require_once '../root/notification.php' ?>

	<?php mysqli_close($connect) ?>

</body>
</html>