<section>
    <h2><?= $sTitre2 ?></h2>
</section>
<section>
    <form method="post" name="connexion" action="index.php">
        <span>Login : <input type="text" name="login" required/></span>
        <span>Password : <input type="password" name="password" required/></span>
        <input type="submit" name="connexion" value="Valider" />
    </form>
    <?php if (isset($msgLogin) && $msgLogin == "Echec de l'authentification") 
        echo "<span>$msgLogin</span>" ; ?>
</section>