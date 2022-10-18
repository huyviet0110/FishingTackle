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
	<link rel="stylesheet" type="text/css" href="../css/notification_crud.css">
	<link rel="stylesheet" type="text/css" href="../css/pagination.css">
	<link rel="stylesheet" type="text/css" href="../css/footer.css">
</head>
<body>
	<?php 
		require_once '../root/menu.php';
		require_once 'dashboard.php';
	?>
	
	<script src="https://kit.fontawesome.com/9741b0bef5.js" crossorigin="anonymous"></script>
	<script src="../form_validation/frontend_check/confirm_delete.js"></script>

	<?php mysqli_close($connect) ?>
</body>
</html>