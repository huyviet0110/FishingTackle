<?php 
	require_once '../form_validation/backend_check/page.php';
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title></title>

	<link rel="stylesheet" type="text/css" href="../css/menu.css">
	<link rel="stylesheet" type="text/css" href="../css/dashboard.css">
	<link rel="stylesheet" type="text/css" href="../css/header.css">
	<link rel="stylesheet" type="text/css" href="../css/content.css">
	<link rel="stylesheet" type="text/css" href="../css/card.css">
	<link rel="stylesheet" type="text/css" href="../css/notification.css">
	<link rel="stylesheet" type="text/css" href="../css/form.css">
	<link rel="stylesheet" type="text/css" href="../css/footer.css">
</head>
<body>
	<?php require_once '../root/menu.php' ?>

	<div id="dashboard">

		<?php require_once '../root/header.php' ?>

		<div class="content">

			<div id="notification" style="margin-bottom: 20px; font-size: 20px;"></div>

			<div class="form">
				<div class="form-title">
					<h3 class="h3-format">Add a new manufacturer</h3>
				</div>
				<div class="form-content">
					<form method="post" action="process_insert.php" enctype="multipart/form-data">
						<div class="form-input">
							<p>Image (Correct format: png, jpg, jpec, gif)</p>
							<input type="file" name="image" id="input_image">
							<div id="image_error"></div>
						</div>
						<div class="form-input">
							<p>Name</p>
							<input type="text" name="name" id="input_name">
							<div id="name_error"></div>
						</div>
						<div class="form-textarea">
							<p>Description</p>
							<textarea name="description" id="input_description"></textarea>
							<div id="description_error"></div>
						</div>
						<div class="form-input">
							<p>Phone number</p>
							<input type="number" name="phone_number" id="input_phone_number">
							<div id="phone_number_error"></div> 
						</div>
						<div class="form-input">
							<p>Address</p>
							<input type="text" name="address" id="input_address"> 
							<div id="address_error"></div>
						</div>
						<div class="form-input">
							<p>Email</p>
							<input type="email" name="email" id="input_email">
							<div id="email_error"></div>
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

	<script src="../form_validation/frontend_check/check_error.js"></script>
	<script src="../form_validation/frontend_check/image.js"></script>
	<script src="../form_validation/frontend_check/insert_image.js"></script>
	<script src="../form_validation/frontend_check/name.js"></script>
	<script src="../form_validation/frontend_check/description.js"></script>
	<script src="../form_validation/frontend_check/phone_number.js"></script>
	<script src="../form_validation/frontend_check/address.js"></script>
	<script src="../form_validation/frontend_check/email.js"></script>
	
	<script type="text/javascript">
		function check() {
			let count = 0;
			const result_check = [
				check_insert_image(),
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
			return (count === 6) ? true : false;
		}
	</script>

	<script src="https://kit.fontawesome.com/9741b0bef5.js" crossorigin="anonymous"></script>
	<?php require_once '../root/notification.php' ?>
	
</body>
</html>