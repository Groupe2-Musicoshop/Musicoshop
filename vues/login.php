<?php
	session_start();
	@$username=$_POST["username"];
	@$pass=$_POST["password"];
	@$valider=$_POST["valider"];
	$message="";
    $_SESSION['root']="http://".$_SERVER['HTTP_HOST']."/Musicoshop";

	if(isset($valider)){
require_once '../modele/Database.php';
		$pdo=new PDO("mysql:host=localhost;dbname=musicoshop","root","");
		$res=$pdo->prepare("select * from utilisateur where userName=? and password=? limit 1");
		$res->setFetchMode(PDO::FETCH_ASSOC);
		$res->execute(array($username,hash('sha256', "$pass")));
		$tab=$res->fetchAll();
		if(count($tab)==0)
			$message="Mauvais email ou mot de passe!";
		else{
			$_SESSION["userType"]="user";
			$_SESSION["islogged"]="yes";
            $_SESSION["username"]=$_POST["username"];


        header('Location: ../index.php');
		}
	}
?>

<!DOCTYPE html>
<html>

<head>
    <link rel="stylesheet" href="<?=$_SESSION['root']?>/css/login.css" />
    <!-- CSS only -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
</head>

<body>
   
    <div class="jumbotron">
        <form class="box" action="" method="post" name="login">
            <div class="mb-3">
	        <h4 class="title">Connexion espace client</h4>
            </div>
            <div class="mb-3">
            <input type="text" class="form-control" name="username" placeholder="Nom d'utilisateur" required>
            </div>
            <div class="mb-3">
            <input type="password" class="form-control" name="password" placeholder="Mot de passe" required>
            </div>
            <?php if (! empty($message)) { ?>
            <p class="errorMessage"><?php echo $message; ?></p>
            <?php } ?>
            <input type="submit" value="Connexion " name="valider" class="box-button">
            <p class="box-register"><a href="pwlost.php"><u>Vous avez oublié votre mot de passe ?</u></a></p>
          
            </p>
        </form>
    </div>
    
</body>

</html>