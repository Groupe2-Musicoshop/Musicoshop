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

			$req=$pdo->prepare("select * from utilisateur where email=? ");
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

					echo '
					<div id="modal" class="modal fade show show-message" tabindex="-1">
					<div class="modal-dialog">
					  <div class="modal-content">
						<div class="modal-header">
						  <h5 class="modal-title">Information</h5>
						  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
						</div>
						<div class="modal-body">
						  <p>'.$message.'</p>
						</div>
						<div class="modal-footer">
						<a id="btn-modal" class="btn btn-primary" data-bs-toggle="modal" href="'.$_SESSION['root'].'/index.php" role="button" data-bs-dismiss="modal">OK</a>			  
						</div>
					  </div>
					</div>
				  </div>';

				}else{

					$message="Votre compte n'a pas encore été validé par l'administrateur";
	
				}      
				
			}
		}
	}

	$page = basename($_SERVER["PHP_SELF"]);
    $cat = new Categorie();
    $cat->set_PageActive($page);   
?>
<div class="jumbotron">
    
        <div id="title" class="white">Mot de passe oublié</div>
        <img src='<?=$_SESSION['root']?>/img/headers_cats/cat_login_signin.jpg' class='w100 d-inline-block align-top landscape' alt=''>

        <?php $cat->genCategoriesHorizontaly()?>   

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
        <div class="center col-md-6 col-lg-4">
			<input type="submit" value="Envoyer " name="valider" class="btn btn-primary box-button">
        </div>
		<p class="box-register"><a href="<?=$_SESSION['root']?>/login.php"><u>Se connecter<u></a></p>
        <p class="box-register"><a href="<?=$_SESSION['root']?>/signin.php"><u>S'inscrire maintenant</u></a></p>
        </p>
    </form>
</div>