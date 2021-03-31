<?php

	session_start();
	$_SESSION['root']="http://".$_SERVER['HTTP_HOST']."/musicoshop";

include_once(__DIR__."/../modele/Nav.php");
$page = basename($_SERVER["PHP_SELF"]);
//echo $_SERVER['REQUEST_URI']."<br>";

$prepaNav = '[
{"titre":"Accueil","droit":"a","link":[
{"titre":"","link":"index.php","userType":"user"}
]},
{"titre":"Utilisateurs", "link":[
{"titre":"Ajouter un utilisateur","link":"model/utilisateur/insertUser.php","userType":"amin"},
{"titre":"Liste des utilisateurs","link":"model/utilisateur/users.php","userType":"user"}
]},
{"titre":"Entreprises", "link":[
{"titre":"Ajouter une entreprise","link":"model/entreprise/insertEntreprise.php","userType":"amin"},
{"titre":"Liste des entreprises","link":"model/entreprise/entreprises.php","userType":"user"}
]},
{"titre":"logout","link":[
{"titre":"","link":"vue/logout.php","userType":"user"}
]}
]';

$nav = new Nav($prepaNav);
$nav->set_Root($_SESSION['root']);
$nav->set_PageActive($page);
$nav->set_userType($_SESSION['userType']);

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

    <link rel="icon" href="img/favicon.ico" />


    <link rel="stylesheet" href="css/global.css">
    <link rel="stylesheet" href="css/header.css">
    <link rel="stylesheet" href="css/nav.css">
    <link rel="stylesheet" href="css/fildarianne.css">
    <link rel="stylesheet" href="css/formulaire.css">
    <link rel="stylesheet" href="css/panier.css">
    <link rel="stylesheet" href="css/footer.css">

    <title>Musicoshop</title>

</head>

<body>

    <div class="container">

        <div id="header">
            <nav class="navbar navbar-expand-lg navbar-light bg-light">

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav mr-auto">
                        <?php $nav->genNav();?>

                    </ul>
                </div>
            </nav>
        </div>