<?php
    require_once 'modele/Database.php';
    require 'vues/add-to-cart.php';	
    //require 'vues/search.php';

    $art = new Article();
    $art->setDesignation(isset($_POST["search"]));

    $cat = new Categorie();
    $cat->set_PageActive($page); 

    $_SESSION['page-retour'] = basename($_SERVER["PHP_SELF"]);
?>

<div class="jumbotron">
    <div id="body-shop" class="body-mu">
        <div id="title" class="white">Resultat de la recherche : <?=$_POST["search"]?></div>
        <img src='<?=$_SESSION['root']?>/img/headers_cats/cat_no.jpg' class='w100 d-inline-block align-top landscape' alt=''>

        <div id="categorie" class="filters button-group js-radio-button-group bg-color-whi">
            <?php $cat->genCategories();?>
        </div>

        <div class="row">
            <div class="col-12">
                <div id="catalog" class="catalog">

                    <?php $art->genCardArticle('search');?>

                </div>
            </div>
        </div>
    </div>