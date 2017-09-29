<?php
	// Fonction : getAnnuaireContent
	// Desc : Lit le contenu du fichier sources
	//        Ce fichier doit contenir des lignes comprenant 3 champs séparés par des ';'
	// IN : Le fichier de données (abonnés) avec son chemin
	// OUT : La liste des abonnés
    function getAnnuaireContent($sFilePath){
        // Controle la présence du fichier sources
        if (!file_exists($sFilePath) || !is_file($sFilePath)){	
            echo 'Erreur "getAnnuaireContent()", Chemin de la source invalide ou fichier inexistant.';
            return null;
        }else{
         // Lecture du contenu du fichier
            $tContentFile = file($sFilePath);
            for ($i=0; $i<count($tContentFile); $i++) {
                $tListe[] = explode(';', $tContentFile[$i]);
            }
            return $tListe;
        }
    }
				
				function ajouterMAJ($sFileData, $sNom, $sPrenom, $sTelephone){
								if (!file_exists($sFileData) || !is_file($sFileData)){	
												echo 'Erreur "getAnnuaireContent()", Chemin de la source invalide ou fichier inexistant.';
												return FALSE;
								}else{
												$file = fopen($sFileData,	"a");
												fwrite($file,	"\r\n".$sNom.";".$sPrenom.";".$sTelephone);
												fclose($file);
												return TRUE;
        }
				}
				
				function recherche($sFileData, $sNom, $sPrenom, $sTelephone){
								foreach ($sFileData as $num_ligne => $lignes){
												$ligne = explode(";", $lignes);
												$premiereRech = TRUE;
												foreach ($ligne as $key1 => $segment) {
																if($key1 == 0 && $sNom != ""){
																				if(strcasecmp(substr($segment, 0, strlen($sNom)), $sNom) == 0 && $premiereRech){
																								$lignRepOk[$i] = $lignes;
																								$tabResultLigne[$i] = $num_ligne;
																								$i++;
																								$premiereRech = FALSE;
																				}
																}elseif($key1 == 1 && $sPrenom != ""){
																				if(strcasecmp(substr($segment, 0, strlen($sPrenom)), $sPrenom) == 0 && $premiereRech){
																								$lignRepOk[$i] = $lignes;
																								$tabResultLigne[$i] = $num_ligne;
																								$i++;
																								$premiereRech = FALSE;
																				}
																}elseif($key1 == 2 && $sTelephone != ""){
																				if(strcasecmp(substr($segment, 0, strlen($sTelephone)), $sTelephone) == 0 && $premiereRech){
																								$lignRepOk[$i] = $lignes;
																								$tabResultLigne[$i] = $num_ligne;
																								$i++;
																								$premiereRech = FALSE;                    
																				}
																};
												};
								};
								return $tabResultLigne;
				};
?>