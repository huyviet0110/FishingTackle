<?php 

	require_once 'admin/connect.php';

	$product_id = mysqli_real_escape_string($connect, $_POST['product_id']);
	$customer_id = mysqli_real_escape_string($connect, $_POST['customer_id']);
	$rating = mysqli_real_escape_string($connect, $_POST['rating']);
	$review = mysqli_real_escape_string($connect, $_POST['review']);

	$sql = "insert into products_reviews (product_id, customer_id, rating, review)
			values ('$product_id', '$customer_id', '$rating', '$review')";
	mysqli_query($connect, $sql);
	$error = mysqli_error($connect);
	if(empty($error)){
		echo 1;
	} else {
		echo 0;
	}

	mysqli_close($connect);