<?php
    class Controleur_GestionDonnees extends BaseControleur {
    
        public function getNomControleur() {
            return "GestionDonnees";
        }

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

					case "gestionMarque":
						$this->afficheVue("listeDonnees", $donnees);
						$modeleMarque = $this->obtenirDAO("Marque");
						$donnees["marques"] = $modeleMarque->obtenirTous();
						$donnees["titre"] = "Gestion des Marques";
						$donnees["btnAjout"] = "Ajout d'un nouvel élément";
						$this->afficheVue("gestionMarque", $donnees);
						break;
					case "sauvegarderMarque":
						var_dump($params);
						if (isset($params["id"]) && isset($params["nom"]) && isset($params["disponibilite"])) {
							if ($params["disponibilite"]=="on") $params["disponibilite"] = true;
							else $params["disponibilite"] = false;
							$modeleMarque = $this->obtenirDAO("Marque");
							$reponse = $modeleMarque->sauvegarder($params["id"], $params["nom"], $params["disponibilite"]);
								
							header("Location: index.php?GestionDonnees&action=gestionMarque");
						} else { // Sinon, on affiche le formulaire pour l'ajout
							$this->afficheVue("formulaireMarque", $donnees);
						}
						break;
				}			
			} else {
				// Action par défaut
				$this->afficheVue("listeDonnees");
				$this->afficheVue("pageDonnees");
	
			}

			$this->afficheVue("piedDePage");
		}
	
    }
?>