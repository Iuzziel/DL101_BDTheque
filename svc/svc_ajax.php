<?php

header('Content-Type: text/html; charset=utf-8');
header('Access-Control-Allow-Origin: *');

if	(!isset($_REQUEST['req']))	{
				die("Le silence est d'or ...");
}	else	{
				include_once('../inc/ini.inc.php');
				//include_once('inc/vue.inc.php');
				require("../exp/mysqlexception.php");
				require("../dao/Connexion.php");
				require("../dao/ThemeManager.php");

				if	($_REQUEST['req']	==	'themes')	{
								if	(isset($_REQUEST['id_bd']))	{
												$tmpId_bd	=	$_REQUEST['id_bd'];
												$rs	=	ThemeManager::getBdTheme($tmpId_bd);
								}	else	{
												die("Le silence est d'or ...");
								}
				}

				if	(!$rs)	{
								print	"PDO::errorInfo():";
								$msg	=	$base->errorInfo();
								print	$msg[2]	.	"<br />";
								die("Arret du traitement");
				}
				if	(!$rs)	{
								die("Requete : cnx->query()");
				}

				foreach	($rs	AS	$enr)	{
								$output[]	=	$enr;
				}

				var_dump($output);

				print(json_encode($output,	JSON_FORCE_OBJECT));
}
?>

