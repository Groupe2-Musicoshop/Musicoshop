<?php
	session_start();
    
	$_SESSION['root']="http://".$_SERVER['HTTP_HOST']."/Musicoshop";

	require 'vues/header.php';	

	require 'vues/body-my-cmds.php';
	
	require 'vues/footer.php';
?>