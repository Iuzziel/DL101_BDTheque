<section>
    <img src="img/<?= $detail_bd->bd_image ?>" 
         alt="Couverture de <?= $detail_bd->bd_titre ?>" 
         style="width:367px;height:500px;"/>
    <p>
        Titre : <?= $detail_bd->bd_titre ?> <br/>
        Auteur : <?= $detail_aut->aut_nom ?> <br/>
        Resumé : <?= $detail_bd->bd_resume; ?>
    </p>
</section>
<section id="commentaire">
<?php foreach ($rsCom as $com) : ?>
    <p>
        Auteur : <?= $com->com_auteur; ?> <br/>
        Date : <?= $com->com_date; ?> <br/>
        Commentaire : <?= $com->com_texte; ?> <br/>
    </p>
<?php endforeach; ?>
</section>