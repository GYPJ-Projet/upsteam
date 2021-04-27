<?php
	class Controleur_Voiture extends BaseControleur {

		// Méthode qui retourne le nom la table de la BD de cette classe  Modele_Voiture
		public function getNomControleur() {
			return "Voiture";
		}

		// La fonction qui sera appelée par le routeur
		public function traite(array $params) {
			
			// Initialisation des donnees a un tableau vide par défaut
			$donnees = array();

			// On charge les fichiers de langue selon la langue choisi par l'usager.
			$donnees["langue"] = $this->chargerLangue($params);

			$idLangue = $donnees["langue"]["idLangue"]; // On récupère l'ID de la langue

			$this->afficheVue("tete");
			$this->afficheVue("entete", $donnees);
            $this->afficheVue("menu", $donnees);
			
			if (isset($params["action"])) {

				// Switch en fonction de l'action qui est envoyée en paramètre de la requête
				// Ce switch détermine la vue $vue et obtient le modèle $data
				switch($params["action"]) {

					
                    case "filtre":      //Pour l'option de filtre de la page d'acceuil.
                        break;	
						
					case "accueil":
					default:
						// Action par défaut
						
						$modeleVoiture         = $this->obtenirDAO("Voiture");
						$modeleTypeCarburant   = $this->obtenirDAO("TabLangues", "typecarburant");
						$modeleCouleur         = $this->obtenirDAO("TabLangues", "couleur"); 
						$modeleTransmission    = $this->obtenirDAO("TabLangues", "transmission");
						$modeleTypeCarrosserie = $this->obtenirDAO("TabLangues", "typecarrosserie");

						

						// On affiche les 12 premieres tuiles
						$donnees["voitures"] = $modeleVoiture->obtenirLeNombreVoulu(0, 12, 'id');
						$donnees["typeCarburant"]   = $this->creerTabLangue($modeleTypeCarburant->obtenirTousDisponible(), $idLangue);
						$donnees["couleur"]         = $this->creerTabLangue($modeleCouleur->obtenirTousDisponible(), $idLangue);
						$donnees["transmission"]    = $this->creerTabLangue($modeleTransmission->obtenirTousDisponible(), $idLangue);
						$donnees["typeCarrosserie"] = $this->creerTabLangue($modeleTypeCarrosserie->obtenirTousDisponible(), $idLangue);

						$donnees['langues'] = $langue;
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

				$donnees["voitures"] = $modeleVoiture->obtenirLeNombreVoulu(0, 12, 'id');
				$donnees["typeCarburant"]   = $this->creerTabLangue($modeleTypeCarburant->obtenirTousDisponible(), $idLangue);
				$donnees["couleur"]         = $this->creerTabLangue($modeleCouleur->obtenirTousDisponible(), $idLangue);
				$donnees["transmission"]    = $this->creerTabLangue($modeleTransmission->obtenirTousDisponible(), $idLangue);
				$donnees["typeCarrosserie"] = $this->creerTabLangue($modeleTypeCarrosserie->obtenirTousDisponible(), $idLangue);

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