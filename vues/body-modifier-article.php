<?php 

require_once 'modele/Database.php';

    $database = new Database();

    $conn = $database->getConnection();

?>
	<?php 
	
	if(isset($_POST['update'])){
		
		$qtestock  = $_POST['qtestock'];
		$prix 	= $_POST['prix'];
		$note 	= $_POST['note'];
		$idInstrument 	= $_POST['Id_Instrument'];
		$sql = "UPDATE article SET qtestock='{$qtestock}', prix = '{$prix}',note = '{$note}',
					Id_Instrument = '{$idInstrument}'
					WHERE Id_Article=" . $_POST['articleid'];

		if( $conn->query($sql)){
			echo "<div class='alert alert-success'>Article mis à jour avec succès</div>";
		}else{
			echo "<div class='alert alert-danger'>Error: There was an error while updating user info</div>";
		}
	}
	
	$id= $_GET['id'];
	 	 
	$sql = "SELECT * FROM article INNER JOIN instruments ON instruments.Id_Instrument = article.Id_Instrument WHERE Id_Article={$id}";
	$result = $conn->query($sql);

	if($result->rowCount() < 1){
		header('Location: #');
		exit;
	}
	$row = $result->fetch(PDO::FETCH_ASSOC);
	$conn=null;
	$result=null;
	?>
<div class="jumbotron">

	<form class="box" action="" method="POST">
		
		<p class="box-return"><a href="liste-des-articles.php"><i class="fa fa-chevron-circle-left" aria-hidden="true"></i>
		<u>Retour à la liste des articles</u></a></p>
        <h3><i class="glyphicon glyphicon-plus"></i>&nbsp;Modifier un article</h3> 

		<input type="hidden" value="<?=$row['Id_Article'] ?>" name="articleid">

		<strong><span>Id : <?=$row['Id_Article'] ?></span></strong>	
		<br>
		<label for="designation">Stock</label>
		<input type="text" id="designation"  name="qtestock" value="<?= $row['qtestock'] ?>" class="form-control"><br>

	
		<label for="prix">Prix</label>
		<input type="text"  name="prix" id="prix" value="<?=$row['prix'] ?>" class="form-control"><br>

		<label for="note">Note</label>
		<input type="text"  name="note" id="note" value="<?=$row['note'] ?>" class="form-control"><br>
	
		<label for="idCategorie">Id instrument</label>
		<input type="text"  name="Id_Instrument" id="Id_Instrument" value="<?= ucfirst($row['Id_Instrument']) ?>" class="form-control"><br>

		<div class="center col-md-6 col-lg-4">
			<input type="submit" name="update" class="btn btn-primary box-button" value="Modifier">
		</div>
	</form>
</div>