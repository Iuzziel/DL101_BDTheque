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
        try {
            if (!empty($membre->pseudo) && !empty($membre->mdp)) {
                $sql = "SELECT COUNT(*) FROM membre "
                        . "WHERE membre_pseudo = ? "
                        . "AND membre_mdp = ?";
                $stmt = Connexion::getConnexion()->prepare($sql);
                $stmt->bindParam(1, $membre->pseudo);
                $stmt->bindParam(2, $membre->mdp);
                $stmt->execute();
                // Rajouter le contrôle de la reussite de la vérif
                return 1;
            }
        } catch (MySQLException $e) {
            die($e->retourneErreur());
        }
    }

}

?>