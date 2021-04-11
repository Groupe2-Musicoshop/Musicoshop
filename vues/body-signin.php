<?php
    if (!isset($_SESSION)) { session_start(); }
    $_SESSION['root']="http://".$_SERVER['HTTP_HOST']."/Musicoshop";

	@$nom=$_POST["nom"];
	@$prenom=$_POST["prenom"];
	@$adresse=$_POST["adresse"];
	@$ville=$_POST["ville"];
	@$codepostal=$_POST["codepostal"];
	@$email=$_POST["email"];
	@$password=$_POST["password"];
	@$repass=$_POST["repass"];
	@$valider=$_POST["valider"];

	$message="";

	if(isset($valider)){        

		if(empty($nom))$message="Nom invalide!";
		if(empty($prenom)) $message.="Prénom invalide!";
		if(empty($adresse)) $message.="adresse invalide!";
		if(empty($ville)) $message.="ville invalide!";
		if(empty($codepostal)) $message.="Code-postal invalide!";
		if(empty($email)) $message.="email invalide!";
		if(empty($password)) $message.="Mot de passe invalide!";
		if($password!=$repass) $message.="Mots de passe non identiques!";	

		if(empty($message)){
            
			require_once 'modele/Database.php';
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

                $username = $nom.$prenom;

				$ins=$pdo->prepare("insert into utilisateur(userName,nom,prenom,adresse,ville,codePostal,email,password,type,valideuser,changepwd) values(?,?,?,?,?,?,?,?,?,?,?)");
				$ins->execute(array($username,$nom,$prenom,$adresse,$ville,$codepostal,$email,hash('sha256', $password),'user',0,0));
				
                $message="Votre inscription a bien té prise en compte un Administrateur la valideras sous 24h";

				echo '<script type="text/javascript">window.alert("'.$message.'");</script>';
				echo "<script type='text/javascript'> document.location = 'index.php'; </script>";
			}
		}
	}
?>

<div class="jumbotron">
    <form class="box" action="" method="post">

        <div class="mb-3">
            <h4 class="title">Enregistrement</h4>
        </div>

        <div class="mb-3">
            <input type="text" class="form-control" name="nom" placeholder="Nom" required>
        </div>

        <div class="mb-3">
            <input type="text" class="form-control" name="prenom" placeholder="Prénom" required>
        </div>

        <div class="mb-3">
            <input type="text" class="form-control" name="adresse" placeholder="Rue et n°" required>
        </div>

        <div class="mb-3">
            <input type="text" class="form-control" name="codepostal" placeholder="Code postal" required>
        </div>

        <div class="mb-3">
            <input type="text" class="form-control" name="ville" placeholder="ville" required>
        </div>

        <div class="mb-3">
            <input type="text" class="form-control" name="email" placeholder="Adresse e-mail" required>
        </div>

        <div class="mb-3">
            <input type="password" class="form-control" name="password" placeholder="Mot de passe" required>
        </div>

        <div class="mb-3">
            <input type="password" class="form-control" name="repass" placeholder="Confirmation du mot de passe"
                required>
        </div>

        <?php if (!empty($message)) { ?>
        <p class="errorMessage"><?php echo $message; ?></p>
        <?php } ?>

        <input type="submit" name="valider" value="valider" class="box-button" />
        <p class="box-register">Déjà inscrit? <a href="login.php"><u>Connectez-vous ici<u></a></p>

    </form>
</div>