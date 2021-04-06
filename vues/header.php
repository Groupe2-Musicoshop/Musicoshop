<?php
	session_start();
    
	$_SESSION['root']="http://".$_SERVER['HTTP_HOST']."/Musicoshop";

    /* param : unlog  ou user ou admin */
    $_SESSION['userType'] = "unlog";
    $_SESSION['nbAticle'] = 0;
    $_SESSION['username']="Pierre";

include_once(__DIR__."/../modele/Nav.php");
$page = basename($_SERVER["PHP_SELF"]);
//echo $_SERVER['REQUEST_URI']."<br>";

$prepaNav = '[    
    {"titre":"img/user.svg" , "type":"img" , "link":[
    {"titre":"Se connecter","link":"vues/login.php","userType":"unlog"},
    {"titre":"S\'inscrire","link":"vues/signin.php","userType":"unlog"},
    {"titre":"Se déconnecter","link":"vues/logout.php","userType":"logout"},
    {"titre":"Mon espace client","link":"vues/my-space.php","userType":"user"},
    {"titre":"Mes commandes","link":"vues/my-cmds.php","userType":"user"},    
    {"titre":"Nous contacter","link":"vues/contact-us.php","userType":"user"},
    {"titre":"Changer mon mot de passe","link":"vues/change-pwd.php","userType":"user"}
    ]},
    {"titre":"img/cart.svg" , "type":"img" , "link":[
    {"titre":"Aller au panier","link":"vues/cart.php","userType":"all"},    
    {"titre":"","link":"","userType":"all"}    
    ]}
]';

$nav = new Nav($prepaNav);
$nav->set_Root($_SESSION['root']);
$nav->set_PageActive($page);
$nav->set_userType($_SESSION['userType']);
$nav->set_nbArticle($_SESSION['nbAticle']);

?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css"
        integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">

    <link rel="stylesheet" type="text/css" href="//fonts.googleapis.com/css?family=Varela+Round" />

    <link rel="icon" href="<?=$_SESSION['root']?>/img/favicon.ico" />


    <link rel="stylesheet" type="text/css" href='<?=$_SESSION['root']?>/css/global.css'>
    <link rel="stylesheet" type="text/css" href="<?=$_SESSION['root']?>/css/nav.css">
    <link rel="stylesheet" type="text/css" href="<?=$_SESSION['root']?>/css/header.css">
    <link rel="stylesheet" type="text/css" href="<?=$_SESSION['root']?>/css/fildarianne.css">
    <link rel="stylesheet" type="text/css" href="<?=$_SESSION['root']?>/css/formulaire.css">
    <link rel="stylesheet" type="text/css" href="<?=$_SESSION['root']?>/css/panier.css">
    <link rel="stylesheet" type="text/css" href="<?=$_SESSION['root']?>/css/footer.css">

    <title>Musicoshop</title>

</head>

<body class="bg-color-gla">

    <div class="container bg-color-pla">

        <div id="header">
            <nav id="barre-musicoshop" class="navbar sticky-top navbar-expand-lg navbar-light bg-color-bzb">
                <a class="navbar-brand" href="index.php">
                    <img src="<?=$_SESSION['root']?>/img/logo/Musicoshop_logo.PNG" width="150" alt="">
                </a>
                <form class="form-inline my-2 my-lg-0">
                    <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
                    <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
                </form>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav mr-auto">
                        <?php $nav->genNav();?>
                    </ul>
                </div>
            </nav>
        </div>
        <?php
            //header('Content-type:application/json;charset=utf-8');
            //$arr =  json_decode($instruments);
            //echo $arr;
            /*foreach ($arr as $value) {
                $id = $value->{'id'};
                $imageBody = $value->{'name'};
                $imageBody = str_replace(" ", "_", $imageBody);
                $imageBody = str_replace("à", "a", $imageBody);
                $id."-".$imageBody;

                echo $img = "<h6>../img/".$id."-".$imageBody.".png</h6>";
            }*/
        ?>