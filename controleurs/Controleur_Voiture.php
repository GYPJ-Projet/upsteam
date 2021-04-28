<?php
	class Controleur_Voiture extends BaseControleur {

		// Méthode qui retourne le nom du contrôleur où aller chercher la langue 
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

			// On pointes sur les modèles que la voiture a besoin.
			$modeleVoiture         = $this->obtenirDAO("Voiture");
			$modeleTypeCarburant   = $this->obtenirDAO("TabLangues", "typecarburant");
			$modeleCouleur         = $this->obtenirDAO("TabLangues", "couleur"); 
			$modeleTransmission    = $this->obtenirDAO("TabLangues", "transmission");
			$modeleTypeCarrosserie = $this->obtenirDAO("TabLangues", "typecarrosserie");
      		$modeleToutMarqueDispo          = $this->obtenirDAO("Marque", "obtenirToutMarqueDispo");
			$modeleToutModeleDispo          = $this->obtenirDAO("Modele", "obtenirToutModeleDispo");
			$modeleToutCarrosserieDispo     = $this->obtenirDAO("Carrosserie");

			
			// On prend les données dans la langue qu'il faut afficher.	
			$donnees["typeCarburant"]   = $this->creerTabLangue($modeleTypeCarburant->obtenirTousDisponible(), $idLangue);
			$donnees["couleur"]         = $this->creerTabLangue($modeleCouleur->obtenirTousDisponible(), $idLangue);
			$donnees["transmission"]    = $this->creerTabLangue($modeleTransmission->obtenirTousDisponible(), $idLangue);
			$donnees["typeCarrosserie"] = $this->creerTabLangue($modeleTypeCarrosserie->obtenirTousDisponible(), $idLangue);	
      
      //Obtention des informations pour le filtre.
			$donnees["toutesMarquesDispo"]      = $modeleToutMarqueDispo->obtenirToutDisponible();
			$donnees["toutesModeleDispo"]       = $modeleToutModeleDispo->obtenirToutDisponible();
			$donnees["toutesCarrosserieDispo"]  = $modeleToutCarrosserieDispo->obtenirToutDisponible();
      


            // Si on a reçu une action, on la traite...
			if (isset($params["action"])) {

				// Switch en fonction de l'action qui est envoyée en paramètre de la requête
				// Ce switch détermine la vue $vue et obtient le modèle $data
				switch($params["action"]) {

					case "descriptionVoiture" :
						// Si on a reçu le paramètre id de la voiture à afficher.
						if (isset($params["id"]))
						{
							$donnees["voiture"] = $modeleVoiture->obtenirParId($params["id"]);
							$donnees["images"]  = $modeleVoiture->obtenirImagesParIdVoiture($params["id"]);
						}
						break;

                    case "filtre":      //Pour l'option de filtre de la page d'acceuil.
                        break;	
						
					case "accueil":

					default:
						// Action par défaut


						// On affiche les 12 premieres tuiles
						$donnees["voitures"] = $modeleVoiture->obtenirLeNombreVoulu(0, 12, 'id');

						/* $vue = "Accueil";	 */	
						$this->afficheVue("accueil_debut", $donnees);

						// On affiche les 12 premieres tuiles
						$donnees["voitures"]                = $modeleVoiture->obtenirLeNombreVoulu(0, 12, 'id');
            
						
						/* $vue = "Accueil";	 */	

						$this->afficheVue("accueil_debut", $donnees);

						$this->afficheVue("listeVoitures", $donnees);
						$this->afficheVue("accueil_fin_section_grille");
						$this->afficheVue("voirPlus");
						$this->afficheVue("accueil_fin");
			
						break;
				}			
			} else {
				// Action par défaut
				// On affiche les 12 premiers voitures
				$donnees["voitures"] = $modeleVoiture->obtenirLeNombreVoulu(0, 12, 'id');


				/* $vue = "Accueil";	 */	
				$this->afficheVue("accueil_debut", $donnees);

        $this->afficheVue("listeVoitures", $donnees);
				$this->afficheVue("accueil_fin_section_grille");
				$this->afficheVue("voirPlus");
				$this->afficheVue("accueil_fin");
			}

			$this->afficheVue("piedDePage", $donnees);
		}
	}
?>