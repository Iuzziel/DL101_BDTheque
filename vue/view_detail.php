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
    <table>
<?php foreach ($rsCom as $com) : ?>
    <?php if ($com->com_mod == 1) : ?>
        <tr>
            <td>Auteur : <?= $com->com_auteur; ?> </td>
            <td>Date : <?= $com->com_date; ?> </td>
            <td>Commentaire : <?= $com->com_texte; ?> </td>
        </tr>
    <?php endif; ?>
<?php endforeach; ?>
    </table>
</section>