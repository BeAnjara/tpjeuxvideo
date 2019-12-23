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
		if(isset($_GET['id_delete'])):
			$id = triage($_GET['id_delete']);
			$req = $db->prepare('DELETE FROM jeux_video WHERE ID = :id');
			$req->execute(array(
				'id' => $id
			));
		endif;
	 ?>
<?php header('Location: index.php'); ?>
<?php include "view/footer.php"; ?>
