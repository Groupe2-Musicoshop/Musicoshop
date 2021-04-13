<?php

require_once 'modele/Database.php';
require_once 'modele/Article.php';

class Panier{
    private ?int $Id_Panier;
    private ?int $qtite_Art;
    private ?int $Id_Article;
    private ?float $prixT;

    // Table
    private $db_tables = [
        "panier",
        "article",
        "instruments",
        "categorie"
    ];

    /**
     * Get the value of Id_Panier
     *
     * @return  ?int
     */
    public function getIdPanier()
    {
        return $this->Id_Panier;
    }

    /**
     * Set the value of Id_Panier
     *
     * @param  ?int  $Id_Panier
     *
     * @return  self
     */
    public function setIdPanier(?int $Id_Panier)
    {
        $this->Id_Panier = $Id_Panier;

        return $this;
    }

    /**
     * Get the value of qtite_Art
     *
     * @return  ?int
     */
    public function getQtiteArt()
    {
        return $this->qtite_Art;
    }

    /**
     * Set the value of qtite_Art
     *
     * @param  ?int  $qtite_Art
     *
     * @return  self
     */
    public function setQtiteArt(?int $qtite_Art)
    {
        $this->qtite_Art = $qtite_Art;

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

        /**
     * Get the value of prixT
     *
     * @return  ?float
     */
    public function getPrixT()
    {
        return $this->prixT;
    }

    /**
     * Set the value of prixT
     *
     * @param  ?float  $prixT
     *
     * @return  self
     */
    public function setPrixT(?float $prixT)
    {
        $this->prixT = $prixT;

        return $this;
    }

    function genCardArticle(){
      
        $stmt = $this->getSqlArticles();

        $MontantTotal = floatval(0.00);

        echo'<div class="tbl-container">';
        echo "<table id='tabCart' class='table'><thead><tr>";
        echo "<th scope='col'>Article</th>";
        echo "<th scope='col'>Qte</th>";
        echo "<th scope='col'>Prix Total</th>";
        echo "<th scope='col'>Action</th>";
        echo "</tr></thead><tbody>";
        
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            
            extract($row);
            
            echo "<form action='' method='POST'>";
            echo '<tr><td>';
            echo '<div class="card cat'.$row["idCategorie"].' col-md-12" data-category="cat'.$row['idCategorie'].'">';                    
            
            echo '<div class="box_img">';
            echo '<span class="helper"></span>';
            echo '<img src="'.$row['img'].'" class="img_thumb card-img-top" alt="">';
            echo '</div>';
            echo '<div class="card-body row">';
            echo '<div class="col-md-10">';
            echo '<h5 class="card-title">Cat : '.ucfirst($row['libele']).'</h5>';
            echo '<h5 class="card-title">Article : '.ucfirst($row['designation']).'</h5>';
            echo "<input type='hidden' value='". $row['Id_Article'] ."' name='Id_Article_cart' />"; 
            echo '<h6>Noté : ';
            for ($i = 1; $i <= $row['note']; $i++) {
                echo '<img src="'.$_SESSION['root'].'/img/article/star.svg" class="img_thumb star card-img-top" alt="">';
            }
            echo '</h6>';
            echo '</div>';
            echo '<div class="col-md-2">';
                echo '<h5>'.$row['qtestock'].' en stock <br>au prix de '.$row['prix'].' €</h5>';

                echo '<input type="hidden" value="'.$row['Id_Panier'].'" name="Id_Panier" />';
                echo '<input type="hidden" value="'.$row['prix'].'" name="prix" />';

                echo '</div>';
            echo '</div>';
            echo '</div>';
            echo '</td>';

            echo '<td><button class="btn btn-light" type="submit" value="-" name="moinsQte" >-</button>&nbsp;'. $row['qtite_Art'] .'&nbsp;<button class="btn btn-light" type="submit" value="+" name="plusQte" >+</button></td>';
            echo '<td>'. $row['prixT'] .' €</td>';
            echo '<td><button class="btn btn-danger " type="submit" value="" name="trashArt" ><i class="fa fa-trash"></i></button></td>';
            echo '</tr>';
            echo '</form>';

            $MontantTotal = $MontantTotal + $row['prixT'];
        }

        echo "</tbody>       
        <tfoot>
        <tr>
          <td class='text_right' colspan='2'>Montant total</td>
          <td >".number_format($MontantTotal,2)." €</td><td></td>
        </tr>
      </tfoot></table></div>";
    }

    function genTabCartArticles(){

        $numUser=1;
        
        echo "<table class='table table-dark'><thead><tr>";
        echo "<th scope='col'>#</th>";
        echo "<th scope='col'>Article</th>";
        echo "<th scope='col'>Qte</th>";
        echo "<th scope='col'>Prix Total</th>";
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

        $sqlQuery = "SELECT * FROM `panier`
        INNER JOIN article
        ON panier.Id_Article = article.Id_Instrument
        INNER JOIN instruments
        on article.Id_Instrument = instruments.Id_Instrument
        INNER JOIN categorie
        on categorie.idCategorie  = instruments.idCategorie ";

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

    public function addArticleToCart($Qte,$Id_Article,$prix){
        $database = new Database();
        $conn = $database->getConnection();   

        $sqlQuery = "INSERT INTO panier(qtite_Art, Id_Article,prixT)".
        " VALUES ('".$Qte."','".$Id_Article."','".$prix."')";

        $stmt = $conn->prepare($sqlQuery);

        $stmt->execute();
        //return $stmt;
    }

    public function updateQtiteArtCart($Id_Article,$prix){
        $database = new Database();
        $conn = $database->getConnection();   

        $qte = $this->getQte_ArtById_Article($Id_Article);

        $qte = $qte + 1;

        $prixT = $qte * $prix;

        $sqlQuery = "update panier set qtite_Art=".$qte.",prixT =".$prixT." WHERE Id_Article=".$Id_Article;

        $stmt = $conn->prepare($sqlQuery);

        $stmt->execute();
        //return $stmt;
    }

    public function updateQtitePlusMoinsArtCart($Id_Article,$action,$prix){
        $database = new Database();
        $conn = $database->getConnection();   

        $qte = $this->getQte_ArtById_Article($Id_Article);

        if($action=="plusQte"){$qte = $qte + 1;}

        if($action=="moinsQte"){$qte = $qte - 1;}

        $prixT = $qte * $prix;

        $sqlQuery = "update panier set qtite_Art=".$qte.",prixT =".$prixT." WHERE Id_Article=".$Id_Article;

        $stmt = $conn->prepare($sqlQuery);

        $stmt->execute();
        //return $stmt;
    }

    public function getId_PanierById_Article($Id_Article){
        $database = new Database();
        $conn = $database->getConnection();
        $Id_PanierToReturn=0;

        $sqlQuery = "SELECT Id_Panier from panier WHERE Id_Article=".$Id_Article ;
 
        $stmt = $conn->prepare($sqlQuery);              
        
        $stmt->execute();

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            extract($row);
            $Id_PanierToReturn = $Id_Panier;
        }

        return $Id_PanierToReturn;

    }

    public function getQte_ArtById_Article($Id_Article){
        $database = new Database();
        $conn = $database->getConnection();
        $qtite_ArtToReturn=0;

        $sqlQuery = "SELECT qtite_Art from panier WHERE Id_Article=".$Id_Article ;
 
        $stmt = $conn->prepare($sqlQuery);              
        
        $stmt->execute();

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            extract($row);
            $qtite_ArtToReturn = $qtite_Art;
        }

        return $qtite_ArtToReturn;

    }

    public function getSumQteCart(){
        $database = new Database();
        $conn = $database->getConnection();
        $sumQteToReturn=0;

        $sqlQuery = "SELECT sum(qtite_Art)as sumQte FROM panier";
 
        $stmt = $conn->prepare($sqlQuery);              
        
        $stmt->execute();

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            extract($row);
            $sumQteToReturn = $sumQte;
        }

        return $sumQteToReturn;
    }
    public function deleteArtCart($Id_Panier){
        $database = new Database();
        $conn = $database->getConnection();   

        $sqlQuery = "DELETE FROM panier WHERE Id_Panier = ".$Id_Panier;

        $stmt = $conn->prepare($sqlQuery);

        $stmt->execute();
    }
 }
?>