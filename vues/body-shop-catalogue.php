<?php
    require_once 'modele/Database.php';
    require 'vues/add-to-cart.php';	

    $_SESSION['page-retour'] = basename($_SERVER["PHP_SELF"]);

?>

<div class="jumbotron">
    <div id="body-shop" class="body-mu">
        <div id="title" class="white">Catalogue</div>
        <img src='<?=$_SESSION['root']?>/img/headers_cats/cat_no.jpg' class='w100 d-inline-block align-top landscape' alt=''>

        <div id="categorie" class="filters button-group js-radio-button-group bg-color-whi">
            <?php $cat->genCategories();?>
        </div>

        <div class="row">
            <div class="col-12">
                <div id="catalog" class="catalog">

                    <?php $art->genCardArticle(0,false);?>

                </div>
                <?php /*$art->getPagination(0, $page);*/?>
            </div>
        </div>
    </div>