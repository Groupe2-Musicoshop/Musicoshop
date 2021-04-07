<?php
	session_start();
    
	//$_SESSION['root']="http://".$_SERVER['HTTP_HOST']."/Musicoshop";
	
	require 'header.php';
	
	if($_SESSION['userType'] =='admin'){
		require 'admin/body-shop.php';
	}
	else{
		require 'body-my-space.php';
	}
	
	require 'footer.php';
?>