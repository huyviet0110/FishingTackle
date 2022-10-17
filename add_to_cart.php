<?php 

	session_start();
	
	if(empty($_GET['id']) && !is_numeric($_GET['id'])){
		header('location:collections.php');
		exit();
	}

	$id = $_GET['id'];

	if(empty($_SESSION['cart'][$id])){
		require_once 'admin/connect.php';
		$sql = "select 
					image,
					name,
					(select price from products_detail
					 where product_id = '$id'
					 limit 1) as price
				from products
				where id = '$id'";
		$result = mysqli_query($connect, $sql);
		$result_num_rows = mysqli_num_rows($result);
		if($result_num_rows === 0){
			header('location:collections.php');
			exit();
		}
		$each = mysqli_fetch_array($result);
		$image = $each['image'];
		$name = $each['name'];
		$price = $each['price'];

		$_SESSION['cart'][$id]['image'] = $image;
		$_SESSION['cart'][$id]['name'] = $name;
		$_SESSION['cart'][$id]['price'] = $price;
		$_SESSION['cart'][$id]['quantity'] = 1;
	} else {
		$_SESSION['cart'][$id]['quantity']++;
	}

	// echo json_encode($_SESSION['cart']);

	header("location:product_detail.php?id=$id");