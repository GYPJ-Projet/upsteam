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
			$modelePropulsion      = $this->obtenirDAO("motopropulseur");
			$modeleTypeCarrosserie = $this->obtenirDAO("TabLangues", "typecarrosserie");

   			$modeleToutMarqueDispo          = $this->obtenirDAO("Marque");
				
			// On prend les données dans la langue qu'il faut afficher.	
			$donnees["typeCarburant"]   = $this->creerTabLangue($modeleTypeCarburant->obtenirTousDisponible(), $idLangue);
			$donnees["couleur"]         = $this->creerTabLangue($modeleCouleur->obtenirTousDisponible(), $idLangue);
			$donnees["transmission"]    = $this->creerTabLangue($modeleTransmission->obtenirTousDisponible(), $idLangue);
			$donnees["typeCarrosserie"] = $this->creerTabLangue($modeleTypeCarrosserie->obtenirTousDisponible(), $idLangue);	
      
      		//Obtention des informations pour le filtre.

            // PH - Obtention des informations pour le filtre.

			$donnees["toutesMarquesDispo"]      = $modeleToutMarqueDispo->obtenirToutDisponible();
			$donnees["propulsion"]              = $modelePropulsion->obtenirToutDisponible();

            // Si on a reçu une action, on la traite...
			if (isset($params["action"])) {

				// Switch en fonction de l'action qui est envoyée en paramètre de la requête
				// Ce switch détermine la vue $vue et obtient le modèle $data
				switch($params["action"]) {

					case "descriptionVoiture" :

						// Affichage de la description de la voiture demandé
						// Si on a reçu le paramètre id de la voiture à afficher.
						if (isset($params["id"])) {
							$modeleDescription = $this->obtenirDAO("TabLangues", "description");
							$donnees["voiture"] = $modeleVoiture->obtenirParId($params["id"]);
							$donnees["images"]  = $modeleVoiture->obtenirImagesParIdVoiture($params["id"]);
							
							// On prend l'instance de la description de la voiture dans la langue que l'on doit afficher
							$uneLangueDescription = $modeleDescription->obtenirParId1Id2($donnees["voiture"]["id"] ,$idLangue);
							$donnees["description"] = $uneLangueDescription->getNom(); // La description dans la bonne langue.
						}

						$this->afficheVue("descriptionVoiture", $donnees);

						break;

                    case "filtre":      //Pour l'option de filtre de la page d'acceuil.
                        if( isset($params["prixMin"]) &&
                            isset($params["prixMax"]) &&
                            isset($params["marques"]) &&
                            isset($params["modele"]) &&
                            isset($params["anneeDeb"]) &&
                            isset($params["anneeFin"]) &&
                            isset($params["kmMin"]) &&
                            isset($params["kmMax"]) &&
                            isset($params["carburant"]) &&
                            isset($params["carrosserie"]) &&
                            isset($params["transmission"]) &&
                            isset($params["propulsion"])){
                                
                            $donnees["voitures"] = $modeleVoiture->obtenirVoitureFiltrer(
                                $params["prixMin"],
                                $params["prixMax"],
                                $params["marques"],
                                $params["modele"],
                                $params["anneeDeb"],
                                $params["anneeFin"],
                                $params["kmMin"],
                                $params["kmMax"],
                                $params["carburant"],
                                $params["carrosserie"],
                                $params["transmission"],
                                $params["propulsion"]);
                                                                                    
                            $this->afficheVue("accueil_debut", $donnees);
                            $this->afficheVue("listeVoitures", $donnees);
                            $this->afficheVue("accueil_fin_section_grille");
                            $this->afficheVue("voirPlus", $donnees);
                            $this->afficheVue("accueil_fin");

                        }
                        break;	
                    
                    case "chercher":
                        if( isset($params["critere"])){
                            Debug::toLog($params["critere"]);
                            $donnees["voitures"] = $modeleVoiture->obtenirVoitureChercher($params["critere"]);
                            $this->afficheVue("accueil_debut", $donnees);
                            $this->afficheVue("listeVoitures", $donnees);
                            $this->afficheVue("accueil_fin_section_grille");
                            $this->afficheVue("voirPlus");
                            $this->afficheVue("accueil_fin");
                        }
                        break;
						
					case "accueil":
					default:
						// Action par défaut


						// On affiche les 12 premieres tuiles
						$donnees["voitures"] = $modeleVoiture->obtenirLeNombreVoulu(0, 12, 'id');

						/* $vue = "Accueil";	 */	
						$this->afficheVue("accueil_debut", $donnees);
						$this->afficheVue("listeVoitures", $donnees);
						$this->afficheVue("accueil_fin_section_grille");
						$this->afficheVue("voirPlus", $donnees);
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
				$this->afficheVue("voirPlus", $donnees);
				$this->afficheVue("accueil_fin");
			}

			$this->afficheVue("piedDePage", $donnees);
		}
	}
?>