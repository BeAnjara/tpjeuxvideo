
<?php 
	include "connect_to_db.php";
	include "view/header.php";
	session_start(); 
?>

<a href="search_view.php"> Chercher un possesseur de jeu </a> <br>
<a href="create_view.php"> Créer un possesseur de jeu</a>
<?php 
	if($_SESSION && $_SESSION['Update']):
		echo "<p class=\"alert alert-success\">". $_SESSION['Update'] . "</p>";
	endif;

	session_unset();
	session_destroy();
 ?>

<?php 
	$req = $db->query('SELECT * FROM jeux_video');
	$alldata = $req->fetchAll(PDO::FETCH_ASSOC);
 ?>

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
	<? foreach($alldata as $row => $linedata): ?>
		<tr>
			<td> <?php echo $linedata['nom']; ?></td>
			<td> <?php echo $linedata['possesseur']; ?></td>
			<td> <?php echo $linedata['console']; ?></td>
			<td> <?php echo $linedata['prix']; ?></td>
			<td> <?php echo $linedata['nbre_joueurs_max']; ?></td>
			<td style="padding: 5px;">
				<div class="button-group"></div> 
					<a href="edit.php?id_edit=<?php echo $linedata["ID"] ?>" class="btn btn-info"> Edit</a>
					<a href="delete.php?id_delete=<?php echo $linedata["ID"] ?>" class="btn btn-danger delete" id="item_<?php echo $linedata["ID"] ?>"> Delete</a>
				</div>
			</td>
		</tr>
	<?endforeach;?>

	</tbody>
</table>
<?php include "view/footer.php"; ?>
















