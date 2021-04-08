<?php
//session_start();
$_SESSION['root']="http://".$_SERVER['HTTP_HOST']."/Musicoshop";



	@$username=$_POST["username"];
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
        

		if(empty($username)) $message="Nom invalide!";
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

<<<<<<< HEAD
				$ins=$pdo->prepare("insert into utilisateur(userName,prenom,adresse,ville,codePostal,email,password,type,valideuser) values(?,?,?,?,?,?,?,?,?)");
				$ins->execute(array($username,$prenom,$adresse,$ville,$codepostal,$email,hash('sha256', $password),'user',0));
				header('Location:../ghj-login.php');
=======
				$ins=$pdo->prepare("insert into utilisateur(userName,prenom,adresse,ville,codePostal,email,password,type) values(?,?,?,?,?,?,?,?)");
				$ins->execute(array($username,$prenom,$adresse,$ville,$codepostal,$email,hash('sha256', $password),'user'));
				header('Location:../body-login.php');
>>>>>>> 7f1fc759aec791d15fd9c55b4405ce2bf88325ad
			}
		}
	}
?>

<head>
    <link rel="stylesheet" href="<?=$_SESSION['root']?>/css/login.css" />
    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
</head>

<div class="jumbotron">
    <form class="box" action="" method="post">

        <div class="mb-3">
            <h4 class="title">Enregistrement</h4>
        </div>

        <div class="mb-3">
            <input type="text" class="form-control" name="username" placeholder="Nom" required>
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
            <input type="password" class="form-control" name="repass" placeholder="Confirmation du mot de passe" required>
        </div>

        <?php if (!empty($message)) { ?>
            <p class="errorMessage"><?php echo $message; ?></p>
        <?php } ?>

        <input type="submit" name="valider" value="valider" class="box-button" />
        <p class="box-register">Déjà inscrit? <a href="login.php"><u>Connectez-vous ici<u></a></p>

    </form>
</div>