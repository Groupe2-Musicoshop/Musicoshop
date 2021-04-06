<?php

require_once 'modele/Database.php';

class Categorie{
    private ?string $libele;
    private ?string $categorieActive;

    // Table
    private $db_table = "categorie";

    /**
     * Get the value of libele
     *
     * @return  ?string
     */
    public function getLibele()
    {
        return $this->libele;
    }

    /**
     * Set the value of libele
     *
     * @param  ?string  $libele
     *
     * @return  self
     */
    public function setLibele(?string $libele)
    {
        $this->libele = $libele;

        return $this;
    }

    /**
     * Get the value of categorieActive
     *
     * @return  ?string
     */
    public function getCategorieActive()
    {
        return $this->categorieActive;
    }

    /**
     * Set the value of categorieActive
     *
     * @param  ?string  $categorieActive
     *
     * @return  self
     */
    public function setCategorieActive(?string $categorieActive)
    {
        $this->categorieActive = $categorieActive;

        return $this;
    }

    function genCategories(){
        $stmt = $this->getSqlCategories();
        
        echo "<button class='button is-checked' data-filter='*'>show all</button>";

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            extract($row);

            //echo "<li  value=".$idCategorie."><a>".$libele."</a></li>";
            echo "<button class='button' data-filter='.".$idCategorie."'>".$libele."</button>";
        }
    }

    public function getSqlCategories(){
        $database = new Database();
        $conn = $database->getConnection();

        $sqlQuery = "SELECT 
                    idCategorie, libele
                  FROM
                    ". $this->db_table;

         
        $stmt = $conn->prepare($sqlQuery);              
        
        $stmt->execute();
        return $stmt;
    }
}
?>