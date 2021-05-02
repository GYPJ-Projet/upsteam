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

			// On pointes sur les modèles dont on a besoin.
			$modeleMarque          = $this->obtenirDAO("Marque");
			$modeleModele          = $this->obtenirDAO("Modele");
			$modeleAnnee           = $this->obtenirDAO("Annee");
			$modeleVoiture         = $this->obtenirDAO("Voiture");
			$modeleMotopropulseur  = $this->obtenirDAO("Motopropulseur");
			$modeleTypeCarburant   = $this->obtenirDAO("TabLangues", "typecarburant");
			$modeleCouleur         = $this->obtenirDAO("TabLangues", "couleur"); 
			$modeleTransmission    = $this->obtenirDAO("TabLangues", "transmission");
			$modeleTypeCarrosserie = $this->obtenirDAO("TabLangues", "typecarrosserie");
			//$modeleDescription     = $this->obtenirDAO("TabLangues", "description");

			if (isset($params["action"])) {

				// Switch en fonction de l'action qui est envoyée en paramètre de la requête
				// Ce switch détermine la vue $vue et obtient le modèle $data
				switch($params["action"]) {

					case "afficherFormulaireMarque":
						// Si le parametres id est existe, on affiche le formulaire pour la modification
						if (isset($params["id"])) {
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
							$donnees["marques"] = $modeleMarque->obtenirTousDisponible();
							$donnees["modele"] = $modeleModele->obtenirParId($params["id"]);
							$this->afficheVue("formulaireModele", $donnees);
						} else { // Sinon, on affiche le formulaire pour l'ajout
							$donnees["marques"] = $modeleMarque->obtenirTousDisponible();
							$this->afficheVue("formulaireModele", $donnees);
						}
						break;
					case "sauvegarderModele":
						if (isset($params["id"]) && isset($params["nom"]) && isset($params["idMarque"]) && isset($params["page"])) {
							if (isset($params["disponibilite"]) && $params["disponibilite"] == "on") $params["disponibilite"] = 1;
							else $params["disponibilite"] = 0;
							$nouvelleModele = new Modele($params["id"], $params["nom"], $params["idMarque"], $params["disponibilite"]);
							
							$reponse = $modeleModele->sauvegarder($nouvelleModele);
							
							header("Location: index.php?GestionDonnees&action=gestionModele");
								
						} else { // Sinon, on affiche le formulaire pour l'ajout
							$this->afficheVue("formulaireMarque", $donnees);
						}
						break;
					case "afficherFormulaireCouleur":
						// Si le parametres id est existe, on affiche le formulaire pour la modification
						if (isset($params["id"])) {
							$donnees["couleurs"] = $this->creerTabLangue($modeleCouleur->obtenirTousDisponible(), $idLangue);
							$this->afficheVue("formulaireCouleur", $donnees);
						} else { // Sinon, on affiche le formulaire pour l'ajout
							$donnees["marques"] = $modeleMarque->obtenirTousDisponible();
							$this->afficheVue("formulaireModele", $donnees);
						}
						break;
					case "afficherFormulaireVoiture":
						// Obtenir toutes les marques
						$donnees["marques"] = $modeleMarque->obtenirTousDisponible();
						// Obtenir toutes les modeles
						$donnees["modeles"] = $modeleModele->obtenirTousDisponible();
						// Obtenir toutes les années
						$donnees["annees"] = $modeleAnnee->obtenirTousDisponible();
						// Obtenir toutes les motopropulseur
						$donnees["motopropulseurs"] = $modeleMotopropulseur->obtenirTousDisponible();
						// Obtenir toutes les types de carburant
						$donnees["typesCarburant"] = $this->creerTabLangue($modeleTypeCarburant->obtenirTousDisponible(), $idLangue);
						// Obtenir toutes les couleurs
						$donnees["couleurs"]         = $this->creerTabLangue($modeleCouleur->obtenirTousDisponible(), $idLangue);
						// Obtenir toutes les types de transmission
						$donnees["transmissions"]    = $this->creerTabLangue($modeleTransmission->obtenirTousDisponible(), $idLangue);
						// Obtenir toutes les types de carrosserie
						$donnees["typesCarrosserie"] = $this->creerTabLangue($modeleTypeCarrosserie->obtenirTousDisponible(), $idLangue);
						// Obtenir toutes les types de carrosserie
						//$donnees["descriptions"] = $this->creerTabLangue($modeleDescription->obtenirTousDisponible(), $idLangue);

						// Si le parametres id est existe, on affiche le formulaire pour la modification
						if (isset($params["id"])) {
							// Obtenir les données à propos de la voiture avec id 
							$donnees["voiture"] = $modeleVoiture->obtenirParId($params["id"]);	
						} 
						$this->afficheVue("formulaireVoiture", $donnees);
						break;
					case "sauvegarderVoiture":
						if (isset($params["id"])  && isset($params["idModele"]) && isset($params["idAnnee"]) && isset($params["kilometrage"])
							&& isset($params["dateArrivee"]) && isset($params["prixAchat"]) && isset($params["prixVente"]) 
							&& isset($params["idMotopropulseur"]) && isset($params["idTypeCarburant"]) && isset($params["idCouleur"])
							&& isset($params["idTransmission"]) && isset($params["idTypeCarrosserie"]) && isset($params["vna"])
							&& isset($params["page"])) {
							if (isset($params["disponibilite"]) && $params["disponibilite"] == "on") $params["disponibilite"] = 1;
							else $params["disponibilite"] = 0;
							
							$nouvelleVoiture = new Voiture($params["id"], $params["idModele"], $params["idAnnee"], $params["kilometrage"],
							$params["dateArrivee"], $params["prixAchat"], $params["prixVente"], $params["idMotopropulseur"], 
							$params["idTypeCarburant"], $params["idCouleur"], $params["idTransmission"], $params["idTypeCarrosserie"],
							$params["vna"], $params["disponibilite"]);
								
							$reponse = $modeleVoiture->sauvegarde($nouvelleVoiture);
								
							header("Location: index.php?GestionDonnees&action=gestionVoiture" . $params["page"]);
									
						} else { // Sinon, on affiche le formulaire pour l'ajout
							$this->afficheVue("formulaireVoiture", $donnees);
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