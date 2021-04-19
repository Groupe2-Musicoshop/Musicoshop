<?php 

require_once 'modele/Database.php';

$database = new Database();

$conn = $database->getConnection();

if(isset($_POST['update'])){
	$designation  = $_POST['designation'];
	if(empty($_POST['image'])){
		$sql = "SELECT img FROM instruments WHERE Id_Instrument=". $_POST['instrumentid'];
		$stmt = $conn->prepare($sql);
		$stmt->execute();
		$row = $stmt->fetch();
		$image = $row['img'];

	}else{
		$image = $_SESSION['root'].'/img/cart_img/'.$_POST['image'];
	}
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
<div class="jumbotron">
		<form class="box" action="" method="POST">
		<p class="box-return"><a href="liste-des-instruments.php"><i class="fa fa-chevron-circle-left" aria-hidden="true"></i>
		<u>Retour à la liste des instruments</u></a></p>
        <h3><i class="glyphicon glyphicon-plus"></i>&nbsp;Modifier un instrument</h3> 
		<input type="hidden" value="<?=$row['Id_Instrument'] ?>" name="instrumentid">
		<strong><span>Id : <?=$row['Id_Instrument'] ?></span></strong>
		<br>
		<label for="designation">Désignation</label>
		<input type="text" id="designation"  name="designation" value="<?=$row['designation'] ?>" class="form-control"><br>
		<label for="image">Adresse image</label>
		<input type="file"  name="image" id="image" class="form-control"><br>
		<label for="idCategorie">Catégorie</label>
		<select name="idCategorie" class="form-select">
			<?php
			$sql = 'SELECT idCategorie, libele FROM categorie';
			foreach ($conn->query($sql) as $row) {
			?>
			<option value="<?=$row['idCategorie']?>">
				<?=ucfirst($row['libele'])?></option>
			<?php
			}
			?>
        </select>
		<br>
		<div class="center col-4"><input type="submit" name="update" class="btn btn-primary box-button" value="Update">
		</div>
	</form>
</div>
