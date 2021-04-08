<?php

    if(isset($_SESSION['idUtilisateur'])){

        echo $_SESSION['idUtilisateur'];

        $user->updatelUser($_SESSION['idUtilisateur']);

    }else{

        //include_once(__DIR__."/../../modele/Database.php");
        include_once(__DIR__."/../../modele/User.php");
    
        $user = new User();
    }

?>

<div id="body-shop" class="body-mu">

    <div id="title">Musicoshop Admin</div>
    <a class="dropdown-item bg-color-pla" href="http://localhost:8080/Musicoshop/ctrl/service.php">Update BDD</a>
    
    <?php $user->genUsersToValidate();?>
</div>