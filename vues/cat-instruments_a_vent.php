<?php
    $page = basename($_SERVER["PHP_SELF"]);
    require_once 'vues/header.php';
?>


<div id="<?=$page?>" class="body-mu">

    <img src='<?=$_SESSION['root']?>"/img/headers_cats/cat_iav.jpg' class='d-inline-block align-top' alt=''>
    <div id="title">Instruments à Vent</div>
</div>
<?php
	require_once 'vues/footer.php';
?>