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
			$this->afficheVue("entete", $donnees);
            $this->afficheVue("menu", $donnees);
			
			
			if (isset($params["action"])) {

				// Switch en fonction de l'action qui est envoyée en paramètre de la requête
				// Ce switch détermine la vue $vue et obtient le modèle $data
				switch($params["action"]) {

					case "gestionMarque":
						$this->afficheVue("listeDonnees", $donnees);
						$modeleMarque = $this->obtenirDAO("Marque");
						$donnees["marques"] = $modeleMarque->obtenirTous();
						$this->afficheVue("gestionMarque", $donnees);
						break;
					case "sauvegarderMarque":
						if (isset($params["id"]) && isset($params["nom"])) {
							if (isset($params["disponibilite"]) && $params["disponibilite"] == "on") $params["disponibilite"] = 1;
							else $params["disponibilite"] = 0;
							$modeleMarque = $this->obtenirDAO("Marque");
							$nouvelleMarque = new Marque($params["id"], $params["nom"], $params["disponibilite"]);
							var_dump($nouvelleMarque);
							$reponse = $modeleMarque->sauvegarder($nouvelleMarque);
							//header("Location: index.php?GestionDonnees&action=gestionMarque");
							// Comme la redirection php ne fonctionne pas puisque le menu active le JS
							// on est obligé d'utiliser la redirection JS à la place
?>
							<script> location.replace("index.php?GestionDonnees&action=gestionMarque"); </script>
<?php							
						} else { // Sinon, on affiche le formulaire pour l'ajout
							$this->afficheVue("formulaireMarque", $donnees);
						}
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