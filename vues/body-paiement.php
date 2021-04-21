<?php
    if (!isset($_SESSION)) { session_start(); }
    
	@$valider=$_POST["valider"];
	$date = new DateTime('Y');


    require_once 'modele/Database.php';
    require_once 'modele/Commande.php';
    require_once 'modele/Panier.php';
	
	$userName = $_SESSION["username"];

    if(isset($valider)){     
		
		$cmd = new Commande();
		$cmd->cartToCmd($userName);

		$cart = new Panier();
		
		if($_SESSION['userType'] =='admin'){
		
			$cart->setCOOKIE($_COOKIE["PHPSESSID"].$_SESSION['username']);
		}
		else{
	
			$cart->setCOOKIE($_COOKIE["PHPSESSID"]);
		}

		$cart->deleteALlArtCart();;
		echo '
		<div id="modal" class="modal fade show show-message" tabindex="-1">
		<div class="modal-dialog">
		  <div class="modal-content">
			<div class="modal-header">
			  <h5 class="modal-title">Information</h5>
			  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<div class="modal-body">
			  <p>Payement accepté</p>
			</div>
			<div class="modal-footer">
			<a id="btn-modal" class="btn btn-primary" data-bs-toggle="modal" href="'.$_SESSION['root'].'/index.php" role="button" data-bs-dismiss="modal">OK</a>			  
			</div>
		  </div>
		</div>
	  </div>';
	}
		
	

	        
?>
<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<!------ Include the above in your HEAD tag ---------->

<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.8/css/all.css">

<div class="container">
<br>  <h2 class="text-center">Formulaire de paiement</h2>
<hr>

<div class="jumbotron">
<form id="paiement" action="" method="POST">
<h3>Modes de paiement</h3>

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
			<input type="text" class="form-control" required name="cardNumber" placeholder="" pattern="^4[0-9]{12}(?:[0-9]{3})?|5[1-5][0-9]{14}$|^2(?:2(?:2[1-9]|[3-9][0-9])|[3-6][0-9][0-9]|7(?:[01][0-9]|20))[0-9]{12}$">
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
	        	<label><span class="hidden-xs">Expiration</span> </label>
        	<div class="form-inline">
        		<select class="form-control" style="width:45%">
				  <option>07 - Juillet</option>
				  <option>08 - Août</option>
				  <option>09 - Septembre</option>
				  <option>10 - Octobre</option>
				  <option>11 - Novembre</option>
				  <option>12 - Décembre</option>

				</select>
	            <span style="width:10%; text-align: center"> / </span>
	            <select class="form-control" style="width:45%">
					<option><?php echo $date->format('Y')?></option>
					<option><?php echo $date->format('Y')+1?></option>
					<option><?php echo $date->format('Y')+2?></option>
					<option><?php echo $date->format('Y')+3?></option>
				</select>
        	</div>
			</div>
    </div>
	    <div class="col-sm-4">
	        <div class="form-group">
	            <label data-toggle="tooltip" title="" data-original-title="3 digits code on back side of the card">CVV <i class="fa fa-question-circle"></i><div class="hover-image"><img src="<?=$_SESSION['root']?>/img/cvv.png"></div></label>
	            <input type="text" class="form-control" pattern="^[0-9]{3}$" required="" placeholder="ex. 123">
	        </div> <!-- form-group.// -->
	    </div>
	</div> <!-- row.// -->
		<div class="row justify-content-center">
			<button class="col-12 col-md-5 btn btn-primary" type="submit" name="valider" > Acheter maintenant</button>
		</div>
	</form>
</div> <!-- tab-pane.// -->
<div class="tab-pane fade" id="nav-tab-paypal">
<p>Paypal est le moyen le plus simple de payer en ligne</p>
<p>

<a href="https://www.paypal.com/fr/signin" target="_blank" class="btn btn-primary" ><i class="fab fa-paypal"></i> Connectez-vous à votre compte PayPal</a>

</p>
</div>
<div class="tab-pane fade" id="nav-tab-bank">
<p>Coordonnées du compte bancaire</p>
<dl class="param">
  <dt>Banque: </dt>
  <dd> THE WORLD BANK</dd>
</dl>
<dl class="param">
  <dt>Numéro d'accréditation: </dt>
  <dd> 12345678912345</dd>
</dl>
<dl class="param">
  <dt>IBAN: </dt>
  <dd> FR5212739000502454276512N40</dd>
</dl>

</div> <!-- tab-pane.// -->
</div> <!-- tab-content .// -->

</div> <!-- card-body.// -->
</article> <!-- card.// -->

</div> <!-- row.// -->
</form>
</div> 

