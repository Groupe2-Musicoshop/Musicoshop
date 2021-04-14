<?php
   if (!isset($_SESSION)) { session_start(); }
   
   include_once(__DIR__."/../modele/Nav.php");
   include_once(__DIR__."/../modele/Categorie.php");
   include_once(__DIR__."/../modele/Article.php");
   include_once(__DIR__."/../modele/Panier.php");
   include_once(__DIR__."/../modele/User.php");

   @$Id_Article_cart=$_POST["Id_Article_cart"];

   @$Id_Panier=$_POST["Id_Panier"];
   @$prix=$_POST["prix"];   
   @$qtite_Art=$_POST["qtite_Art"];   

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

    /*if (isset($_POST["params"])) {
        $cart->updateQtitePlusMoinsArtCart($postArray[1],"plusQte",$postArray[2]);

        $_SESSION['nbAticle']=$cart->getSumQteCart($postArray[0]);
        header("Location: ".$_SESSION['root']."/cart.php");
    }*/

    if (isset($_POST["trashArt"])) {

        $cart->deleteArtCart($Id_Panier,$qtite_Art,$Id_Article_cart);
        $_SESSION['nbAticle']=$cart->getSumQteCart();
    }     

    /*if (isset($_POST["Id_Article_cart"])) {
       echo "<script type='text/javascript'> document.location = 'singleArticle.php'; </script>";
    }*/	

?>

<div class="jumbotron">

    <div id="cart" class="body-mu">

        <div id="title" class="white">Votre panier</div>

        <img src='<?=$_SESSION['root']?>/img/headers_cats/cat_ca.jpg' class='w100 d-inline-block align-top landscape' alt=''>

        <?php $cat->genCategoriesHorizontaly()?>

        <div class="row">

            <div class="col-12">

                <?php $cart->genCardArticle()?>

            </div>
        </div>

    </div><a href="../Musicoshop/paiement.php" class="btn btn-warning" role="button" aria-pressed="true">Passer votre commande</a>


</div>