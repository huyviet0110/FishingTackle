<?php 
	session_start();
	require_once 'connect.php';

	if(empty($_SESSION['admin_id'])){
		if(!empty($_COOKIE['admin_remember'])){
			$token = $_COOKIE['admin_remember'];
			$sql = "select id, avatar, name from admins
					where token = '$token'";
			$result = mysqli_query($connect, $sql);
			$result_num_rows = mysqli_num_rows($result);
			if($result_num_rows === 1){
				$each = mysqli_fetch_array($result);
				$_SESSION['admin_id'] = $each['id'];
				$_SESSION['admin_avatar'] = $each['avatar'];
				$_SESSION['admin_name'] = $each['name'];
			}
		} else {
			header('location:index.php');
			exit();
		}
	}
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title></title>

	<link rel="stylesheet" type="text/css" href="css/menu.css">
	<link rel="stylesheet" type="text/css" href="css/dashboard.css">
	<link rel="stylesheet" type="text/css" href="css/header.css">
	<link rel="stylesheet" type="text/css" href="css/content.css">
	<link rel="stylesheet" type="text/css" href="css/footer.css">
	
	<script src="https://kit.fontawesome.com/9741b0bef5.js" crossorigin="anonymous"></script>
</head>
<body>
	<?php 
		require_once 'menu.php';
		require_once 'dashboard.php';
	?>

</body>
</html>