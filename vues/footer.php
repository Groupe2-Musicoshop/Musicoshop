<?php

    $cat = new Categorie();
?>
<div id="footer" class="bg-color-bzb">
    <div class="row">

        <div class="col-footer col-sd-12 col-md-6 col-xl-4">
            <ul id="cat-footer" class="mr-auto">
                <h3>Catégories</h3> 
                <?php $cat->genCategoriesVerticaly()?>
            </ul>
        </div>

        <div class="col-footer col-sd-12 col-md-6 col-xl-4">
            <?php require_once 'vues/social_footer.php';?>
        </div>

        <div class="col-footer col-sd-12 col-md-6 col-xl-4">
            <div id="paiements">

                <h3>Paiements et sécurité</h3> 

                <div>
                    <span></span>
                    <img src="https://www.datatrans.ch/media/filer_public/74/d7/74d7c2d0-6298-4b9d-a996-5136f61a3b21/paypal.svg" srcset="" alt="Datatrans AG – Wallets | PayPal (International)">

                    <span></span>
                    <img src="https://www.datatrans.ch/media/filer_public/cf/3c/cf3c542d-7c27-43b2-b075-d70d89026932/amazon-pay.svg" srcset="" alt="Datatrans AG – Wallets | Amazon Pay">
                </div>   
                
                <div>
                    <span></span> 
                    <img src="https://www.datatrans.ch/media/filer_public/46/f7/46f7604c-d3e2-470a-a946-f15e5ba1226f/visa.svg" srcset="" alt="Datatrans AG – Cartes de Crédit | Visa (International)">

                    <span></span>
                    <img src="https://www.datatrans.ch/media/filer_public/26/2a/262ab488-b418-461b-9186-bf3263104440/mastercard.svg" srcset="" alt="Datatrans AG – Cartes de Crédit | Mastercard (International)">
                </div> 

                <div>
                    <span></span>
                    <img src="https://www.datatrans.ch/media/filer_public/c0/8a/c08a5d06-23a2-4ce5-9e83-a5da086b00a9/card_amex-old.svg" srcset="" alt="Datatrans AG – Cartes de Crédit | American Express (International)">

                    <span></span>
                    <img src="https://www.datatrans.ch/media/filer_public/06/89/06898aeb-f744-4082-a8dd-8d0353a43df0/diners.svg" srcset="" alt="Datatrans AG – Cartes de Crédit | Diners Club (International)">
                </div>  
                <p>&nbsp;</p>
                <p>Réglez de manière sûre et sécurisée par Carte bancaire, Virement, PayPal ou Amazon Pay.</p>  

            </div>
        </div>
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