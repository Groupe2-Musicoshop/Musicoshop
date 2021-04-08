<?php

require_once 'modele/Database.php';

class Article{
    private ?string $designation;
    private ?string $image;
    private ?float $prix;
    private ?float $note;
    private ?int $stock;

    // Table
    private $db_tables = [
        "instruments",
        "article"
    ];

    /**
     * Get the value of designation
     *
     * @return  ?string
     */
    public function getDesignation()
    {
        return $this->designation;
    }

    /**
     * Set the value of designation
     *
     * @param  ?string  $designation
     *
     * @return  self
     */
    public function setDesignation(?string $designation)
    {
        $this->designation = $designation;

        return $this;
    }

    /**
     * Get the value of image
     *
     * @return  ?string
     */
    public function getImage()
    {
        return $this->image;
    }

    /**
     * Set the value of image
     *
     * @param  ?string  $image
     *
     * @return  self
     */
    public function setImage(?string $image)
    {
        $this->image = $image;

        return $this;
    }

        /**
     * Get the value of prix
     *
     * @return  ?float
     */
    public function getPrix()
    {
        return $this->prix;
    }

    /**
     * Set the value of prix
     *
     * @param  ?float  $prix
     *
     * @return  self
     */
    public function setPrix(?float $prix)
    {
        $this->prix = $prix;

        return $this;
    }

            /**
     * Get the value of note
     *
     * @return  ?float
     */
    public function getNote()
    {
        return $this->note;
    }

    /**
     * Set the value of note
     *
     * @param  ?float  $note
     *
     * @return  self
     */
    public function setNote(?float $note)
    {
        $this->note = $note;

        return $this;
    }
    
    /**
     * Get the value of stock
     *
     * @return  ?int
     */
    public function getStock()
    {
        return $this->stock;
    }

    /**
     * Set the value of stock
     *
     * @param  ?int  $stock
     *
     * @return  self
     */
    public function setStock(?int $stock)
    {
        $this->stock = $stock;

        return $this;
    }

    function genCategories(){
        $stmt = $this->getSqlCategories();
        
        echo "<button class='button is-checked' data-filter='*'>show all</button>";

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            extract($row);

            //echo "<li  value=".$idCategorie."><a>".$designation."</a></li>";
            echo "<button class='button' data-filter='.".$idCategorie."'>".$designation."</button>";
        }
    }

    function genCategoriesVerticaly(){

        $pages_json = json_decode($this->pagesCategories,true);

        $numpage="0";

        //print_r($pages_json);

        $stmt = $this->getSqlCategories();

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            extract($row);

            echo "<li  value=".$idCategorie."><a href='".$_SESSION['root']."/".$pages_json[$numpage]['page']."'>".$designation."</a></li>";
            $numpage+=1;
        }
    }

        function genCategoriesHorizontaly(){

        $pages_json = json_decode($this->pagesCategories,true);

        $numpage="0";

        //print_r($pages_json);

        $stmt = $this->getSqlCategories();
        echo "<nav class='navbar navbar-expand-lg navbar-light bg-color-whi'>";

        echo "<div class='collapse navbar-collapse' id='navbarCatHorizontalyContent'>";

        echo "<ul id='cat-horizontaly' class='navbar-nav'>";

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            extract($row);
               
            echo "<li class='nav-item ".$this->get_PageActive($pages_json[$numpage]['page'])."' value=".$idCategorie."><a class='nav-link' href='".$_SESSION['root']."/".$pages_json[$numpage]['page']."'>".$designation."</a></li>";
            $numpage+=1;
        }
        echo "</ul></div></nav>";
    }

    public function getSqlCategories(){
        $database = new Database();
        $conn = $database->getConnection();

        $sqlQuery = "SELECT 
                    idCategorie, designation
                  FROM
                    ". $this->db_table;

         
        $stmt = $conn->prepare($sqlQuery);              
        
        $stmt->execute();
        return $stmt;
    }
}
?>