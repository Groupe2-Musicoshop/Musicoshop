<?php
    require_once 'modele/Database.php';

    $cat = new Categorie();

    $database = new Database();
    $conn = $database->getConnection();

?>

<div id="categorie" class="filters button-group js-radio-button-group bg-color-whi">
    <?php $cat->genCategories();?>
</div>

<div id="body-shop" class="body-mu">
    <div id="title">Catalogue</div>
        <div class="row">
        <?php
            $sql = 'SELECT * FROM instruments';
            foreach ($conn->query($sql) as $row) {
        ?>
            <div class="card col-md-4 my-2 py-4" >
                <div class="box_img">
                    <img src="<?=$row['img']?>" class="img_thumb card-img-top" alt="">
                </div>
                <div class="card-body">
                    <h5 class="card-title "><?=ucfirst($row['designation'])?></h5>
                    <p class="card-text ">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                    <a href="" class="btn btn-primary ">Lire plus</a>
                </div>
            </div>
        <?php } ?>
        </div>
</div>