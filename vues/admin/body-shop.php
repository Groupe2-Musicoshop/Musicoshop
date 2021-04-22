<?php

	if(isset($_POST["idUtilisateur"])){      
        //$user = new User();
        //$user->updatelUser($_POST['idUtilisateur']);

        $database = new Database();
        $conn = $database->getConnection();

        $sqlQuery = "UPDATE utilisateur SET valideuser=1  WHERE idUtilisateur=".$_POST["idUtilisateur"];
         
        $stmt = $conn->prepare($sqlQuery);              
        
        $stmt->execute();
        
        echo "<script type='text/javascript'> document.location = 'index.php'; </script>";

    }else{

        include_once(__DIR__."/../../modele/Database.php");
        include_once(__DIR__."/../../modele/User.php");
    
        $user = new User();
    }
    $conn=null;
    $stmt=null;
?>

<div id="body-shop" class="body-mu">

    <div id="title">Musicoshop Admin</div>
    <a class="dropdown-item bg-color-pla" href="<?=$_SESSION['root']?>/ctrl/service.php">Update BDD</a>

    <article class="card">

        
        <div class="card-body p-5">
            
            <p>Utilisateurs à valider</p>

            <?php $user->genUsersToValidate();?>

        </div>

    </article>

    <article class="card">

        
        <div class="card-body p-5">
            
            <p>Liste des Utilisateurs</p>

            <?php $user->genUsers();?>

        </div>

    </article>

</div>