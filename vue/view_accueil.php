<form action="" method="get">
				<input type="hidden" name="choix" value="login" />
				<input type="submit" name="affChoixLog" value="Administration" />
</form>
				
<div class="container">
				<div class="row">
								<ul>
								<?php foreach ($affichageListBD as $bd) : ?>
												<div class="col-lg-4 col-sm-6">
																<form action="" method="get">
																				<input type="hidden" name="choix" value="detail" />
																				<button id="btnCouv" type="submit" name="bd_id" value="<?= $bd->bd_id ?>">
																								<img src="img/<?= $bd->bd_image ?>" 
																													alt="Couverture de <?= $bd->bd_titre ?>" 
																													style="width:100px;height:136px;"/>
																				</button>
																				<li>
																								Auteur : <?= $aut = AuteurManager::getAuteurNom($bd->bd_auteur_id);?> <br/>
																								Titre : <?= $bd->bd_titre ?> <br/>
																				</li>
																</form>
												</div><!--Fin de Col-->
								<?php endforeach; ?>
								</ul>
				</div><!--Fin de Row-->

				<div class="row">
								<div class="col-sm-4">
												<form method="get" action="">
																<input type="hidden" name="offset" value="<?= $indicePageOffset - 5 ?>" />
																<input type="submit" value="Précédent" />
												</form>
								</div><!--Fin de Col-->
								<div class="col-sm-4">
												<span>Page - <?= (($indicePageOffset / 5) + 1) ?></span>
								</div><!--Fin de Col-->
								<div class="col-sm-4">
												<form method="get">
																<input type="hidden" name="offset" value="<?= $indicePageOffset + 5 ?>" />
																<input type="submit" value="Suivant" />
												</form>
								</div><!--Fin de Col-->
				</div><!--Fin de Row-->
				
</div><!--Fin de Container-->