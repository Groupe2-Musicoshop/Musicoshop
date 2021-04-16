<?php 

	// Initialiser la session

require_once 'modele/Database.php';

    $database = new Database();

    $conn = $database->getConnection();

?>
	<?php 
	
	if(isset($_POST['update'])){
		
			$username  = $_POST['username'];
			$email 	= $_POST['email'];
            $sexe 	= $_POST['sexe'];
			$nom 	= $_POST['nom'];
			$prenom = $_POST['prenom'];
            $adresse 	= $_POST['adresse'];
			$ville  	= $_POST['ville'];
			$codePostal 	= $_POST['codePostal'];

			$sql = "UPDATE utilisateur SET userName='{$username}', email = '{$email}',sexe = '{$sexe}',
						nom = '{$nom}',prenom = '{$prenom}',adresse = '{$adresse}',ville = '{$ville}',codePostal = '{codePostal}'
						WHERE idUtilisateur=" . $_POST['utilisateurid'];

			if( $conn->query($sql)){
				echo "<div class='alert alert-success'>Successfully updated  article</div>";
			}else{
				echo "<div class='alert alert-danger'>Error: There was an error while updating user info</div>";
			}
		}

	// recuperation du id passer en parametre 
	
	//$id = isset($_GET['id']) ? (int) $_GET['id'] : 0;

    $username=$_SESSION["username"];
	
	//$id= $_GET['id'];
	 	 
	$sql = "SELECT * FROM utilisateur WHERE userName='$username'";
	$result = $conn->query($sql);

	if($result->rowCount() < 1){
		//header('Location: #');
		echo "<script type='text/javascript'> document.location = '".$_SESSION['root']."/index.php'; </script>";
		exit;
	}


	$row = $result->fetch(PDO::FETCH_ASSOC);
	$page = basename($_SERVER["PHP_SELF"]);
    $cat = new Categorie();
    $cat->set_PageActive($page);   

	
	
?>

<div class="jumbotron">
    <div id="<?=$page?>" class="body-mu">

        <div id="title" class="white">Mes commandes</div>
        <img src='<?=$_SESSION['root']?>/img/headers_cats/cat_login_signin.jpg' class='w100 d-inline-block align-top landscape' alt=''>

        <?php $cat->genCategoriesHorizontaly()?>

        <div class="row">
            <div class="col-12">
                <div id="commandes" class="commandes">


                </div>
  
            </div>
        </div>

    </div>
</div>
