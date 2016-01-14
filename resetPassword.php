<?php
session_start();

	require(__DIR__.'/config/db.php');
	require(__DIR__.'/functions.php');
	// Initialisation un tableau d'erreurs (associatif)
	$errors = [];

	$email = isset($_GET['email']) ? $_GET['email'] : $_POST['email'];
	$token = isset($_GET['token']) ? $_GET['token'] : $_POST['token'];

	// Si l'email ou le token ne figure pas dans l'url , l'uilisateur n'a rien à faire dans cette page
	if (empty($email) || empty($token)){
		header("Location: index.php");
		die();
	}

	// On récupère les données de l'utilisateur par son email 
	$query = $pdo->prepare('SELECT id, token, expire_token FROM gamers WHERE email = :email');
	$query->bindValue(':email', $email, PDO::PARAM_STR);
	$query->execute();
	$resultUser = $query->fetch();

	// si la requête renvoie un utilisateur
	if($resultUser) {
		// Redirection si le token de l'url ne corresponde au token de l'utilisateur, on le redirige sur index.php
		if ($token != $resultUser['token']){
			header("Location: index.php");
			die();
		}
		// Si la date du token est expirée, on le redirige vers forgot_password.php 
		if ($resultUser['expire_token'] < date("Y-m-d H:i:s")){
			header("Location: forgot_password.php");
			die();
		}
	}

	if(isset($_POST['action'])) {

	  	$password = trim(htmlentities($_POST['password']));
	  	$passwordConfirm = trim(htmlentities($_POST['passwordConfirm']));

		// Check du champs password
	 	if($password != $passwordConfirm) {
	 		$errors['password'] = "Les mots de passes ne sont pas les mêmes";
	 	}
	 	elseif(strlen($password) < 6) {
	 		$errors['password'] = "Le mot de passe est trop court";
	 	}
	 	else {
			// Le password contient au moins une lettre ?
			$containsLetter  = preg_match('/[a-zA-Z]/', $password);
			// Le password contient au moins un chiffre ?
			$containsDigit   = preg_match('/\d/', $password);
			// Le password contient au moins un autre caractère ?
			$containsSpecial = preg_match('/[^a-zA-Z\d]/', $password);
			// Si une des conditions n'est pas remplie... erreur
			if (!$containsLetter || !$containsDigit || !$containsSpecial){
				$errors['password'] = "Choisissez un meilleur mot de passe avec au moins un 6 caractères avec une lettre, un chiffre et caractère spécial.";
			}
	 	}
	 	
	 	if(empty($errors)) {
	 		// Mise à jour dans la bdd
	        $query = $pdo->prepare('UPDATE gamers SET password = :password, token = NULL, expire_token = NULL, updated_at = NOW() WHERE id = :id');
	        
	        // Hash du password pour de sécurité
	 		$hashedPassword = password_hash($password, PASSWORD_DEFAULT);
	 		$query->bindValue(':password', $hashedPassword, PDO::PARAM_STR);
	        $query->bindValue(':id', $resultUser['id'], PDO::PARAM_STR);
	        $query->execute();

	        if($query->rowCount() > 0) {
	 			// Récupération de l'utilisateur depuis la bdd pour l'affecter à une variable session
	 			$query = $pdo->prepare('SELECT * FROM gamers WHERE id = :id');
	 			$query->bindValue(':id', $resultUser['id'], PDO::PARAM_INT);
	 			$query->execute();
	 			$resultUser = $query->fetch();

	 			// On stocke le user en session et on retire le password
				unset($resultUser['password']);
	 			$_SESSION['gamers'] = $resultUser;

	 			header("Location: catalogue.php");
	 			die();
	 		}
	        else {
	          $errors['app'] = "Erreur d'application";
	        }
	 	}
	}
?>

<!DOCTYPE html>
<html>
<head>
	<title>Forgot password?</title>
	<!-- Bootstrap CSS -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
	<link rel="stylesheet" href="css/bootstrap-theme.min.css">
	<link rel="stylesheet" href="css/main.css">

	<script src="js/vendor/modernizr-2.8.3-respond-1.4.2.min.js"></script>
</head>
<body>

<div class="jumbotron">
				<div class="container" id="header">

					<div id="imgLogo" >
						<img src="img/logo.png">  
					</div>

					<h1 id="gameloc">Réinitialisation du mot de passe</h1>

				</div>
			</div>

	<div class="container-fluid">
		<div class="row">

			<div class="col-md-4 col-md-offset-4">
	          <form method="POST" action="<?php echo $_SERVER['PHP_SELF'] ?>">
	            <div class="form-group">
	              <label for="password">Password</label>
	              <input type="password" class="form-control" id="password" name="password" placeholder="Password">
	            </div>
	            <div class="form-group">
	              <label for="passwordConfirm">Confirm Password</label>
	              <input type="password" class="form-control" id="passwordConfirm" name="passwordConfirm" placeholder="Confirm Password">
	            </div>

	            <?php if(isset($errors)) : ?> 
	    			<span id="helpBlock2" class="help-block">
	    			<?php foreach($errors as $error):?>
	    				<?php echo $error ; ?>
	    			<?php endforeach; ?>
	    			</span>
	    		<?php endif;?>
	            
				<input type="hidden" name="token" value="<?php echo $token; ?>" />
				<input type="hidden" name="email" value="<?php echo $email; ?>" />
	            <button type="submit" name="action" class="btn btn-default">Submit</button>
	          </form>
        	</div>
      	</div>
    </div>
   			<footer>
                <p>&copy; Mohand, Nadia , Bilel</p>
            </footer>
  </body>
</html>


