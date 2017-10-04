<?php

class BandeDessineeManager {

    /**
     * Retourne tous les enregistrements de la table
     * 
     * @return BandeDessinee[]
     */
    public static function getAllBandesDessinees() {
        // Pas besoin de se connecter à la base, la classe Connexion le fera si besoin.
        //PDO::query() retourne un objet PDOStatement, ou FALSE si une erreur survient. 
        // donc une exception est levée par la classe Connexion
        try {
            $sql = 'SELECT * FROM bandesdessinees';
            $result = Connexion::select($sql, PDO::FETCH_OBJ);
        } catch (MySQLException $e) {
            die($e->retourneErreur());
        }
        return $result;
    }

    /**
     * Retourne les $limit enregistrements de la table a partir de $offset exclue
     * 
     * @return BandeDessinee[]
     */
    public static function getHowManyBD($limit, $offset) {
        // Pas besoin de se connecter à la base, la classe Connexion le fera si besoin.
        //PDO::query() retourne un objet PDOStatement, ou FALSE si une erreur survient. 
        // donc une exception est levée par la classe Connexion
        try {
            $sql = "SELECT * FROM bandesdessinees LIMIT $limit OFFSET $offset";
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
     * @param BandeDessinee $bandeDessinee
     * @return BandeDessinee[]
     */
    public static function getBandeDessinee($bandeDessinee) {
        try {
            if (!empty($bandeDessinee->bd_id)) {
                $sql = "select * from bandesdessinees where bd_id = $bandeDessinee->bd_id";
            } elseif (!empty($bandeDessinee->bd_titre)) {
                $sql = "select * from bandesdessinees where bd_titre = '$bandeDessinee->bd_titre'";
            }
            $result = Connexion::select($sql, PDO::FETCH_OBJ);
        } catch (MySQLException $e) {
            die($e->retourneErreur());
        }
        return $result;
    }

    /**
     * Insère un enregistrement dans la base
     * 
     * @param BandeDessinee $bandeDessinee
     * @return Objet de type PDOStatement
     */
    public static function setBandeDessinee($bandeDessinee) {
        try {
            $sql = "INSERT INTO bandesdessinees(bd_titre, bd_resume, bd_image, bd_auteur_id) " .
                    "VALUES (?, ?, ?, ?)";
            $stmt = Connexion::getConnexion()->prepare($sql);
            $stmt->bindParam(1, $bandeDessinee->bd_titre);
            $stmt->bindParam(2, $bandeDessinee->bd_resume);
            $stmt->bindParam(3, $bandeDessinee->bd_image);
            $stmt->bindParam(4, $bandeDessinee->bd_auteur_id);
            $stmt->execute();
            return 1;
        } catch (MySQLException $e) {
            die($e->retourneErreur());
        }
    }

    /**
     * Modifie les champs de la table à partir de son id
     * 
     * @param BandeDessinee $bandeDessinee
     * @return Objet de type PDOStatement
     */
    public static function updBandeDessinee($bandeDessinee) {
        try {
            $sql = "UPDATE bandesdessinees SET bd_titre = '$bandeDessinee->bd_titre', "
                    . "bd_resume = $bandeDessinee->bd_resume, "
                    . "bd_image = $bandeDessinee->bd_image, "
                    . "bd_auteur_id = $bandeDessinee->bd_auteur_id " 
                    . "WHERE bd_id = $bandeDessinee->bd_id";
            $result = Connexion::select($sql);
        } catch (MySQLException $e) {
            die($e->retourneErreur());
        }
        return $result;
    }

    /**
     * Supprime un enregistrement dans la base
     * 
     * @param BandeDessinee $bandeDessinee
     * @return Objet de type PDOStatement
     */
    public static function delBandeDessinee($bandeDessinee) {
        try {
            if (!empty($bandeDessinee->bd_id)) {
                $sql = "DELETE FROM bandesdessinees WHERE bd_id = $bandeDessinee->bd_id";
            } elseif (!empty($bandeDessinee->bd_titre)) {
                $sql = "DELETE FROM bandesdessinees WHERE bd_titre = '$bandeDessinee->bd_titre'";
            }
            $result = Connexion::select($sql);
        } catch (MySQLException $e) {
            die($e->retourneErreur());
        }
        return $result;
    }

}

?>