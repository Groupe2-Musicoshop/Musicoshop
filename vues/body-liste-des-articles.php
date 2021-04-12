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

$sql 	= "SELECT * FROM article";
$result = $conn->query($sql);

if ($result->rowCount() > 0)
{ 
	?>
	
<head>
    <link rel="stylesheet" href="<?=$_SESSION['root']?>css/login.css" />
    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
</head>
<div class="jumbotron">


	<h2>liste des articles</h2>

	<table class="table table-bordered table-striped">
		<tr>

			<td>ID</td>
			<td>Stock</td>
			<td>Prix</td>
            			<td>Note</td>

			<td>ID Instrument</td>
			<td width="70px">Supprimer</td>
			<td width="70px">Modifier</td>
		</tr>
	<?php
		while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
		echo "<form action='' method='POST'>";	//added
		echo "<input type='hidden' value='". $row['Id_Article']."' name='articleid' />"; //added
		echo "<tr>";
		echo "<td>".$row['Id_Article'] . "</td>";
		echo "<td>".$row['qtestock'] . "</td>";
		echo "<td>".$row['prix'] . "</td>";
        echo "<td>".$row['note'] . "</td>";
		echo "<td>".$row['Id_Instrument'] . "</td>";
		//echo "<td>".$row['contact'] . "</td>";
		echo "<td><input type='submit' name='delete' value='Delete' class='btn btn-danger' /></td>";  
		echo "<td><a href='modifier-article.php?id=".$row['Id_Article']."' class='btn btn-info'>Edit</a></td>";
		echo "</tr>";
		echo "</form>"; //added 
	}
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