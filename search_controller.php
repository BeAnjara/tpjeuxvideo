
<?php 
	include "connect_to_db.php";
	include "view/header.php"; 
?>
<a href="index.php"> Retour à la page d'acceuil</a> <br>
<a href="search_view.php"> Rechercher un possesseur de jeu</a>
<? if(isset($_POST['submit'])):?>
	
	<? if (isset($_POST['possesseur']) && !empty($_POST['possesseur'])): ?>
			
		<? if(isset($_POST['triage']) && ($_POST['triage'] == 'croissant')):?>
			<? $search = $db->prepare('SELECT * FROM jeux_video WHERE possesseur = :possesseur ORDER BY prix') ?>			
		<? elseif(isset($_POST['triage']) && ($_POST['triage'] == 'decroissant')):?>
			<? $search = $db->prepare('SELECT * FROM jeux_video WHERE possesseur = :possesseur ORDER BY prix DESC') ?>
		<? else: ?>
			<? $search = $db->prepare('SELECT * FROM jeux_video WHERE possesseur = :possesseur') ?>
		<? endif;?>

		<? $search->execute(array('possesseur' => $_POST['possesseur'])) ?>
			
			
			 
		<!-- Check if possesseur already exists in database -->
		<?php 
			$exist = false;
			$result = $search->fetchAll(PDO::FETCH_ASSOC);
			foreach($result as $row => $content):
				$exist = true;
				break;
			endforeach;
		 ?>
		<? if($exist): ?>
			<table class="table">
					<thead>
						<tr>
							<th>Nom Jeux</th>
							<th>possesseur</th>
							<th>console</th>
							<th>prix</th>
							<th>Nombre Joueur max</th>
							<th>Action</th>
						</tr>
					</thead>
				<tbody>
					<? foreach($result as $row => $content): ?>
						<tr>
							<td> <?= $content['nom']; ?></td>
							<td> <?= $content['possesseur']; ?></td>
							<td> <?= $content['console']; ?></td>
							<td> <?= $content['prix']; ?></td>
							<td> <?= $content['nbre_joueurs_max']; ?></td>
							<td style="padding: 5px;">
								<div class="button-group"></div> 
									<a href="edit.php?id_edit=<?php echo $content["ID"] ?>" class="btn btn-info"> Edit</a>
									<a href="delete.php?id_delete=<?php echo $content["ID"] ?>" class="btn btn-danger"> Delete</a>
								</div>
							</td>
						</tr>
					<? endforeach; ?>
				</tbody>
			</table>

		<? else: ?>
			<div class="alert alert-danger">
				<?php echo "Le nom ". $_POST['possesseur'] . " n'existe pas dans la base"; ?>
			</div>	
		<? $search->closeCursor(); ?>
		<? endif; ?>
	<? else: ?>
		<div class="alert alert-danger">
			<?php echo "Veuillez entrer un nom"; ?>
		</div>
	<? endif;?>
<? endif;?>
<?php include "view/footer.php"; ?>
