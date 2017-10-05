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
<div class="row">
				<section>
								<h3 id="ajout-bd">Ajout d'une nouvelle bande déssinée :</h3>
								<?php if (isset($msgUpload) && $msgUpload != '') echo "<p>$msgUpload</p>";?>
								<form method="post" enctype="multipart/form-data" name="addBD">
												<span>Titre : <input type="text" required name="titre" placeholder="Titre de la BD" /></span>
												<span>Resume : <input type="text" required name="resume" placeholder="Résumé de la BD" /></span>
												<input type="hidden" name="MAX_FILE_SIZE" value="15000000" />
												<span>Couverture : <input type="file" required name="couverture" accept="image/*"/></span>
												<span>
																Auteur : <select name="id_auteur">
																<?php $rsAllAut = AuteurManager::getAllAuteur(); ?>
																<?php foreach ($rsAllAut as $autVal) : ?>
																<option value="<?=$autVal->aut_id?>"><?=$autVal->aut_nom?></option>
																<?php endforeach; ?>
																</select>
												</span>
												<input type="submit" name="BD" value="Ajouter">
								</form>
				</section>
</div><!--Fin de row-->