<div class="jumbotron">
    <section class="mb-4">
        <h2 class="h1-responsive font-weight-bold text-center my-4">Nous contacter</h2>
        <p class="text-center w-responsive mx-auto mb-5">Vous avez une question? N'hésitez pas à nous contacter directement. Notre équipe reviendra à toute heure vers vous pour vous aider.</p>
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
            <a class="btn btn-primary" onclick="validateForm();">Envoyer</a> 
            </div>
            <div class="status"></div>
        </div>

    </section>
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

