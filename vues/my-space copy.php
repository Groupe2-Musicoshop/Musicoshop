<?php
	// Initialiser la session
	session_start();
	$_SESSION['root']="http://".$_SERVER['HTTP_HOST']."musicoshop/";
	
require_once '../modele/Database.php';

    $database = new Database();

    $conn = $database->getConnection();
	
	
	// Vérifiez si l'utilisateur est connecté, sinon redirigez-le vers la page de connexion
	if(!isset($_SESSION["username"])){
		header("Location: ../login.php");
		exit(); 
	}
	require_once 'header.php';
	
	if($_SESSION['userType'] =='admin'){
		require_once 'vues/admin/body-shop.php';
	}
	else{
		require_once 'body-my-space.php';
	}
	
	require_once 'footer.php';
?>