<?php

require_once __DIR__.'/Database.php';
require_once __DIR__.'/Article.php';
require_once __DIR__.'/User.php';

class Commande{
    private ?int $Id_Panier;
    private ?int $qtite_Art;
    private ?int $Id_Article;
    private ?float $prixT;
    private ?string $userName;

    // Table
    private $db_tables = [
        "commande",
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

    function genCmds($userName){
      
        $stmtCmd = $this->getSqlCmds($userName);

        $MontantTotal = floatval(0.00);

        echo'<div class="tbl-container">';

        echo '<div class="card-body row">';
        echo '<div class="col-md-12">';
        
        while ($rowCmd = $stmtCmd->fetch(PDO::FETCH_ASSOC)){
            
            extract($rowCmd);
            
            echo "<form action='' method='POST' name='formData".$rowCmd["idCmd"]."'>";
            
            echo '<tr><td>';
            echo '<div class="card cmd'.$rowCmd["idCmd"].' col-md-12" data-category="cmd'.$rowCmd['idCmd'].'">';   
            
                echo '<h6 class="card-title">N°Commande : '.ucfirst($rowCmd['numCmd']).'</h6>';
                echo '<h6 class="card-title">Date de la Commande : '.ucfirst($rowCmd['dateCmd']).'</h6>';
                echo '<div style="padding:0;" class="col-md-1">';
                    echo '<a class="btn btn-primary" href="facture.php?idCmd='.$rowCmd["idCmd"].'">Facture</a>';
                echo '</div>';
                echo'<a data-toggle="collapse" href="#collapse'.$rowCmd["idCmd"].'" role="button" aria-expanded="false" aria-controls="collapse'.$rowCmd["idCmd"].'">
                Détails</a>';

                echo'<div class="collapse" id="collapse'.$rowCmd["idCmd"].'">
                <div class="card card-body">';

                echo "<table id='tabCart' class='table'><thead><tr>";
                echo "<th scope='col'></th>";
                echo "<th scope='col'>Qte</th>";
                echo "<th scope='col'>designation</th>";
                echo "<th scope='col'>Prix</th>";
                echo "<th scope='col'>Prix Total</th>";
                echo "<th scope='col'>Action</th>";
                echo "</tr></thead><tbody>";
            
                $stmtLigneCmd = $this->getSqlLigneCmds($idCmd);

                $MontantTotal = 0;
                
                while ($rowtLigneCmd = $stmtLigneCmd->fetch(PDO::FETCH_ASSOC)){
                    
                    extract($rowtLigneCmd);
                    
                    echo "</tr>";

                        echo '<td><div class="img_cmd">';
                            echo '<span class="helper"></span>';
                            echo '<img src="'.$rowtLigneCmd['img'].'" class="img_thumb card-img-top" alt="">';
                        echo '</div></td>';

                        echo '<td><h6 class="card-title">'.ucfirst($rowtLigneCmd['qtite']).'</h6></td>';

                        echo '<td><h6 class="card-title"><a href="singleArticle.php?id_art='.$rowtLigneCmd['Id_Article'].'" class="">'.ucfirst($rowtLigneCmd['designation']).'</a></h6></td>';          
                        echo '<td><h6 class="card-title">'.ucfirst($rowtLigneCmd['prix']).' €</h6></td>';         
                        
                        $prixT = $rowtLigneCmd['qtite'] * $rowtLigneCmd['prix'];

                        echo '<td><h6 class="card-title">'.ucfirst($prixT).' €</h6></td>';         
                        
                        echo "<input type='hidden' value='". $rowtLigneCmd['Id_Article'] ."' name='Id_Article_cmd' />"; 
                        echo '<input type="hidden" value="'.$rowtLigneCmd['prix'].'" name="prix" />';
                        echo '<input type="hidden" value="'.$rowtLigneCmd['qtestock'].'" name="qtestock" />';

                        echo '<td><button id="addCart'.$rowtLigneCmd['Id_Article'].'" class="btn btn-primary " type="submit" value="+" name="addCart">Acheter de nouveau</button></td>'; 

                    echo '</tr>';
                    echo '</form>';
                    $MontantTotal = $MontantTotal + $prixT;
                }
            echo "</tbody>       
            <tfoot>
            <tr>
                <td colspan='3'></td>
                <td class='text_right' >Montant total</td>
                <td>".number_format($MontantTotal,2)." €</td><td></td>
            </tr>
            </tfoot></table></div></div>
            </div>";
        }

        echo "</div></div>";
    }


    public function getSqlCmds($userName){
        $database = new Database();
        $conn = $database->getConnection();

        $user = new User();
        $idUtilisateur = $user->getUserIdByUserName($userName);

        $sqlQuery = "SELECT * FROM commande WHERE idUtilisateur=".$idUtilisateur;

        $stmt = $conn->prepare($sqlQuery);

        $stmt->execute();
        return $stmt;
    }

    public function getSqlCmdsById($idCmd){
        $database = new Database();
        $conn = $database->getConnection();

        $sqlQuery = "SELECT * FROM commande WHERE idCmd=".$idCmd;

        $stmt = $conn->prepare($sqlQuery);

        $stmt->execute();
        return $stmt;
    }

    public function getSqlLigneCmds($idCmd){
        $database = new Database();
        $conn = $database->getConnection();

        $sqlQuery = "SELECT * FROM ligne_commande
        INNER JOIN article ON  ligne_commande.Id_Article = article.Id_Article
        INNER JOIN instruments on article.Id_Instrument = instruments.Id_Instrument".
        " WHERE ligne_commande.idCmd=".$idCmd;

        $stmt = $conn->prepare($sqlQuery);

        $stmt->execute();
        return $stmt;
    }

    function cartToCmd($userName) {
        $panier = new Panier();
        
        if($_SESSION['userType'] =='admin'){
		
            $panier->setCOOKIE($_COOKIE["PHPSESSID"].$_SESSION['username']);
        }
        else{

            $panier->setCOOKIE($_COOKIE["PHPSESSID"]);
        }

        $stmt = $panier->getSqlArticles();

        $date = $this->getDatetimeNow("");

        $idCmd = $this->addCartToCmd($userName,$date);

        $datecourte = $this->getDatetimeNow("court");

        $numCmd = str_replace("-","",$datecourte.$idCmd);

        $MontantTotal = floatval(0.00);

        $designationGlobale = "Comprenant: ";

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            $designationGlobale = $designationGlobale."<br> - ".$row['qtite_Art']." ".$row['designation']." à ".$row['prix']." € Pour un total de ".$row['prixT']." €";

            $this->addLigneCmd($idCmd,$row['Id_Article'],$row['qtite_Art']);

            $MontantTotal = $MontantTotal + $row['prixT'];
        }

        $this->updateCmd($idCmd,$numCmd,$designationGlobale,$MontantTotal);
    }

    public function addCartToCmd($userName,$date){
        $database = new Database();
        $conn = $database->getConnection();   

        $idCmdToReturn=0;

        $user = new User();
        $idUtilisateur = $user->getUserIdByUserName($userName);

        $sqlQuery = "INSERT INTO commande(dateCmd,idUtilisateur) VALUES ('".$date."','".$idUtilisateur."')";

        $stmt = $conn->prepare($sqlQuery);

        $stmt->execute();

        $idCmdToReturn = $conn->lastInsertId();

        return $idCmdToReturn;
    }

    public function updateCmd($idCmd,$numCmd,$description,$total){
        $database = new Database();
        $conn = $database->getConnection();  

        $sqlQuery = "update commande set numCmd=".$numCmd.",description ='".$description."',total =".$total." WHERE idCmd=".$idCmd;

        $stmt = $conn->prepare($sqlQuery);

        $stmt->execute();
    }

    public function addLigneCmd($idCmd,$Id_Article,$qtite){
        $database = new Database();
        $conn = $database->getConnection();   

        $sqlQuery = "INSERT INTO ligne_Commande(idCmd,Id_Article,qtite)".
        " VALUES ('".$idCmd."','".$Id_Article."','".$qtite."')";

        $stmt = $conn->prepare($sqlQuery);

        $stmt->execute();
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

    function getDatetimeNow($type) {
        $tz_object = new DateTimeZone('Europe/Paris');

        setlocale (LC_TIME, 'fr_FR.utf8','fra'); 

        $datetime = new DateTime();
        $datetime->setTimezone($tz_object);
        $date1 = date("Y-m-d");


        if($type=="court"){

            return $datetime->format('Y\-m\-d');

        }else{

            return strftime("%A %d %B %G", strtotime($date1));
        }
    }
 }
?>