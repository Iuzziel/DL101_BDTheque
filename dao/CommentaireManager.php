<?php

class	CommentaireManager	{

				/**
					* Retourne tous les enregistrements de la table
					* 
					* @return Commentaire[]
					*/
				public	static	function	getAllCommentaire()	{
								// Pas besoin de se connecter à la base, la classe Connexion le fera si besoin.
								//PDO::query() retourne un objet PDOStatement, ou FALSE si une erreur survient. 
								// donc une exception est levée par la classe Connexion
								try	{
												$sql	=	'SELECT * FROM commentaires';
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
					* @param BandeDessinee $bd
					* @return Commentaire[]
					*/
				public	static	function	getCommentaire($bd)	{
								try	{
												if	(!empty($bd))	{
																$sql	=	"SELECT * FROM commentaires "
																								.	"WHERE com_bd_id = $bd->bd_id "
																								.	"ORDER BY com_date DESC";
												}
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
					* @param Commentaire $commentaire
					* @return Commentaire[]
					*/
				public	static	function	getThisCommentaire($commentaire)	{
								try	{
												if	(!empty($commentaire))	{
																$sql	=	"SELECT * FROM commentaires "
																								.	"WHERE com_id = $commentaire->com_id";
												}
												$result	=	Connexion::select($sql,	PDO::FETCH_OBJ);
								}	catch	(MySQLException	$e)	{
												die($e->retourneErreur());
								}
								return	$result;
				}

				/**
					* Insère un enregistrement dans la base.
					* Protection contre les injections sql par prepared statement
					* 
					* @param Commentaire $commentaires
					* @return int 1 si tout s'est bien passé
					*/
				public	static	function	setCommentaire($commentaires)	{
								try	{
												$sql	=	"INSERT INTO commentaires(com_bd_id, com_mod, com_auteur, com_texte) "	.
																				"VALUES (?, 0, ?, ?)";
												$stmt	=	Connexion::getConnexion()->prepare($sql);
												$stmt->bindParam(1,	$commentaires->com_bd_id);
												$stmt->bindParam(2,	$commentaires->com_auteur);
												$stmt->bindParam(3,	$commentaires->com_texte);
												$stmt->execute();
												return	1;
								}	catch	(MySQLException	$e)	{
												die($e->retourneErreur());
								}
				}

				/**
					* Modifie les champs de la table à partir de son id
					* 
					* @param Commentaire $commentaires
					* @return Objet de type PDOStatement
					*/
				public	static	function	updCommentaire($commentaires)	{
								try	{
												$sql	=	"UPDATE commentaires SET com_mod = $commentaires->com_mod, "
																				.	"com_auteur = '$commentaires->com_auteur', "
																				.	"com_texte = '$commentaires->com_texte' "
																				.	"WHERE com_id = $commentaires->com_id";
												$result	=	Connexion::select($sql);
								}	catch	(MySQLException	$e)	{
												die($e->retourneErreur());
								}
								return	$result;
				}

				/**
					* Supprime un enregistrement dans la base
					* 
					* @param Commentaire $commentaires
					* @return Objet de type PDOStatement
					*/
				public	static	function	delCommentaire($commentaires)	{
								try	{
												if	(!empty($commentaires->com_id))	{
																$sql	=	"DELETE FROM commentaires WHERE com_id = $commentaires->com_id";
												}
												$result	=	Connexion::select($sql);
								}	catch	(MySQLException	$e)	{
												die($e->retourneErreur());
								}
								return	$result;
				}

}

?>