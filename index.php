<?php
	// Appel des fonctions externes
	include_once('inc/ini.inc.php');
	include_once('inc/vue.inc.php');
	
	// Initialisation des variables
	$sDebug = 0;
	$sTitre = 'Titre par défaut';
	$sTitrePage = 'Titre de la page par Défaut';
	$sFileIni = 'ini/html.ini.php';
	$taParam = array(); // Tableau associatif des parametres
	$sFileData = '';
	
	// Récupération des paramètres
	$taParam = recupParam($sFileIni);		
	
	// Contrôle des paramètres
	//if (isset($taParam['titre']) && isset($taParam['titrePage']) && isset($taParam['source']) && isset($taParam['fichier']) && isset($taParam['DEBUG']))
	if ( isset($taParam['titrePage']) ){
            $sFileData = trim($taParam['source']).trim($taParam['fichier']);
	}else{
            echo 'Le fichier : "'.$sFileIni.'" ne contient pas tous les paramètres.';	
	}

	$sDebug = $taParam['DEBUG'];  // 0 ou 1
	
	debug($sDebug, "\$taParam", $taParam); // print_r($taParam);
	
	// Mise à jour des titres
	if ( isset($taParam['titre']) ){
            $sTitre = $taParam['titre'];
	}
	if ( isset($taParam['titrePage']) ){
            $sTitrePage = $taParam['titrePage'];
	}
        
        // Ouverture de la session
        if (session_status() != PHP_SESSION_ACTIVE) {
            session_start();
        }

	// Appel des vues
	require('vue/view_header.php');
	require('ctl/ctl_bdtheque_content.php'); // Appel du controleur accueil
	require('vue/view_footer.php');
?>	
	
