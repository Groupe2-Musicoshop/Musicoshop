<?php

require_once 'modele/Database.php';

class Article{
    private ?string $designation;
    private ?string $image;
    private ?float $prix;
    private ?float $note;
    private ?int $stock;
    
    private ?int $Id_Article=0;

    // Table
    private $db_tables = [
        "instruments",
        "article",
        "categorie"
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
    
    /**
     * Get the value of Id_Article
     *
     * @return  ?int
     */
    public function getIdArticle()
    {
        return $this->Id_Article;
    }

    /**
     * Set the value of Id_Article
     *
     * @param  ?int  $Id_Article
     *
     * @return  self
     */
    public function setIdArticle(?int $Id_Article)
    {
        $this->Id_Article = $Id_Article;

        return $this;
    }

    function genCardArticle($numCat){

        if($numCat>0){

            $stmt = $this->getSqlArticleByCat($numCat);

        }else{

            if($this->Id_Article>0){

                $stmt = $this->getSqlSingleArticleByID($this->Id_Article);

            }else{

                $stmt = $this->getSqlArticles();

            }

        }


        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            extract($row);
            echo '<form method="POST">';
            echo '<div class="card cat'.$row["idCategorie"].' col-md-4" data-category="cat'.$row['idCategorie'].'">';
                echo '<a class="linkcat" href="'.$_SESSION['root'].'/'.$row["page"].'"><i class="fa fa-quote-left"></i>&nbsp;'.$row["libele"].'&nbsp;<i class="fa fa-quote-right"></i></a>';

            echo '<div class="box_img">';
            echo '<span class="helper"></span>';
            echo '<img src="'.$row['img'].'" class="img_thumb card-img-top" alt="">';
            echo '</div>';
            echo '<div class="card-body row">';
            echo '<div class="col-md-8">';
            echo '<h5 class="card-title">'.ucfirst($row['designation']).'</h5>';
            echo '<h6>';
            for ($i = 1; $i <= $row['note']; $i++) {
                echo '<img src="'.$_SESSION['root'].'/img/article/star.svg" class="img_thumb star card-img-top" alt="">';
            }
            echo '</h6>';
            echo '<a href="" class="btn btn-primary ">Lire plus</a>';
            echo '</div>';
            echo '<div class="col-md-4">';
                echo '<h5>'.$row['prix'].' €</h5>';
                //echo '<a class="btn btn-success" href=""><i class="fa fa-cart-plus"></i></a>';

		        echo '<button class="btn btn-success " type="submit" value="+" name="addCart" ><i class="fa fa-cart-plus"></i></button>';
		        echo '<input type="hidden" value="'.$row['Id_Article'].'" name="Id_Article" />';
		        echo '<input type="hidden" value="'.$row['prix'].'" name="prix" />';

                echo '</div>';
            echo '</div>';
            echo '</div>';
            echo '</form>';
        }
    }

    function genTabCartArticles($cart){

        $numUser=1;
        
        echo "<table class='table table-dark'><thead><tr>";
        echo "<th scope='col'>#</th>";
        echo "<th scope='col'>Id_Article</th>";
        //echo "<th scope='col'>Nom</th>";
        //echo "<th scope='col'>Prénom</th>";
        //echo "<th scope='col'>Type</th>";
        echo "<th scope='col'>Action</th>";
        echo "</tr></thead><tbody>";

        for($i = 0 ; $i < count($cart) ; $i++) {

            echo "<form action='' method='POST'>";	//added
		    echo "<input type='hidden' value='". $cart[$i] ."' name='Id_Article' />"; //added
            echo "<tr><th scope='row'>". $cart[$i] ."</th>";
            echo "<td>". $cart[$i] ."</td>";
            //echo "<td>".$nom."</td>";
            //echo "<td>".$prenom."</td>";
            //echo "<td>".$type."</td>";
            echo "<td><input type='submit' name='view' value='Voir' class='btn btn-primary' /></td>";
            echo "</tr>";
        }
        echo "</tbody></table>";
        echo "</form>";
    }

    public function getSqlArticles(){
        $database = new Database();
        $conn = $database->getConnection();

        $sqlQuery = "SELECT * FROM "
        .$this->db_tables[1].
        " INNER JOIN ".$this->db_tables[0].
        " ON instruments.Id_Instrument = article.Id_Instrument ".
        " INNER JOIN ".$this->db_tables[2].
        " on categorie.idCategorie = instruments.idCategorie";

        $stmt = $conn->prepare($sqlQuery);

        $stmt->execute();
        return $stmt;
    }

    public function getSqlArticleByCat($numCat){
        $database = new Database();
        $conn = $database->getConnection();

        $sqlQuery = "SELECT * FROM "
        .$this->db_tables[1].
        " INNER JOIN ".$this->db_tables[0].
        " ON instruments.Id_Instrument = article.Id_Instrument".
        " INNER JOIN ".$this->db_tables[2].
        " on categorie.idCategorie = instruments.idCategorie".
        " WHERE instruments.idCategorie = ".$numCat;

        $stmt = $conn->prepare($sqlQuery);

        $stmt->execute();
        return $stmt;
    }

    public function getSqlSingleArticleByID(){
        $database = new Database();
        $conn = $database->getConnection();

        $sqlQuery = "SELECT * FROM "
        .$this->db_tables[1].
        " INNER JOIN ".$this->db_tables[0].
        " ON instruments.Id_Instrument = article.Id_Instrument".
        " INNER JOIN ".$this->db_tables[2].
        " on categorie.idCategorie = instruments.idCategorie".
        " WHERE instruments.Id_Article = ".$this->Id_Article;

        $stmt = $conn->prepare($sqlQuery);

        $stmt->execute();
        return $stmt;
    }
}
?>