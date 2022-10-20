<?php 

	$each = mysqli_fetch_array($result);
	$customer_id = $each['customer_id'];
	$created_at = $each['created_at'];

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

		$_SESSION['error'] = "The time for you to retrieve your password from the link we sent to your email has expired. Please use the \"forgot your password\" feature again to recover your password.";
		header('location:sign_in.php');
		exit();
	}