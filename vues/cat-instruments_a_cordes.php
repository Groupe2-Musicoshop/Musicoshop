<?php
    $page = basename($_SERVER["PHP_SELF"]);
    require_once 'header.php';
?>


<div id="<?=$page?>" class="body-mu">

    <img src='<?=$_SESSION['root']?>"/img/headers_cats/cat_iac.jpg' class='d-inline-block align-top' alt=''>
    <div id="title">Instruments à cordes</div>
</div>
<?php
	require_once 'footer.php';
?>