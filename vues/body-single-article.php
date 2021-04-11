<?php
    require_once 'modele/Database.php';

    $page = basename($_SERVER["PHP_SELF"]);

    @$addCart=$_POST["addCart"];
	@$Id_Article=$_POST["Id_Article"];

    $cat = new Categorie();

    $cat->set_PageActive($page); 

    $art = new Article();
    $art->setIdArticle($Id_Article);


	$message="";
    
    if (isset($addCart)) {

        array_push($_SESSION['cart'],$Id_Article);   

        $_SESSION['nbAticle'] += 1;
                
    }else{

        $_SESSION['cart']=array();

    }
?>



<div class="jumbotron">
    <div id="body-shop" class="body-mu">
        <div id="title" class="white">Simple Article</div>
        <img src='<?=$_SESSION['root']?>/img/headers_cats/cat_simple_art.jpg' class='w100 d-inline-block align-top' alt=''>

        <?php $cat->genCategoriesHorizontaly()?>

        <div class="row">
            <div class="col-12">
                <div id="catalog" class="catalog">

                    <?php $art->genCardArticle(0)?>

                </div>
            </div>
        </div>
    </div>