<?php 
	session_start();
	if(empty($_SESSION['admin_id'])){
		header('location:../index.php');
		exit();
	}

	if($_SESSION['admin_level'] === 1){
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
					<h3 class="h3-format">Add a new size</h3>
				</div>
				<div class="form-content">
					<form method="post" action="process_insert.php">
						<div class="form-input">
							<p>Name</p>
							<input type="text" name="name" id="input_name">
							<div id="name_error"></div>
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
	
	<?php 
		require_once '../connect.php';
		require_once '../root/notification.php';
		mysqli_close($connect);
	?>
	
</body>
</html>