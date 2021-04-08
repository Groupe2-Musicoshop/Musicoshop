<?php
    $page = basename($_SERVER["PHP_SELF"]);
    $cat = new Categorie();
    $cat->set_PageActive($page);    
?>

<div class="body-mu">
    
    <div id="title" class="white">Guitares & Basses</div>
    <img src='<?=$_SESSION['root']?>/img/headers_cats/cat_g&b.jpg' class='w100 d-inline-block align-top' alt=''>

    <?php $cat->genCategoriesHorizontaly()?>

</div>