<?php 
	//créer un panier
	function creationPanier(){
	   if (!isset($_SESSION['panier'])){
	      $_SESSION['panier']=array();
	      // $_SESSION['panier']['id'] = array();
	      // // $_SESSION['panier']['libelleJeu'] = array();
	      // // $_SESSION['panier']['qteJeu'] = array();
	      // // $_SESSION['panier']['prixJeu'] = array();
	      // // $_SESSION['panier']['verrou'] = false;
		}
	}


	// fonction isVerouille
	function isVerrouille(){
	   if (isset($_SESSION['panier']) && $_SESSION['panier']['verrou'])
	   return true;
	   else
	   return false;
	}
	

	// ajouter un Jeu
	function ajouterJeu($id,$libelleJeu,$qteJeu,$prixJeu){
		creationPanier();

	   		$game = [];
	   		$game['id']=$id;
	   		$game['qteJeu']=$qteJeu;
	   		$game['libelleJeu']=$libelleJeu;
	   		$game['prixJeu']=$prixJeu;

	   		$_SESSION['panier']=$game;
	}

	// Montant du panier
	function MontantGlobal(){
	   $total=0;
	   $total = $_SESSION['panier']['qteJeu'] * $_SESSION['panier']['prixJeu'];
	   return $total;
	}

	// Supprimer le panier
	function supprimePanier(){
   	unset($_SESSION['panier']);
	}


 ?>


