<?php
   if (!isset($_SESSION)) { session_start(); }

    $page = basename($_SERVER["PHP_SELF"]);
    $cat = new Categorie();
    $cat->set_PageActive($page); 

    $art = new Article();

    $cart = $_SESSION['cart'];

    if (isset($_POST["Id_Article"])) {
        echo "<script type='text/javascript'> document.location = 'singleArticle.php'; </script>";
    }

?>

<div class="jumbotron">

    <div id="cart" class="body-mu">

        <div id="title" class="white">Votre panier</div>

        <img src='<?=$_SESSION['root']?>/img/headers_cats/cat_ca.jpg' class='w100 d-inline-block align-top' alt=''>

        <?php $cat->genCategoriesHorizontaly()?>

        <div class="row">

            <div class="col-12">

                <?php $art->genTabCartArticles($cart);?>

            </div>
        </div>

    </div>
</div>