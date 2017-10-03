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
    $nouveauCom = new Commentaire();
    $varCtrlSql = 0;

    //////////////Partie Visiteur////////////
    // Vérification si on arrive d'un formulaire, et si oui alimentation des variables
    if (isset($_GET['choix'])) $sChoix = $_GET['choix'];
    if (isset($_POST['commentaire'])){
        $nouveauCom->com_bd_id = $_POST['bd_id'];
        $nouveauCom->com_auteur = $_POST['auteurCom'];
        $nouveauCom->com_texte = $_POST['textCom'];
        $varCtrlSql = CommentaireManager::setCommentaire($nouveauCom);
    }

    // Récupère l'offset par rapport a l'affichage des bd.
    if (isset($_GET['offset'])){
        if (!($_GET['offset'] < 0)) {
            $indicePageOffset = $_GET['offset'];
        }else{
            $indicePageOffset = 0;
        }
    }
    
    // Récupère le détail de la bd
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
    
    ///////////////Partie Administrateur///////////////////
    
    // Récupération du commentaire à éditer
    if (isset($_POST['comEdit']) && $_POST['comEdit'] == "Edit"){
        $tmpCom = new Commentaire();
        $tmpCom->com_id = $_POST['com_id'];
        $rsComEdit = CommentaireManager::getThisCommentaire($tmpCom);
        foreach ($rsComEdit as $rsComEditVal){
            $detail_Com->com_id = $rsComEditVal->com_id;       
            $detail_Com->com_date = $rsComEditVal->com_date;       
            $detail_Com->com_mod = $rsComEditVal->com_mod;       
            $detail_Com->com_bd_id = $rsComEditVal->com_bd_id;       
            $detail_Com->com_auteur = $rsComEditVal->com_auteur;       
            $detail_Com->com_texte = $rsComEditVal->com_texte;       
        }
    }

    // Validation de l'édition d'un commentaire
    if (isset($_POST['comEdit']) && $_POST['comEdit'] == "Valider"){
        $detail_Com->com_id = $_POST['com_id'];       
        $detail_Com->com_mod = 1;       
        $detail_Com->com_auteur = $_POST['auteurCom'];
        $detail_Com->com_texte = $_POST['texteCom'];       
        var_dump($detail_Com);
        CommentaireManager::updCommentaire($detail_Com);
        $detail_Com = new Commentaire();
    }
    // Récupère le numéro de ligne en cas de suppression ou de mise à jour
    if (($sChoix == 'Modifier') || ($sChoix == 'ModifierMAJ') || ($sChoix == 'Supprimer'))  $sNumLigne = $_GET['numLigne'];

    debug($sDebug, "\$sChoix=".$sChoix,'');

    // Partie à changer pour conditionner l'arriver sur la page admin
    if (true) {
        $rsCom = CommentaireManager::getAllCommentaire();
    }
    
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
            require('vue/view_admin_commentaire.php');
            //require('vue/view_accueil.php');
    }
?>