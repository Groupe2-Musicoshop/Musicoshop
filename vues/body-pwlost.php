<?php
	if (!isset($_SESSION)) { session_start(); }
	$_SESSION['root']="http://".$_SERVER['HTTP_HOST']."/Musicoshop";
	
	require_once 'modele/Database.php';
	require_once 'modele/User.php';

	@$email=$_POST["email"];
	
	@$valider=$_POST["valider"];
	
	if(isset($valider)){

		if(empty($email)) $message="email invalide!";
		
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

				if($tab[0]["valideuser"]!=0){

					$database = new Database();
					$conn = $database->getConnection();

					$sqlQuery = "UPDATE utilisateur SET changepwd=1  WHERE email='".$email."'";
			
					$stmt = $conn->prepare($sqlQuery);              
					
					$stmt->execute();

					$message="Vous avez reçu un lien sur votre boite mail pour modifier votre mot de passe!";

					echo '<script type="text/javascript">window.alert("'.$message.'");</script>';
					echo "<script type='text/javascript'> document.location = '".$_SESSION['root']."/index.php'; </script>";

				}else{

					$message="Votre compte n'a pas encore été validé par l'administrateur";
	
				}      
				
			}
		}
	}
?>
<div class="jumbotron">
    <form class="box" action="" method="post" name="login">
        <div class="mb-3">
            <h4 class="title">Vous avez oublié votre mot de passe</h4>
        </div>    
		<div class="form-floating mb-3">
  <input type="email" class="form-control" id="floatingInput" name="email" placeholder="name@example.com">
  <label for="floatingInput">Adresse e-mail</label>
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