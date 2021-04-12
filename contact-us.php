<?php
	session_start();
    
	$_SESSION['root']="http://".$_SERVER['HTTP_HOST']."/Musicoshop";

	require 'vues/header.php';	

	require 'vues/body-contact-us.php';
	
	require 'vues/footer.php';
?>