<?php
	// Initialiser la session
	//session_start();
	//$_SESSION['root']="http://".$_SERVER['HTTP_HOST']."musicoshop/";
	
	
	// Vérifiez si l'utilisateur est connecté, sinon redirigez-le vers la page de connexion
	/*if(!isset($_SESSION["username"])){
		header("Location:vues/login.php");
		exit(); 
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