<?php
    class Controleur_GestionDonnees_AJAX extends BaseControleur {
    
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

			if (isset($params["action"])) {

				// Switch en fonction de l'action qui est envoyée en paramètre de la requête
				// Ce switch détermine la vue $vue et obtient le modèle $data
				switch($params["action"]) {

					case "afficherFormulaireMarque":
						// Si le parametres id est existe, on affiche le formulaire pour la modification
						if (isset($params["id"])) {
							$modeleMarque = $this->obtenirDAO("Marque");
							$donnees["marque"] = $modeleMarque->obtenirParId($params["id"]);
							$this->afficheVue("formulaireMarque", $donnees);
						} else { // Sinon, on affiche le formulaire pour l'ajout
							$this->afficheVue("formulaireMarque", $donnees);
						}
						break;
					case "sauvegarderMarque":
						if (isset($params["id"]) && isset($params["nom"]) && isset($params["page"])) {
							if (isset($params["disponibilite"]) && $params["disponibilite"] == "on") $params["disponibilite"] = 1;
							else $params["disponibilite"] = 0;
							$modeleMarque = $this->obtenirDAO("Marque");
							$nouvelleMarque = new Marque($params["id"], $params["nom"], $params["disponibilite"]);
							$reponse = $modeleMarque->sauvegarder($nouvelleMarque);
							
							header("Location: index.php?GestionDonnees&action=gestionMarque&page=" . $params["page"]);
				
						} else { // Sinon, on affiche le formulaire pour l'ajout
							$this->afficheVue("formulaireMarque", $donnees);
						}
						break;
					
					case "afficherFormulaireModele":
						// Si le parametres id est existe, on affiche le formulaire pour la modification
						if (isset($params["id"])) {
							$modeleMarque = $this->obtenirDAO("Marque");
							$donnees["marques"] = $modeleMarque->obtenirTousDisponible();
							$modeleModele = $this->obtenirDAO("Modele");
							$donnees["modele"] = $modeleModele->obtenirParId($params["id"]);
							$this->afficheVue("formulaireModele", $donnees);
						} else { // Sinon, on affiche le formulaire pour l'ajout
							$modeleMarque = $this->obtenirDAO("Marque");
							$donnees["marques"] = $modeleMarque->obtenirTousDisponible();
							$this->afficheVue("formulaireModele", $donnees);
						}
						break;
					case "sauvegarderModele":
						if (isset($params["id"]) && isset($params["nom"]) && isset($params["idMarque"])) {
							if (isset($params["disponibilite"]) && $params["disponibilite"] == "on") $params["disponibilite"] = 1;
							else $params["disponibilite"] = 0;
							$modeleModele = $this->obtenirDAO("Modele");
							$nouvelleModele = new Modele($params["id"], $params["nom"], $params["idMarque"], $params["disponibilite"]);
							
							$reponse = $modeleModele->sauvegarder($nouvelleModele);
							
							header("Location: index.php?GestionDonnees&action=gestionModele");
								
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