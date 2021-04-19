<?php

require_once __DIR__.'/Database.php';
require_once __DIR__.'/Article.php';

class Panier{

    //public ?string $this->getCOOKIE() = $this->getCOOKIE();

    private ?int $Id_Panier;
    private ?int $qtite_Art;
    private ?int $Id_Article;
    private ?float $prixT;
    private ?string $userName;

    private ?string $COOKIE;

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

    /**
     * Get the value of userName
     *
     * @return  ?string
     */
    public function getUserName()
    {
        return $this->userName;
    }

    /**
     * Set the value of userName
     *
     * @param  ?string  $userName
     *
     * @return  self
     */
    public function setUserName(?string $userName)
    {
        $this->userName = $userName;

        return $this;
    }

        /**
     * Get the value of _COOKIE
     *
     * @return  ?string
     */
    public function getCOOKIE()
    {
        return $this->COOKIE;
    }

    /**
     * Set the value of _COOKIE
     *
     * @param  ?string  $_COOKIE
     *
     * @return  self
     */
    public function setCOOKIE(?string $COOKIE)
    {
        $this->COOKIE = $COOKIE;

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
            
            echo "<form action='' method='POST' name='formData".$row["Id_Panier"]."'>";
            
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
                echo '<a href="singleArticle.php?id_art='.$row['Id_Article'].'" class="btn btn-primary ">Lire plus</a>';
            echo '</div>';
            echo '<div class="col-md-2">';
                echo '<h5>'.$row['qtestock'].' en stock <br>au prix de '.$row['prix'].' €</h5>';

                echo '<input type="hidden" value="'.$row['Id_Panier'].'" name="Id_Panier" />';
                echo '<input type="hidden" value="'.$row['prix'].'" name="prix" />';
                echo '<input type="hidden" value="'.$row['qtite_Art'].'" name="qtite_Art" />';

                echo '</div>';
            echo '</div>';
            echo '</div>';
            echo '</td>';

            echo '<td><button class="btn btn-light" type="submit" value="-" name="moinsQte" >-</button>&nbsp;'. $row['qtite_Art'] .'&nbsp;<button class="btn btn-light" type="submit" value="+" name="plusQte" >+</button></td>';
                        
            echo '<td><span id="prixT'.$row['Id_Panier'].'">'. $row['prixT'] .'</span> €</td>';
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

    function genMiniCardArticle(){
      
        $stmt = $this->getSqlArticles();

        $MontantTotal = floatval(0.00);

        echo'<div class="tbl-container">';
        echo "<table id='miniTabCart' class='table'>";
        echo "<tbody>";
        
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            
            extract($row);
            
            echo "<form action='' method='POST' name='formData".$row["Id_Panier"]."'>";
            
            echo '<tr><td>';
            echo '<div class="card col-md-12" data-category="cat'.$row['idCategorie'].'">';                    
            

            echo '<div class="card-body row">';
                echo '<div class="col-md-4">';
                echo '<div class="box_img">';
                    echo '<span class="helper"></span>';
                    echo '<img src="'.$row['img'].'" class="img_thumb card-img-top" alt="">';
                echo '</div>';
                echo '</div>';
                    echo '<div class="col-md-8">';

                    echo '<h5 class="card-title"><a href="singleArticle.php?id_art='.$row['Id_Article'].'">'.ucfirst($row['designation']).'</a></h5>';
                    echo "<input type='hidden' value='". $row['Id_Article'] ."' name='Id_Article_cart' />";
                    echo '<h5>'.$row['qtestock'].' en stock '.$row['prix'].' €</h5>';
                    echo '<input type="hidden" value="'.$row['Id_Panier'].'" name="Id_Panier" />';
                    echo '<input type="hidden" value="'.$row['prix'].'" name="prix" />';
                    echo '<input type="hidden" value="'.$row['qtite_Art'].'" name="qtite_Art" />';
                echo '</div>';
            echo '</div>';
            echo '</div>';
            echo '</td>';            
            echo '</form>';            
        }

        echo "</table></div>";
    }

    function genTabCartArticles($cart){

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
        ON panier.Id_Article = article.Id_Article
        INNER JOIN instruments
        on article.Id_Instrument = instruments.Id_Instrument
        INNER JOIN categorie
        on categorie.idCategorie  = instruments.idCategorie "
        ." WHERE sessId='".$this->getCOOKIE()."'" ;
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
        " WHERE instruments.idCategorie = ".$numCat." and sessId='".$this->getCOOKIE()."'" ;

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
        " WHERE instruments.Id_Article = ".$this->Id_Article." and sessId='".$this->getCOOKIE()."'" ;

        $stmt = $conn->prepare($sqlQuery);

        $stmt->execute();

        return $stmt;
    }

    public function addArticleToCart($Qte,$Id_Article,$prix,$qtestock){
        $database = new Database();
        $conn = $database->getConnection();   

        $sqlQuery = "INSERT INTO panier(sessId,qtite_Art, Id_Article,prixT)".
        " VALUES ('".$this->getCOOKIE()."','".$Qte."','".$Id_Article."','".$prix."')";

        $stmt = $conn->prepare($sqlQuery);

        $stmt->execute();

        $qtestock = $qtestock - 1;

        $article = new Article();
        $article->updateStock_ArtById_Article($qtestock,$Id_Article);
    }

    public function updateQtiteArtCart($Id_Article,$prix,$qtestock){
        $database = new Database();
        $conn = $database->getConnection();   

        $qte = $this->getQte_ArtById_Article($Id_Article);

        $qte = $qte + 1;

        $qtestock = $qtestock - 1;

        $prixT = $qte * $prix;

        $sqlQuery = "update panier set qtite_Art=".$qte.",prixT =".$prixT." WHERE Id_Article=".$Id_Article." and sessId='".$this->getCOOKIE()."'" ;

        $stmt = $conn->prepare($sqlQuery);

        $stmt->execute();

        $article = new Article();
        $article->updateStock_ArtById_Article($qtestock,$Id_Article);

    }

    public function updateQtitePlusMoinsArtCart($Id_Article,$action,$prix){
        $database = new Database();

        $qte=0;
        $qtestock=0;

        $conn = $database->getConnection();   

        $qte = $this->getQte_ArtById_Article($Id_Article);
        $qtestock = $this->getStock_ArtById_Article($Id_Article);

        if($action=="plusQte" && $qtestock>0){

            $qte = $qte + 1;
            $qtestock = $qtestock - 1;
        }

        if($action=="moinsQte" && $qte>1){

                $qte = $qte - 1;
                $qtestock = $qtestock + 1;

        }

        $prixT = $qte * $prix;

        $sqlQuery = "update panier set qtite_Art=".$qte.",prixT =".$prixT." WHERE Id_Article=".$Id_Article." and sessId='".$this->getCOOKIE()."'";

        $stmt = $conn->prepare($sqlQuery);

        $stmt->execute();

        $article = new Article();
        $article->updateStock_ArtById_Article($qtestock,$Id_Article);

        $nav = new Nav();
        $nav->set_nbArticle($this->getSumQteCart());

        return [$qte,$prixT];
    }

    public function getId_PanierById_Article($Id_Article){
        $database = new Database();
        $conn = $database->getConnection();
        $Id_PanierToReturn=0;

        $sqlQuery = "SELECT Id_Panier from panier WHERE Id_Article=".$Id_Article." and sessId='".$this->getCOOKIE()."'" ;
 
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

        $sqlQuery = "SELECT qtite_Art from panier WHERE Id_Article=".$Id_Article." and sessId='".$this->getCOOKIE()."'" ;
 
        $stmt = $conn->prepare($sqlQuery);              
        
        $stmt->execute();

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            extract($row);
            $qtite_ArtToReturn = $qtite_Art;
        }

        return $qtite_ArtToReturn;

    }

    public function getStock_ArtById_Article($Id_Article){
        $database = new Database();
        $conn = $database->getConnection();
        $qtestock_ArtToReturn=0;

        $sqlQuery = "SELECT qtestock FROM `panier` INNER JOIN article ON panier.Id_Article = article.Id_Instrument INNER JOIN instruments on article.Id_Instrument = instruments.Id_Instrument  WHERE panier.Id_Article=".$Id_Article." and sessId='".$this->getCOOKIE()."'" ;
 
        $stmt = $conn->prepare($sqlQuery);              
        
        $stmt->execute();

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            extract($row);
            $qtestock_ArtToReturn = $qtestock;
        }

        return $qtestock_ArtToReturn;

    }

    public function getSumQteCart(){
        $database = new Database();
        $conn = $database->getConnection();
        $sumQteToReturn=0;

        $sqlQuery = "SELECT sum(qtite_Art) as sumQte FROM `panier` WHERE sessId='".$this->getCOOKIE()."'";
 
        $stmt = $conn->prepare($sqlQuery);              
        
        $stmt->execute();

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            extract($row);
            $sumQteToReturn = $sumQte;
        }

        return $sumQteToReturn;
    }

    public function deleteArtCart($Id_Panier,$qtite_Art,$Id_Article){
        $database = new Database();
        $conn = $database->getConnection();   
        
        $qtestock = $this->getStock_ArtById_Article($Id_Article);

        $sqlQuery = "DELETE FROM panier WHERE Id_Panier = ".$Id_Panier." and sessId='".$this->getCOOKIE()."'" ;

        $stmt = $conn->prepare($sqlQuery);

        $stmt->execute();

        $qtestock = $qtestock + $qtite_Art;
        
        $article = new Article();        
        
        $article->updateStock_ArtById_Article($qtestock,$Id_Article);

        $nav = new Nav();
        $nav->set_nbArticle($this->getSumQteCart());        
    }

    public function deleteALlArtCart(){
        $database = new Database();
        $conn = $database->getConnection();   
        
        $sqlQuery = "DELETE FROM panier WHERE sessId='".$this->getCOOKIE()."'" ;

        $stmt = $conn->prepare($sqlQuery);

        $stmt->execute();       
    }

    public function getNbArtCart(){
        $database = new Database();
        $conn = $database->getConnection();   

        $nb_ArtToReturn= 0;
        
        $sqlQuery = "select Count(*) as nba  FROM panier WHERE sessId='".$this->getCOOKIE()."'";

        $stmt = $conn->prepare($sqlQuery);

        $stmt->execute(); 

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            extract($row);
            $nb_ArtToReturn = $nba;
        }

        return $nb_ArtToReturn;
    }

 }
?>