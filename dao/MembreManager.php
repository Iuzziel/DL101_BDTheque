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
                $sql = "SELECT COUNT(*) FROM membres "
                        . "WHERE membre_pseudo = ? "
                        . "AND membre_mdp = ?";
                $stmt = Connexion::getConnexion()->prepare($sql);
                $stmt->bindParam(1, $membre->pseudo);
                $stmt->bindParam(2, $membre->mdp);
                if($stmt->execute()){
																				$tmpStm = $stmt->fetchAll(PDO::FETCH_NUM);
																				if($tmpStm[0][0] == '1'){
																								return 1;
																				}
																}else{
																				return 0;
																}
            }
        } catch (MySQLException $e) {
            die($e->retourneErreur());
        }
    }

}

?>