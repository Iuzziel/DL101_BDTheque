<?php

/**
	* Gestion des erreurs avec les exeptions
	*/
class	MySQLException	extends	Exception	{

				private	$cnx	=	"";

				public	function	__construct($Msg,	$cnx)	{
								parent	::	__construct($Msg);
								$this->cnx	=	$cnx;
				}

				/**
					* Retourne le message, la ligne et le fichier d'origine de l'erreur
					* 
					* @return string
					*/
				public	function	RetourneErreur()	{
								$msg	=	'<div><strong>'	.	$this->getMessage()	.	'</strong><br>';
								//$msg .= ' Ligne : ' . $this->getLine();
								//$msg .= ' dans ' . $this->getFile();
								if	(isset($this->cnx))	{
												$msg	.=	$this->cnx->errorInfo()[2]	.	'</div><br>';
								}
								return	$msg;
				}

}

?>