<?php 
	
	try {
		session_start();
		if(empty($_POST['id']) || empty($_SESSION['cart'][$_POST['id']])){
			throw new Exception("Invalid ID", 1);
		}
		$id = $_POST['id'];
		unset($_SESSION['cart'][$id]);
		echo 1;
	} catch (Exception $e) {
		echo $e->getMessage();
	}
	