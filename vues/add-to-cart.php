<?php
    $page = basename($_SERVER["PHP_SELF"]);

    @$addCart=$_POST["addCart"];
	@$Id_Article=$_POST["Id_Article"];
	@$prix=$_POST["prix"];

    $cat = new Categorie();
    $art = new Article();
    $cart = new Panier();
    $user = new User();

	$message="";
    
    if (isset($addCart)) {

        if($cart->getId_PanierById_Article($Id_Article)>0){
          
            $cart->updateQtiteArtCart($Id_Article,$prix);

        }else{
            
            $cart->addArticleToCart(1,$Id_Article,$prix);

        }
    }
?>