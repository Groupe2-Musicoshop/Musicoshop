<?php
    $page = basename($_SERVER["PHP_SELF"]);
    $cat = new Categorie();
    $cat->set_PageActive($page);    
?>
<div class="jumbotron">
    <div id="<?=$page?>" class="body-mu">

        <div id="title" class="white">Pianos & Claviers</div>
        <img src='<?=$_SESSION['root']?>/img/headers_cats/cat_p&c.jpg' class='w100 d-inline-block align-top' alt=''>

        <?php $cat->genCategoriesHorizontaly()?>

    </div>
</div>