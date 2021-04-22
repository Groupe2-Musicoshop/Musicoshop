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

            $message="Votre mot de passe a été changé avec succès";

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
                <a id="btn-modal" class="btn btn-primary" data-bs-toggle="modal" href="'.$_SESSION['root'].'/logout.php" role="button" data-bs-dismiss="modal">OK</a>			  
                </div>
              </div>
            </div>
          </div>';
			
		}
	} 
    $page = basename($_SERVER["PHP_SELF"]);
    $cat = new Categorie();
    $cat->set_PageActive($page);   
	
?>
<div class="jumbotron">
    <div id="cat_b&p" class="body-mu">

        <div id="title" class="white">Changement de Mot de passe</div>
        <img src='<?=$_SESSION['root']?>/img/headers_cats/cat_login_signin.jpg' class='w100 d-inline-block align-top landscape' alt=''>

        <?php $cat->genCategoriesHorizontaly()?>
    
        <form class="box" action="" method="post">
            <p class="box-return"><a href="index.php"><i class="fa fa-chevron-circle-left" aria-hidden="true"></i>
			      <u>Retour</u></a></p>

            <div class="mb-3">
                <h4 class="title">Changement de Mot de passe </h4>
            </div>
            <div class="form-floating">
            <input type="password" class="form-control" id="floatingPassword" name="password" placeholder="Mot de passe" required>
            <label for="floatingPassword">Nouveau mot de passe</label>
            </div><br>

            <div class="form-floating">
            <input type="password" class="form-control" id="floatingPassword" name="repass" placeholder="Confirmation du mot de passe" required>
            <label for="floatingPassword">Confirmation du mot de passe</label>
            </div><br>
        

            <?php if (!empty($message)) { ?>
            <p class="errorMessage"><?php echo $message; ?></p>
            <?php } ?>

            <div class="center col-4"><input type="submit" name="valider" value="Valider" class="btn btn-primary box-button" />
            </div>
        </form>
    </div>
</div>