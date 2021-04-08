<?php
    $page = basename($_SERVER["PHP_SELF"]);
    $cat = new Categorie();
    $cat->set_PageActive($page);    
?>


<div id="<?=$page?>" class="body-mu">

    <div id="title" class="white">Instruments à cordes</div>
    <img src='<?=$_SESSION['root']?>/img/headers_cats/cat_iac.jpg' class='w100 d-inline-block align-top' alt=''>
    
    <?php $cat->genCategoriesHorizontaly()?>

</div>