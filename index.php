<?php
	// Initialiser la session
	session_start();
	//$_SESSION['root']="http://".$_SERVER['HTTP_HOST']."musicoshop/";
	
	
	// Vérifiez si l'utilisateur est connecté, sinon redirigez-le vers la page de connexion
	/*if(!isset($_SESSION["username"])){
		header("Location:vue/login.php");
		exit(); 
	}*/
	require_once 'vue/header.php';
	
	if($_SESSION['userType'] =='admin'){
		require_once 'vue/admin/body-shop.php';
	}
	else{
		require_once 'vue/body-shop.php';
	}
	
	require_once 'vue/footer.php';
?>