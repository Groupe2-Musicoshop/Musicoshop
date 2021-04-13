<?php
    $page = basename($_SERVER["PHP_SELF"]);
    
    @$addCart=$_POST["addCart"];
	@$Id_Article=$_POST["Id_Article"];
	@$prix=$_POST["prix"];
    
    $cat = new Categorie();
    $cat->set_PageActive($page);   


    $art = new Article();
    $cart = new Panier();
    $user = new User();

	$message="";
    
    if (isset($addCart)) {

        if($cart->getId_PanierById_Article($Id_Article)>0){
          
            $cart->updateQtiteArtCart($Id_Article,$prix);

        }else{
            
            $cart->addArticleToCart(1,$Id_Article,$prix);
            
        }
    }
?>

<div class="jumbotron">
    <div id="cat_b&p" class="body-mu">

        <div id="title" class="white">Bateries & Percussions</div>
        <img src='<?=$_SESSION['root']?>/img/headers_cats/cat_b&p.jpg' class='w100 d-inline-block align-top landscape' alt=''>

        <?php $cat->genCategoriesHorizontaly()?>

        <div class="row">
            <div class="col-12">
                <div id="catalog" class="catalog">
                    <?php $art->genCardArticle(2);?>
                </div>
                <?php $art->getPagination(2, $page);?>    
            </div>
        </div>

    </div>
</div>