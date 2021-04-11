<?php
if (!isset($_SESSION)) { session_start(); }
//$_SESSION['root']="http://".$_SERVER['HTTP_HOST']."/Musicoshop";
require_once 'modele/Database.php';

	@$password=$_POST["password"];
	@$repass=$_POST["repass"];
	@$valider=$_POST["valider"];
	$message="";
    
    if(isset($valider)){
        
		if(empty($password)) $message.="Mot de passe invalide!";
		if($password!=$repass) $message.="Mots de passe non identiques!";	

		if(empty($message)){

            $database = new Database();
            $pdo = $database->getConnection();

			$ins=$pdo->prepare("update `utilisateur` set password=?,changepwd=? where username=?");
            
            $ins->execute(array(hash('sha256', $password),0,$_SESSION["username"]));

            $message="Votre mot de passe à été changer avec succès";

            echo '<script type="text/javascript">window.alert("'.$message.'");</script>';
            
            echo "<script type='text/javascript'> document.location = '".$SESSION['root']."vues/logout.php'; </script>";
			
		}
	}
?>

<div class="jumbotron">
    <form class="box" action="" method="post">


        <div class="mb-3">
            <h4 class="title">Changement de Mot de passe </h4>
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

    </form>
</div>