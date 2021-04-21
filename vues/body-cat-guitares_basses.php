<?php
    $page = basename($_SERVER["PHP_SELF"]);
    require_once 'modele/Database.php';
    require 'vues/add-to-cart.php';	
    
    $cat = new Categorie();
    $cat->set_PageActive($page);   


    $art = new Article();
    $cart = new Panier();
    
    if($_SESSION['userType'] =='admin'){
		
        $cart->setCOOKIE($_COOKIE["PHPSESSID"].$_SESSION['username']);
    }
    else{

        $cart->setCOOKIE($_COOKIE["PHPSESSID"]);
    }

    $user = new User();

	$message="";

    if(isset($_GET['page']) && $_GET['page']>1){

        $_SESSION['page-retour'] = basename($_SERVER["PHP_SELF"])."?page=".$_GET['page'];

    }else{
        
        $_SESSION['page-retour'] = basename($_SERVER["PHP_SELF"]);
    }
?>

<div class="jumbotron">
    <div class="body-mu">

        <div id="title" class="white">Guitares & Basses</div>

        <img src='<?=$_SESSION['root']?>/img/headers_cats/cat_g&b.jpg' class='w100 d-inline-block align-top landscape' alt=''>

        <?php $cat->genCategoriesHorizontaly()?>

        <div class="row">
            <div class="col-12">
                <div id="catalog" class="catalog">

                    <?php $art->genCardArticle(1);?>

                </div>
                <?php $art->getPagination(1, $page);?>    
            </div>
        </div>

    </div>
</div>