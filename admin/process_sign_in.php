<?php 
	
	session_start();
	require_once 'connect.php';

	if(empty($_POST['email']) || empty($_POST['password'])){
		$_SESSION['error'] = 'You must fill in all the information!';
		header('location:index.php');
		exit();
	}

	$email = mysqli_real_escape_string($connect, $_POST['email']);
	$password = mysqli_real_escape_string($connect, $_POST['password']);

	$sql = "select 
				admins.id, 
				admins.avatar, 
				admins.name,
				admins.email,
				positions.level
			from admins
			join positions on positions.id = admins.position_id 
			where admins.email = '$email' and admins.password = '$password'";
	$result = mysqli_query($connect, $sql);
	$each = mysqli_fetch_array($result);
	$error = mysqli_error($connect);
	if(!empty($error)){
		echo $error;
		die();
	}
	$result_num_rows = mysqli_num_rows($result);
	if($result_num_rows < 1){
		$_SESSION['error'] = 'Wrong email or password!';
		header('location:index.php');
		exit();
	}

	$id = $each['id'];
	$token = uniqid('admin_', true) . time();
	$sql = "update admins
			set
				token = '$token'
			where id = $id";
	mysqli_query($connect, $sql);
	$error = mysqli_error($connect);
	if(!empty($error)){
		echo $error;
		die();
	}

	setcookie('admin_remember', $token, time() + 24*60*60 * 30);

	$_SESSION['admin_id'] = $each['id'];
	$_SESSION['admin_avatar'] = $each['avatar'];
	$_SESSION['admin_name'] = $each['name'];
	$_SESSION['admin_level'] = $each['level'];

	$email = $each['email'];
	$name = $each['name'];
	$title = 'Successfully Sign-in into HuyViet FishingTackle';
	$content = 'You have successfully signed in, if this is not your sign in then change your password immediately';

	require_once 'mail.php';
	send_mail($email, $name, $title, $content);

	header('location:admin_page.php');