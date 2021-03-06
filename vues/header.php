<?php
    if (!isset($_SESSION)) { session_start(); }
    $_SESSION['root']="http://".$_SERVER['HTTP_HOST']."/Musicoshop";

    include_once(__DIR__."/../modele/Nav.php");
    include_once(__DIR__."/../modele/Categorie.php");
    include_once(__DIR__."/../modele/Article.php");
    include_once(__DIR__."/../modele/Panier.php");
    include_once(__DIR__."/../modele/User.php");
    
    /* param : unlog  ou user ou admin */
    if (!isset($_SESSION['isLogged'])){

        $_SESSION['userType'] = "unlog";      
    }

    $cart = new Panier();
    
    if($_SESSION['userType'] =='admin'){
		
        $cart->setCOOKIE($_COOKIE["PHPSESSID"].$_SESSION['username']);
    }
    else{

        $cart->setCOOKIE($_COOKIE["PHPSESSID"]);
    }

	$_SESSION['nbAticle']=$cart->getSumQteCart();

    $page = basename($_SERVER["PHP_SELF"]);
    //echo $_SERVER['REQUEST_URI']."<br>";

    $nav = new Nav();
    $nav->set_Root($_SESSION['root']);
    $nav->set_PageActive($page);
    $nav->set_userType($_SESSION['userType']);
    $nav->set_nbArticle($cart->getSumQteCart());

    @$search = $_POST["search"];

?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css"
        integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">

    <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet"
        integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">

    <link rel="stylesheet" type="text/css" href="//fonts.googleapis.com/css?family=Varela+Round" />

    <link rel="icon" href="<?=$_SESSION['root']?>/img/favicon.ico" />

    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">

    <link rel="stylesheet" type="text/css" href="<?=$_SESSION['root']?>/css/global.css">
    <link rel="stylesheet" type="text/css" href="<?=$_SESSION['root']?>/css/header.css">
    <link rel="stylesheet" type="text/css" href="<?=$_SESSION['root']?>/css/nav.css">
    <link rel="stylesheet" type="text/css" href="<?=$_SESSION['root']?>/css/article.css">
    <link rel="stylesheet" type="text/css" href="<?=$_SESSION['root']?>/css/panier.css">
    <link rel="stylesheet" type="text/css" href="<?=$_SESSION['root']?>/css/login.css" />
    <link rel="stylesheet" type="text/css" href="<?=$_SESSION['root']?>/css/categorie.css">
    <link rel="stylesheet" type="text/css" href="<?=$_SESSION['root']?>/css/fildarianne.css">
    <link rel="stylesheet" type="text/css" href="<?=$_SESSION['root']?>/css/formulaire.css">
    <link rel="stylesheet" type="text/css" href="<?=$_SESSION['root']?>/css/panier.css">
    <link rel="stylesheet" type="text/css" href="<?=$_SESSION['root']?>/css/commandes.css">
    <link rel="stylesheet" type="text/css" href="<?=$_SESSION['root']?>/css/footer.css">
    
    <title>Musicoshop</title>

</head>

<body class="bg-color-gla">

    <div class="container bg-color-pla">

        <div id="header">
            <nav id="barre-musicoshop" class="navbar navbar-expand-lg navbar-light bg-color-bzb">

                <div class="container-fluid">

                    <a class="navbar-brand" href="index.php">
                        <img class="logo" src="<?=$_SESSION['root']?>/img/logo/Musicoshop_logo.PNG" width="150" alt="">
                    </a>
                    
                    <form id="formSearch" class="form-group form-inline my-2 my-lg-0" action="<?=$_SESSION['root']?>/searchArticle.php" method="POST">
                        <div class="btn-group">
                            <input id="inputSearch" class="form-control mr-sm-2" type="search" name="search" value="<?=$search ?>" placeholder="Rechercher un article" aria-label="Search">
                            <span id="searchclear" ><i class="fa fa-times" aria-hidden="true"></i></span>
                        </div>
                            <button class="btn btn-outline-mu my-2 my-sm-0" type="submit">Rechercher</button>
                    </form>
                    
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarTogglerDemo01" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    
                    <div class="collapse navbar-collapse" id="navbarSupportedContent">

                        <ul class="navbar-nav ml-auto mr-auto">
                            <?php $nav->genNav();?>
                        </ul>
                    </div>
                    
                </div>
            </nav>
        </div>
