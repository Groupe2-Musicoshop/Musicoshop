<?php
	//session_start();
	@$username=$_POST["username"];
	@$pass=$_POST["password"];
	@$valider=$_POST["valider"];
	$message="";
    
    $_SESSION['root']="http://".$_SERVER['HTTP_HOST']."/Musicoshop";

	if(isset($valider)){
    require_once 'modele/Database.php';

        $database = new Database();
        $pdo = $database->getConnection();

		$res=$pdo->prepare("select * from utilisateur where userName=? and password=? limit 1");
		$res->setFetchMode(PDO::FETCH_ASSOC);
		$res->execute(array($username,hash('sha256', "$pass")));
		$tab=$res->fetchAll();

        //print_r($tab);
        
        if (count($tab)==0) {
            
            $message="Mauvais email ou mot de passe!";
        
        }else{

            if($tab[0]["valideuser"]!=0){

                
                $_SESSION["userType"]=$tab[0]["type"];
                $_SESSION["isLogged"]=$_POST["valider"];
                
                if($tab[0]["nom"]==""){
                    
                    $_SESSION["username"]=$_POST["username"];
                    
                }else{
                    
                    $_SESSION["username"]=$tab[0]["prenom"]." ".$tab[0]["nom"];
                    
                }
                header('Location:index.php');
            }else{

                $message="Votre compte n'a pas encore été validé par l'administrateur";

            }        
		}
	}
?>

<!DOCTYPE html>
<html>

<head>
    <link rel="stylesheet" href="<?=$_SESSION['root']?>/css/login.css" />
    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
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