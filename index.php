<?php 
	try 
	{
		$db = new PDO ('mysql:host=localhost;dbname=videogame', 'root', '', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
	} 
	catch (Exception $e)
	{
		die('Erreur : '.$e->getMessage());
	}
 ?>
<!DOCTYPE html>
<html>
<head>
	<title>Jeu vidéo</title>
	<meta charset="utf-8">
	<link rel="stylesheet" href="css/bootstrap.min.css">
</head>
<body>

<div class="container">
	<form action="./index.php" method="POST">
		<div class="form-group">
			Possesseur: <input type="text" name="possesseur" id="possesseur" class="form-control">
		</div>
		
	<button type="submit" class="btn btn-primary" name="submit">Submit</button>		
	</form>

<? if(isset($_POST['submit'])):?>
	<? if (isset($_POST['possesseur']) && !empty($_POST['possesseur'])): ?>
			<? $search = $db->prepare('SELECT * FROM jeux_video WHERE possesseur = :possesseur') ?>
			<? $search->execute(array('possesseur' => $_POST['possesseur'])) ?>
			<? $exist = false ?>
			<table class="table">
				<thead>
					<tr>
						<th>Nom Jeux</th>
						<th>possesseur</th>
						<th>console</th>
						<th>prix</th>
						<th>Nombre Joueur max</th>
					</tr>
				</thead>
				<tbody>	
			<? while($result = $search->fetch()):?>
				<? $exist = true ?>

				<tr>
					<td> <?= $result['nom']; ?></td>
					<td> <?= $result['possesseur']; ?></td>
					<td> <?= $result['console']; ?></td>
					<td> <?= $result['prix']; ?></td>
					<td> <?= $result['nbre_joueurs_max']; ?></td>
				</tr>
			<? endwhile; ?>

			<? if ( $exist == false):?>
				<div class="alert alert-danger">
					<?php echo "Le nom ". $_POST['possesseur'] . " n'existe pas dans la base"; ?>
				</div>
			<? endif;?>

				</tbody>
			</table>
	<? else: ?>
		<div class="alert alert-danger">
					<?php echo "Veuillez entrer un nom"; ?>
				</div>
	<? $search->closeCursor(); ?>
	<? endif;?>		
<? endif;?>
</div>



















<script src="js/jquery-3.3.1.min.js"></script>
<script src="js/popper.min.js"></script>
<script src="js/bootstrap.min.js"></script>
</body>
</html>