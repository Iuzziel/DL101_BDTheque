<?php

class MembreManager {

    /**
     * Retourne les enregistrements de la table correspondant aux propriétés de
     * l'objet passé en paramètre. 
     * 
     *  ATTENTION à éviter l'injection SQL
     * 
     * @param Membre $membre
     * @return Membre[]
     */
    public static function verifLogin($membre) {
        $result = '';
        try {
            if (!empty($membre->pseudo) && !empty($membre->mdp)) {
                $sql = "select nom,prenom from membre where login = '" .
                        addslashes($membre->pseudo)
                        . "' AND mdp_md5 = '" .
                        $membre->mdp
                        . "'";

                $result = Connexion::select($sql, PDO::FETCH_OBJ);
            }
        } catch (MySQLException $e) {
            die($e->retourneErreur());
        }
        return $result;
    }

}

?>