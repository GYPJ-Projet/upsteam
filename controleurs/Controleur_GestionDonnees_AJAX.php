<?php
    class Controleur_GestionDonnees_AJAX extends BaseControleur {
    
        // La fonction qui sera appelée par le routeur
		public function traite(array $params) {
			
			// Initialisation des donnees a un tableau vide par défaut
			$donnees = array();
			
			if (isset($params["action"])) {

				// Switch en fonction de l'action qui est envoyée en paramètre de la requête
				// Ce switch détermine la vue $vue et obtient le modèle $data
				switch($params["action"]) {

					case "afficherFormulaireMarque":
						// Si le parametres id est existe, on affiche le formulaire pour la modification
						if (isset($params["id"])) {
							$modeleMarque = $this->obtenirDAO("Marque");
							$donnees["marque"] = $modeleMarque->obtenirParId($params["id"]);
							$donnees["titreFormulaire"] = "Modification de Marque";
							$this->afficheVue("formulaireMarque", $donnees);
						} else { // Sinon, on affiche le formulaire pour l'ajout
							$this->afficheVue("formulaireMarque", $donnees);
						}
						break;
			
				}			
			} else {
				// Action par défaut
				$this->afficheVue("pageDonnees");
	
			}

		}
	
    }
?>