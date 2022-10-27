<?php 

	session_start();
	setcookie('remember', '', -1);
	unset($_SESSION['id']);
	unset($_SESSION['avatar']);
	unset($_SESSION['name']);

	header('location:index.php');