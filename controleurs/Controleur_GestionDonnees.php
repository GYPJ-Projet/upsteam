<?php
    class Controleur_GestionDonnees extends BaseControleur {
    
        public function getNomControleur() {
            return "GestionDonnees";
        }

		// La fonction qui sera appelée par le routeur
		public function traite(array $params) {
			
			// Initialisation des donnees a un tableau vide par défaut
			$donnees = array();
	
			// On charge les fichiers de langue selon la langue choisi par l'usager.
			$donnees["langue"] = $this->chargerLangue($params);

			$idLangue = $donnees["langue"]["idLangue"]; // On récupère l'ID de la langue

			$this->afficheVue("tete");
			$this->afficheVue("entete");
            $this->afficheVue("menu", $donnees);
			
			if (isset($params["action"])) {

				// Switch en fonction de l'action qui est envoyée en paramètre de la requête
				// Ce switch détermine la vue $vue et obtient le modèle $data
				switch($params["action"]) {
					// Affichage de la liste des marques
					case "gestionMarque":
						$this->afficheVue("listeDonnees", $donnees);
						$modeleMarque = $this->obtenirDAO("Marque");
						$donnees["marques"] = $modeleMarque->obtenirTous();
						$this->afficheVue("gestionMarque", $donnees);
						break;
					// Affichage de la liste des modèles
					case "gestionModele":
						$this->afficheVue("listeDonnees", $donnees);
						$modeleModele = $this->obtenirDAO("Modele");
						$donnees["modeles"] = $modeleModele->obtenirTousAvecMarque();
						$this->afficheVue("gestionModele", $donnees);
						break;
				}			
			} else {
				// Action par défaut
				$this->afficheVue("listeDonnees", $donnees);
				$this->afficheVue("pageDonnees", $donnees);
			}

			$this->afficheVue("piedDePage");
		}
	
    }
?>