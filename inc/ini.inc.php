<?php

// Fonction : recupParam
// Desc : Lit le contenu du fichier de paramètres
//        Ce fichier doit contenir des lignes sous la forme : cle=valeur
// IN : Le fichier de paramètre avec son chemin
// OUT : Le tableau associatif des clé=valeur
function	recupParam($sFilePath)	{
				// Initialise les variables
				$tContentFile;
				$tLine	=	'';
				$taParam	=	array();

				// Controle la presence du fichier de paramètres
				if	(!file_exists($sFilePath)	||	!is_file($sFilePath))	{
								echo	'Erreur "recupParam()", Chemin de la source invalide ou fichier inexistant.';
								return	null;
				}	else	{
								// Lecture du contenu du fichier
								$sContentFile	=	file($sFilePath);
								for	($i	=	0;	$i	<	count($sContentFile);	$i++)	{
												$tLine	=	explode('=',	$sContentFile[$i]);
												$taParam[$tLine[0]]	=	$tLine[1];
								}
								return	$taParam;
				}
}

?>