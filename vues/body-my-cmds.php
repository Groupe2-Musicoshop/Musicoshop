<?php 

	// Initialiser la session

	require_once 'modele/Database.php';
	require_once 'modele/Commande.php';

	@$addCart=$_POST["addCart"];
	@$Id_Article=$_POST["Id_Article_cmd"];
	@$prix=$_POST["prix"];
	@$qtestock=$_POST["qtestock"];

	$cat = new Categorie();
	$art = new Article();
	$cart = new Panier();
    
    if($_SESSION['userType'] =='admin'){
		
        $cart->setCOOKIE($_COOKIE["PHPSESSID"].$_SESSION['username']);
    }
    else{

        $cart->setCOOKIE($_COOKIE["PHPSESSID"]);
    }

	$user = new User();

    $database = new Database();

    $conn = $database->getConnection();
	
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

    $username=$_SESSION["username"];
	 	 
	$sql = "SELECT * FROM utilisateur WHERE userName='$username'";
	$result = $conn->query($sql);

	if($result->rowCount() < 1){
		//header('Location: #');
		echo "<script type='text/javascript'> document.location = '".$_SESSION['root']."/index.php'; </script>";
		exit;
	}

	$row = $result->fetch(PDO::FETCH_ASSOC);
	$page = basename($_SERVER["PHP_SELF"]);
    $cat = new Categorie();
    $cat->set_PageActive($page);   

	$userName = $_SESSION["username"];

	$cmd = new Commande();
	
?>

<div class="jumbotron">
    <div id="<?=$page?>" class="body-mu">

        <div id="title" class="white">Mes commandes</div>
        <img src='<?=$_SESSION['root']?>/img/headers_cats/cat_login_signin.jpg' class='w100 d-inline-block align-top landscape' alt=''>

        <?php $cat->genCategoriesHorizontaly()?>

        <div class="row">
        
            <p class="box-return"><a href="index.php"><i class="fa fa-chevron-circle-left" aria-hidden="true"></i>
            <u>Retour</u></a></p>
            <div class="col-12">
                <div id="commandes" class="commandes">

				<?=$cmd->genCmds($userName) ?>

                </div>
  
            </div>
        </div>

    </div>
</div>
