<?php

class People {

    // Il est impératif d'initialiser les variables, sinon le isset ne fonctionne pas !
    public $id='';
    public $name='';
    public $sex='';
    public $birthyear='';

    /**
     * PHP ne supportant pas (encore) la surcharge de méthode, on ne peut définir plusieurs
     * constructeurs avec des paramètres différents.
     * Pour contourner cette limitation, on passe un tableau associatif en argument
     * le parcours de ce tableau permettra d'alimenter la ou les données membres
     * 
     * @param tableau associatif $args
     */
    public function __construct($args = null) {
        if (is_array($args) && !empty($args)) {
            // Pour chaque clé, on récupère sa valeur.
            foreach($args as $key => $value)
            {
                if (!isset($this->$key)) throw new MySQLException("propriété '$key' inconnue !");
                // Si la propriété de la classe est vide, alors on met à jour sa valeur.
                //if(isset($this->$key))  $this->$key = $value;
                $this->$key = $value;
            }
        }
    }

}

?>