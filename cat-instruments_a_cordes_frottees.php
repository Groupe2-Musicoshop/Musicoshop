<?php
	session_start();
    
	$_SESSION['root']="http://".$_SERVER['HTTP_HOST']."/Musicoshop";

	require 'vues/header.php';	

	require 'vues/body-cat-instruments_a_cordes_frottees.php';
	
	require 'vues/footer.php';
?>