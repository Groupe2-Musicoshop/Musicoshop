<?php
    $page = basename($_SERVER["PHP_SELF"]);
    $cat = new Categorie();
    $cat->set_PageActive($page);   
?>
<div class="jumbotron">
    <div id="cat_b&p" class="body-mu">

        <div id="title" class="white">Nous contacter</div>
        <img src='<?=$_SESSION['root']?>/img/headers_cats/cat_login_signin.jpg' class='w100 d-inline-block align-top landscape' alt=''>

        <?php $cat->genCategoriesHorizontaly()?>
    

    <section class="mb-4">

    <!--Section heading-->
    <h2 class="h1-responsive font-weight-bold text-center my-4">Nous contacter</h2>
    <!--Section description-->
    <p class="text-center w-responsive mx-auto mb-5">Vous avez une question? N'hésitez pas à nous contacter directement. Notre équipe reviendra à toute heure vers vous pour vous aider.
</p>

    <div class="row">

        <!--Grid column-->
        <div">
            <form id="contact-form" name="contact-form" action="" method="POST">
                <div class="row">
                    <div class="col-md-6">
                        <div class="md-form mb-0">
                            <label for="name" class="">Votre nom</label>
                            <input type="text" id="name" name="name" class="form-control">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="md-form mb-0">
                            <label for="email" class="">Votre e-mail</label>
                            <input type="text" id="email" name="email" class="form-control">
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="md-form mb-0">
                            <label for="subject" class="">Sujet</label>
                            <input type="text" id="subject" name="subject" class="form-control">
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="md-form">
                            <label for="message">Votre message</label>
                            <textarea type="text" id="message" name="message" rows="10" class="form-control md-textarea"></textarea>
                        </div>
                        <br>
                    </div>
                </div>
            </form>
            <div class="text-center text-md-left">
            <div class="center col-4"><a  class="btn btn-primary btn-lg btn-block" onclick="validateForm();">Envoyer</a></div>
            </div>
            <div class="status"></div>
        </div>

    </section>
</div>
</div>

<script>
function validateForm() {

    var name =  document.getElementById('name').value;

    if (name == "") {
        document.querySelector('.status').innerHTML = "Votre nom est vide!";
        return false;
    }

    var email =  document.getElementById('email').value;

    if (email == "") {

        document.querySelector('.status').innerHTML = "Votre e-mail est vide!";
        return false;

    } else {

        var re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
        
        if(!re.test(email)){

            document.querySelector('.status').innerHTML = "E-mail format invalide!";
            return false;
        }
    }
    var subject =  document.getElementById('subject').value;

    if (subject == "") {

        document.querySelector('.status').innerHTML = "Sujet vide!";
        return false;
    }

    var message =  document.getElementById('message').value;

    if (message == "") {
        document.querySelector('.status').innerHTML = "Message vide!";
        return false;
    }
    
    document.querySelector('.status').innerHTML = "Message envoyé";
  }
</script>

