<?php

	if(isset($_POST["idUtilisateur"])){      
        //$user = new User();
        //$user->updatelUser($_POST['idUtilisateur']);

        $database = new Database();
        $conn = $database->getConnection();

        $sqlQuery = "UPDATE utilisateur SET valideuser=1  WHERE idUtilisateur=".$_POST["idUtilisateur"];

        echo $sqlQuery;
         
        $stmt = $conn->prepare($sqlQuery);              
        
        $stmt->execute();
        
        header('Location:index.php');

    }else{

        include_once(__DIR__."/../../modele/Database.php");
        include_once(__DIR__."/../../modele/User.php");
    
        $user = new User();
    }

?>

<div id="body-shop" class="body-mu">

    <div id="title">Musicoshop Admin</div>
    <a class="dropdown-item bg-color-pla" href="http://localhost:8080/Musicoshop/ctrl/service.php">Update BDD</a>
    <a class="dropdown-item bg-color-pla" href="http://localhost:8080/Musicoshop/vues/body-ajout-article.php">Ajouter un
        article</a>

    <?php $user->genUsersToValidate();?>
</div>