<?php
	session_start();

	if(isset($_POST["idUtilisateur"])){

        echo $_POST["idUtilisateur"];

        $_SESSION['idUtilisateur']=$_POST["idUtilisateur"];

    }
    
	$_SESSION['root']="http://".$_SERVER['HTTP_HOST']."/Musicoshop";

	require_once 'vues/header.php';
	
	if($_SESSION['userType'] =='admin'){
		require_once 'vues/admin/body-shop.php';
	}
	else{
		require_once 'vues/body-shop-catalogue.php';
	}
	
	require_once 'vues/footer.php';
?>