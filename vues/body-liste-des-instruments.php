<?php 

//require_once 'connect.php';
require_once 'modele/Database.php';


    $database = new Database();

    $conn = $database->getConnection();

if( isset($_POST['delete'])){
	$sql = "DELETE FROM instruments WHERE Id_Instrument=" . $_POST['instrumentid'];
	if($conn->query($sql) === TRUE){
		echo "<div class='alert alert-success'>Successfully delete  instrument</div>";
	}
}
$sql 	= "SELECT * FROM instruments INNER JOIN categorie ON categorie.idCategorie = instruments.idCategorie ORDER BY instruments.Id_Instrument ASC";
$result = $conn->query($sql);

if ($result->rowCount() > 0) { ?>
	
<div class="jumbotron">

<p class="box-return"><a href="index.php"><i class="fa fa-chevron-circle-left" aria-hidden="true"></i>
<u>Retour à l'index</u></a></p>
	<h2>Liste des instruments</h2>
		<table class="table_instrument table table-bordered table-striped">
			<thead>
				<tr>
					<td>Désignation</td>
					<td>Image</td>
					<td>Catégorie</td>
					<td width="70px">Supprimer</td>
					<td width="70px">Modifier</td>
				</tr>
			</thead> 
			<tbody>
				<?php
				while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
				echo "<form action='' method='POST'>";	//added
					echo "<input type='hidden' value='". $row['Id_Instrument']."' name='instrumentid' />"; //added
					echo "<tr>";
					echo "<td>".ucfirst($row['designation']) . "</td>";
					echo "<td><img class='img_small' src='".$row['img'] ."' alt=''></td>";
					echo "<td>".$row['libele'] . "</td>";
					echo "<td><a href='#' class='btn btn-danger' data-toggle='modal' data-target='#smallModal".$row['Id_Instrument']."'>Supprimer</a></td>";  
					echo "<td><a href='modifier-instrument.php?id=".$row['Id_Instrument']."' class='btn btn-info'>Modifier</a></td>";
					echo "</tr>";
					echo "<div class='modal' id='smallModal".$row['Id_Instrument']."' tabindex='-1' role='dialog' aria-labelledby='smallModal' aria-hidden='true'>";
						echo "<div class='modal-dialog'>";
							echo "<div class='modal-content'>";
								echo "<div class='modal-header'>";
									echo "<h5 class='modal-title' id='myModalLabel'>Confirmation</h5>";
									echo "<button type='button' class='btn-close' data-bs-dismiss='modal' aria-label='Close'>&times;</button>";
									echo "</div>";
									echo "<div class='modal-body'>";
										echo "<p>Confirmez la suppression de l'instrument<br><b> '".$row['designation'] ."'</b><p>";
									echo "</div>";
									echo "<div class='modal-footer'>";
										echo "<button type='button' class='btn btn-secondary' data-dismiss='modal'>Annuler</button>";
										echo "<input type='submit' name='delete' value='Confirmer' class='btn btn-danger' />";
								echo "</div>";
							echo "</div>";
						echo "</div>";
					echo "</div>";
				echo "</form>"; //added 
				}
				?>
			</tbody>
	</table>
	</div>
</div>
<?php 
}
else
{
	echo "<br><br>Pas d'enregistrements";
}
?>