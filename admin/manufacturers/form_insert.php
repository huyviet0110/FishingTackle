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
	<link rel="stylesheet" type="text/css" href="../css/form.css">
	<link rel="stylesheet" type="text/css" href="../css/footer.css">
</head>
<body>
	<?php require_once '../root/menu.php' ?>

	<div id="dashboard">

		<?php require_once '../root/header.php' ?>

		<div class="content">
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
						</div>
						<div class="form-textarea">
							<p>Description</p>
							<textarea name="description"></textarea>
						</div>
						<div class="form-input">
							<p>Phone number</p>
							<input type="number" name="phone_number"> 
						</div>
						<div class="form-input">
							<p>Address</p>
							<input type="text" name="address"> 
						</div>
						<div class="form-input">
							<p>Email</p>
							<input type="email" name="email"> 
						</div>
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

	<script src="../form_validation/frontend_check/check_image.js"></script><!-- 
	<script src="../form_validation/frontend_check/check_name.js"></script>
	<script src="../form_validation/frontend_check/check_description.js"></script>
	<script src="../form_validation/frontend_check/check_phone_number.js"></script>
	<script src="../form_validation/frontend_check/check_address.js"></script>
	<script src="../form_validation/frontend_check/check_email.js"></script> -->

	<script type="text/javascript">
		function check() {

			check_image();
			// check_name();
			// check_description();
			// check_phone_number();
			// check_address();
			// check_email();

			if(check_image() == true){
				return true;
			}

		}
	</script>
	
</body>
</html>