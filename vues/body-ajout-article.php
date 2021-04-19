<?php
    //session_start();
    //$_SESSION['root']="http://".$_SERVER['HTTP_HOST']."/Musicoshop";

    require_once 'modele/Database.php';

    $database = new Database();

    $conn = $database->getConnection();

	@$qtestock=$_POST["qtestock"];
	@$prix=$_POST["prix"];
	@$note=$_POST["note"];
	@$id_instrument=$_POST["id_instrument"];
	@$valider=$_POST["valider"];

	$message="";

	if(isset($valider)){

        if(empty($qtestock)) $message="Il faut renseigner un stock";
        if(empty($prix)) $message.="Il faut renseigner un prix";
        if(empty($note)) $message.="Il faut renseigner une note";
        if(empty($id_instrument)) $message.="Il faut séléctionner un instrument";

        $ins=$conn->prepare("insert into article(qtestock,prix,note,Id_Instrument) values(?,?,?,?)");
        $ins->execute(array($username,$prenom,$adresse,$ville));
        echo "Article ajouté à la base";
        
    }
    $page = basename($_SERVER["PHP_SELF"]);
    $cat = new Categorie();
    $cat->set_PageActive($page);   
	
?>

<div class="jumbotron">
    <div id="cat_b&p" class="body-mu">

        <div id="title" class="white">Ajouter un article</div>
        <img src='<?=$_SESSION['root']?>/img/headers_cats/cat_login_signin.jpg' class='w100 d-inline-block align-top landscape' alt=''>

        <?php $cat->genCategoriesHorizontaly()?>
    
    <form class="box" action="" method="post">

        <div class="mb-3">
            <h4 class="title">Ajouter un article</h4>
        </div>

        <div class="mb-3">
            <input type="text" class="form-control" name="qtestock" placeholder="Quantité" required>
        </div>

        <div class="mb-3">
            <input type="text" class="form-control" name="prix" placeholder="Prix" required>
        </div>

        <div class="mb-3">
            <select name="note" class="form-select" aria-label="Default select example">
                <option selected>Note de l'article</option>
                <option value="1">One star</option>
                <option value="2">Two stars</option>
                <option value="3">Three stars</option>
                <option value="4">four stars</option>
                <option value="5">five stars</option>
            </select>
        </div>

        <div class="mb-3">
            <select name="id_instrument" class="form-select" aria-label="Default select example">
                <?php
                $sql = 'SELECT Id_Instrument, designation FROM instruments ';
                foreach ($conn->query($sql) as $row) {
                ?>
                <option value="<?php echo $row['Id_Instrument'];?>">
                    <?php echo ucfirst($row['designation']);?></option>
                <?php
            }
            ?>

            </select>
        </div>

        <?php if (!empty($message)) { ?>
        <p class="errorMessage"><?php echo $message; ?></p>
        <?php } ?>

        <div class="center col-4"><input type="submit" name="valider" value="Valider" class="btn btn-primary box-button" />
        </div>
        <!--<p class="box-register">Déjà inscrit? <a href="login.php"><u>Connectez-vous ici<u></a></p>-->

    </form>
</div>