<?php
   @$Id_Article_cart=$_POST["Id_Article_cart"];
   @$Id_Panier=$_POST["Id_Panier"];
   @$prix=$_POST["prix"];   
   @$moinsQte=$_POST["moinsQte"];
   @$plusQte=$_POST["plusQte"];
   
   $page = basename($_SERVER["PHP_SELF"]);
   $cat = new Categorie();
   $cat->set_PageActive($page); 
   
   $art = new Article();
   $cart = new Panier();
   
   

    
    if (isset($_POST["moinsQte"])) {
        $cart->updateQtitePlusMoinsArtCart($Id_Article_cart,"moinsQte",$prix);
        $_SESSION['nbAticle']=$cart->getSumQteCart($Id_Panier);
    }

    if (isset($_POST["plusQte"])) {
        $cart->updateQtitePlusMoinsArtCart($Id_Article_cart,"plusQte",$prix);
        $_SESSION['nbAticle']=$cart->getSumQteCart($Id_Panier);
    }

    if (isset($_POST["trashArt"])) {
        $cart->deleteArtCart($Id_Panier);
        $_SESSION['nbAticle']=$cart->getSumQteCart($Id_Panier);
    }     

    /*if (isset($_POST["Id_Article_cart"])) {
       echo "<script type='text/javascript'> document.location = 'singleArticle.php'; </script>";
    }*/
?>