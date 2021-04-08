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
    
    function genCardArticle(){
        $stmt = $this->getSqlArticles();

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            extract($row);
            echo '<div class="card cat'.$row["idCategorie"].' col-md-4" data-category="cat'.$row['idCategorie'].'">';
                echo '<div class="box_img">';
                    echo '<img src="'.$row['img'].'" class="img_thumb card-img-top" alt="">';
                echo '</div>';
                echo '<div class="card-body row">';
                    echo '<div class="col-md-8">';
                        echo '<h5 class="card-title">'.ucfirst($row['designation']).'</h5>';
                        echo '<a href="" class="btn btn-primary ">Lire plus</a>';
                    echo '</div>';
                    echo '<div class="col-md-4">';
                        echo '<h5>'.$row['prix'].' €</h5>';
                        echo '<a class="btn btn-success" href=""><i class="fa fa-cart-plus"></i></a>';
                    echo '</div>';
                echo '</div>';
            echo '</div>';
            
        }
    }
    
    public function getSqlArticles(){
        $database = new Database();
        $conn = $database->getConnection();

        $sqlQuery = "SELECT * FROM "
                        .$this->db_tables[0].
                    " INNER JOIN ".$this->db_tables[1].
                    " ON instruments.Id_Instrument = article.Id_Instrument";
        
        $stmt = $conn->prepare($sqlQuery);              
        
        $stmt->execute();
        return $stmt;
    }
}
?>