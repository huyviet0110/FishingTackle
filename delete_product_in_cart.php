<?php 

	session_start();

	if(empty($_POST['id']) || empty($_SESSION['cart'][$_POST['id']])){
		header('location:view_cart.php');
		exit();
	}

	$id = $_POST['id'];
	unset($_SESSION['cart'][$id]);

	header('location:view_cart.php');