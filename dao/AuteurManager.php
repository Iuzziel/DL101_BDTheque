<?php

class AuteurManager {

    /**
     * Retourne tous les enregistrements de la table
     * 
     * @return Auteur[]
     */
    public static function getAllAuteur() {
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
     * @param Auteur $auteur
     * @return Auteur[]
     */
    public static function getAuteur($auteur) {
        try {
            if (!empty($auteur->aut_id)) {
                $sql = "select * from auteurs where aut_id = $auteur->aut_id";
            } elseif (!empty($auteur->aut_nom)) {
                $sql = "select * from auteurs where aut_nom = '$auteur->aut_nom'";
            }
            $result = Connexion::select($sql, PDO::FETCH_OBJ);
        } catch (MySQLException $e) {
            die($e->retourneErreur());
        }
        return $result;
    }
    
    /**
     * Retourne les enregistrement de la table correspondant a l'id passé en parametre.
     * @param type $auteurID
     * @return type
     */
    public static function getAuteurNom($auteurID) {
        try {
            if (!empty($auteurID)) {
                $sql = "select * from auteurs where aut_id = $auteurID";
            }
            $result = Connexion::select($sql, PDO::FETCH_OBJ);
        } catch (MySQLException $e) {
            die($e->retourneErreur());
        }
        foreach ($result as $value) {
            $tmpMsg = $value->aut_nom;
        }
        return $tmpMsg;
    }

    /**
     * Insère un enregistrement dans la base
     * 
     * @param Auteur $auteur
     * @return Objet de type PDOStatement
     */
    public static function setAuteur($auteur) {
        try {
            $sql = "INSERT INTO auteurs(aut_nom) " .
                    "VALUES '".ucfirst($auteur->aut_nom)."'";
            $result = Connexion::select($sql);
        } catch (MySQLException $e) {
            die($e->retourneErreur());
        }
        return $result;
    }

    /**
     * Modifie les champs de la table à partir de son id
     * 
     * @param Auteur $auteur
     * @return Objet de type PDOStatement
     */
    public static function updAuteur($auteur) {
        try {
            $sql = "UPDATE auteurs SET aut_nom = '$auteur->aut_nom', " 
                    . "WHERE aut_id = $auteur->aut_id";
            $result = Connexion::select($sql);
        } catch (MySQLException $e) {
            die($e->retourneErreur());
        }
        return $result;
    }

    /**
     * Supprime un enregistrement dans la base
     * 
     * @param Auteur $auteur
     * @return Objet de type PDOStatement
     */
    public static function delAuteur($auteur) {
        try {
            if (!empty($auteur->aut_id)) {
                $sql = "DELETE FROM auteurs WHERE aut_id = $auteur->aut_id";
            } elseif (!empty($auteur->aut_nom)) {
                $sql = "DELETE FROM auteurs WHERE aut_nom = '$auteur->aut_nom'";
            }
            $result = Connexion::select($sql);
        } catch (MySQLException $e) {
            die($e->retourneErreur());
        }
        return $result;
    }

}

?>