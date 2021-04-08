<?php

require_once 'modele/Database.php';

class User{

    private $rootFor;
    
    // Table
    private $db_table = "utilisateur";  

    function genUsersToValidate(){

        $stmt = $this->getSqlUsersToValidate();

        $numUser=1;
        
        echo "<table class='table table-dark'><thead><tr>";
        echo "<th scope='col'>#</th>";
        echo "<th scope='col'>User Name</th>";
        echo "<th scope='col'>Nom</th>";
        echo "<th scope='col'>Prénom</th>";
        echo "<th scope='col'>Type</th>";
        echo "<th scope='col'>Action</th>";
        echo "</tr></thead><tbody>";

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            extract($row);
            
            echo "<tr><th scope='row'>".$numUser."</th>";
            echo "<td>".$userName."</td>";
            echo "<td>".$nom."</td>";
            echo "<td>".$prenom."</td>";
            echo "<td>".$type."</td>";
            echo "<td><a href='".$_SESSION['root']."/index.php?idUtilisateur=".$row['idUtilisateur']."' class='btn btn-info'>Valider</a></td>";
            echo "</tr>";
        }
        echo "</tbody></table>";
    }

    public function getSqlUsersToValidate(){
        $database = new Database();
        $conn = $database->getConnection();

        $sqlQuery = "SELECT * FROM ". $this->db_table." WHERE valideuser=0";

         
        $stmt = $conn->prepare($sqlQuery);              
        
        $stmt->execute();
        return $stmt;
    }

    public function updatelUser($idUtilisateur){
        $database = new Database();
        $conn = $database->getConnection();

        $sqlQuery = "UPDATE ". $this->db_table." SET valideuser = 1  WHERE idUtilisateur=".$idUtilisateur;
         
        $stmt = $conn->prepare($sqlQuery);              
        
        $stmt->execute();

    }
}
?>