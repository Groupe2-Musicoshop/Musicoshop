<?php
	session_start();
    
	$_SESSION['root']="http://".$_SERVER['HTTP_HOST']."/Musicoshop";

	require 'vues/facture-cmd.php';
	
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">

	<link rel="icon" href="<?=$_SESSION['root']?>/img/favicon.ico" />
    <title>Facture Musicoshop</title>

</head>
<body>
</body>

</html>