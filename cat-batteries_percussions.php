<?php
    if (!isset($_SESSION)) { session_start(); }
    
	$_SESSION['root']="http://".$_SERVER['HTTP_HOST']."/Musicoshop";

	require 'vues/header.php';	

	require 'vues/body-cat-batteries_percussions.php';
	
	require 'vues/footer.php';
?>