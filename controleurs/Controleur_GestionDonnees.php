<?php
    class Controleur_GestionDonnees extends BaseControleur {
    
        // La fonction qui sera appelée par le routeur
		public function traite(array $params) {
			
			// Initialisation des donnees a un tableau vide par défaut
			$donnees = array();
	
			$this->afficheVue("tete");
			$this->afficheVue("entete");
			
			if (isset($params["action"])) {

				// Switch en fonction de l'action qui est envoyée en paramètre de la requête
				// Ce switch détermine la vue $vue et obtient le modèle $data
				switch($params["action"]) {

					case "gestionMarque":
						$this->afficheVue("listeDonnees", $donnees);
						$modeleMarque = $this->obtenirDAO("Marque");
						$donnees["marques"] = $modeleMarque->obtenirTous();
						$donnees["titre"] = "Gestion des Marques";
						$this->afficheVue("gestionMarque", $donnees);
					
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