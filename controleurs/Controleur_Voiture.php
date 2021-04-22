<?php
	class Controleur_Voiture extends BaseControleur {

		// La fonction qui sera appelée par le routeur
		public function traite(array $params) {
			
			// Initialisation des donnees a un tableau vide par défaut
			$donnees = array();
	
			$this->afficheVue("tete");
			$this->afficheVue("entete");
            $this->afficheVue("menu");
			
			if (isset($params["action"])) {

				// Switch en fonction de l'action qui est envoyée en paramètre de la requête
				// Ce switch détermine la vue $vue et obtient le modèle $data
				switch($params["action"]) {

					default:
						// Action par défaut
						
						$modeleVoiture = $this->obtenirDAO("Voiture");
						$modeleTypeCarburant   = $this->obtenirDAO("TabLangues", "typecarburant");
						$modeleCouleur         = $this->obtenirDAO("TabLangues", "couleur"); 
						$modeleTransmission    = $this->obtenirDAO("TabLangues", "transmission");
						$modeleTypeCarrosserie = $this->obtenirDAO("TabLangues", "typecarrosserie");

						$donnees["langue"]   = 1;  // francais pour test valeur de son id.

						// On affiche les 12 premieres tuiles
						$donnees["voitures"] = $modeleVoiture->obtenirLeNombreVoulu(0, 12, 'id');
						$donnees["typeCarburant"]   = $this->creerTabLangue($modeleTypeCarburant->obtenirTous(), $donnees["langue"]);
						$donnees["couleur"]         = $this->creerTabLangue($modeleCouleur->obtenirTous(), $donnees["langue"]);
						$donnees["transmission"]    = $this->creerTabLangue($modeleTransmission->obtenirTous(), $donnees["langue"]);
						$donnees["typeCarrosserie"] = $this->creerTabLangue($modeleTypeCarrosserie->obtenirTous(), $donnees["langue"]);

						/* $vue = "Accueil";	 */	

						$this->afficheVue("accueil_debut");
						$this->afficheVue("listeVoitures", $donnees);
						$this->afficheVue("accueil_fin_section_grille");
						$this->afficheVue("voirPlus");
						$this->afficheVue("accueil_fin");
			
						break;
				}			
			} else {
				// Action par défaut
				// On affiche les 12 premiers produits
				$modeleVoiture = $this->obtenirDAO("Voiture");
				$modeleTypeCarburant   = $this->obtenirDAO("TabLangues", "typecarburant");
				$modeleCouleur         = $this->obtenirDAO("TabLangues", "couleur"); 
				$modeleTransmission    = $this->obtenirDAO("TabLangues", "transmission");
				$modeleTypeCarrosserie = $this->obtenirDAO("TabLangues", "typecarrosserie");

				$donnees["langue"]   = 2;  // francais pour test valeur de son id.
				$donnees["voitures"] = $modeleVoiture->obtenirLeNombreVoulu(0, 12, 'id');
				$donnees["typeCarburant"]   = $this->creerTabLangue($modeleTypeCarburant->obtenirTous(), $donnees["langue"]);
				$donnees["couleur"]         = $this->creerTabLangue($modeleCouleur->obtenirTous(), $donnees["langue"]);
				$donnees["transmission"]    = $this->creerTabLangue($modeleTransmission->obtenirTous(), $donnees["langue"]);
				$donnees["typeCarrosserie"] = $this->creerTabLangue($modeleTypeCarrosserie->obtenirTous(), $donnees["langue"]);

				/* $vue = "Accueil";	 */	
				$this->afficheVue("accueil_debut");
                $this->afficheVue("listeVoitures", $donnees);
				$this->afficheVue("accueil_fin_section_grille");
				$this->afficheVue("voirPlus");
				$this->afficheVue("accueil_fin");
			}

			$this->afficheVue("piedDePage");
		}
	}
?>