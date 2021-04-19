<?php

require_once __DIR__.'/Panier.php';

class Nav{
    private ?string $pageActive;
    private ?string $userType;
    private ?int $nbArticle;
    private ?string $root;
    private ?string $navigation = '[    
        {"titre":"img/user.svg" , "type":"img" , "link":[
        {"titre":"Se connecter","link":"login.php","userType":"unlog"},
        {"titre":"S\'inscrire","link":"signin.php","userType":"unlog"},
        {"titre":"Se déconnecter","link":"vues/logout.php","userType":"logout"},
        {"titre":"Mon espace client","link":"my-space.php","userType":"user"},
        {"titre":"Mes commandes","link":"my-cmds.php","userType":"user"},    
        {"titre":"Nous contacter","link":"contact-us.php","userType":"user"},
        {"titre":"Changer mon mot de passe","link":"change-password.php","userType":"user"},
        {"titre":"Ajouter un Article","link":"ajout-article.php","userType":"admin"},
        {"titre":"Ajouter un Instrument","link":"ajout-instrument.php","userType":"admin"},
        {"titre":"Liste des Articles","link":"liste-des-articles.php","userType":"admin"},
        {"titre":"Liste des Instruments","link":"liste-des-instruments.php","userType":"admin"}
        ]},
        {"titre":"img/cart.svg" , "type":"img" , "link":[
        {"titre":"","link":"","userType":"cart"},
        {"titre":"Aller au panier","link":"cart.php","userType":"btn"}
        ]}
    ]';

    /**
     * constructeur 
     */
    function __construct(){
     
    }

    function get_PageActive($pageAtester){

        if($this->pageActive==$pageAtester){ 
            return 'active';
        }else{
            return '';
        }

    }

    function get_MultiPageActive($arr_pagesAtester){
        $b=false;

        foreach ($arr_pagesAtester as $value){
            if(str_contains($value->{'link'},$this->pageActive)){ 
                $b = true;
            }else{
                $b = $b || str_contains($value->{'link'},$this->pageActive);
            }
        }
        if($b)return 'active';
        else return '';
    }

    function set_PageActive($pageActive){
        $this->pageActive = $pageActive;
    }

    function set_Root($root){
        $this->root = $root;
    }

    function get_Root(){
        return $this->root;
    }

    function set_nbArticle($nbArticle){
        $this->nbArticle = $nbArticle;
    }

    function get_nbArticle(){
        return $this->nbArticle;
    }

    function set_userType($userType){
        $this->userType = $userType;
    }

    function get_userType(){
        return $this->userType;
    }

    function get_Navigation(){
        return $this->navigation;
    }

    function set_Navigation($navigation){
        $this->navigation = $navigation;
    }
    
    function genNav(){        

        $parsed_json = json_decode($this->navigation);

        foreach ($parsed_json as $value) {

            $titreNav = $value->{'titre'};

            if(count($value->{'link'})>1){
                if ($value->{'type'}!="none") {

                    echo "<li class='nav-item dropdown ".$this->get_MultiPageActive($value->{'link'})."'>";
                    echo "<a class='nav-link dropdown-toggle' href='#' id='navbarDropdown' role='button' data-toggle='dropdown' ";
                    echo "aria-haspopup='true' aria-expanded='false'>";
                
                    if ($value->{'type'}=="img") {
                        echo "<img src='".$_SESSION['root']."/".$titreNav."' width='40' height='40' class='d-inline-block align-top' alt=''>";

                        if (($this->get_userType()=="user" || $this->get_userType()=="admin") && $titreNav =="img/user.svg") {
                            echo "<img id='check' src='".$_SESSION['root']."/img/check.svg' width='15' height='15' class='d-inline-block align-top' alt=''>";
                        }

                        if ($titreNav =="img/cart.svg" && $this->get_nbArticle()>0) {

                            echo "<div id='nbArt' class='view' ><span>".$this->get_nbArticle()."</span></div>";

                        }else if ($titreNav =="img/cart.svg" && $this->get_nbArticle()==0) {

                            echo "<div id='nbArt' ><span></span></div>";

                        }

                    } else {
                        echo $titreNav;
                        echo "<span class='caret'></span>";
                    }

                    echo "</a>";
                
                    echo "<div class='dropdown-menu' aria-labelledby='navbarDropdown'>";

                    foreach ($value->{'link'} as $value2n) {

                        if ($value2n->{'userType'} == "all") {

                            echo "<a class='dropdown-item' href='".$this->get_Root()."/".$value2n->{'link'}."'>".$value2n->{'titre'}."</a>";

                        } elseif ($value2n->{'userType'} == "logout" and ($this->get_userType()=="user" || $this->get_userType()=="admin")) {

                            echo "<a class='dropdown-item bg-color-pla' href='".$this->get_Root()."/".$value2n->{'link'}."'>Bonjour ".$_SESSION['navUsername'].".<br/>".$value2n->{'titre'}."</a>";

                        } elseif ($value2n->{'userType'} == $this->get_userType()) {

                            echo "<a class='dropdown-item' href='".$this->get_Root()."/".$value2n->{'link'}."'>".$value2n->{'titre'}."</a>";
                            
                        }else if($value2n->{'userType'} == "btn"){
                            echo "<a class='dropdown-item btn btn-primary' href='".$this->get_Root()."/".$value2n->{'link'}."'>".$value2n->{'titre'}."</a>";

                            //echo '<a href="singleArticle.php?id_art='.$row['Id_Article'].'" class="btn btn-primary ">'.ucfirst($row['designation']).'</a>';
                        }

                        if($value2n->{'userType'} == "cart"){
                            
                            $cart = new Panier();

                            if($_SESSION['userType'] =='admin'){
		
                                $cart->setCOOKIE($_COOKIE["PHPSESSID"].$_SESSION['username']);
                            }
                            else{
                        
                                $cart->setCOOKIE($_COOKIE["PHPSESSID"]);
                            }
                        
                            $cart->genMiniCardArticle();
                        }
                    }
                    echo "</div></li>";
                }
            }
            else{
                foreach ($value->{'link'} as $value2n){

                    
                    if($value2n->{'userType'} == "all"){

                        echo "<li class='nav-item ".$this->get_PageActive($value2n->{'link'})."'>";

                        echo "<a class='nav-link' href='".$this->get_Root()."/".$value2n->{'link'}."'>";

                        if($value->{'type'}=="img"){

                            echo "<img src='".$titreNav."' width='40' height='40' class='d-inline-block align-top' alt=''>";

                        }else{

                            echo $titreNav;
                            
                        }

                        echo "</a>";

                        if($this->get_nbArticle()>0){                                
                                
                            echo "<div id='nbArt' ><span>".$this->get_nbArticle()."</span></div>";

                        }else{
                            echo "<div id='nbArt' ><span></span></div>";

                        }
                                                
                        echo "</li>";

                    }else if( $value2n->{'userType'} == $this->get_userType() || $this->get_userType()=="admin"){
                        
                        echo "<li class='nav-item ".$this->get_PageActive($value2n->{'link'})."'>";
                        echo "<a class='nav-link' href='".$this->get_Root()."/".$value2n->{'link'}."'>";

                        if($value->{'type'}=="img"){

                            echo "<img src='".$titreNav."' width='40' height='40' class='d-inline-block align-top' alt=''>";

                        }else{
                            
                            echo $titreNav;

                        }

                        echo "</a></li>";

                    }
                }
            }
        }
            
    //eturn $nav;
    }
}
?>