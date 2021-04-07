<?php

    $cat = new Categorie();
?>
<div id="footer" class="bg-color-bzb">
    <div class="row">

        <div class="col-sd-12 col-md-6 col-xl-4">
            <ul id="cat-footer" class="mr-auto">
                <?php $cat->genCategoriesVerticaly()?>
            </ul>
        </div>

        <div class="col-sd-12 col-md-6 col-xl-4">
            <?php require_once 'vues/social_footer.php';?>
        </div>

        <div class="col-sd-12 col-md-6 col-xl-4"></div>
    </div>
</div>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"
    integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous">
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous">
</script>

<script src="https://unpkg.com/isotope-layout@3/dist/isotope.pkgd.js"></script>
<script language="javascript" type="text/javascript" src="ctrl/main.js"></script>
</body>

</html>