<div class="row">
				<section>
								<h3 id="ajout-bd">Ajout d'une nouvelle bande déssinée :</h3>
								<?php if (isset($msgUpload) && $msgUpload != '') echo "<p>$msgUpload</p>";?>
								<form method="post" enctype="multipart/form-data" name="addBD">
												<p>Titre : <input type="text" required name="titre" placeholder="Titre de la BD" /></p>
												<p>Resume : <input type="text" required name="resume" placeholder="Résumé de la BD" /></p>
												<input type="hidden" name="MAX_FILE_SIZE" value="15000000" />
												<p>Couverture : <input type="file" required name="couverture" accept="image/*"/></p>
												<p>
																Auteur : <select name="id_auteur">
																<?php $rsAllAut = AuteurManager::getAllAuteur(); ?>
																<?php foreach ($rsAllAut as $autVal) : ?>
																<option value="<?=$autVal->aut_id?>"><?=$autVal->aut_nom?></option>
																<?php endforeach; ?>
																</select>
												</p>
												<input type="hidden" name="BD" value="Ajouter">
												<input type="submit" name="affichAjoutBD" value="Ajouter la BD">
								</form>
				</section>
</div><!--Fin de row-->