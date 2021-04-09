<?php
    require_once 'modele/Database.php';

    $cat = new Categorie();
    $art = new Article();

?>

<div id="categorie" class="filters button-group js-radio-button-group bg-color-whi">
    <?php $cat->genCategories();?>
</div>

<div class="jumbotron">
    <div id="body-shop" class="body-mu">
        <p id="title">Catalogue</p>
        <div class="row">
            <div class="col-12">
                <div class="catalog">

                    <?php $art->genCardArticle(0);?>

                </div>
            </div>
        </div>
    </div>
</div>