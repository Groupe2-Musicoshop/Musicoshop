<?php 

require_once 'modele/Database.php';

    $database = new Database();

    $conn = $database->getConnection();

?>
	<?php 
	
	if(isset($_POST['update'])){
		
			$designation  = $_POST['qtestock'];
			$image 	= $_POST['prix'];
            $note 	= $_POST['note'];
			$idCategorie 	= $_POST['Id_Instrument'];
			//$contact  	= $_POST['contact'];
			$sql = "UPDATE article SET qtestock='{$designation}', prix = '{$image}',note = '{$note}',
						Id_Instrument = '{$idCategorie}'
						WHERE Id_Article=" . $_POST['articleid'];

			if( $conn->query($sql)){
				echo "<div class='alert alert-success'>Successfully updated  article</div>";
			}else{
				echo "<div class='alert alert-danger'>Error: There was an error while updating user info</div>";
			}
		}

	// recuperation du id passer en parametre 
	
	//$id = isset($_GET['id']) ? (int) $_GET['id'] : 0;
	
	$id= $_GET['id'];
	 	 
	$sql = "SELECT * FROM article WHERE Id_Article={$id}";
	$result = $conn->query($sql);

	if($result->rowCount() < 1){
		header('Location: #');
		exit;
	}
	$row = $result->fetch(PDO::FETCH_ASSOC);

		$id1=$row['Id_Instrument'];

	$sql1 = "SELECT * FROM instruments WHERE Id_Instrument=$id1";
	$result1 = $conn->query($sql1);
	$row1 = $result1->fetch(PDO::FETCH_ASSOC);
	//echo $row['designation'];


	?>
	<head>
    <link rel="stylesheet" href="<?=$_SESSION['root']?>css/login.css" />
    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
</head>
<div class="jumbotron">
			<form class="box" action="" method="POST">
            			<h3><i class="glyphicon glyphicon-plus"></i>&nbsp;Modifier un article</h3> 

				    <input type="hidden" value="<?php echo $row['Id_Article']; ?>" name="articleid">
				
				    <label class="form-label" for="Id_Instrument">ID article</label>
				    <input type="text" id="articleid"  name="articleid" value="<?php echo $row['Id_Article']; ?>" class="form-control"><br>
				
				
				    <label for="designation">Stock</label>
				    <input type="text" id="designation"  name="qtestock" value="<?php echo $row['qtestock']; ?>" class="form-control"><br>
			
				
				    <label for="image">Prix</label>
				    <input type="text"  name="prix" id="image" value="<?php echo $row['prix']; ?>" class="form-control"><br>
			
                
				    <label for="image">Note</label>
				    <input type="text"  name="note" id="image" value="<?php echo $row['note']; ?>" class="form-control"><br>
				
				 	<label for="idCategorie">ID Instrument</label>
				    <input type="text"  name="Id_Instrument" id="idCategorie" value="<?php echo $row['Id_Instrument']; ?>" class="form-control"><br>
			
				
				    <label for="idCategorie">Désignation instrument</label>
				    <input type="text"  name="designation" id="idCategorie" value="<?php echo $row1['designation']; ?>" class="form-control"><br>
			
				    <input type="submit" name="update" class="box-button" value="Update">
					<p class="box-register"><a href="liste-des-articles.php"><u>Retour à la liste des articles</u></a></p>

			</form>
		</div>