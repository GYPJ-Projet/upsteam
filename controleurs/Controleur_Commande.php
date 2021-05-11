<?php
	class Controleur_Commande extends BaseControleur {

		// Méthode qui retourne le nom du contrôleur où aller chercher la langue 
		public function getNomControleur() {
			return "Commande";
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


            // Si on a reçu une action, on la traite...
			if (isset($params["action"])) {

				// Switch en fonction de l'action qui est envoyée en paramètre de la requête
				// Ce switch détermine la vue $vue et obtient le modèle $data
				switch($params["action"]) {

					case "afficherCommande" :

						// Affichage de la commande du client 
						// Si on a reçu les paramètres Panier .
						if (isset($params["panier"])) {
							// on converti le tableau reçu en array
							$donnees["panier"] = json_decode($params["panier"], true);
						}

						$this->afficheVue("AfficherCommande", $donnees);

						break;                   
				}			
			} else {
				// traitement à determiner ici
			}

			$this->afficheVue("piedDePage", $donnees);
		}
	}
?>