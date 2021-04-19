<?php
    require_once 'modele/Database.php';
    require 'vues/add-to-cart.php';	
    //Recuperer l'id de l'article
	@$idArticle=$_GET["id_art"];

    $cat = new Categorie();

    $cat->set_PageActive($page); 

    $art = new Article();
    $art->setIdArticle($idArticle);

	$message="";  

?>

<div class="jumbotron">

    <div id="body-shop" class="body-mu">

        <div id="title" class="white">Simple Article</div>

        <img src='<?=$_SESSION['root']?>/img/headers_cats/cat_simple_art.jpg' class='w100 d-inline-block align-top' alt=''>

        <?php $cat->genCategoriesHorizontaly()?>

        <?php $art->genSingleArticle()?>
    </div>
</div>