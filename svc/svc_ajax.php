<?php

header('Content-Type: text/html; charset=utf-8');
header('Access-Control-Allow-Origin: *');

if	(!isset($_REQUEST['req']))	{
				die("Le silence est d'or ...");
}	else	{
				require("dao/Connexion.php");

				if	($_REQUEST['req']	==	'villes')	{
								if	(isset($_REQUEST['codpost']))	{
												$sql	=	"SELECT * FROM bandesdessinees ORDER BY bd_titre ASC";
								}	else	{
												die("Le silence est d'or ...");
								}
				}
				
				$base = Connexion::getConnexion();
				$rs	=	$base->query($sql);

				if	(!$rs)	{
								print	"PDO::errorInfo():";
								$msg	=	$base->errorInfo();
								print	$msg[2]	.	"<br />";
								die("Arret du traitement");
				}
				if	(!$rs)	{
								die("Requete : cnx->query($slq, $base)"	.	mysql_error());
				}

				while	($e	=	mysql_fetch_assoc($rs))
								$output[]	=	$e;

				print(json_encode($output,	JSON_FORCE_OBJECT));
}

?>

