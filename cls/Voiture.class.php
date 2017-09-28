<?php

/**
	* Description of Voiture
	*/
class	Voiture	{
				protected $immatriculation;
				protected $couleur;
				protected $poids;
				protected $puissance;
				protected $rservoir;
				protected $essence;
				protected $places;
				protected $assure;
				protected $message;
				//Reference
				protected $chauffeur;

				//Methodes
				/**
				 * 
				 * @param int $distanceParcourue
				 * @param int $vitesseMoyenne
				 * @return string
				 */
				public function se_deplacer($distanceParcourue, $vitesseMoyenne){
								if(gettype($distanceParcourue) == "integer" && gettype($distanceParcourue) == "integer"){
												$consomme = $this->Consommation($distanceParcourue, $vitesseMoyenne);
												$this->niveauEssence -= $consomme;
												if($this->niveauEssence > 0){
																return "Il vous reste ".$this->niveauEssence."L. Vous avez consommé ".$consomme."L.";
												}else	{
																$this->niveauEssence = 0;
																return "Vous êtes à sec.";
												}
								}else{
												return "Mauvais paramètres.";
								}
				}
				
				/**
				 * 
				 * @param int $distanceParcourue
				 * @param int $vitesseMoyenne
				 * @return int
				 */
				private function consommation($distanceParcourue, $vitesseMoyenne){
								echo "voiture";
								if($vitesseMoyenne < 50)	{
												return $distanceParcourue * 10 / 100;
								}elseif($vitesseMoyenne >= 50 && $vitesseMoyenne < 90){
												return $distanceParcourue * 5 / 100;
								}elseif($vitesseMoyenne >= 90 && $vitesseMoyenne < 130){
												return $distanceParcourue * 8 / 100;
								}else{
												return $distanceParcourue * 12 / 100;
								}
				}
				
				/**
				 * 
				 * @param int $essence
				 * @return string
				 */
				public function mettre_essence($essence){
								if(gettype($essence) == "integer"){
												if(($this->capaciteReservoir - $this->niveauEssence) >= $essence && gettype($essence) == "integer"){
																$this->niveauEssence += $essence;
																return "Reservoir complété, maintenant à :".$this->niveauEssence."L.";
												}else{
																return "Probleme de quantitée, action échouée.";
												}												
								}
				}
				
				/**
				 * 
				 * @param string $couleur
				 * @return string
				 */
				public	function	repeindre($couleur)	{
								if(gettype($couleur) == "string"){
												if($this->couleur == $couleur){
																$msg = "Merci pour ce rafraichissement.";
																return $msg;
												}else{
																$this->setCouleur($couleur);
																$msg = "Couleur changé";
																return $msg;
												}												
								} 
				}
				
				public	function	toString()	{
								$msg = "Voiture : immat:".$this->immatriculation." coul:".$this->couleur
																." poids:".$this->poids."kg puissance:".$this->puissance."cv reservoir:"
																.$this->capaciteReservoir."L niveau du reservoir:".$this->niveauEssence
																." nb place:".$this->nombrePlace."p assure:".$this->assure
																." tableau de bords:".$this->messageTabBord.". ";
								return $msg;
				}
				
				//Accesseurs
				public	function	getImmatriculation()	{
								return $this->immatriculation;
				}
				public	function	getCouleur()	{
								return $this->couleur;
				}
				public	function	setCouleur($couleur)	{
								$this->couleur = $couleur;
				}
				public	function	getPoids()	{
								return $this->poids;
				}
				public	function	getPuissance()	{
								return $this->puissance;
				}
				public	function	getReservoir()	{
								return $this->capaciteReservoir;
				}
				public	function	getEssence()	{
								return $this->niveauEssence;
				}
				public	function	setEssence($niveauEssence)	{
								$this->niveauEssence = $niveauEssence;
				}
				public	function	getPlaces()	{
								return $this->nombrePlace;
				}
				public	function	getAssure()	{
								return $this->assure;
				}
				public	function	setAssure($assure)	{
								$this->assure = $assure;
				}
				public	function	getMessage()	{
								return $this->messageTabBord;
				}
				public	function	setMessage($messageTabBord)	{
								$this->messageTabBord = $messageTabBord;
				}
				/**
				 * @param Personne $chauffeur
				 */
				public function	setChauffeur($chauffeur)	{
								if(gettype($chauffeur === Chauffeur::class)){
												$this->chauffeur	=	$chauffeur;
								}
				}
				public function	getChauffeur()	{
								return	$this->chauffeur;
				}

				
				/**
				 * Constructeur Voiture
				 * @param string $immatriculation
				 * @param string $couleur
				 * @param int $poids
				 * @param int $puissance
				 * @param float $reservoir
				 * @param float $essence
				 * @param int $places
				 * @param bool $assure
				 * @param string $message
				 */
				public function __construct($immatriculation, $couleur, $poids, $puissance, 
												$capaciteReservoir, $nombrePlace)	{
								$this->immatriculation = $immatriculation;
								$this->couleur = $couleur;
								$this->poids = $poids;
								$this->puissance = $puissance;
								$this->capaciteReservoir = $capaciteReservoir;
								$this->nombrePlace = $nombrePlace;
								
								$this->niveauEssence = 5;
								$this->assure = "FALSE";
								$this->messageTabBord = "Message d'accueil";
				}
}

?>