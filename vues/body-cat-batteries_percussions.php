<?php
    $page = basename($_SERVER["PHP_SELF"]);
    $cat = new Categorie();
    $cat->set_PageActive($page);    
?>


<div id="cat_b&p" class="body-mu">

    <div id="title" class="white">Bateries & Percussions</div>
    <img src='<?=$_SESSION['root']?>/img/headers_cats/cat_b&p.jpg' class='w100 d-inline-block align-top' alt=''>

    <?php $cat->genCategoriesHorizontaly()?>

</div>