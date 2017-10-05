<div>
				<div class="row">
								<div class="hidden-xs col-sm-2">
												<section>
												<h4>Menu</h4><hr class="no-margin">
												<ul>
																<li>
																				<a href="#ajout-auteur">
																								<span class="fa fa-angle-double-right text-primary"></span>Ajout d'un auteur
																				</a>
																</li>
																<li>
																				<a href="#ajout-bd">
																								<span class="fa fa-angle-double-right text-primary"></span>Ajout d'une BD
																				</a>
																</li>
																<li>
																				<a href="#commentaire">
																								<span class="fa fa-angle-double-right text-primary"></span>Modération des commentaires
																				</a>
																</li>
												</ul>
								</section>
								</div><!--Fin Aside-->
								<div class="col-sm-10">
												<?php require('vue/view_admin_formulaire.php'); ?>
												<?php require('vue/view_admin_commentaire.php'); ?>
								</div>
				</div><!--Fin de row-->
</div><!--Fin Container-->