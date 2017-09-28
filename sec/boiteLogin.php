<?php

if (session_status() !== PHP_SESSION_ACTIVE) {
    session_start();
}

$_SESSION['msg'] = "";

if (isset($_POST['pseudo']) && !empty($_POST['pseudo']) &&
        isset($_POST['mdp']) && !empty($_POST['mdp'])) {

    $_SESSION['pseudo'] = $_POST['pseudo'];
    

    require 'dao/Connexion.php';
    require 'dao/MembreManager.php';
    require 'dao/Membre.php';
    require 'exception/MySQLException.php';

    try {
        $membre = new \Membre(
                array("pseudo" => $_POST['pseudo'],
            "mdp" => $_POST['mdp']));

        $result = MembreManager::verifLogin($membre);

        if ($result->rowCount() == 1) {
            $_SESSION['auth'] = TRUE;
            $_SESSION['msg'] = "Vous êtes connecté.";
            $membre = $result->fetch(PDO::FETCH_OBJ);
            $_SESSION['membre'] = $membre->prenom . ' ' . $membre->nom;
        } else {
            $_SESSION['auth'] = FALSE;
            $_SESSION['msg'] = "Erreur d'authentification !";
        }
    } catch (MySQLException $e) {
        die($e->retourneErreur());
    }
}
?>
<div id = "btLogin">
    <?php
    if (isset($_SESSION['membre']))
        echo "Bonjour, " . $_SESSION['membre'];
    else
        echo 'Connexion :';
    ?>
    <img src="images/btLogout.png" 
         <?php if (isset($_SESSION['auth']) && $_SESSION['auth']) { ?>
         title="Se déconnecter" 
         <?php } else { ?>
         title="Se connecter" 
         <?php } ?>
         onclick="afficheLogin(document.getElementById('boiteDialogue'))">
</div>
<!-- Une boîte de dialogue -->
<?php
if (isset($_SESSION['auth']) && $_SESSION['auth']) {

// Boite de déconnexion  
    ?>
    <div id="boiteDialogue">
        <img alt="Fermer" src="images/croix.png" title="Fermer" onclick="afficheLogin(document.getElementById('boiteDialogue'))">
        <form action="securite/logout.php" method="POST">
            <fieldset><legend>Membre</legend>
                <div id ="BDcontenu">
                    <label for="pseudo">Vous êtes connecté avec le pseudo : 
                        <?php if (isset($_SESSION['pseudo'])) echo $_SESSION['pseudo']; ?>
                    </label><br><br>
                    <input type="submit" name="Deconnecter" value="déconnexion"/>
                </div>
            </fieldset>
        </form>
    </div>
    <?php
} else {
    // boite de connexion
    ?>
    <div id="boiteDialogue">
        <img alt="Fermer" src="images/croix.png" title="Fermer" onclick="afficheLogin(document.getElementById('boiteDialogue'))">
        <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="POST">
            <fieldset><legend>Connexion</legend>
                <div id ="BDcontenu">
                    <label for="pseudo">Pseudo :</label> 
                    <input name="pseudo" type="text" 
                           value="<?php if (isset($_SESSION['pseudo'])) echo $_SESSION['pseudo']; ?>" 
                           required="required"/><br />
                    <label for="mdp">Mot de passe :</label>
                    <input name="mdp" type="password" 
                           value="" 
                           required="required"/><br />
                    <label name="msg">
                        <?php if (isset($_SESSION['msg'])) echo $_SESSION['msg']; ?> 
                    </label>
                    <input type="submit" name="Connecter" value="connecter"
                           onclick="
                               mdp=document.getElementById('mdp');
                               mdp.value = CryptoJS.MD5(mdp.value);
                               return true;
                           "/>
                </div>
            </fieldset>
        </form>
    </div>
    <?php
}
?>
<script type="text/javascript" src="js/fonction.js"></script>
<script type="text/javascript" src="http://crypto-js.googlecode.com/svn/tags/3.1.2/build/rollups/md5.js"></script>
<?php
// Si on revient de la boite de connexion et que ca a échoué, on la réaffiche
if (isset($_POST['Connecter']) && 
        (!isset($_SESSION['auth']) ||
         isset($_SESSION['auth']) && !$_SESSION['auth']))
    echo "<script>afficheLogin(document.getElementById('boiteDialogue'));</script>";
?>
