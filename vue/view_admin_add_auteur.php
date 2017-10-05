<div class="row">
				<section>
								<h3 id="ajout-auteur">Ajout d'un nouvel auteur :</h3>
								<?php if (isset($msgAddAut) && $msgAddAut != '') echo "<p>$msgAddAut</p>";?>
								<form method="post" name="addAuteur">
												<span>Auteur : <input type="text" name="nomAuteur" required placeholder="Nom de l'auteur">
																<input type="submit" name="auteur" value="Ajouter"></span>
								</form>
				</section>
</div><!--Fin de row-->