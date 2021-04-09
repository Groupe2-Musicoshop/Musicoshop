<?php
    $page = basename($_SERVER["PHP_SELF"]);
    $cat = new Categorie();
    $art = new Article();
    $cat->set_PageActive($page);    
?>

<div class="jumbotron">
    <div id="<?=$page?>" class="body-mu">

        <div id="title" class="white">Instruments à Vent</div>
        <img src='<?=$_SESSION['root']?>/img/headers_cats/cat_iav.jpg' class='w100 d-inline-block align-top' alt=''>

        <?php $cat->genCategoriesHorizontaly()?>

        <div class="row">
            <div class="col-12">
                <div class="catalog">

                    <?php $art->genCardArticle(4);?>

                </div>
            </div>
        </div>

    </div>
</div>