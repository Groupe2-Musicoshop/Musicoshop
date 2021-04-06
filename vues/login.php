<?php
session_start();
$_SESSION['root']="http://".$_SERVER['HTTP_HOST']."/Musicoshop";
?>
<!DOCTYPE html>
<html>

<head>
    <link rel="stylesheet" href="<?=$_SESSION['root']?>/css/login.css" />
    <!-- CSS only -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
</head>

<body>
    <?php
//session_start();


require_once '../modele/Database.php';

$database = new Database();
$conn = $database->getConnection();

if (isset($_POST['username'])){
	$username = stripslashes($_REQUEST['username']);
	//$username = $conn->quote($username);
	$_SESSION['username'] = $username;
	$password = stripslashes($_REQUEST['password']);
	$password =  $conn->quote($password);

    $sqlQuery = "SELECT * FROM `users` WHERE username='".$username."' and password='".hash('sha256', "$password")."'";

	//$stmt = $conn->prepare($sqlQuery);

    $stmt = $conn->query($sqlQuery);   
	
	if ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
		$user = mysqli_fetch_assoc($result);
		$_SESSION['userType'] = $user['type'];
		$_SESSION['isLogged'] = 'yes';

        echo "login usertype => ".$_SESSION['userType'];

        header('Location: ../index.php');
		
	}else{
		$message = "Le nom d'utilisateur ou le mot de passe est incorrect.";
	}
}
?>
    <div class="jumbotron">
        <form class="box" action="" method="post" name="login">
            <div class="mb-3">
	        <h4 class="title">Connexion espace client</h4>
            </div>
            <div class="mb-3">
            <input type="text" class="form-control" name="username" placeholder="Nom d'utilisateur" required>
            </div>
            <div class="mb-3">
            <input type="password" class="form-control" name="password" placeholder="Mot de passe" required>
            </div>
            <?php if (! empty($message)) { ?>
            <p class="errorMessage"><?php echo $message; ?></p>
            <?php } ?>
            <input type="submit" value="Connexion " name="submit" class="box-button">
            <p class="box-register"><a href="pwlost.php"><u>Vous avez oublié votre mot de passe ?</u></a></p>
          
            </p>
        </form>
    </div>
    
</body>

</html>