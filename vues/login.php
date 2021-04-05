<!DOCTYPE html>
<html>

<head>
    <link rel="stylesheet" href="../css/login.css" />
</head>

<body>
    <?php
session_start();

$_SESSION['root']="http://".$_SERVER['HTTP_HOST']."/musicoshop";

require('config.php');

if (isset($_POST['username'])){
	$username = stripslashes($_REQUEST['username']);
	$username = mysqli_real_escape_string($conn, $username);
	$_SESSION['username'] = $username;
	$password = stripslashes($_REQUEST['password']);
	$password = mysqli_real_escape_string($conn, $password);
    $query = "SELECT * FROM `comptes` WHERE username='".$username."' and password='".hash('sha256', "$password")."'";
	$result = mysqli_query($conn,$query);
	
	if (mysqli_num_rows($result) == 1) {
		$user = mysqli_fetch_assoc($result);
		$_SESSION['userType'] = $user['type'];

        header("Location: ".$_SESSION['root']."index.php");
		
	}else{
		$message = "Le nom d'utilisateur ou le mot de passe est incorrect.";
	}
}
?>
    <div class="jumbotron">
        <form class="box" action="" method="post" name="login">

            <h1 class="box-logo box-title"><a href="">AUTHENTIFICATION </a></h1>
            <h1 class="box-title">Connexion</h1>
            <input type="text" class="box-input" name="username" placeholder="Nom d'utilisateur">
            <input type="password" class="box-input" name="password" placeholder="Mot de passe">
            <input type="submit" value="Connexion " name="submit" class="box-button">
            <p class="box-register">Vous êtes nouveau ici? <a href="<?=$_SESSION['root']?>register.php">S'inscrire</a>
            </p>
            <?php if (! empty($message)) { ?>
            <p class="errorMessage"><?php echo $message; ?></p>
            <?php } ?>
        </form>
    </div>
</body>

</html>