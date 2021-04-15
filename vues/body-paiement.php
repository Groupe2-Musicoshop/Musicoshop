<?php
    if (!isset($_SESSION)) { session_start(); }
    
	@$valider=$_POST["valider"];

    require_once 'modele/Database.php';
    require_once 'modele/Panier.php';

    if(isset($valider)){     

		
		$userName = $_SESSION["username"];
		
		$cart = new Panier();
		$cart->cartToCmd($userName);


		$message="Payement accepté";

		echo '<script type="text/javascript">window.alert("'.$message.'");</script>';
		echo "<script type='text/javascript'> document.location = 'index.php'; </script>";
	}
		
	

	        
?>
<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<!------ Include the above in your HEAD tag ---------->

<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.8/css/all.css">


<div class="container">
<br>  <p class="text-center">Formulaire de paiement</p>
<hr>

<div class="jumbotron">
<form id="paiement" action="" method="POST">
<p>Modes de paiement</p>

<article class="card">
<div class="card-body p-5">

<ul class="nav bg-light nav-pills rounded nav-fill mb-3" role="tablist">
	<li class="nav-item">
		<a  class="nav-link active" data-toggle="pill" href="#nav-tab-card">
		<i  class="fa fa-credit-card"></i> Carte de crédit</a></li>
	<li class="nav-item">
		<a  class="nav-link" data-toggle="pill" href="#nav-tab-paypal">
		<i class="fab fa-paypal"></i>  Paypal</a></li>
	<li class="nav-item">
		<a  class="nav-link" data-toggle="pill" href="#nav-tab-bank">
		<i class="fa fa-university"></i>  Virement bancaire</a></li>
</ul>

<div class="tab-content">
<div class="tab-pane fade show active" id="nav-tab-card">
	<p class="alert alert-success">Remplisser votre formulaire à l'abri des regards indiscrets!</p>
	<form role="form">
	<div class="form-group">
		<label for="username">Nom mentionné sur la carte</label>
		<input type="text" class="form-control" name="username" placeholder="" required>
	</div> <!-- form-group.// -->

	<div class="form-group">
		<label for="cardNumber">Numéro de la carte</label>
		<div class="input-group">
			<input type="text" class="form-control" name="cardNumber" placeholder="" required>
			<div class="input-group-append">
				<span class="input-group-text text-muted">
					<i class="fab fa-cc-visa"></i>   <i class="fab fa-cc-amex"></i>   
					<i class="fab fa-cc-mastercard"></i> 
				</span>
			</div>
		</div>
	</div> <!-- form-group.// -->

	<div class="row">
	    <div class="col-sm-8">
	        <div class="form-group">
	            <label><span class="hidden-xs">Expiration</span> </label>
	        	<div class="input-group">
	        		<input type="number" class="form-control" placeholder="MM" name="" required>
		            <input type="number" class="form-control" placeholder="YY" name="" required>
	        	</div>
	        </div>
	    </div>
	    <div class="col-sm-4">
	        <div class="form-group">
	            <label data-toggle="tooltip" title="" data-original-title="3 digits code on back side of the card">CVV <i class="fa fa-question-circle"></i></label>
	            <input type="number" class="form-control" required="">
	        </div> <!-- form-group.// -->
	    </div>
	</div> <!-- row.// -->
	<div class="row">
	<div class="center col-4"><button  class="btn btn-primary btn-lg btn-block" type="submit" name="valider"> Acheter maintenant  </button></div>
	</div>
	</form>
</div> <!-- tab-pane.// -->
<div class="tab-pane fade" id="nav-tab-paypal">
<p>Paypal is easiest way to pay online</p>
<p>
<button type="button" class="btn btn-primary"> <i class="fab fa-paypal"></i> Log in my Paypal </button>
</p>
<p><strong>Note:</strong> Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
tempor incididunt ut labore et dolore magna aliqua. </p>
</div>
<div class="tab-pane fade" id="nav-tab-bank">
<p>Bank accaunt details</p>
<dl class="param">
  <dt>BANK: </dt>
  <dd> THE WORLD BANK</dd>
</dl>
<dl class="param">
  <dt>Accaunt number: </dt>
  <dd> 12345678912345</dd>
</dl>
<dl class="param">
  <dt>IBAN: </dt>
  <dd> 123456789</dd>
</dl>
<p><strong>Note:</strong> Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
tempor incididunt ut labore et dolore magna aliqua. </p>
</div> <!-- tab-pane.// -->
</div> <!-- tab-content .// -->

</div> <!-- card-body.// -->
</article> <!-- card.// -->

</div> <!-- row.// -->
</form>
</div> 