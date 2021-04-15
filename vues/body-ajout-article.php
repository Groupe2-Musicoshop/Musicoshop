<?php
    //session_start();
    //$_SESSION['root']="http://".$_SERVER['HTTP_HOST']."/Musicoshop";

    require_once 'modele/Database.php';

    $database = new Database();

    $conn = $database->getConnection();


	@$username=$_POST["qtestock"];
	@$prenom=$_POST["prix"];
	@$adresse=$_POST["note"];
	@$ville=$_POST["id_instrument"];
	//@$codepostal=$_POST["codepostal"];
	//@$email=$_POST["email"];
	//@$password=$_POST["password"];
	//@$repass=$_POST["repass"];
	@$valider=$_POST["valider"];

	$message="";

	if(isset($valider)){

        if(empty($username)) $message="Nom invalide!";
        if(empty($prenom)) $message.="Prénom invalide!";
        if(empty($adresse)) $message.="adresse invalide!";
        if(empty($ville)) $message.="ville invalide!";
        //if(empty($codepostal)) $message.="Code-postal invalide!";
        //if(empty($email)) $message.="email invalide!";
        //if(empty($password)) $message.="Mot de passe invalide!";
        //if($password!=$repass) $message.="Mots de passe non identiques!";	
        //if(empty($message)){

        $ins=$conn->prepare("insert into article(qtestock,prix,note,Id_Instrument) values(?,?,?,?)");
        $ins->execute(array($username,$prenom,$adresse,$ville));
        echo "Article ajouté à la base";
        
    }
    $page = basename($_SERVER["PHP_SELF"]);
    $cat = new Categorie();
    $cat->set_PageActive($page);   
	
?>

<head>
    <link rel="stylesheet" href="<?=$_SESSION['root']?>/css/login.css" />
    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
</head>


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

        <input type="submit" name="valider" value="valider" class="btn btn-primary box-button" />
        <!--<p class="box-register">Déjà inscrit? <a href="login.php"><u>Connectez-vous ici<u></a></p>-->

    </form>
