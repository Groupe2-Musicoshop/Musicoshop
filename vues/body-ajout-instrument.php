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
        if(empty($idCategorie)) $message.="La categorie est obligatoire";

        $ins=$conn->prepare("insert into instruments(designation,img,idCategorie) values(?,?,?)");
        $ins->execute(array($designation,$img,$idCategorie));
        echo "Instrument ajouté à la base";
        
    }
    $page = basename($_SERVER["PHP_SELF"]);
    $cat = new Categorie();
    $cat->set_PageActive($page);   
    
    $conn=null;
    $stmt=null;
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
            <label for="floatingInput">Désignation</label>
            <input type="text" class="form-control" name="designation" placeholder="" required>
        </div>

        <div class="mb-3">
            <label for="floatingInput">Adresse image</label>
            <input type="file" class="form-control" name="img" placeholder="" required>
        </div>

        <div class="mb-3">
            <label for="floatingInput">ID Catégorie</label>
            <input type="text" class="form-control" name="idCategorie" placeholder="" required>
        </div>

        <?php if (!empty($message)) { ?>
        <p class="errorMessage"><?php echo $message; ?></p>
        <?php } ?>

        <div class="center col-md-6 col-lg-4"><input type="submit" name="valider" value="Valider" class="btn btn-primary box-button" />
        </div>
    </form>