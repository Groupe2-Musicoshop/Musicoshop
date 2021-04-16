<?php

require_once __DIR__.'/Database.php';
require_once __DIR__.'/Article.php';

class Commande{
    private ?int $Id_Panier;
    private ?int $qtite_Art;
    private ?int $Id_Article;
    private ?float $prixT;
    private ?string $userName;

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

    function cartToCmd($userName) {
        $panier = new Panier();
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
    
        $datetime = new DateTime();
        $datetime->setTimezone($tz_object);

        if($type=="court"){

            return $datetime->format('Y\-m\-d');

        }else{

            return $datetime->format('Y\-m\-d\h:i:s');
        }
    }
 }
?>