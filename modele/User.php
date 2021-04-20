<?php

require_once __DIR__.'/Database.php';

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
            echo "<form action='' method='POST'>";	//added
		    echo "<input type='hidden' value='". $row['idUtilisateur']."' name='idUtilisateur' />"; //added
            echo "<tr><th scope='row'>".$numUser."</th>";
            echo "<td>".$userName."</td>";
            echo "<td>".$nom."</td>";
            echo "<td>".$prenom."</td>";
            echo "<td>".$type."</td>";
            echo "<td><input type='submit' name='Valider' value='Valider' class='btn btn-primary' /></td>";
            echo "</tr>";
        }
        echo "</tbody></table>";
        echo "</form>";
    }

    public function getSqlUsersToValidate(){
        $database = new Database();
        $conn = $database->getConnection();

        $sqlQuery = "SELECT * FROM ". $this->db_table." WHERE valideuser=0";

         
        $stmt = $conn->prepare($sqlQuery);              
        
        $stmt->execute();
        return $stmt;

        $conn=null;
        $stmt=null;
    }

    public function updatelUser($idUtilisateur){
        $database = new Database();
        $conn = $database->getConnection();

        $sqlQuery = "UPDATE ". $this->db_table." SET valideuser=1  WHERE idUtilisateur=".$idUtilisateur;
         
        $stmt = $conn->prepare($sqlQuery);              
        
        $stmt->execute();

        $conn=null;
        $stmt=null;
    }

    public function updatelUserChangePwd($email){
        $database = new Database();
        $conn = $database->getConnection();

        $sqlQuery = "UPDATE ". $this->db_table." SET changepwd=1  WHERE email=".$email;
         
        $stmt = $conn->prepare($sqlQuery);              
        
        $stmt->execute();

        $conn=null;
        $stmt=null;
    }

    public function getUserIdByUserName($userName){

        $database = new Database();
        $conn = $database->getConnection();

        $idUtilisateurToReturn=0;

        $sqlQuery = "SELECT `idUtilisateur` from `utilisateur` WHERE userName LIKE '".$userName."'";
 
        $stmt = $conn->prepare($sqlQuery);              
        
        $stmt->execute();

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            extract($row);
            $idUtilisateurToReturn = $idUtilisateur;
        }

        return $idUtilisateurToReturn;
        $conn=null;
        $stmt=null;
    }

    public function getCoordonneesFromUser($idUtilisateur){

        $database = new Database();
        $conn = $database->getConnection();

        $arryCoordUserToReturn=array();

        $sqlQuery = "SELECT * from `utilisateur` WHERE idUtilisateur = ".$idUtilisateur;
 
        $stmt = $conn->prepare($sqlQuery);              
        
        $stmt->execute();

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            extract($row);
            $arryCoordUserToReturn = [$userName,$sexe,$nom,$prenom];
        }

        return $arryCoordUserToReturn;
        $conn=null;
        $stmt=null;
    }
}
?>