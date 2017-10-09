<?php

class	Recherche	{

				/**
					* retourne un rs contenant les titres se rapprochant de la recherche
					* @param String $strRecherche
					* @return type
					*/
				public	static	function	recherche($strRecherche)	{
								try	{
												$sql	=	'SELECT bd_titre FROM bandesdessinees WHERE bd_titre LIKE ? ORDER BY bd_titre ASC';
												$stmt	=	Connexion::getConnexion()->prepare($sql);
												$stmt->bindParam(1,	ucfirst($strRecherche)	.	'%');
												$stmt->execute();
												$result	=	Connexion::select($sql,	PDO::FETCH_OBJ);
								}	catch	(MySQLException	$e)	{
												die($e->retourneErreur());
								}
								return	$result;
				}

}
