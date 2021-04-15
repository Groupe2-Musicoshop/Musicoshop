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
            <br><br>
            <ul class="list-unstyled mb-0">
                <li><p><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-geo-alt-fill" viewBox="0 0 16 16">
                <path d="M8 16s6-5.686 6-10A6 6 0 0 0 2 6c0 4.314 6 10 6 10zm0-7a3 3 0 1 1 0-6 3 3 0 0 1 0 6z"/>
                </svg>
                Champs sur Marne, 77300, France</p>
                </li>

                <li><p><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-telephone-fill" viewBox="0 0 16 16">
                <path fill-rule="evenodd" d="M1.885.511a1.745 1.745 0 0 1 2.61.163L6.29 2.98c.329.423.445.974.315 1.494l-.547 2.19a.678.678 0 0 0 .178.643l2.457 2.457a.678.678 0 0 0 .644.178l2.189-.547a1.745 1.745 0 0 1 1.494.315l2.306 1.794c.829.645.905 1.87.163 2.611l-1.034 1.034c-.74.74-1.846 1.065-2.877.702a18.634 18.634 0 0 1-7.01-4.42 18.634 18.634 0 0 1-4.42-7.009c-.362-1.03-.037-2.137.703-2.877L1.885.511z"/>
                </svg> 01 23 56 89 56</p>
                </li>
                
                <li><p><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-envelope-fill" viewBox="0 0 16 16">
                <path d="M.05 3.555A2 2 0 0 1 2 2h12a2 2 0 0 1 1.95 1.555L8 8.414.05 3.555zM0 4.697v7.104l5.803-3.558L0 4.697zM6.761 8.83l-6.57 4.027A2 2 0 0 0 2 14h12a2 2 0 0 0 1.808-1.144l-6.57-4.027L8 9.586l-1.239-.757zm3.436-.586L16 11.801V4.697l-5.803 3.546z"/>
                </svg>
                musicoshop@musicoshop.com</p></i>
                </li>
                
                <br>
               
               
                <a href="../Musicoshop/contact-us.php">Contactez-nous</a>
               
            </ul>
        
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