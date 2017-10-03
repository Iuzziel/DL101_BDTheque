<section>
    <table>
        <?php if ($detail_Com->com_id > 0) : ?>
        <form method="post" name="comEdit">
            <tr>
                <td>Date : <?= $detail_Com->com_date; ?> </td>
                <td><input type="submit" name="comEdit" value="Valider"/></td>
                <td>Auteur : <input type="text" name="auteurCom" required value="<?= $detail_Com->com_auteur ?>" /></td>
                <td>Commentaire : <input type="text" name="texteCom" required value="<?= $detail_Com->com_texte ?>" /></td>
                <input type="hidden" name="com_id" value="<?= $detail_Com->com_id ?>" />
            </tr>
        </form>
        <?php endif; ?>
<?php foreach ($rsCom as $com) : ?>
    <?php if ($com->com_mod == 0) : ?>
        <tr>
            <form method="post" name="comMod">
                <td>Date : <?= $com->com_date; ?></td>
                <td>Auteur : <?= $com->com_auteur; ?></td>
                <td>
                    <input type="submit" name="comEdit" value="Valider"/>
                    <input type="submit" name="comEdit" value="Edit"/>
                    <input type="submit" name="comEdit" value="Supprimer"/>
                </td>
                <td>Commentaire : <?= $com->com_texte; ?></td>
                <input type="hidden" name="com_id" value="<?= $com->com_id ?>" />
            </form>
        </tr>
    <?php endif; ?>
<?php endforeach; ?>
    </table>
</section>
