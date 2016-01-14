      <?php

      session_start();
      include_once("fonctions-panier.php");
      $nbJeux= 0;
      $id = $_GET['game_id'];
      $libelleJeu = $_GET['titre'];
      $qteJeu = $_GET['qteJeu'];
      $prixJeu = 10;

      creationPanier();
      ajouterJeu($id,$libelleJeu,$qteJeu,$prixJeu);

      ?>
<!doctype html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang=""> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8" lang=""> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9" lang=""> <![endif]-->
<!--[if gt IE 8]><!--> 
<html class="no-js" lang=""> <!--<![endif]-->
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
              </button>
              <a class="navbar-brand" href="index.php">GAMELOC</a>
            </div>

            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
              <ul class="nav navbar-nav">
                <li><a href="catalogue.php">Catalogue</a></li>
              </ul>
              <ul class="nav navbar-nav navbar-right">
                <li><a href="#"><?php echo "Bonjour ".$_SESSION['gamers']['firstname']." !"; ?></a></li>
                <li><a href="panier.php" >Panier <i class="glyphicon glyphicon-shopping-cart" ></i> <?php echo $qteJeu; ?></a></li>         
                <li><a href="logout.php">Logout</a></li>
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

              <h2 id="gameloc">MON PANIER</h2>

                <form method="Post" action="panier.php">
             

          </div>
        </div>
     
                  <div class="container">
                    <div class="formConnexion col-md-8 col-md-offset-1">
                      <div>
                      <h2>Détail de mon panier</h2>
                      <p>Voici le récapitulatif de votre commande, veuillez en vérifier le contenu.</p>
                        
                         <?php if ((count($_SESSION['panier']) <= 0 )):?>
                               <?php echo '<p class="alert alert-info">Votre panier est vide !</p>'; ?>
                               <?php else :  ?>
             
                                <table class="table">
                                  <thead>
                                    <tr>
                                      <th>Titre du Jeu</th>
                                      <th>Prix</th>
                                      <th>Total</th>
                                    </tr>
                                  </thead>
                                  <tbody>
                                 
                                    <tr class="success">
                                      <td><?php echo $_SESSION['panier']['libelleJeu']; ?></td>
                                      <td><?php echo $_SESSION['panier']['prixJeu']; ?>€ </td>
                                      <td><?php echo MontantGlobal();?>€</td>
                                    </tr>
                                
                                  </tbody>
                                </table>
                          <?php endif;  ?>

                    </div>
                    <form action="<?php echo $_SERVER['PHP_SELF'];?>" method="POST">
                    <button type="submit" name="action" class="btn btn-success">Payer</button>
                    </form>
                  

                    <?php
                  
                     
                        //   echo "<tr>";
                        //   echo "<td>".htmlspecialchars($_SESSION['panier']['libelleJeu'][$i])."</ td>";
                        //   echo "<td><input type=\"text\" size=\"4\" name=\"q[]\" value=\"".htmlspecialchars($_SESSION['panier']['qteJeu'][$i])."\"/></td>";
                        //   echo "<td>".htmlspecialchars($_SESSION['panier']['prixJeu'][$i])."</td>";
                        //   echo "<td><a href=\"".htmlspecialchars("panier.php?action=suppression&l=".rawurlencode($_SESSION['panier']['libelleJeu'][$i]))."\">XX</a></td>";
                        //   echo "</tr>";

                        // echo "<tr><td colspan=\"2\"> </td>";
                        // echo "<td colspan=\"2\">";
                        // echo "Total : ".MontantGlobal();
                        // echo "</td></tr>";

                        // echo "<tr><td colspan=\"4\">";
                        // echo "<input type=\"submit\" value=\"Rafraichir\"/>";
                        // echo "<input type=\"hidden\" name=\"action\" value=\"refresh\"/>";

                        // echo "</td></tr>";
                      
                    
                    ?>
                    <div>
                      <footer>
                          <p>&copy; Mohand, Nadia , Bilel et Cesario</p>
                      </footer>
                  </div>
               </div>
            </div>
        

</div>


<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
<script>window.jQuery || document.write('<script src="js/vendor/jquery-1.11.2.min.js"><\/script>')</script>

<script src="js/vendor/bootstrap.min.js"></script>

<script src="js/main.js"></script>
</body>
</html>
