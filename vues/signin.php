<?php
session_start();
$_SESSION['root']="http://".$_SERVER['HTTP_HOST']."/Musicoshop";
?>
<!DOCTYPE html>
<html>

<head>
    <link rel="stylesheet" href="<?=$_SESSION['root']?>/css/login.css" />
    <!-- CSS only -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
</head>

<body>
    <?php
require('config.php');

if (isset($_REQUEST['username'], $_REQUEST['email'], $_REQUEST['password'])){
	// récupérer le nom d'utilisateur et supprimer les antislashes ajoutés par le formulaire
	$username = stripslashes($_REQUEST['username']);
	$username = mysqli_real_escape_string($conn, $username); 
	// récupérer l'email et supprimer les antislashes ajoutés par le formulaire
	$email = stripslashes($_REQUEST['email']);
	$email = mysqli_real_escape_string($conn, $email);
	// récupérer le mot de passe et supprimer les antislashes ajoutés par le formulaire
	$password = stripslashes($_REQUEST['password']);
	$password = mysqli_real_escape_string($conn, $password);
	
	$query = "INSERT into `users` (username, email, type, password)
				VALUES ('$username', '$email', 'user', '".hash('sha256', $password)."')";
	$res = mysqli_query($conn, $query);

    if($res){
       echo "<div class='sucess'>
             <h3>Vous êtes inscrit avec succès.</h3>
             <p>Cliquez ici pour vous <a href='login.php'>connecter</a></p>
			 </div>";
    }
}else{
?>

<form class="box" action="" method="post">
<div class="mb-3">
	<h4 class="title">Enregistrement</h4>
    </div>
    <div class="mb-3">
	<input type="text" class="form-control" name="username" placeholder="Nom d'utilisateur" required>
    </div>
    <div class="mb-3">
    <input type="text" class="form-control" name="email" placeholder="Adresse e-mail" required>
    </div>
    <div class="mb-3">
    <input type="password" class="form-control" name="password" placeholder="Mot de passe" required>
    </div>
    <input type="submit" name="submit" value="S'inscrire" class="box-button" />
    <p class="box-register">Déjà inscrit? <a href="login.php"><u>Connectez-vous ici<u></a></p>
</form>
<?php } ?>
</body>
</html>