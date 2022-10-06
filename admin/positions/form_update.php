<?php 
	
	$table_name = 'positions';
	require_once '../root/get_data_from_id.php';
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
					<h3 class="h3-format">Update this position</h3>
				</div>
				<div class="form-content">
					<form method="post" action="process_update.php">
						<input type="hidden" name="id" value="<?php echo $each['id'] ?>">
						<input type="hidden" name="page" value="<?php echo $page ?>">
						<div class="form-input">
							<p>Name</p>
							<input type="text" name="name" id="input_name" value="<?php echo $each['name'] ?>" required>
							<div id="name_error"></div>
						</div>
						<div class="form-input">
							<p>Salary</p>
							<input type="number" name="salary" id="input_salary" value="<?php echo $each['salary'] ?>" step="any" required>
							<div id="salary_error"></div>
						</div>
						<div class="form-input">
							<p>Level</p>
							<input type="number" name="level" id="input_level" value="<?php echo $each['level'] ?>" required>
							<div id="level_error"></div>
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
	
	<script src="../form_validation/frontend_check/check_error.js"></script>
	<script src="../form_validation/frontend_check/name.js"></script>

	<script type="text/javascript">
		function check() {
			let count = 0;
			const result_check = [
				check_name()
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