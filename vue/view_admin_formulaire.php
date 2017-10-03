<section>
    <form method="post" name="addAuteur">
        <span>Auteur : <input type="text" required placeholder="Nom de l'auteur">
            <input type="submit" name="auteur" value="Ajouter"></span>
    </form>
</section>
<section>
    <form method="post" action="ctl/ctl_upload.php" enctype="multipart/form-data" name="addBD">
        <span>Titre : <input type="text" required name="titre" placeholder="Titre de la BD" /></span>
        <span>Resume : <input type="text" required name="resume" placeholder="Résumé de la BD" /></span>
        <input type="hidden" name="MAX_FILE_SIZE" value="15000000" />
        <span>Couverture : <input type="file" required name="couverture" accept="image/*"/></span>
        <span>Auteur : <input type="list" required name="auteur" /></span>
            <input type="submit" name="BD" value="Ajouter">
    </form>
</section>