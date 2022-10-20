<?php 

	if(empty($_POST['email'])){
		header('location:sign_in.php');
		exit();
	}

	$email = $_POST['email'];

	function get_current_url(){
		$url = "http://" . $_SERVER['HTTP_HOST'];
		return $url;
	}

	require_once 'admin/connect.php';

	$sql = "select id, name from customers
			where email = '$email'";
	$result = mysqli_query($connect, $sql);
	$each = mysqli_fetch_array($result);
	$customer_id = $each['id'];
	$name = $each['name'];

	$sql = "select count(*), created_at from forgot_password
			where customer_id = '$customer_id'";
	$result = mysqli_query($connect, $sql);
	$check = mysqli_fetch_array($result)['count(*)'];
	if($check == 1){
		$created_at = mysqli_fetch_array($result)['created_at'];
		$created_at = date_create($created_at);
		$current_timestamp = date("Y/m/d H:i:s");
		$current_timestamp = date_create($current_timestamp);
		$diff = date_diff($created_at, $current_timestamp);
		$number_of_days_of_existence = (int)($diff->format("%R%a"));
		$number_of_hours_of_existence = (int)($diff->format("%R%H"));

		if($number_of_days_of_existence >= 1 || $number_of_hours_of_existence > 2){
			$sql = "delete from forgot_password
					where customer_id = '$customer_id'";
			mysqli_query($connect, $sql);
		} else {
			$_SESSION['error'] = "You have used the \"forgot password\" feature in the last 2 hours, to continue using this feature you need to wait 2 hours since the last time you used the \"forgot password\" feature.";
			header('location:sign_in.php');
			exit();
		}
	}

	$token = uniqid('forgot_password_', true) . time();
	$sql = "insert into forgot_password (customer_id, token)
			values ('$customer_id', '$token')";
	mysqli_query($connect, $sql);

	require_once 'mail.php';
	$title = "Change new password | HuyViet FishingTackle";
	$link = get_current_url() . "/change_new_password.php?token=$token";
	$content = "To change your new password, <a href='$link'>Click here</a>";
	$email = "nguyenluonghuy88@gmail.com";
	send_mail($email, $name, $title, $content);

	// $_SESSION['success'] = 'Check your email';
	// header('location:sign_in.php');