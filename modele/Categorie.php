<?php

//require_once $_SESSION['root'].'/modele/Database.php';
require_once __DIR__.'/Database.php';
//include_once(__DIR__."/../modele/Database.php";

class Categorie{
    private ?string $libele;
    private ?string $categorieActive;
    private ?string $pageActive;

    // Table
    private $db_table = "categorie";

    private $pagesCategories = '[
        {"page":"cat-guitares_basses.php"},
        {"page":"cat-batteries_percussions.php"},
        {"page":"cat-pianos_claviers.php"},        
        {"page":"cat-instruments_a_vent.php"},
        {"page":"cat-instruments_a_cordes_frottees.php"},
        {"page":"cat-instruments_a_cordes.php"}
    ]';

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

    function get_PageActive($pageAtester){

        if($this->pageActive==$pageAtester){ 
            return 'active';
        }else{
            return '';
        }

    }

    function set_PageActive($pageActive){
        $this->pageActive = $pageActive;
    }

    function genCategories(){
        $stmt = $this->getSqlCategories();
        
        echo "<button class='button is-checked' data-filter='*'>Toutes</button>";

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            extract($row);

            //echo "<li  value=".$idCategorie."><a>".$libele."</a></li>";
            echo "<button class='button' data-filter='.cat".$idCategorie."'>".$libele."</button>";
        }
    }

    function genCategoriesVerticaly(){

        $pages_json = json_decode($this->pagesCategories,true);

        $numpage="0";

        //print_r($pages_json);

        $stmt = $this->getSqlCategories();

        echo "<li value='all'><a href='".$_SESSION['root']."/index.php'>Catalogue</a></li>";

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            extract($row);

            echo "<li value=".$idCategorie."><a href='".$_SESSION['root']."/".$pages_json[$numpage]['page']."'>".$libele."</a></li>";
            $numpage+=1;
        }
    }

        function genCategoriesHorizontaly(){

        $pages_json = json_decode($this->pagesCategories,true);

        $numpage="0";

        //print_r($pages_json);

        $stmt = $this->getSqlCategories();
        echo "<nav class='navbar navbar-expand-lg navbar-light bg-color-whi m1rem'>";

        echo '<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCatHorizontalyContent" aria-controls="navbarCatHorizontalyContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
        </button>';

        echo "<div class='collapse navbar-collapse' id='navbarCatHorizontalyContent'>";

        echo "<ul id='cat-horizontaly' class='navbar-nav'>";

            echo "<li class='nav-item ' value='all'><a class='nav-link' href='".$_SESSION['root']."/index.php'>Catalogue</a></li>";


        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            extract($row);
               
            echo "<li class='nav-item ".$this->get_PageActive($pages_json[$numpage]['page'])."' value=".$idCategorie."><a class='nav-link' href='".$_SESSION['root']."/".$pages_json[$numpage]['page']."'>".$libele."</a></li>";
            $numpage+=1;
        }
        echo "</ul></div></nav>";
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
        
        $conn=null;
        $stmt=null;
    }
}
?>