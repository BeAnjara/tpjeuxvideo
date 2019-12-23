<?php 
	include "connect_to_db.php";
	include "view/header.php"; 
	session_start();
?>
<a href="index.php"> Retour à la page d'acceuil</a><br>
<?php 
	if($_SESSION):
		if($_SESSION['success']):
			echo "<p class=\"alert alert-success\">" . $_SESSION['success'] . "</p>";
		endif;
	endif;
 ?>
<div class="row">
	<div class="offset-lg-3 col-lg-6">
		<br><br>
		<h5> Créer un Jeu </h5>
		<form action="create_controller.php" method="POST">

			<div class="form-group">
				Nom: <input type="text" class="form-control" name="nom">				<?php 
					if($_SESSION && $_SESSION['nameError'] != null):
					 echo "<p class=\"alert alert-danger\">". $_SESSION['nameError'] ."</p>";
					endif; 
				?>			
			</div>

			<div class="form-group">
				Possesseur: <input type="text" class="form-control" name="possesseur">
				<?php 
					if($_SESSION && $_SESSION['possesseurError'] != null):
					 echo "<p class=\"alert alert-danger\">". $_SESSION['possesseurError'] ."</p>";
					endif; 
				?>
			</div>

			<div class="form-group">
				Console: <input type="text" class="form-control" name="console">
				<?php 
					if($_SESSION && $_SESSION['consoleError'] != null):
					 echo "<p class=\"alert alert-danger\">". $_SESSION['consoleError'] ."</p>";
					endif; 
				?>
			</div>

			<div class="form-group">
				Prix: <input type="number" min="1" class="form-control" name="prix">
				<?php 
					if($_SESSION && $_SESSION['prixError'] != null):
					 echo "<p class=\"alert alert-danger\">". $_SESSION['prixError'] ."</p>";
					endif; 
				?>
			</div>

			<div class="form-group">
				Nombre joueur max: <input type="number" min="1" max="20" class="form-control" name="nbre_joueurs_max">
				<?php 
					if($_SESSION && $_SESSION['nbmaxError'] != null):
					 echo "<p class=\"alert alert-danger\">". $_SESSION['nbmaxError'] ."</p>";
					endif; 
				?>
			</div>

			<div class="form-group">
				Commentaire: <input type="text" class="form-control" name="commentaires">
				<?php 
					if($_SESSION && $_SESSION['commentaireError'] != null):
					 echo "<p class=\"alert alert-danger\">". $_SESSION['commentaireError'] ."</p>";
					endif; 
				?>
			</div>

			<button class="btn btn-primary" name="create_submit" type="submit">Submit</button>
		</form>
		
	</div>
	
</div>

<?php 
	include "view/footer.php";
	 session_unset();
	 session_destroy();
?>
