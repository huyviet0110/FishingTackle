<?php 

	$page = 1;
	if(!empty($_POST['page']) && is_numeric($_POST['page'])){
		$page = $_POST['page'];
	}