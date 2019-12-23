<?php 
	include "connect_to_db.php";
	include "view/header.php";
	session_start();
	function triage($data){
 			$data = trim($data);
 			$data = stripcslashes($data);
 			$data = htmlspecialchars($data);
 			return $data;
 		} 
?>

<?php 
	if(isset($_GET['id_edit'])):
		$idEdit = triage($_GET['id_edit']);
		$req = $db->prepare('SELECT * FROM jeux_video WHERE ID = :id_edit');
		$req->execute(array(
			'id_edit' => $idEdit
		));
		$res = $req->fetch(PDO::FETCH_ASSOC);
	endif;

	if(isset($_POST['edit_submit'])):
		$nom = triage($_POST['nom']);
		$possesseur = triage($_POST['possesseur']);
		$console = triage($_POST['console']);
		$prix = triage($_POST['prix']);
		$nbreMax = triage($_POST['nbre_joueurs_max']);
		$commentaires = triage($_POST['commentaires']);
		 $idEdit = triage($_POST['ID']);


		$update = $db->prepare('UPDATE jeux_video SET nom = :nom, possesseur = :possesseur, console = :console, prix = :prix, nbre_joueurs_max = :nbre_joueurs_max, commentaires = :commentaires WHERE ID = :id_edit');
		$update->execute(array(
			'nom' => $nom,
			'possesseur' => $possesseur,
			'console' => $console,
			'prix' => $prix,
			'nbre_joueurs_max' => $nbreMax,
			'commentaires' => $commentaires,
			'id_edit' => $idEdit
		));
		$_SESSION['Update'] = "Game updated with succes";
		header('Location: index.php');
	endif;
 ?>

<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST" class="offset-lg-3 col-lg-6">
		<div class="form-group">
			<? if(isset($_GET['id_edit'])): ?>
				ID: <input type="text" class="form-control" name="ID" value="<?php echo $res['ID']; ?>" readonly>				
			<? else: ?>
				Nom: <input type="text" class="form-control" name="ID" value="<?php ?>">
			<? endif; ?>
		</div>

		<div class="form-group">
			<? if(isset($_GET['id_edit'])): ?>
				Nom: <input type="text" class="form-control" name="nom" value="<?php echo $res['nom']; ?>">				
			<? else: ?>
				Nom: <input type="text" class="form-control" name="nom" value="<?php ?>">
			<? endif; ?>
		</div>

		<div class="form-group">
			<? if(isset($_GET['id_edit'])): ?>
				Possesseur: <input type="text" class="form-control" name="possesseur" value="<?php echo $res['possesseur']; ?>">
			<? else: ?>
				Possesseur: <input type="text" class="form-control" name="possesseur" value="<?php ?>">
			<? endif; ?>
		</div>

		<div class="form-group">
			<? if(isset($_GET['id_edit'])): ?>
				Console: <input type="text" class="form-control" name="console" value="<?php echo $res['console']; ?>">
			<? else: ?>
				Console: <input type="text" class="form-control" name="console" value="<?php  ?>">
			<? endif; ?>
		</div>

		<div class="form-group">
			<? if(isset($_GET['id_edit'])): ?>
				Prix: <input type="number" min="1" class="form-control" name="prix" value="<?php echo $res['prix']; ?>">
			<? else: ?>
				Prix: <input type="number" min="1" class="form-control" name="prix" value="<?php ?>">
			<? endif; ?>

		</div>

		<div class="form-group">
			<? if(isset($_GET['id_edit'])): ?>
				Nombre joueur max: <input type="number" min="1" max="20" class="form-control" name="nbre_joueurs_max" value="<?php echo $res['nbre_joueurs_max']; ?>">
			<? else: ?>
				Nombre joueur max: <input type="number" min="1" max="20" class="form-control" name="nbre_joueurs_max" value="<?php ?>">
			<? endif; ?>

		
		</div>

		<div class="form-group">
			<? if(isset($_GET['id_edit'])): ?>
				Commentaire: <input type="text" class="form-control" name="commentaires" value="<?php echo $res['commentaires']; ?>">
			<? else: ?>
				Commentaire: <input type="text" class="form-control" name="commentaires" value="<?php ?>">
			<? endif; ?>
		</div>

			<div class="button-group">
				<button class="btn btn-primary" name="edit_submit" type="submit">Submit</button>
				<a href="index.php" class="btn btn-info"> Cancel</a>
				
			</div>

</form>
<?php include "view/footer.php"; ?>
