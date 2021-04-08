<?php
    $page = basename($_SERVER["PHP_SELF"]);
    $cat = new Categorie();
    $cat->set_PageActive($page);    
?>


<div id="cat_iacf" class="body-mu">

    <div id="title" class="white">Instruments à cordes Frotées</div>
    <img src='<?=$_SESSION['root']?>/img/headers_cats/cat_iacf.jpg' class='w100 d-inline-block align-top' alt=''>

    <?php $cat->genCategoriesHorizontaly()?>

</div>
