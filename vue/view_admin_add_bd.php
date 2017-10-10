<div class="row">
				<section>
								<h3 id="ajout-bd">Ajout d'une nouvelle bande déssinée :</h3>
								<?php	if	(isset($msgUpload)	&&	$msgUpload	!=	'')	echo	"<span class=\"label label-warning\" >$msgUpload</span>";	?>
								<form method="post" enctype="multipart/form-data" name="addBD">
												<p>Titre : <input type="text" required name="titre" placeholder="Titre de la BD" /></p>
												<p>Resume : <input type="text" required name="resume" placeholder="Résumé de la BD" /></p>
												<input type="hidden" name="MAX_FILE_SIZE" value="15000000" />
												<p>Couverture (en .jpg) : <input type="file" required name="couverture" accept=".jpg"/></p>
												<p>
																Auteur : <select name="id_auteur">
																				<?php	$rsAllAut	=	AuteurManager::getAllAuteur();	?>
																				<?php	foreach	($rsAllAut	as	$autVal)	:	?>
																								<option value="<?=	$autVal->aut_id	?>"><?=	$autVal->aut_nom	?></option>
																				<?php	endforeach;	?>
																</select>
												</p>
												<p>
																Theme : <select name="id_theme">
																				<?php	$rsAllTh	=	ThemeManager::getAllTheme();	?>
																				<?php	foreach	($rsAllTh	as	$thVal)	:	?>
																								<option value="<?=	$thVal->th_id	?>"><?=	$thVal->th_intitule	?></option>
																				<?php	endforeach;	?>
																</select>
												</p>
												<input type="hidden" name="BD" value="Ajouter">
												<input type="submit" name="affichAjoutBD" value="Ajouter la BD">
								</form>
				</section>
				<section>
								<h3>Suppression d'une bande déssinée :</h3>
								<a href="index.php?choix=" class="gras">Menu d'accueil avec suppression</a>
								<p>
												Vous allez être redirigé vers la page d'accueil. En selectionnant 
												une bd vous afficherez les détails, et pourrez supprimer celle-ci 
												depuis un bouton spécifique qui s'affichera au dessus de la couverture.
								</p>
				</section>
</div><!--Fin de row-->