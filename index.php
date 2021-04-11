<?php
	if (!isset($_SESSION)) { session_start(); }
	$_SESSION['root']="http://".$_SERVER['HTTP_HOST']."/Musicoshop";
    

	/*if (!isset($_SESSION['cart'])) {
		$_SESSION['cart']=array();
	}*/
	require_once 'vues/header.php';
	
	if($_SESSION['userType'] =='admin'){
		require_once 'vues/admin/body-shop.php';
	}
	else{
		require_once 'vues/body-shop-catalogue.php';
	}
	
	require_once 'vues/footer.php';
?>