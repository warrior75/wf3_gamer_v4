

<?php
	session_start();

	require(__DIR__.'/config/db.php');
	require(__DIR__.'/functions.php');

	// Cette fonction doit être mis de préférence dans le fichier functions.php

	checkLoggedIn();

	// L'utilisateur est connecté

	// On va vérifié que ce user a le role admin 

	if ($_SESSION['gamers']['role'] != 'admin') {
		header("HTTP/1.0 403 Forbidden");
		die();
	}

	// compter le nbr. de users en bdd
	$query = $pdo->query('SELECT count(id) as total FROM gamers');
	$resultCount = $query->fetch();
	$totalUser = $resultCount['total'];// affiche dans le page admin

  $query = $pdo -> prepare('SELECT games.*,plateforme.name as plateforme_name FROM games 
                                              INNER JOIN plateforme ON platform_id = plateforme.id 
                                              WHERE user_id IN (SELECT id FROM gamers
                                              WHERE created_at > SUBDATE(CURRENT_DATE,1))');
  // $query->execute();
  // $name_plateform = $query->fetch();

  // $query = $pdo->prepare('SELECT * FROM games
  //                         WHERE user_id IN (SELECT id FROM gamers
  //                         WHERE created_at > SUBDATE(CURRENT_DATE,1))');
  $query->execute();
  $new_games = $query->fetchAll();

?>
<!DOCTYPE html>
<html>
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
  <header>
      <nav class="navbar navbar-inversed">
          <div class="container-fluid">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
              <a class="navbar-brand" href="index.php">GAMELOC</a>
            </div>

            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
              <ul class="nav navbar-nav">
                <li class="active"><a href="inscription.php">Inscription</a></li>
                <li><a href="add_games.php">Ajoutez un jeu !</a></li>
                <li><a href="catalogue.php">Catalogue</a></li>
              </ul>
            </div><!-- /.navbar-collapse -->
          </div><!-- /.container-fluid -->
        </nav>
    <h2>Statistiques</h2>
    <p>Le site contient <?php echo $totalUser ?>utilisateur(s).</p>
    <p>Cette session est visible que pour les administrateurs</p>
    <h1>Localisation des utilisateurs</h1>

    <style type="text/css">
     
      #map { height: 200px; }
    </style>

  </header>
  <body>
    <div id="map"></div>
    <script type="text/javascript">

var map;

var myLatLng = {lat: 48.8909964, lng: 2.2345892};

function initMap() {
  map = new google.maps.Map(document.getElementById('map'), {
    center: {lat: -34.397, lng: 150.644},
    // on peut changer le zoom
    zoom: 12
  });

      var marker = new google.maps.Marker({
        position: myLatLng,
        map: map,
        title: 'hello'
	});
}



    </script>
    <script async defer
      src="https://maps.googleapis.com/maps/api/js?key=AIzaSyApFHyhOE1lniNGNo0yrkthO-wEUp4OOzM&callback=initMap">
    </script>


<h1>Les derniers jeux ajoutés par les inscrits</h1>
          <?php if(!empty($new_games)): ?>
                
          
            <!-- 2. Dynamiser avec php -->
                <?php foreach ($new_games as $game): ?>
                  
                
                <div class="fiche">
                    <img src="<?php echo $game['url_img']; ?>" height="170" width="120">
                    <h5>Titre :<?php echo $game['title']; ?></h5>
                    <h5>Plateforme : <?php echo $game['plateforme_name']; ?></h5>
                    <p>description : <?php echo $game['description'] ?></p>
                </div>
              <?php endforeach ?>  
          <?php endif; ?>

    <footer>
        <p>&copy; Mohand, Nadia , Bilel et Césario</p>
      </footer>
    <!-- /container -->        
        <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
        <script>window.jQuery || document.write('<script src="js/vendor/jquery-1.11.2.min.js"><\/script>')</script>

        <script src="js/vendor/bootstrap.min.js"></script>

        <script src="js/main.js"></script>

  </body>
</html>