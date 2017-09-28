<?php

class Connexion {

    private static $cnx;

    /**
     * Se connecte à la base de données, il n'est pas nécessaire d'appeler cette méthode,
     * les autres méthodes vont le faire si besoin.
     * 
     * @return type identifiant de connexion
     * @throws MySQLException
     */
    public static function getConnexion() {

        // singleton de la connexion
        // empty détermine si une variable est considérée comme vide. Une variable est considérée comme vide si elle n'existe pas, ou si sa valeur équivaut à FALSE. La fonction empty() ne génère pas d'alerte si la variable n'existe pas. 
        if (empty(self::$cnx)) {
            $fichier = 'config/param.ini.php';
            if (file_exists($fichier) && is_file($fichier)) {
                $config = parse_ini_file($fichier, true);

                $host = $config['SQL']['host'];
                $user = $config['SQL']['user'];
                $passwd = $config['SQL']['passwd'];
                $base = $config['SQL']['base'];
            } else {
                throw new MySQLException("Impossible de trouver le fichier de configuration 'config/sql.ini'");
            }
            echo 'Connexion à la base<br>';
            // Pas de try ... catch ici,on laisse l'appelant gérer l'erreur
            try {
                self::$cnx = new PDO("mysql:host=$host;dbname=$base;charset=utf8", $user, $passwd,
                        // Beaucoup d'applications web utilisent des connexions persistantes aux serveurs de base de données. Les connexions persistantes ne sont pas fermées à la fin du script, mais sont mises en cache et réutilisées lorsqu'un autre script demande une connexion en utilisant les mêmes paramètres. Le cache des connexions persistantes vous permet d'éviter d'établir une nouvelle connexion à chaque fois qu'un script doit accéder à une base de données, rendant l'application web plus rapide. 
                        array(\PDO::ATTR_PERSISTENT => true));
            } catch (Exception $e) {
                throw new MySQLException($e->getMessage(),self::$cnx);
            }
        }
        return self::$cnx;
    }

    /**
     * Envoie une requête et retourne le résultat dans le format PDO demandé.<br>
     * Si nécessaire, ne pas oublier de tester le nbre d'enreg retourné avec
     * $result->rowCount()
     * 
     * $format est optionnel, par défaut -> PDO::FETCH_ASSOC
     * 
     * @param string $sql
     * @param [int $format]
     * @return un tableau en fonction du format
     * @throws MySQLException
     */
    public static function select($sql, $format = PDO::FETCH_ASSOC) {

        if (empty(self::$cnx)) {
            self::$cnx = Connexion::getConnexion();
        }
        // Libération des ressources précédentes
        //self::$cnx->closeCursor();
        //PDO::query() retourne un objet PDOStatement, ou FALSE si une erreur survient. 
        // donc le try .. catch est inutile
        $result = self::$cnx->query($sql, $format);
        if (!$result) {
            throw new MySQLException("Erreur sur la requête : $sql", self::$cnx);
        } else {
            return $result;
        }
    }

    /**
     * Retourne l'identifiant de la dernière ligne insérée
     * 
     * @return String
     */
    public static function dernierId() {
        if (empty(self::$cnx)) {
            self::$cnx = Connexion::getConnexion();
        }
        return self::$cnx->lastInsertId();
    }

}

