<?php
    //session_start();
    //$_SESSION['root']="http://".$_SERVER['HTTP_HOST']."/Musicoshop";

    require_once 'modele/Database.php';

    $database = new Database();

    $conn = $database->getConnection();


	@$designation=$_POST["designation"];
	@$img=$_POST["img"];
	@$idCategorie=$_POST["idCategorie"];
	@$valider=$_POST["valider"];

	$message="";

	if(isset($valider)){

        if(empty($designation)) $message="Le champ designation est vide";
        if(empty($img)) $message.="Le champ image est vide";
        if(empty($adresse)) $message.="La categorie est obligatoire";

        $ins=$conn->prepare("insert into instruments(designation,img,idCategorie) values(?,?,?)");
        $ins->execute(array($username,$prenom,$adresse));
        echo "Instrument ajouté à la base";
        
    }
    $page = basename($_SERVER["PHP_SELF"]);
    $cat = new Categorie();
    $cat->set_PageActive($page);   
	
?>
<div class="jumbotron">
    <div id="cat_b&p" class="body-mu">

        <div id="title" class="white">Ajouter un instrument</div>
        <img src='<?=$_SESSION['root']?>/img/headers_cats/cat_login_signin.jpg' class='w100 d-inline-block align-top landscape' alt=''>

        <?php $cat->genCategoriesHorizontaly()?>
    
    <form class="box" action="" method="post">

        <div class="mb-3">
            <h4 class="title">Ajouter un instrument</h4>
        </div>

        <div class="mb-3">
            <input type="text" class="form-control" name="designation" placeholder="Désignation" required>
        </div>

        <div class="mb-3">
            <input type="text" class="form-control" name="img" placeholder="Adresse image" required>
        </div>

        <div class="mb-3">
            <input type="text" class="form-control" name="idCategorie" placeholder="ID catégorie" required>
        </div>

        <?php if (!empty($message)) { ?>
        <p class="errorMessage"><?php echo $message; ?></p>
        <?php } ?>

        <input type="submit" name="valider" value="valider" class="btn btn-primary box-button" />

    </form>