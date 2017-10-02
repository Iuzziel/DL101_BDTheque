<?php
    // Appel des fonctions externes
    include_once('inc/modele.inc.php');
    include_once('exp/mysqlexception.php');
    include_once ('dao/Connexion.php');
    include_once ('cls/Auteur.class.php');
    include_once ('dao/AuteurManager.php');
    include_once ('cls/BandeDessinee.class.php');
    include_once ('dao/BandeDessineeManager.php');
    include_once ('cls/Commentaire.class.php');
    include_once ('dao/CommentaireManager.php');

    // Initialisation des variables
    $sChoix  = 'accueil';
    $sTitre2 = 'Sous Titre par defaut';
    $detail_bd = new BandesDessinee();
    $detail_aut = new Auteur();
    $detail_tCom = Array();
    $detail_Com = new Commentaire();
    $indicePageOffset = 0;

    if (isset($_GET['choix'])) $sChoix = $_GET['choix'];
    
    // Récupère l'offset par rapport a l'affichage des bd.
    if (isset($_GET['offset'])){
        if (!($_GET['offset'] < 0)) {
            $indicePageOffset = $_GET['offset'];
        }else{
            $indicePageOffset = 0;
        }
    }
    
    // Récupère les coordonnées de l'abonné en cas d'ajout ou de mise à jour
    if (($sChoix == 'detail') 
            || ($sChoix == 'gestionAbonneMAJ')){
        $detail_bd->bd_id = $_GET['bd_id'];
        $rsBD = BandeDessineeManager::getBandeDessinee($detail_bd);
        foreach ($rsBD as $rsBDValue){
            $detail_bd->bd_id = $rsBDValue->bd_id;
            $detail_bd->bd_titre = $rsBDValue->bd_titre;
            $detail_bd->bd_resume = $rsBDValue->bd_resume;
            $detail_bd->bd_image = $rsBDValue->bd_image;
            $detail_bd->bd_auteur_id = $rsBDValue->bd_auteur_id;
        }
        
        $detail_aut->aut_id = $detail_bd->bd_auteur_id;
        
        $rsAut = AuteurManager::getAuteur($detail_aut);
        foreach ($rsAut as $rsAutValue){
            $detail_aut->aut_id = $rsAutValue->aut_id;
            $detail_aut->aut_nom = $rsAutValue->aut_nom;
        }
        
        $rsCom = CommentaireManager::getCommentaire($detail_bd);
    }

    // Récupère le numéro de ligne en cas de suppression ou de mise à jour
    if (($sChoix == 'Modifier') || ($sChoix == 'ModifierMAJ') || ($sChoix == 'Supprimer'))  $sNumLigne = $_GET['numLigne'];

    debug($sDebug, "\$sChoix=".$sChoix,'');

    // Traitement des données
    switch ($sChoix) {
        case 'detail' :
            $sTitre2 = 'Détail de la BD';
            break;
        default :
            $affichageListBD = BandeDessineeManager::getHowManyBD(5, $indicePageOffset);      
    }

    // Choix de l'affichage
    switch ($sChoix) {
        case 'detail' :
            require('vue/view_detail.php');
            break;
        default :
            require('vue/view_accueil.php');
    }
?>