<?php
	class Controleur_Taxes_AJAX extends BaseControleur {	
        

        // Méthode qui retourne le nom du contrôleur où aller chercher la langue 
		public function getNomControleur() {
			return "Taxes";
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
        
                    case "getTaxesProvince":

                        
                        if (isset($params["idProvince"])) {

                            Debug::toLog($params["idProvince"], "class Controleur_Taxes_AJAX - function traite - case getTaxesProvince  - params[idProvince] :");

                            $modeleTaxe  = $this->obtenirDAO("Taxe");

                            // On va chercher les taxe de la Province dans la table Taxe de la BD

                            $donnees["taxes"] = $modeleTaxe->obtenirTaxesParIdProvince($params["idProvince"]);

                            Debug::toLog($donnees["taxes"], "class Controleur_Taxes_AJAX - function traite - case getTaxesProvince  - donnees[taxes] :");
                            
                            $vue = "envoyerLesTaxesProvince";
                            $this->afficheVue($vue, $donnees); // On retourne ce nombre au javascript AJAX.
                            break;
                        }
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