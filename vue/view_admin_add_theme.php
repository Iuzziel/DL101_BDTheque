<div class="row">
				<section>
								<h3 id="theme">Ajout d'un theme à une bande déssinée :</h3>
								<?php	if	(isset($msgAddBDTh)	&&	$msgAddBDTh	!=	'')	echo	"<span class=\"label label-warning\" >$msgAddBDTh</span>";	?>
								<form method="post" name="addBDTheme">
												<p>
																BD auquel vous voulez ajouter un thème : <select name="id_bd">
																				<?php	$rsAllBD	=	BandeDessineeManager::getAllBandesDessinees();	?>
																				<?php	foreach	($rsAllBD	as	$bdVal)	:	?>
																								<option value="<?=	$bdVal->bd_id	?>"><?=	$bdVal->bd_titre	?></option>
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
												<input type="hidden" name="addBDTheme" value="Ajouter">
												<input type="submit" name="affichAjoutBD" value="Ajouter le Thème à la BD">
								</form>
				</section>
				<section>
								<h3>Suppression d'un theme lié à une bande déssinée :</h3>
								<?php	if	(isset($msgDelBDTh)	&&	$msgDelBDTh	!=	'')	echo	"<span class=\"label label-warning\" >$msgAddBDTh</span>";	?>
								<form method="post" name="delBDTheme">
												<p>
																BD auquel vous voulez supprimer un thème : <select name="id_bd" id="selectBD">
																				<?php	$rsAllBD	=	BandeDessineeManager::getAllBandesDessinees();	?>
																				<?php	foreach	($rsAllBD	as	$bdVal)	:	?>
																								<option value="<?=	$bdVal->bd_id	?>"><?=	$bdVal->bd_titre	?></option>
																				<?php	endforeach;	?>
																</select>
												</p>
												<p><!--Inserer du javascript pour rendre la combo reactive au choix de la bd-->
																Theme : <select name="id_theme" id="selectTheme"></select>
												</p>
												<input type="hidden" name="delBDTheme" value="Supprimer">
												<input type="submit" name="affichAjoutBD" value="Supprimer le Thème lié a cette BD">
								</form>
				</section>
				<script type="text/JavaScript" language="JavaScript" src="svc/svc_ajax.js"></script>
</div><!--Fin de row-->