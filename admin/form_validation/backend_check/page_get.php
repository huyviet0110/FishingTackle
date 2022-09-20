<?php 

	$page = 1;
	if(!empty($_GET['page']) && is_numeric($_GET['page'])){
		$page = $_GET['page'];
	}