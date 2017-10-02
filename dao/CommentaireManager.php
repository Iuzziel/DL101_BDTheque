<?php

class CommentaireManager {

    /**
     * Retourne tous les enregistrements de la table
     * 
     * @return Auteur[]
     */
    public static function getAllCommentaire() {
        // Pas besoin de se connecter à la base, la classe Connexion le fera si besoin.
        //PDO::query() retourne un objet PDOStatement, ou FALSE si une erreur survient. 
        // donc une exception est levée par la classe Connexion
        try {
            $sql = 'SELECT * FROM auteurs';
            $result = Connexion::select($sql, PDO::FETCH_OBJ);
        } catch (MySQLException $e) {
            die($e->retourneErreur());
        }
        return $result;
    }
    
    /**
     * Retourne les enregistrements de la table correspondant aux propriétés de
     * l'objet passé en paramètre. La recherche s'effectue en fonction des propriétés
     * renseignée, dans l'ordre 'id' puis 'name'
     * 
     * @param BandeDessinee $bd
     * @return Commentaire[]
     */
    public static function getCommentaire($bd) {
        try {
            if (!empty($bd)) {
                $sql = "select * from commentaires where com_bd_id = $bd->bd_id";
            }
            $result = Connexion::select($sql, PDO::FETCH_OBJ);
        } catch (MySQLException $e) {
            die($e->retourneErreur());
        }
        return $result;
    }
}

?>