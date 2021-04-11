<?php

    $page = basename($_SERVER["PHP_SELF"]);
    $cat = new Categorie();
    $cat->set_PageActive($page); 

    $art = new Article();



    if (!isset($_SESSION['cart'])) {

        $_SESSION['cart']=array();

    }

?>

<div class="jumbotron">

    <div id="cart" class="body-mu">

        <div id="title" class="white">Votre panier</div>

        <img src='<?=$_SESSION['root']?>/img/headers_cats/cat_ca.jpg' class='w100 d-inline-block align-top' alt=''>

        <?php $cat->genCategoriesHorizontaly()?>

        <div class="row">

            <div class="col-12">

                <?php $art->genTabCartArticles($_SESSION['cart']);?>

            </div>
        </div>

    </div>
</div>