<?php
	session_start();
	$_SESSION['root']="http://".$_SERVER['HTTP_HOST']."/Musicoshop";
	require_once 'modele/Database.php';
	require_once 'modele/User.php';


	//@$username=$_POST["username"];
	//@$prenom=$_POST["prenom"];
	@$email=$_POST["email"];
	//@$password=$_POST["password"];
	//@$repass=$_POST["repass"];
	@$valider=$_POST["valider"];
	//$message="";

	if(isset($valider)){

		//if(empty($username)) $message="Nom invalide!";
		//if(empty($prenom)) $message.="Prénom invalide!";
		if(empty($email)) $message.="email invalide!";
		//if(empty($password)) $message.="Mot de passe invalide!";
		//if($pass!=$repass) $message.="Mots de passe non identiques!";	
		if(empty($message)){

            $database = new Database();
            $pdo = $database->getConnection();

			$req=$pdo->prepare("select idUtilisateur from utilisateur where email=? ");
			$req->setFetchMode(PDO::FETCH_ASSOC);
			$req->execute(array($email));
			$tab=$req->fetchAll();
			
            if (count($tab) == 0) {
				
                $message="Adresse e-mail n'existe pas!";

            }else{

				/*$user = new User();
				$user->updatelUserChangePwd($email);*/
				$database = new Database();
            	$conn = $database->getConnection();

				$sqlQuery = "UPDATE utilisateur SET changepwd=1  WHERE email='".$email."'";
         
				$stmt = $conn->prepare($sqlQuery);              
				
				$stmt->execute();

                $message="Vous avez reçu un lien sur votre boite mail pour modifier votre mot de passe!";

				echo '<script type="text/javascript">window.alert("'.$message.'");</script>';
				echo "<script type='text/javascript'> document.location = 'index.php'; </script>";
				
			}
		}
	}
?>

<div class="jumbotron">
    <form class="box" action="" method="post" name="login">
        <div class="mb-3">
            <h4 class="title">Vous avez oublié votre mot de passe</h4>
        </div>
        <div class="mb-3">
            <input type="email" class="form-control" name="email" placeholder="Adresse e-mail" required>
        </div>

        <?php if (! empty($message)) { ?>

        <p class="errorMessage"><?php echo $message; ?></p>

        <?php } ?>

        <input type="submit" value="Envoyer " name="valider" class="box-button">
        <p class="box-register"><a href="<?=$_SESSION['root']?>/login.php"><u>Se connecter<u></a></p>
        <p class="box-register"><a href="<?=$_SESSION['root']?>/signin.php"><u>S'inscrire maintenant</u></a></p>
        </p>
    </form>
</div>