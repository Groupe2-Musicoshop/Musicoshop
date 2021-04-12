<?php
    require_once 'modele/Database.php';

    $page = basename($_SERVER["PHP_SELF"]);

    $cat = new Categorie();
    $art = new Article();

    @$addCart=$_POST["addCart"];
	@$Id_Article=$_POST["Id_Article"];

	$message="";
    
    if (isset($addCart)) {

        array_push($_SESSION['cart'],$Id_Article);   

        $_SESSION['nbAticle'] += 1;                
    }
?>



<div class="jumbotron">
    <div id="body-shop" class="body-mu">
        <div id="title" class="white">Catalogue</div>
        <img src='<?=$_SESSION['root']?>/img/headers_cats/cat_no.jpg' class='w100 d-inline-block align-top' alt=''>

        <div id="categorie" class="filters button-group js-radio-button-group bg-color-whi">
            <?php $cat->genCategories();?>
        </div>

        <div class="row">
            <div class="col-12">
                <div id="catalog" class="catalog">

                    <?php $art->genCardArticle(0);?>

                </div>
                <?php $art->getPagination(0, $page);?>
            </div>
        </div>
    </div>