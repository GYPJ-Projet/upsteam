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
					// Affichage de la liste des marques
					case "gestionMarque":
						// Nombre des marqued affichées sur une page
        				$marquesParPage = 10;
        				// Obtenir un nombre toutes les marques dans la base de données
        				$modeleMarque = $this->obtenirDAO("Marque");
						$nbMarquesTotal = $modeleMarque->obtenirNombreMarques();
						// Calculer le nombre des pages 
        				$donnees["nbPages"] = ceil($nbMarquesTotal / $marquesParPage);
        				if (isset($_GET["page"]) AND !empty($_GET["page"]) AND $_GET["page"] > 0 AND $_GET["page"] <= $donnees["nbPages"]) 
        				{
           					$_GET["page"] = intval($_GET["page"]);
            				$donnees["pageCourante"] = $_GET["page"];
        				} else 
        				{
            				$donnees["pageCourante"] = 1;
        				}
    
        				$depart = ($donnees["pageCourante"] - 1) * $marquesParPage;

						$this->afficheVue("listeDonnees", $donnees);
						$donnees["marques"] = $modeleMarque->obtenirMarques($depart, $marquesParPage);
						$this->afficheVue("gestionMarque", $donnees);
						break;
					// Affichage de la liste des modèles
					case "gestionModele":
						$this->afficheVue("listeDonnees", $donnees);
						$modeleModele = $this->obtenirDAO("Modele");
						$donnees["modeles"] = $modeleModele->obtenirTousAvecMarque();
						$this->afficheVue("gestionModele", $donnees);
						break;
					// Affichage de la liste des couleurs
					case "gestionCouleur":
						$this->afficheVue("listeDonnees", $donnees);
						$modeleMarque = $this->obtenirDAO("Couleur");
						$donnees["couleurs"] = $modeleMarque->obtenirTousAvecLangues();
						$this->afficheVue("gestionCouleur", $donnees);
						break;
				}			
			} else {
				// Action par défaut
				$this->afficheVue("listeDonnees", $donnees);
				$this->afficheVue("pageDonnees", $donnees);
			}

			$this->afficheVue("piedDePage", $donnees);
		}
	
    }
?>