<?php

class bd {
	//TODO Faire les getter setter

	protected $bd_id;
	protected $titre;
	protected $resume;
	protected $couv;
	//Reference
	protected $auteur_id;

	//Methodes
	/**
	* Fonction toString, fait se presenter l'objet
	* @return String $msg
	*/
	public function toString()	{
		$msg = "BD : $bd_id titre : $titre resume : $resume couv : $couv auteur_id : $auteur_id";
		return $msg;
	}
	
	/**
	* Constructeur bd
	* @param type $id
	* @param type $titre
	* @param type $resume
	* @param type $couv
	* @param type $auteur_id
	*/
	public function __construct($id, $titre, $resume, $couv, $auteur_id){
		$this->id = $id;
		$this->titre = $titre;
		$this->resume = $resume;
		$this->couv = $couv;
		$this->auteur_id = $auteur_id;
	}
}

?>