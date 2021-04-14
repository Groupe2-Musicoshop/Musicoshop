<?php
    $page = basename($_SERVER["PHP_SELF"]);

    @$addCart=$_POST["addCart"];
	@$Id_Article=$_POST["Id_Article"];
	@$prix=$_POST["prix"];
	@$qtestock=$_POST["qtestock"];

    $cat = new Categorie();
    $art = new Article();
    $cart = new Panier();
    $user = new User();

	$message="";
    
    $_SESSION['nbAticle'] = $cart->getSumQteCart();
    
    if (isset($addCart)) {

        if($cart->getId_PanierById_Article($Id_Article)>0){
          
            $cart->updateQtiteArtCart($Id_Article,$prix,$qtestock);

        }else{
            
            $cart->addArticleToCart(1,$Id_Article,$prix,$qtestock);

        }
      
        echo "<script type='text/javascript'> 
        (function() {
            var element = document.getElementById('nbArt');
            element.innerHTML = ".$cart->getSumQteCart()."; 
            element.classList.add('view');
        })();
        </script>";
    }
?>