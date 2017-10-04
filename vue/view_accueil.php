<section>
    <h2><?= $sTitre2 ?></h2>
</section>
<p>
    <form action="" method="get">
        <input type="submit" name="choix" value="login" />
    </form>
</p>
<ul>
<?php foreach ($affichageListBD as $bd) : ?>
    <form action="" method="get">
        <input type="hidden" name="choix" value="detail" />
        <button type="submit" name="bd_id" value="<?= $bd->bd_id ?>">
            <img src="img/<?= $bd->bd_image ?>" 
                 alt="Couverture de <?= $bd->bd_titre ?>" 
                 style="width:100px;height:136px;"/>
        </button>
        <li>
            Auteur : <?= $aut = AuteurManager::getAuteurNom($bd->bd_auteur_id);?> <br/>
            Titre : <?= $bd->bd_titre ?> <br/>
        </li>
    </form>
<?php endforeach; ?>
</ul>
<form method="get" action="">
    <input type="hidden" name="offset" value="<?= $indicePageOffset - 5 ?>" />
    <input type="submit" value="Précédent" />
</form>
<form method="get">
    <input type="hidden" name="offset" value="<?= $indicePageOffset + 5 ?>" />
    <input type="submit" value="Suivant" />
</form>