<?php 

	session_start();
	require_once 'admin/connect.php';

	if(empty($_SESSION['id'])){
		header('location:sign_in.php');
		exit();
	}

	if(empty($_POST['receiver_name']) || empty($_POST['receiver_address']) || empty($_POST['receiver_phone']) || empty($_SESSION['cart'])){
		header('location:view_cart.php');
		exit();
	}

	$cart = $_SESSION['cart'];
	$receiver_name = $_POST['receiver_name'];
	$receiver_address = $_POST['receiver_address'];
	$receiver_phone = $_POST['receiver_phone'];
	$total_payment = 0;
	$customer_id = $_SESSION['id'];

	foreach ($cart as $product => $each) {
		$total_payment += $each['price'] * $each['quantity'];

		$sql = "insert into orders (receiver_name, receiver_address, receiver_phone, total_payment, status, customer_id)
				values ('$receiver_name', '$receiver_address', '$receiver_phone', '$total_payment', '0', '$customer_id')";
		mysqli_query($connect, $sql);

		$sql = "insert into orders_products (order_id, product_id, quantity)
				values ('$order_id', '$product_id', '$quantity')";
		mysqli_query($connect, $sql);
	}