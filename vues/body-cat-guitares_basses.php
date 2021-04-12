<?php
    $page = basename($_SERVER["PHP_SELF"]);
    $cat = new Categorie();
    $cat->set_PageActive($page);    
    
    $art = new Article();
?>
<div class="jumbotron">
    <div class="body-mu">

        <div id="title" class="white">Guitares & Basses</div>

        <img src='<?=$_SESSION['root']?>/img/headers_cats/cat_g&b.jpg' class='w100 d-inline-block align-top' alt=''>

        <?php $cat->genCategoriesHorizontaly()?>

        <div class="row">
            <div class="col-12">
                <div id="catalog" class="catalog">

                    <?php $art->genCardArticle(1);?>

                </div>
                <?php $art->getPagination(1, $page);?>    
            </div>
        </div>

    </div>
</div>