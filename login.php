<?php
	session_start();
    
	$_SESSION['root']="http://".$_SERVER['HTTP_HOST']."/Musicoshop";

	require 'vues/header.php';	

	require 'vues/body-login.php';
	
	require 'vues/footer.php';
?>