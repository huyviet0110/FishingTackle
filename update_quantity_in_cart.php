<?php 

	try {
		session_start();

		$type_array = array('0', '1');

		if(empty($_POST['id']) || empty($_SESSION['cart'][$_POST['id']]) || !in_array($_POST['type'], $type_array)){
			throw new Exception("Invalid product ID", 1);
		}

		$id = $_POST['id'];
		$type = $_POST['type'];

		if($type == 0){
			$_SESSION['cart'][$id]['quantity']--;
		} else if($type == 1){
			$_SESSION['cart'][$id]['quantity']++;
		}

		if($_SESSION['cart'][$id]['quantity'] === 0){
			unset($_SESSION['cart'][$id]);
		}

		echo 1;
	} catch (Exception $e) {
		echo $e->getMessage();
	}