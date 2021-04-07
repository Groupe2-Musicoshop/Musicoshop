<?php

    $cat = new Categorie();

?>

<div id="categorie" class="filters button-group js-radio-button-group bg-color-whi">
    <?php $cat->genCategories();?>
</div>

<div id="body-shop" class="body-mu">

    <div id="title">Musicoshop Admin</div>
    <a class="dropdown-item bg-color-pla" href="http://localhost:8080/Musicoshop/ctrl/service.php">Update BDD</a>

</div>