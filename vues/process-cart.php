<?php
   if (!isset($_SESSION)) { session_start(); }
   
   include_once(__DIR__."/../modele/Nav.php");
   include_once(__DIR__."/../modele/Categorie.php");
   include_once(__DIR__."/../modele/Article.php");
   include_once(__DIR__."/../modele/Panier.php");
   include_once(__DIR__."/../modele/User.php");

   /*@$Id_Article_cart=$_POST["Id_Article_cart"];
   @$Id_Panier=$_POST["Id_Panier"];
   @$prix=$_POST["prix"];   
   @$moinsQte=$_POST["moinsQte"];
   @$plusQte=$_POST["plusQte"];*/
   
   $page = basename($_SERVER["PHP_SELF"]);
   $cat = new Categorie();
   $cat->set_PageActive($page); 
   
   $art = new Article();
   $cart = new Panier();

   $arrayReturn=array();

   $postArray = $_POST["params"];
       
    if (isset($_POST["moinsQte"])) {
        $cart->updateQtitePlusMoinsArtCart($Id_Article_cart,"moinsQte",$prix);
        $_SESSION['nbAticle']=$cart->getSumQteCart($Id_Panier);
    }

    if (isset($_POST["params"])) {
        $arrayReturn = $cart->updateQtitePlusMoinsArtCart($postArray[1],"plusQte",$postArray[2]);
        $_SESSION['nbAticle']=$cart->getSumQteCart($postArray[0]);
        //echo "<script type='text/javascript'> document.location = $_SESSION['root'].'/cart.php'; </script>";
        //header("Location: ".$_SESSION['root']."/cart.php");
    }

    if (isset($_POST["trashArt"])) {
        $cart->deleteArtCart($Id_Panier);
        $_SESSION['nbAticle']=$cart->getSumQteCart($Id_Panier);
    }   
    echo json_encode($arrayReturn);
?>