<?php
    $page = basename($_SERVER["PHP_SELF"]);
    
    require_once 'modele/Database.php';
    require 'vues/add-to-cart.php';	
    
    $cat = new Categorie();
    $cat->set_PageActive($page);   

    $art = new Article();
    $cart = new Panier();
    $user = new User();

	$message="";
    $_SESSION['page-retour'] = basename($_SERVER["PHP_SELF"]);
?>

<div class="jumbotron">
    <div id="<?=$page?>" class="body-mu">

        <div id="title" class="white">Pianos & Claviers</div>
        <img src='<?=$_SESSION['root']?>/img/headers_cats/cat_p&c.jpg' class='w100 d-inline-block align-top landscape' alt=''>

        <?php $cat->genCategoriesHorizontaly()?>

        <div class="row">
            <div class="col-12">
                <div id="catalog" class="catalog">

                    <?php $art->genCardArticle(3);?>

                </div>
                <?php $art->getPagination(3, $page);?>    
            </div>
        </div>

    </div>
</div>