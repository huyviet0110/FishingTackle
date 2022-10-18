<?php 

	session_start();
	setcookie('admin_remember', '', -1);
	unset($_SESSION['admin_id']);
	unset($_SESSION['admin_avatar']);
	unset($_SESSION['admin_name']);
	unset($_SESSION['admin_level']);

	header('location:index.php');