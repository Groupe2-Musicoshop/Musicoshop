<?php
//session_start();
$_SESSION['root']="http://".$_SERVER['HTTP_HOST']."/Musicoshop";


	@$username=$_POST["username"];
	//@$prenom=$_POST["prenom"];
	@$email=$_POST["email"];
	@$password=$_POST["password"];
	//@$repass=$_POST["repass"];
	@$valider=$_POST["valider"];
	$message="";
	if(isset($valider)){
        require_once '../modele/Database.php';

		if(empty($username)) $message="Nom invalide!";
		//if(empty($prenom)) $message.="Prénom invalide!";
		if(empty($email)) $message.="email invalide!";
		if(empty($password)) $message.="Mot de passe invalide!";
		//if($pass!=$repass) $message.="Mots de passe non identiques!";	
		if(empty($message)){

            $database = new Database();
            $pdo = $database->getConnection();

			$req=$pdo->prepare("select idUtilisateur from utilisateur where email=? limit 1");
			$req->setFetchMode(PDO::FETCH_ASSOC);
			$req->execute(array($email));
			$tab=$req->fetchAll();

			if(count($tab)>0)
				$message="Adresse e-mail existe déjà!";
			else{
                
                $database = new Database();
                $pdo = $database->getConnection();

				$ins=$pdo->prepare("insert into utilisateur(userName,email,password,type) values(?,?,?)");
				$ins->execute(array($username,$email,hash('sha256', $password),'user'));

        header('Location:login.php');
			}
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
         <?php if (! empty($message)) { ?>
            <p class="errorMessage"><?php echo $message; ?></p>
            <?php } ?>
    <input type="submit" name="valider" value="valider" class="box-button" />
    <p class="box-register">Déjà inscrit? <a href="login.php"><u>Connectez-vous ici<u></a></p>
</form>
</body>
</html>