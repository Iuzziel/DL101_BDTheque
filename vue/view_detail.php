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
    <?php if ($varCtrlSql != NULL) echo '<p>Commentaire bien enregistré, en attente de modération</p>'; ?>
    <table>
        <form method="post" action="">
            <input type="hidden" name="bd_id" value="<?= $detail_bd->bd_id ?>" />
            <tr>
                <td><input type="submit" name="commentaire" value="envoyer"/></td>
                <td>Auteur : <input type="text" name="auteurCom" required placeholder="Votre nom" /></td>
                <td>Commentaire : <input type="text" name="textCom" required placeholder="Votre commentaire" /></td>
            </tr>
        </form>
<?php foreach ($rsCom as $com) : ?>
    <?php if ($com->com_mod == 1) : ?>
        <tr>
            <td>Date : <?= $com->com_date; ?> </td>
            <td>Auteur : <?= $com->com_auteur; ?> </td>
            <td>Commentaire : <?= $com->com_texte; ?> </td>
        </tr>
    <?php endif; ?>
<?php endforeach; ?>
    </table>
</section>