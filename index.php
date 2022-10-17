<?php 
	session_start();
	require_once 'admin/connect.php';

	if(isset($_COOKIE['remember'])){
		$token = $_COOKIE['remember'];
		$sql = "select id, avatar, name from customers where token = '$token'";
		$result = mysqli_query($connect, $sql);
		$result_num_rows = mysqli_num_rows($result);
		if($result_num_rows === 1){
			$each = mysqli_fetch_array($result);
			$_SESSION['id'] = $each['id'];
			$_SESSION['avatar'] = $each['avatar'];
			$_SESSION['name'] = $each['name'];
		}
	}
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Fishing Tackle</title>

	<link rel="stylesheet" type="text/css" href="css/page.css">
	<link rel="stylesheet" type="text/css" href="css/header.css">
	<link rel="stylesheet" type="text/css" href="css/menu.css">
	<link rel="stylesheet" type="text/css" href="css/banner.css">
	<link rel="stylesheet" type="text/css" href="css/content.css">
	<link rel="stylesheet" type="text/css" href="css/footer.css">

	<script src="https://kit.fontawesome.com/9741b0bef5.js" crossorigin="anonymous"></script>
</head>
<body>

	<div id="page">

		<?php 
			require_once 'header.php';
			require_once 'menu.php';
			require_once 'banner.php';
			require_once 'content.php';
			require_once 'footer.php';
		?>

		<?php mysqli_close($connect) ?>

	</div>

</body>
</html>