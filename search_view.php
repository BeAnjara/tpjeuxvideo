<?php include "view/header.php"; ?>
<a href="index.php"> Retour à la page d'acceuil</a>
<div class="row">
		<h1 class="offset-lg-3 col-lg-6" style="text-align: center;"> Video Game Database</h1> 
		<div class="offset-lg-3 col-lg-6">
			<br><br>
			<h5> Entrez un nom de possesseur à chercher dans la base de données</h5>
			<form action="search_controller.php" method="POST">
				<div class="form-group">
					Possesseur: <input type="text" name="possesseur" id="possesseur" class="form-control">
				</div>

				<div class="form-group">
					<p> Trier les jeux par prix par ordre croissant ou decroissant: <br></p>
					<div class="form-check-inline">
						<label class="form-check-label">
							<input type="radio" class="form-check-input" name="triage" value="croissant"> Croissant
						</label>
					</div>
					<div class="form-check-inline">
						<label class="form-check-label">
							<input type="radio" class="form-check-input" name="triage" value="decroissant"> Decroissant
						</label>
					</div>
				</div>
				
			<button type="submit" class="btn btn-primary" name="submit">Submit</button>		
			</form>
		</div>
</div>
<?php include "view/footer.php"; ?>
