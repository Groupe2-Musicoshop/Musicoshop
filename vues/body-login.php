<?php
	//session_start();
	@$username=$_POST["username"];
	@$pass=$_POST["password"];
	@$valider=$_POST["valider"];
	$message="";
    
    if (!isset($_SESSION)) { session_start(); }
    $_SESSION['root']="http://".$_SERVER['HTTP_HOST']."/Musicoshop";

	if(isset($valider)){
        require_once 'modele/Database.php';

        $database = new Database();
        $pdo = $database->getConnection();

		$res=$pdo->prepare("select * from utilisateur where userName=? and password=? limit 1");
		$res->setFetchMode(PDO::FETCH_ASSOC);
		$res->execute(array($username,hash('sha256', "$pass")));
		$tab=$res->fetchAll();

        
        if (count($tab)==0) {
            
            $message="Mauvais email ou mot de passe!";
        
        }else{

            if($tab[0]["valideuser"]!=0){

                if($tab[0]["changepwd"]!=0){
                    
                    $_SESSION["username"]=$_POST["username"];

                    //header("Location: ".$_SESSION['root']."/change-password.php");
                    echo "<script type='text/javascript'> document.location = 'change-password.php'; </script>";
                    exit;
                }
               
                $_SESSION["userType"]=$tab[0]["type"];
                $_SESSION["isLogged"]=$_POST["valider"];
                $_SESSION["username"]=$_POST["username"];
                
                if($tab[0]["nom"]==""){
                    
                    $_SESSION["navUsername"]=$_POST["username"];

                    
                }else{
                    
                    $_SESSION["navUsername"]=$tab[0]["prenom"]." ".$tab[0]["nom"];
                    
                }
                
                echo "<script type='text/javascript'> document.location = '".$_SESSION['root']."/index.php'; </script>";

            }else{

                $message="Votre compte n'a pas encore été validé par l'administrateur";

            }        
		}
	}
    $page = basename($_SERVER["PHP_SELF"]);
    $cat = new Categorie();
    $cat->set_PageActive($page);   
?>
<div class="jumbotron">
    <div id="cat_b&p" class="body-mu">

        <div id="title" class="white">Se connecter</div>
        <img src='<?=$_SESSION['root']?>/img/headers_cats/cat_login_signin.jpg' class='w100 d-inline-block align-top landscape' alt=''>

        <?php $cat->genCategoriesHorizontaly()?>    

    <form class="box" action="" method="post" name="login">

        <div class="mb-3">
            <h4 class="title">Connexion espace client</h4>
        </div>

        <div class="form-floating mb-3">
            <input type="text" class="form-control" id="floatingInput" name="username" placeholder="Nom d'utilisateur" required>
            <label for="floatingInput">Nom d'utilisateur</label>
        </div>

        <div class="form-floating">
            <input type="password" class="form-control" id="floatingPassword" name="password" placeholder="Mot de passe" required>
            <label for="floatingPassword">Mot de passe</label>
        </div><br>

        <?php if (! empty($message)) { ?>

        <p class="errorMessage"><?php echo $message; ?></p>
        
        <?php } ?>
        <div class="center col-4"><input type="submit" value="Connexion " name="valider" class="btn btn-primary box-button">
        </div>
        <p class="box-register"><a href="pwlost.php"><u>Vous avez oublié votre mot de passe ?</u></a></p>

        </p>
    </form>