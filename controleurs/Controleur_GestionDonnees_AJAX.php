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
							$this->afficheVue("formulaireModele", $donnees);
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
					case "afficheModeleParIdMarque":
						if (isset($params["idMarque"])) {
							$donnees["modeles"] = $modeleModele->rechercheParMarque($params["idMarque"]);
							echo json_encode($donnees["modeles"]);
						}	
						break;
					case "sauvegarderVoiture":
						if (isset($params["id"])  && isset($params["idModele"]) && isset($params["idAnnee"]) && isset($params["kilometrage"])
							&& isset($params["dateArrivee"]) && isset($params["prixAchat"]) && isset($params["prixVente"]) 
							&& isset($params["idMotopropulseur"]) && isset($params["idTypeCarburant"]) && isset($params["idCouleur"])
							&& isset($params["idTransmission"]) && isset($params["idTypeCarrosserie"]) && isset($params["vna"])
							&& isset($params["page"]) && isset($params["fr-fr"]) && isset($params["en-gb"])) {
							if (isset($params["disponibilite"]) && $params["disponibilite"] == "on") $params["disponibilite"] = 1;
							else $params["disponibilite"] = 0;
							
							$nouvelleVoiture = new Voiture($params["id"], $params["idModele"], $params["idAnnee"], $params["kilometrage"],
							$params["dateArrivee"], $params["prixAchat"], $params["prixVente"], $params["idMotopropulseur"], 
							$params["idTypeCarburant"], $params["idCouleur"], $params["idTransmission"], $params["idTypeCarrosserie"],
							$params["disponibilite"], $params["vna"]);
								
							$reponse = $modeleVoiture->sauvegarde($nouvelleVoiture);
							//Création du repertoire avec nom - id de la voiture ajoutée
							if (isset($reponse) && $reponse > 0) {
								//Créer le repertoire avec le nom - id de voiture
								mkdir(REPERTOIRE_IMAGES.$reponse, 0700);
								// Enregistrer chaque fichier sur le serveur
								for ($i = 0, $l = count($_FILES['images']["name"]); $i < $l; $i++) { 	
									//noms de fichier
									$nomFichier = $_FILES['images']["name"][$i];
									//ficheir extention
									$imageFichierType = strtolower(pathinfo($nomFichier, PATHINFO_EXTENSION));
									//taille de fichier
									$fichierTaille = $_FILES['images']["size"][$i];
									$error =  FALSE;
									//Vérifier extension
									if($imageFichierType !="jpg" && $imageFichierType !="jpeg" && $imageFichierType != "png"
									&& $imageFichierType !="gif")
									{
										$message = "Fichier doit être *.jpg";
										$error = TRUE;
									}
									//Vérifier le taille 2mb
									if($fichierTaille > 2000000){
										$message = "File must be smaller than 2mb";
										$error = TRUE;
									}
									//Vérifier si le fichier est exist;
									if(file_exists(REPERTOIRE_IMAGES.$reponse.'/'.$nomFichier))
									{
										$message = "File already exist";
										$error = TRUE;
									}
									
									if($error == FALSE){
										if(move_uploaded_file($_FILES['images']["tmp_name"][$i], REPERTOIRE_IMAGES.$reponse.'/'.$nomFichier)){
											//enregistrer dans la BD
						
											$modeleVoiture->sauvegardeImages($nomFichier, $reponse);
										}
									}
								}
							}
							//Enregistrer les description
							$modeleVoiture->sauvegardeDescriptions($params["fr-fr"], $reponse, 1);
							$modeleVoiture->sauvegardeDescriptions($params["en-gb"], $reponse, 2);

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