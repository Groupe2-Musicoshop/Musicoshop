<?php 

	// Initialiser la session
	$_SESSION['root']="http://".$_SERVER['HTTP_HOST']."musicoshop/";


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
		header('Location: #');
		exit;
	}
	$row = $result->fetch(PDO::FETCH_ASSOC);
	?>
	<head>
    <link rel="stylesheet" href="<?=$_SESSION['root']?>css/login.css" />
    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
</head>
<div class="jumbotron">
			<form class="box" action="" method="POST">
            			<h3><i class="glyphicon glyphicon-plus"></i>&nbsp;Modifier votre profil</h3> 

				    <input type="hidden" value="<?php echo $row['idUtilisateur']; ?>" name="utilisateurid">
				
				    <label class="form-label" for="username">Username</label>
				    <input type="text" id="articleid"  name="username" value="<?php echo $row['userName']; ?>" class="form-control"><br>
				
				
				    <label for="email">Adresse e-mail</label>
				    <input type="text" id="designation"  name="email" value="<?php echo $row['email']; ?>" class="form-control"><br>
			
				
				    <label for="sexe">Sexe</label>
				    <input type="text"  name="sexe" id="sexe" value="<?php echo $row['sexe']; ?>" class="form-control"><br>
			
                
				    <label for="nom">Nom</label>
				    <input type="text"  name="nom" id="nom" value="<?php echo $row['nom']; ?>" class="form-control"><br>
				
					<label for="prenom">Prénom</label>
				    <input type="text"  name="prenom" id="prenom" value="<?php echo $row['prenom']; ?>" class="form-control"><br>
				    
                    <label for="adresse">Adresse</label>
				    <input type="text"  name="adresse" id="adresse" value="<?php echo $row['adresse']; ?>" class="form-control"><br>
				    
                    <label for="ville">Ville</label>
				    <input type="text"  name="ville" id="ville" value="<?php echo $row['ville']; ?>" class="form-control"><br>

				    <label for="codePostal">Code_Postal</label>
				    <input type="text"  name="codePostal" id="codePostal" value="<?php echo $row['codePostal']; ?>" class="form-control"><br>
			
				    <input type="submit" name="update" class="box-button" value="Update">
			</form>
		</div>
