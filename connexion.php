<?php 
session_start(); 
require(__DIR__.'/config/db.php'); 

if(isset($_SESSION['gamers'])){
	header('Location: catalogue.php');
	die();
}

// Vérifier que le button submit a été cliqué

if (isset($_POST['action'])) {
	$email = trim(htmlentities($_POST['email']));
	$password = trim(htmlentities($_POST['password']));

	// Initialisation d'un tableau d'erreurs
	$errors = array();

	// 1. récupération de l'utilisateur dans la bdd grâce à son email

	$query = $pdo -> prepare('SELECT * FROM gamers WHERE email = :email');
	$query -> bindValue(':email',$email,PDO::PARAM_STR);
	$query -> execute();
	$userInfos = $query -> fetch();

	if ($userInfos){
		
		//password_verify est compatible >= PHP 5.5
		if (password_verify($password,$userInfos['password'])) {
			
			//On stocke le user en session mais on retire le password avant
			unset($userInfos['password']);
			$_SESSION['gamers']=$userInfos;
			header('Location: catalogue.php');
			die();
		}
		else{
			$errors['password']="Mot de passe invalide";
			
		}
	} else {
		$errors['email']="Aucun utilisateur avec cet adresse mail";
	}
	


}

 ?>
<!doctype html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang=""> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8" lang=""> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9" lang=""> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" lang=""> <!--<![endif]-->
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <title></title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <link rel="stylesheet" href="css/bootstrap.min.css">
        <style>
            body {
                    padding-bottom: 20px;

            }
        </style>
        <link rel="stylesheet" href="css/bootstrap-theme.min.css">
        <link rel="stylesheet" href="css/main.css">

        <script src="js/vendor/modernizr-2.8.3-respond-1.4.2.min.js"></script>
    </head>
    <body>
        <!--[if lt IE 8]>
            <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
        <![endif]-->
		<nav class="navbar navbar-inversed">
		  <div class="container-fluid">
		    <!-- Brand and toggle get grouped for better mobile display -->
		    <div class="navbar-header">
		      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
		        <span class="sr-only">Toggle navigation</span>
		        <span class="icon-bar"></span>
		        <span class="icon-bar"></span>
		        <span class="icon-bar"></span>
		      </button>
		      <a class="navbar-brand" href="index.php">GAMELOC</a>
		    </div>

		    <!-- Collect the nav links, forms, and other content for toggling -->
		    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
		      <ul class="nav navbar-nav">
		        <li class="active"><a href="inscription.php">Inscription</a></li>
		        <li><a href="connexion.php">Connexion</a></li>
		      </ul>
		      <form class="navbar-form navbar-left" role="search">
		        <div class="form-group">
		          <input type="text" class="form-control" placeholder="Search">
		        </div>
		        <button type="submit" class="btn btn-primary">Chercher</button>
		      </form>
		      <ul class="nav navbar-nav navbar-right">
		        <li><a href="#">Louer</a></li>
		      </ul>
		    </div><!-- /.navbar-collapse -->
		  </div><!-- /.container-fluid -->
		</nav>

    <!-- Main jumbotron for a primary marketing message or call to action -->
    <div class="jumbotron">
      <div class="container" id="header">

        <div id="imgLogo">
          <img src="img/logo.png">  
        </div>

        <h1 id="gameloc">Gameloc</h1>
        <p>Connexion</p>

      </div>
    </div>
    <div class="formConnexion col-md-4 col-md-offset-4">
    		
	    	<form method="POST" action="<?php echo $_SERVER['PHP_SELF'];?>">

			  <div class="form-group">
			    <label for="email">Email</label>
			    <input type="email" class="form-control" name="email" id="email" placeholder="Email">
			  </div>

			 	<?php if(isset($errors['email'])): ?>
	    			<span id="helpBlock2" class="help-block"> 
	    				<?php echo $errors['email'] ;?> 
	    			</span>
		    	<?php endif;?>

			  <div class="form-group">
			    <label for="password">Mot de passe</label>
			    <input type="password" class="form-control" name="password" id="password" placeholder="Mot de passe">
			  </div>

    		<?php if(isset($errors['password'])) : ?> 
    			<span id="helpBlock2" class="help-block">
    				<?php echo ($errors['password']);?> 
    			</span>
    		<?php endif;?>
  	
			  <button type="submit" name="action" class="btn btn-primary">Valider</button>
               <div class="form-group">
                    <p class="help-block"><a href="forgot_password.php">Mot de passe oublié?</a></p>
                </div>
			</form>
			
			<footer>
	        	<p>&copy; Mohand, Nadia , Bilel, Cesario</p>
	      	</footer>
    	</div>
	
   		<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
        <script>window.jQuery || document.write('<script src="js/vendor/jquery-1.11.2.min.js"><\/script>')</script>

        <script src="js/vendor/bootstrap.min.js"></script>

        <script src="js/main.js"></script>
    </body>
</html>
