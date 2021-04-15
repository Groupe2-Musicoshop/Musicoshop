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


    if (isset($_POST["trashArt"])) {

        $cart->deleteArtCart($Id_Panier,$qtite_Art,$Id_Article_cart);
        $_SESSION['nbAticle']=$cart->getSumQteCart();
        
    }     

    if($cart->getSumQteCart()>0){

        echo "<script type='text/javascript'> 
        (function() {
            var element = document.getElementById('nbArt');
            element.innerHTML = ".$cart->getSumQteCart()."; 
            element.classList.add('view'); 
        })();
        </script>";
                
    }else{
        
        echo "<script type='text/javascript'> 
        (function() {
            var element = document.getElementById('nbArt');
            element.innerHTML = '';
            element.classList.remove('view'); 
        })();
        </script>";

    }
    if(isset($_POST['valider'])){
    if(isset($_SESSION['username'])){
    echo "<script type='text/javascript'> document.location = '".$_SESSION['root']."/paiement.php'; </script>";
    }echo "<script type='text/javascript'> document.location = '".$_SESSION['root']."/login.php'; </script>";
    }
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
        <div class="row">
        <form action="" method="post">
        <div class="center col-4"><button  class="btn btn-primary btn-lg btn-block" type="submit" name="valider"> Acheter maintenant  </button></div>
       </form>
</div>
    </div>


</div>