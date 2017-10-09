<?php

class PeopleManager {

    /**
     * Retourne tous les enregistrements de la table
     * 
     * @return People[]
     */
    public static function getAllPeople() {
        // Pas besoin de se connecter à la base, la classe Connexion le fera si besoin.
        //PDO::query() retourne un objet PDOStatement, ou FALSE si une erreur survient. 
        // donc une exception est levée par la classe Connexion
        try {
            $sql = 'select * from people';
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
     * @param People $people
     * @return People[]
     */
    public static function getPeople($people) {
        try {
            if (!empty($people->id)) {
                $sql = "select * from people where id = $people->id";
            } elseif (!empty($people->name)) {
                $sql = "select * from people where name = '$people->name'";
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
     * @param People $people
     * @return Objet de type PDOStatement
     */
    public static function setPeople($people) {
        try {
            $sql = "INSERT INTO people(name, sex, birthyear) " .
                    "VALUES ('" . ucfirst($people->name) . 
                    "',$people->sex,$people->birthyear) ";
            $result = Connexion::select($sql);
        } catch (MySQLException $e) {
            die($e->retourneErreur());
        }
        return $result;
    }

    /**
     * Modifie les champs de la table à partir de son id
     * 
     * @param People $people
     * @return Objet de type PDOStatement
     */
    public static function updPeople($people) {
        try {
            $sql = "UPDATE people SET name = '$people->name', " .
                    "sex = $people->sex, birthyear = $people->birthyear " .
                    "WHERE id = $people->id";
            $result = Connexion::select($sql);
        } catch (MySQLException $e) {
            die($e->retourneErreur());
        }
        return $result;
    }

    /**
     * Supprime un enregistrement dans la base
     * 
     * @param People $people
     * @return Objet de type PDOStatement
     */
    public static function delPeople($people) {
        try {
            if (!empty($people->id)) {
                $sql = "DELETE FROM people WHERE id = $people->id";
            } elseif (!empty($people->name)) {
                $sql = "DELETE FROM people WHERE name = '$people->name'";
            }
            $result = Connexion::select($sql);
        } catch (MySQLException $e) {
            die($e->retourneErreur());
        }
        return $result;
    }

}

?>