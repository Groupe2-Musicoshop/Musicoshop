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
                $message2="Votre login provisoire est : '$username'. Vous pouvez le modifier sur votre espace client";

				echo '<script type="text/javascript">window.alert("'.$message.'");</script>';
                echo '<script type="text/javascript">window.alert("'.$message2.'");</script>';
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

        <div class="mb-3">
            <label for="floatingInput">Civilité</label>
            <select name="sexe" class="form-select" aria-label="Default select example" required value="<?php echo isset($_POST['sexe']) ? $_POST['sexe'] : "";?>">
                <option selected required></option>
                <option value="homme" required>M.</option>
                <option value="femme" required>Mme</option>
            </select>
        </div>
        </div>
        <div class="mb-3">
        <div class="row">
        <div class="col">
                    <label for="floatingInput">Nom</label>
                    <input type="text" class="form-control" name="nom" placeholder="" required value="<?php echo isset($_POST['nom']) ? $_POST['nom'] : "";?>">

        </div>
        <div class="col">
                    <label for="floatingInput">Prénom</label>
                    <input type="text" class="form-control" name="prenom" placeholder="" required value="<?php echo isset($_POST['prenom']) ? $_POST['prenom'] : "";?>">
        </div>
        </div>
        </div>
        <div class="mb-3">
            <label for="floatingInput">Rue et n°</label>
            <input type="text" class="form-control" name="adresse" placeholder="" required value="<?php echo isset($_POST['adresse']) ? $_POST['adresse'] : "";?>">
        </div>

         <div class="mb-3">
        <div class="row">
        <div class="col">
            <label for="floatingInput">Code Postal</label>
            <input type="text" class="form-control" name="codepostal" placeholder="" required value="<?php echo isset($_POST['codepostal']) ? $_POST['codepostal'] : "";?>">
        </div>
        <div class="col">
            <label for="floatingInput">Ville</label>
            <input type="text" class="form-control" name="ville" placeholder="" required value="<?php echo isset($_POST['ville']) ? $_POST['ville'] : "";?>">
        </div>
        </div>
        </div>

        <div class="mb-3">
            <label for="floatingInput">Adresse e-mail</label>
            <input type="email" class="form-control" name="email" placeholder="" required>
        </div>

        <div class="mb-3">
            <label for="floatingInput">Mot de passe</label>
            <input type="password" class="form-control" name="password" placeholder="" required>
        </div>

        <div class="mb-3">
            <label for="floatingInput">Confirmation du mot de passe</label>
            <input type="password" class="form-control" name="repass" placeholder=""
                required>
        </div>

        <?php if (!empty($message)) { ?>
        <p class="errorMessage"><?php echo $message; ?></p>
        <?php } ?>

        <div class="center col-4"><input type="submit" name="valider" value="Valider" class="btn btn-primary btn-lg btn-block" />
        	</div> 

        <p class="box-register">Déjà inscrit? <a href="login.php"><u>Connectez-vous ici<u></a></p>

    </form>
</div>