<?php
    // Appel des fonctions externes
    include_once('inc/modele.inc.php');
    include_once ('dao/Connexion.php');
    include_once ('cls/BandeDessinee.class.php');
    include_once ('dao/BandeDessineeManager.php');

    // Initialisation des variables
    $sChoix  = 'accueil';
    $sTitre2 = 'Sous Titre par defaut';

    if (isset($_GET['choix'])) $sChoix = $_GET['choix'];

    // Récupère les coordonnées de l'abonné en cas d'ajout ou de mise à jour
    if (($sChoix == 'ajouterMAJ') 
            || ($sChoix == 'gestionAbonneMAJ') 
            || ($sChoix == 'Modifier') 
            || ($sChoix == 'ModifierMAJ') 
            || ($sChoix == 'Supprimer')){
        $sNom = strtoupper($_GET['nom']);
        $sPrenom = ucfirst($_GET['prenom']);
        $sTelephone = $_GET['telephone'];
    }

    // Récupère le numéro de ligne en cas de suppression ou de mise à jour
    if (($sChoix == 'Modifier') || ($sChoix == 'ModifierMAJ') || ($sChoix == 'Supprimer'))  $sNumLigne = $_GET['numLigne'];

    debug($sDebug, "\$sChoix=".$sChoix,'');

    // Traitement des données
    switch ($sChoix) {
        case 'abonnes1' :
            debug($sDebug, $sFileData,"");
            $sTitre2 = 'Ajout d\'un abonné';
            break;
    }

    // Choix de l'affichage
    switch ($sChoix) {
        case 'abonnes1' :
            require('vue/view_abonnes1.php');
            break;

        default :
            $affichageListBD = BandeDessineeManager::getHowManyBD(5, 0);
            require('vue/view_accueil.php');
}
?>