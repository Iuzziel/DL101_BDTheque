<?php

class	ThemeManager	{

				/**
					* Retourne tous les enregistrements de la table
					* 
					* @return Theme[]
					*/
				public	static	function	getAllTheme()	{
								// Pas besoin de se connecter à la base, la classe Connexion le fera si besoin.
								//PDO::query() retourne un objet PDOStatement, ou FALSE si une erreur survient. 
								// donc une exception est levée par la classe Connexion
								try	{
												$sql	=	'SELECT * FROM themes ORDER BY th_intitule ASC';
												$result	=	Connexion::select($sql,	PDO::FETCH_OBJ);
								}	catch	(MySQLException	$e)	{
												die($e->retourneErreur());
								}
								return	$result;
				}

				/**
					* Retourne les enregistrements de la table correspondant aux propriétés de
					* l'objet passé en paramètre. La recherche s'effectue en fonction des propriétés
					* renseignée, dans l'ordre 'id' puis 'name'
					* 
					* @param Theme $theme
					* @return Theme[]
					*/
				public	static	function	getTheme($theme)	{
								try	{
												if	(!empty($theme->th_id))	{
																$sql	=	"select * from themes where th_id = $theme->th_id";
												}	elseif	(!empty($theme->th_intitule))	{
																$sql	=	"select * from themes where th_intitule = '$theme->th_intitule'";
												}
												$result	=	Connexion::select($sql,	PDO::FETCH_OBJ);
								}	catch	(MySQLException	$e)	{
												die($e->retourneErreur());
								}
								return	$result;
				}

				/**
					* Retourne les enregistrement de la table correspondant a l'id passé en parametre.
					* @param type $themeID
					* @return type
					*/
				public	static	function	getThemeNom($themeID)	{
								$tmpMsg	=	'';
								try	{
												if	(!empty($themeID))	{
																$sql	=	"select * from themes where th_id = $themeID";
												}
												$result	=	Connexion::select($sql,	PDO::FETCH_OBJ);
								}	catch	(MySQLException	$e)	{
												die($e->retourneErreur());
								}
								foreach	($result	as	$value)	{
												$tmpMsg	.=	$value->aut_nom;
								}
								return	$tmpMsg;
				}

				/**
					* Retourne les enregistrement de la table correspondant a l'id passé en parametre.
					* 
					* @param BandeDessinee->bd_id $LienIdBD
					* @return Objet de type PDOStatement
					*/
				public	static	function	getBdTheme($LienIdBD)	{
								try	{
												if	(!empty($LienIdBD))	{
																$sql	=	"SELECT th.th_id, th.th_intitule "
																								.	"FROM `themes` th "
																								.	"JOIN `liens_bd_themes` li "
																								.	"ON li.lien_themes_id = th.th_id "
																								.	"JOIN bandesdessinees bd "
																								.	"ON li.lien_bd_id = bd.bd_id "
																								.	"WHERE bd_id = $LienIdBD";
												}
												$result	=	Connexion::select($sql,	PDO::FETCH_OBJ);
								}	catch	(MySQLException	$e)	{
												die($e->retourneErreur());
								}
								return	$result;
				}

				/**
					* Insère un enregistrement dans la base
					* 
					* @param Theme $theme
					* @return Objet de type PDOStatement
					*/
				public	static	function	setTheme($theme)	{
								try	{
												$sql	=	"INSERT INTO themes(th_intitule) "	.
																				"VALUES (?)";
												$stmt	=	Connexion::getConnexion()->prepare($sql);
												$stmt->bindParam(1,	ucfirst($theme->th_intitule));
												$stmt->execute();
												return	1;
								}	catch	(MySQLException	$e)	{
												die($e->retourneErreur());
								}
				}

				/**
					* Insère un enregistrement dans la base
					* 
					* @param Theme $theme
					* @return Objet de type PDOStatement
					*/
				public	static	function	setLienTheme($LienIdBD,	$LienIdTheme)	{
								try	{
												$sql	=	"INSERT INTO liens_bd_themes(lien_bd_id, lien_themes_id) "	.
																				"VALUES (?, ?)";
												$stmt	=	Connexion::getConnexion()->prepare($sql);
												$stmt->bindParam(1,	$LienIdBD);
												$stmt->bindParam(2,	$LienIdTheme);
												$stmt->execute();
												return	1;
								}	catch	(MySQLException	$e)	{
												die($e->retourneErreur());
								}
				}

				/**
					* Supprime un enregistrement dans la table lienTheme
					* 
					* @param Theme $theme
					* @return Objet de type PDOStatement
					*/
				public	static	function	delLienTheme($LienIdBD,	$LienIdTheme)	{
								try	{
												$sql	=	"DELETE FROM liens_bd_themes WHERE lien_bd_id = ? AND lien_themes_id = ?";
												$stmt	=	Connexion::getConnexion()->prepare($sql);
												$stmt->bindParam(1,	$LienIdBD);
												$stmt->bindParam(2,	$LienIdTheme);
												$stmt->execute();
												return	1;
								}	catch	(MySQLException	$e)	{
												die($e->retourneErreur());
								}
				}

				/**
					* Modifie les champs de la table à partir de son id
					* 
					* @param Theme $theme
					* @return Objet de type PDOStatement
					*/
				public	static	function	updTheme($theme)	{
								try	{
												$sql	=	"UPDATE themes SET th_intitule = '$theme->th_intitule', "
																				.	"WHERE th_id = $theme->th_id";
												$result	=	Connexion::select($sql);
								}	catch	(MySQLException	$e)	{
												die($e->retourneErreur());
								}
								return	$result;
				}

				/**
					* Supprime un enregistrement dans la base
					* 
					* @param Theme $theme
					* @return Objet de type PDOStatement
					*/
				public	static	function	delTheme($theme)	{
								try	{
												if	(!empty($theme->th_id))	{
																$sql	=	"DELETE FROM themes WHERE th_id = $theme->th_id";
												}	elseif	(!empty($theme->th_intitule))	{
																$sql	=	"DELETE FROM themes WHERE th_intitule = '$theme->th_intitule'";
												}
												$result	=	Connexion::select($sql);
								}	catch	(MySQLException	$e)	{
												die($e->retourneErreur());
								}
								return	$result;
				}

}

?>