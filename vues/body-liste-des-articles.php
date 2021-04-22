<?php 

//require_once 'connect.php';
require_once 'modele/Database.php';


    $database = new Database();

    $conn = $database->getConnection();

echo "<div class='container'>";

if( isset($_POST['delete'])){
	$sql = "DELETE FROM article WHERE Id_Article=" . $_POST['articleid'];
	if($conn->query($sql) === TRUE){
		echo "<div class='alert alert-success'>Successfully delete  article</div>";
	}
}

$sql 	= "SELECT * FROM article INNER JOIN instruments ON instruments.Id_Instrument = article.Id_Instrument";
$result = $conn->query($sql);

if ($result->rowCount() > 0)
{ 
?>
<div class="jumbotron">

<p class="box-return"><a href="index.php"><i class="fa fa-chevron-circle-left" aria-hidden="true"></i>
<u>Retour à l'index</u></a></p>
	<h2>liste des articles</h2>

	<table class="table table-bordered table-striped">
		<thead>
			<tr>
				<td>Instrument</td>
				<td>Stock</td>
				<td>Prix</td>
				<td>Note</td>	
				<td width="70px">Supprimer</td>
				<td width="70px">Modifier</td>
			</tr>
		</thead>
	<?php
		while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
		echo "<form action='' method='POST'>";	//added
		echo "<input type='hidden' value='". $row['Id_Article']."' name='articleid' />"; //added
		echo "<tr>";
		echo "<td>".ucfirst($row['designation']) . "</td>";
		echo "<td>".$row['qtestock'] . "</td>";
		echo "<td>".$row['prix'] . "</td>";
        echo "<td>".intval($row['note']) . "</td>";
		//echo "<td>".$row['contact'] . "</td>";
		echo "<td><a href='#' class='btn btn-danger' data-toggle='modal' data-target='#smallModal".$row['Id_Article']."'>Delete</a></td>"; 
		echo "<td><a href='modifier-article.php?id=".$row['Id_Article']."' class='btn btn-info'>Edit</a></td>";
		echo "</tr>";
		echo "<div class='modal' id='smallModal".$row['Id_Article']."' tabindex='-1' role='dialog' aria-labelledby='smallModal' aria-hidden='true'>";
		echo "    <div class='modal-dialog'>";
		echo "        <div class='modal-content'>";
		echo "        <div class='modal-header'>";
		echo "           <h5 class='modal-title' id='myModalLabel'>Confirmation</h5>";

		echo "            <button type='button' class='btn-close' data-bs-dismiss='modal' aria-label='Close'>&times;</button>";
		echo "        </div>";
		echo "       <div class='modal-body'>";
		echo "           <p>Confirmez la suppression de l'article<br><p>";
		echo "       </div>";
		echo "       <div class='modal-footer'>";
		echo "           <button type='button' class='btn btn-secondary' data-dismiss='modal'>Annuler</button>";
		echo "           <input type='submit' name='delete' value='Confirmer' class='btn btn-danger' />";
		echo "       </div>";
		echo "       </div>";
		echo "   </div>";
		echo "</div>";
		echo "</form>"; //added 
	}
	$conn=null;
	$result=null;
	?>
	</table>
<?php 
}
else
{
	echo "<br><br>Pas d'enregistrements";
}
?> 
</div>