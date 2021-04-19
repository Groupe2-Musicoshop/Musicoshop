<?php
	$a = session_id();
	if(empty($a)) session_start();

	//if (!isset($_SESSION)) { session_start(); }
	$_SESSION['root']="http://".$_SERVER['HTTP_HOST']."/Musicoshop";
	
    
	require 'vues/header.php';
	
	if($_SESSION['userType'] =='admin'){
		
		$_COOKIE["PHPSESSID"] = $_COOKIE["PHPSESSID"].$_SESSION['username'];
		
		require 'vues/admin/body-shop.php';
	}
	else{

		require 'vues/body-shop-catalogue.php';
	}
	
	require 'vues/footer.php';
?>