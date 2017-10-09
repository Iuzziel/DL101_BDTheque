<div class="container-fluid">
				<div class="row">
								<div class="hidden-xs col-sm-2">
												<section>
																<h4>Menu</h4><hr class="no-margin">
																<ul>
																				<li>
																								<a href="#ajout-bd">
																												<span class="fa fa-angle-double-right text-primary gras" >Gestion des BD</span>
																								</a>
																				</li>
																				<li>
																								<a href="#ajout-auteur">
																												<span class="fa fa-angle-double-right text-primary gras">Gestion des auteur</span>
																								</a>
																				</li>
																				<li>
																								<a href="#theme">
																												<span class="fa fa-angle-double-right text-primary gras">Gestion des thèmes</span>
																								</a>
																				</li>
																				<li>
																								<a href="#commentaire">
																												<span class="fa fa-angle-double-right text-primary gras">Modération des commentaires</span>
																								</a>
																				</li>
																</ul>
																<hr class="no-margin">
																<form method="post" name="connexion" action="index.php">
																				<input type="submit" name="connexion" value="Deconnexion" />
																</form>
												</section>
								</div><!--Fin Aside-->
								<div class="col-sm-9">
												<?php	require('vue/view_admin_add_bd.php');	?>
												<?php	require('vue/view_admin_add_auteur.php');	?>
												<?php	require('vue/view_admin_add_theme.php');	?>
												<?php	require('vue/view_admin_commentaire.php');	?>
								</div>
				</div><!--Fin de row-->
</div><!--Fin Container-->