<ul>
<?php foreach ($affichageListBD as $bd) : ?>
    <form action="" method="get">
        <button type="submit" name="detail" value="<?= $bd->bd_id ?>">
            <img src="img/<?= $bd->bd_image ?>" alt="Couverture de <?= $bd->bd_titre ?>" style="width:367px;height:500px;"/>
        </button>
        <li>
            Titre : <?= $bd->bd_titre ?> <br/>
            Auteur : <?= $bd->bd_auteur_id ?> <br/>
            Resumé : <?= $bd->bd_resume; ?>
        </li>
    </form>
<?php endforeach; ?>
</ul>
