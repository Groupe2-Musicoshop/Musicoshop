<?php
    if (!isset($_SESSION)) { session_start(); }
    $_SESSION['root']="http://".$_SERVER['HTTP_HOST']."/Musicoshop";

	@$nom=$_POST["nom"];
	@$prenom=$_POST["prenom"];
    @$sexe=$_POST["sexe"];
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
        		if(empty($sexe)) $message.="Sexe invalide!";

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

				$ins=$pdo->prepare("insert into utilisateur(userName,nom,prenom,sexe,adresse,ville,codePostal,email,password,type,valideuser,changepwd) values(?,?,?,?,?,?,?,?,?,?,?,?)");
				$ins->execute(array($username,$nom,$prenom,$sexe,$adresse,$ville,$codepostal,$email,hash('sha256', $password),'user',0,0));
				
                $message="Votre inscription a bien té prise en compte un Administrateur la valideras sous 24h";

				echo '<script type="text/javascript">window.alert("'.$message.'");</script>';
				echo "<script type='text/javascript'> document.location = 'index.php'; </script>";
			}
		}
	}

    $page = basename($_SERVER["PHP_SELF"]);
    $cat = new Categorie();
    $cat->set_PageActive($page);   
?>
<div class="jumbotron">
    <div id="cat_b&p" class="body-mu">

        <div id="title" class="white">S'inscrire</div>
        <img src='<?=$_SESSION['root']?>/img/headers_cats/cat_login_signin.jpg' class='w100 d-inline-block align-top landscape' alt=''>

        <?php $cat->genCategoriesHorizontaly()?>

        <div class="row">
           
        </div>

   




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
            <select name="sexe" class="form-select" aria-label="Default select example" required>
                <option selected>Sexe</option>
                <option value="homme" required>Homme</option>
                <option value="femme" required>Femme</option>
            </select>
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
            <input type="email" class="form-control" name="email" placeholder="Adresse e-mail" required>
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