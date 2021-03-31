<?php

class Nav{
    private ?string $pageActive;
    private ?string $userType;
    private ?string $root;
    private ?string $navigation;

    /**
     * constructeur
     */
    function __construct($navigation){
     $this->navigation = $navigation;

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
        
        //var_dump(json_decode($this->navigation));

        foreach ($parsed_json as $value) {
            $titreNav = $value->{'titre'};

            if(count($value->{'link'})>1){
                echo "<li class='nav-item dropdown ".$this->get_MultiPageActive($value->{'link'})."'>";
                echo "<a class='nav-link dropdown-toggle' href='#' id='navbarDropdown' role='button' data-toggle='dropdown' ";
                echo "aria-haspopup='true' aria-expanded='false'>".$titreNav."<span class='caret'></span></a>";
                
                echo "<div class='dropdown-menu' aria-labelledby='navbarDropdown'>";

                foreach ($value->{'link'} as $value2n){
                    //if($value2n->{'userType'} == $this->get_userType() || $this->get_userType()=="admin"){
                        echo "<a class='dropdown-item' href='".$this->get_Root()."/".$value2n->{'link'}."'>".$value2n->{'titre'}."</a>";
                    //}
                }
                echo "</div></li>";
            }
            else{
                foreach ($value->{'link'} as $value2n){
                    //if($value2n->{'userType'} == $this->get_userType() || $this->get_userType()=="admin"){
                        echo "<li class='nav-item ".$this->get_PageActive($value2n->{'link'})."'>";
                        echo "<a class='nav-link' href='".$this->get_Root()."/".$value2n->{'link'}."'>".$titreNav."</a>";
                        echo "</li>";
                    //}
                }
            }
        }
            
    //eturn $nav;
    }
}
?>