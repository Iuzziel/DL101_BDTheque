<div class="row">
				<section>
								<h3 id="ajout-auteur">Ajout d'un nouvel auteur :</h3>
								<?php if (isset($msgAddAut) && $msgAddAut != '') echo "<p>$msgAddAut</p>";?>
								<form method="post" name="addAuteur">
												<span>Auteur : <input type="text" name="nomAuteur" required placeholder="Nom de l'auteur">
																<input type="submit" name="auteur" value="Ajouter"></span>
								</form>
				</section>
				<section>
								<h3 id="ajout-auteur">Supression d'un auteur :</h3>
								<form method="post">
												Auteur : <select name="id_auteur">
												<?php $rsAllAut = AuteurManager::getAllAuteur(); ?>
												<?php foreach ($rsAllAut as $autVal) : ?>
												<option value="<?=$autVal->aut_id?>"><?=$autVal->aut_nom?></option>
												<?php endforeach; ?>
												</select>
												<input type="submit" name="auteur" value="Supprimer">
								</form>
				</section>
</div><!--Fin de row-->