<?php 

require_once 'modele/Database.php';

    $database = new Database();

    $conn = $database->getConnection();

?>
	<?php 
	
	if(isset($_POST['update'])){
		
			$designation  = $_POST['designation'];
			$image 	= $_POST['image'];
			$idCategorie 	= $_POST['idCategorie'];
			//$contact  	= $_POST['contact'];
			$sql = "UPDATE instruments SET designation='{$designation}', img = '{$image}',
						idCategorie = '{$idCategorie}'
						WHERE Id_Instrument=" . $_POST['instrumentid'];

			if( $conn->query($sql)){
				echo "<div class='alert alert-success'>Successfully updated  instrument</div>";
			}else{
				echo "<div class='alert alert-danger'>Error: There was an error while updating user info</div>";
			}
		}

	// recuperation du id passer en parametre 
	
	//$id = isset($_GET['id']) ? (int) $_GET['id'] : 0;
	
	$id= $_GET['id'];
	 	 
	$sql = "SELECT * FROM instruments WHERE Id_Instrument={$id}";
	$result = $conn->query($sql);

	if($result->rowCount() < 1){
		header('Location: edit.php');
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
			<p class="box-return"><a href="liste-des-instruments.php"><i class="fa fa-chevron-circle-left" aria-hidden="true"></i>
<u>Retour à la liste des instruments</u></a></p>
            			<h3><i class="glyphicon glyphicon-plus"></i>&nbsp;Modifier un instrument</h3> 

				    <input type="hidden" value="<?php echo $row['Id_Instrument']; ?>" name="instrumentid">
				    <label class="form-label" for="Id_Instrument">ID instrument</label>
				    <input type="text" id="instrumentid"  name="instrumentid" value="<?php echo $row['Id_Instrument']; ?>" class="form-control"><br>
				    <label for="designation">Désignation</label>
				    <input type="text" id="designation"  name="designation" value="<?php echo $row['designation']; ?>" class="form-control"><br>
				    <label for="image">Adresse image</label>
				    <input type="file"  name="image" id="image" value="<?php echo $row['img']; ?>" class="form-control"><br>
				    <label for="idCategorie">ID Catégorie</label>
				    <input type="text"  name="idCategorie" id="idCategorie" value="<?php echo $row['idCategorie']; ?>" class="form-control"><br>
				    <input type="submit" name="update" class="box-button" value="Update">
			</form>
		</div>