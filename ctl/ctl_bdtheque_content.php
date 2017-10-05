<?php
    // Appel des fonctions externes
    include_once ('inc/modele.inc.php');
    include_once ('exp/mysqlexception.php');
    include_once ('dao/Connexion.php');
    include_once ('cls/Auteur.class.php');
    include_once ('dao/AuteurManager.php');
    include_once ('cls/BandeDessinee.class.php');
    include_once ('dao/BandeDessineeManager.php');
    include_once ('cls/Commentaire.class.php');
    include_once ('dao/CommentaireManager.php');
    include_once ('cls/Membre.class.php');
    include_once ('dao/MembreManager.php');

    // Initialisation des variables
    $sChoix  = 'accueil';
    $sTitre2 = 'Bienvenu sur la BDThèque';
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
    if ($sChoix == 'detail'){
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
				//Verif si la connexiont est deja active
				if(isset($_SESSION['logon']) && $_SESSION['logon'] == 'ok' && $sChoix == 'login'){
								$sChoix = 'admin';
				}else if (isset($_POST['connexion']) && $_POST['connexion'] == 'Valider'){
								// Validation de la connexion
        $tmpMembre = new Membre();
        $tmpMembre->pseudo = $_POST['login'];
        $tmpMembre->mdp = $_POST['password'];
        
        $tmpLogin = MembreManager::verifLogin($tmpMembre);

        if ($tmpLogin == 1){
            $msgLogin = "Authentification réussi.";
            $_SESSION['logon'] = 'ok';
            $sChoix = 'admin';
        } else {
            $_SESSION['logon'] = 'nok';
            $msgLogin = "Echec de l'authentification";
            $sChoix = 'login';
        }
    }
				
    //Deconnexion
				if (isset($_POST['connexion']) && $_POST['connexion'] == 'Deconnexion'){
								$_SESSION['logon'] = 'nok';
								session_destroy();
				}
				
    // Validation d'un commentaire
    if (isset($_POST['comMod']) && $_POST['comMod'] == "Valider"){
        $detail_Com->com_id = $_POST['com_id'];            
        $rsComEdit = CommentaireManager::getThisCommentaire($detail_Com);
        foreach ($rsComEdit as $rsComVal){
            $detail_Com->com_id = $rsComVal->com_id;       
            $detail_Com->com_date = $rsComVal->com_date;       
            $detail_Com->com_mod = 1;       
            $detail_Com->com_bd_id = $rsComVal->com_bd_id;       
            $detail_Com->com_auteur = $rsComVal->com_auteur;       
            $detail_Com->com_texte = $rsComVal->com_texte;       
        }
        CommentaireManager::updCommentaire($detail_Com);
        $detail_Com = new Commentaire();
    }
    
    // Récupération du commentaire à éditer
    if (isset($_POST['comMod']) && $_POST['comMod'] == "Edit"){
								$sChoix = 'admin';
        $tmpCom = new Commentaire();
        $detail_Com->com_id = $_POST['com_id'];
        $rsComEdit = CommentaireManager::getThisCommentaire($detail_Com);
        foreach ($rsComEdit as $rsComEditVal){
            $detail_Com->com_id = $rsComEditVal->com_id;       
            $detail_Com->com_date = $rsComEditVal->com_date;       
            $detail_Com->com_mod = $rsComEditVal->com_mod;       
            $detail_Com->com_bd_id = $rsComEditVal->com_bd_id;       
            $detail_Com->com_auteur = $rsComEditVal->com_auteur;       
            $detail_Com->com_texte = $rsComEditVal->com_texte;       
        }
    }

    // Suppression d'un commentaire
    if (isset($_POST['comMod']) && $_POST['comMod'] == "Supprimer"){
        $detail_Com->com_id = $_POST['com_id'];            
        CommentaireManager::delCommentaire($detail_Com);
        $detail_Com = new Commentaire();
    }
    
    // Validation de l'édition d'un commentaire
    if (isset($_POST['comEdit']) && $_POST['comEdit'] == "Valider"){
        $detail_Com->com_id = $_POST['com_id'];       
        $detail_Com->com_mod = 1;       
        $detail_Com->com_auteur = $_POST['auteurCom'];
        $detail_Com->com_texte = $_POST['texteCom'];       
        CommentaireManager::updCommentaire($detail_Com);
        $detail_Com = new Commentaire();
    }
    
    // Ajout d'une BD
    if (isset($_POST['BD']) && $_POST['BD'] == 'Ajouter') {
        $uploaddir = 'img/';
        $uploadfile = $uploaddir . $_FILES['couverture']['name'];
        $msgUpload = '';
        
        if (move_uploaded_file($_FILES['couverture']['tmp_name'], $uploadfile)) {
            $bdTemp = new BandesDessinee();
            $bdTemp->bd_titre = $_POST['titre'];
            $bdTemp->bd_resume = $_POST['resume'];
            $bdTemp->bd_auteur_id = $_POST['id_auteur'];
            $bdTemp->bd_image = $_FILES['couverture']['name'];
            BandeDessineeManager::setBandeDessinee($bdTemp);
            $msgUpload = "Ajout de la BD réussi.";
												$sChoix = 'admin';
        } else {
            $msgUpload = 'Erreur upload impossible.';
												$sChoix = 'admin';
        }
    }
    
    // Ajout d'un auteur
    if (isset($_POST['auteur']) && $_POST['auteur'] == 'Ajouter') {
        $msgAddAut = '';
        $addAuteur = new Auteur();
        $addAuteur->aut_nom = $_POST['nomAuteur'];
        try{
            AuteurManager::setAuteur($addAuteur);
            $msgAddAut = 'Ajout réussi.';
        } catch (Exception $ex) {
            $msgAddAut = 'Erreur.';
        }
    }
    
    debug($sDebug, "\$sChoix=".$sChoix,'');
    
    // Traitement des données
    switch ($sChoix) {
        case 'detail' :
            $sTitre2 = 'Détail de la BD';
            break;
        case 'login' :
            $sTitre2 = 'Connexion';
            break;
        case 'admin' :
            $sTitre2 = 'Partie Administrateur';
            $rsCom = CommentaireManager::getAllCommentaire();
            break;
        default :
            $affichageListBD = BandeDessineeManager::getHowManyBD(5, $indicePageOffset);      
    }

    // Choix de l'affichage
    switch ($sChoix) {
        case 'detail' :
            require('vue/view_detail.php');
            break;
        case 'login' :
            require('vue/view_login.php');
            break;
        case 'admin' :
            require('vue/view_admin_aside.php');
            break;
        default :
            require('vue/view_accueil.php');
    }
?>