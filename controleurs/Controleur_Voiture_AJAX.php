<?php
	class Controleur_Voiture_AJAX extends BaseControleur {	
        

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

            $idLangue = $donnees["langue"]["idLangue"];  // On récupère l'ID de la langue

            if (isset($params["action"])) {

				// La vue est vides par défaut
                $vue = "";
                
				// Switch en fonction de l'action qui est envoyée en paramètre de la requète
				// Ce switch détermine la vue $vue et obtient le modèle $donnees
				switch($params["action"]) {
                    case "obtenirToutModele":       // PH - Pour le filtre de la page d'acceuil
                        $modeleModele = $this->obtenirDAO("Modele");
                        $data = $modeleModele->obtenirToutDisponible();
                        echo json_encode($data);
                        break;

                    
                    case "obtenirSelectionModele":      // PH - Pour le filtre de la page d'acceuil
                        $modeleModele = $this->obtenirDAO("Modele");
                        $data = $modeleModele->rechercheParMarque($params["liste"]);
                        echo json_encode($data);
                        break;

					case "afficheListeVoitures":	
                        // On affiche la lsite des voitures demandées selon index, 
                        // le nombre et le tri
                        if (isset($params["indexDepart"])) {
                            $indexDepart = $params["indexDepart"];
                        }
                        if (isset($params["combien"])) {
                            $nombreAAfficher = $params["combien"];
                        }
                        if (isset($params["tri"])) {
                            $tri = $params["tri"];
                        }

                        $modeleVoiture         = $this->obtenirDAO("Voiture");
						$modeleTypeCarburant   = $this->obtenirDAO("TabLangues", "typecarburant");
						$modeleCouleur         = $this->obtenirDAO("TabLangues", "couleur"); 
						$modeleTransmission    = $this->obtenirDAO("TabLangues", "transmission");
						$modeleTypeCarrosserie = $this->obtenirDAO("TabLangues", "typecarrosserie");


                        if ($nombreAAfficher > 0) {
                            // On affiche les 12 premieres tuiles		// On affiche les 12 premieres tuiles
                            $donnees["voitures"] =  $modeleVoiture->obtenirLeNombreVoulu($indexDepart, $nombreAAfficher, $tri);
                        }

                        $donnees["typeCarburant"]   = $this->creerTabLangue($modeleTypeCarburant->obtenirTousDisponible(), $idLangue);
						$donnees["couleur"]         = $this->creerTabLangue($modeleCouleur->obtenirTousDisponible(), $idLangue);
						$donnees["transmission"]    = $this->creerTabLangue($modeleTransmission->obtenirTousDisponible(), $idLangue);
						$donnees["typeCarrosserie"] = $this->creerTabLangue($modeleTypeCarrosserie->obtenirTousDisponible(), $idLangue);
				
                        $vue = "ListeVoitures";
                        $this->afficheVue($vue, $donnees);  // On retourne le résultat au browser
                        break;	


                    case "combienVoitures":
                        // On va chercher le nombre d'enregistrement dans la table Voitures de la BD
                        $modeleVoiture = $this->obtenirDAO("Voiture");
                        $donnees["NombreDeVoitures"] = $modeleVoiture->combienVoitures();
                        $vue = "combienVoitures";
                        $this->afficheVue($vue, $donnees); // On retourne ce nombre au javascript AJAX.
                        break;
            	
					default:
						echo "ERREUR";		
				}						
			} else {
				// Action par défaut
				echo "ERREUR";					
			}			
		}	

	}
?>