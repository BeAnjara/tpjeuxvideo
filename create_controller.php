<?php 
	include "connect_to_db.php";
	include "view/header.php";
	session_start();
 ?>
 <!-- Fonction de triage des données réçus par le foirmulaire -->
 <?php 
 		function triage($data){
 			$data = trim($data);
 			$data = stripcslashes($data);
 			$data = htmlspecialchars($data);
 			return $data;
 		}
  ?>
<!-- Validation -->
<?php 
	if(isset($_POST['create_submit'])):
		if(empty($_POST['nom'])):
			$_SESSION['nameError'] = 'Name is required';
		else:
			$_SESSION['nameError'] = null;
		endif;

		if(empty($_POST['possesseur'])):
			$_SESSION['possesseurError'] = 'Possesseur is required';
		else:
			$_SESSION['possesseurError'] = null;
		endif;

		if(empty($_POST['console'])):
			$_SESSION['consoleError'] = 'Console is require';
		else:
			$_SESSION['consoleError'] = null;
		endif;

		if(empty($_POST['prix'])):
			$_SESSION['prixError'] = 'Prix is required';
		elseif( (int)$_POST['prix'] < 1 ):
			$_SESSION['prixError'] = 'Prix must be over than 0';
		else:
			$_SESSION['prixError'] = null;
		endif;

		if(empty($_POST['nbre_joueurs_max'])):
			$_SESSION['nbmaxError'] = 'Nombre de joueur is required';
		elseif( (int)$_POST['nbre_joueurs_max'] < 1):
			$_SESSION['nbmaxError'] = 'Nombre de jour must over than 0';
		else:
			$_SESSION['nbmaxError'] = null;
		endif;

		if(empty($_POST['commentaires'])):
			$_SESSION['commentaireError'] = 'Commentaire is require';
		else:
			$_SESSION['commentaireError'] = null;
		endif;

	endif;

	if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["create_submit"])):
		$nom = triage($_POST['nom']);
		$possesseur = triage($_POST['possesseur']);
		$console = triage($_POST['console']);
		$prix = triage($_POST['prix']);
		$nbreMax = triage($_POST['nbre_joueurs_max']);
		$commentaires = triage($_POST['commentaires']);


/**
 * Insert all data from post into databse
 */
		$insertdata = $db->prepare('INSERT INTO jeux_video(nom, possesseur, console, prix, nbre_joueurs_max, commentaires) VALUES(:nom, :possesseur, :console, :prix, :nbre_joueurs_max, :commentaires)');
		$insertdata->execute(array(
			'nom' => $nom,
			'possesseur' => $possesseur,
			'console' => $console,
			'prix' => $prix,
			'nbre_joueurs_max' => $nbreMax,
			'commentaires' => $commentaires
		));
		$_SESSION['success'] = "Le jeu a été bien ajouté";
	endif;


	 header('Location: create_view.php');
 ?>