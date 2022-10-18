<?php 
	
	session_start();

	if(empty($_POST['id']) || empty($_SESSION['cart'][$_POST['id']]) || empty($_GET['button_type']) || empty($_POST['quantity'])){
		header('location:view_cart.php');
		exit();
	}

	$id = $_POST['id'];
	$quantity = $_POST['quantity'];
	$_SESSION['cart'][$id]['quantity'] = $quantity;

	if(strcmp($_GET['button_type'], 'minus') === 0 && $_SESSION['cart'][$id]['quantity'] > 1){
		$_SESSION['cart'][$id]['quantity']--;
	} else if(strcmp($_GET['button_type'], 'plus') === 0){
		$_SESSION['cart'][$id]['quantity']++;
	} else {
		header('location:view_cart.php');
		exit();
	}

	header('location:view_cart.php');