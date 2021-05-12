<?php
    class Controleur_GestionDonnees extends BaseControleur {
    
        public function getNomControleur() {
            return "GestionDonnees";
        }

		// La fonction qui sera appelée par le routeur
		public function traite(array $params) {
			
			//Vérifier la permission
			if (!(isset($_SESSION["usager"])) || isset($_SESSION["usager"]) && $_SESSION["usager"]->getIdRole() > 2) {
				header("Location: index.php?Voiture");
			}
			// Initialisation des donnees a un tableau vide par défaut
			$donnees = array();
	
			// On charge les fichiers de langue selon la langue choisi par l'usager.
			$donnees["langue"] = $this->chargerLangue($params);

			$idLangue = $donnees["langue"]["idLangue"]; // On récupère l'ID de la langue

			$this->afficheVue("tete");

			$this->afficheVue("entete", $donnees);
            $this->afficheVue("menu", $donnees);
			
			// On pointes sur les modèles dont on a besoin.
			$modeleMarque          = $this->obtenirDAO("Marque");
			$modeleModele          = $this->obtenirDAO("Modele");
			$modeleVoiture         = $this->obtenirDAO("Voiture");
			$modeleTaxe            = $this->obtenirDAO("Taxe");
			$modeleProvince        = $this->obtenirDAO("province");
			$modeleAnnee           = $this->obtenirDAO("Annee");
			$modeleMotopropulseur  = $this->obtenirDAO("Motopropulseur");
			$modeleCouleur         = $this->obtenirDAO("Couleur");
			$modeleFacture		   = $this->obtenirDAO("Facture");
			
			$modeleTypeCarburant   = $this->obtenirDAO("TabLangues", "typecarburant");
			$modeleTransmission    = $this->obtenirDAO("TabLangues", "transmission");
			$modeleTypeCarrosserie = $this->obtenirDAO("TabLangues", "typecarrosserie");
			$modeleDescription     = $this->obtenirDAO("TabLangues", "description");
			$modeleStatut          = $this->obtenirDAO("TabLangues", "statut");
			//$modeleModePaiement    = $this->obtenirDAO("TabLangues", "modepaiement");
			//$modeleExpedition      = $this->obtenirDAO("TabLangues", "expedition");

			// On prend les données dans la langue qu'il faut afficher.	
			$donnees["statut"]   = $this->creerTabLangue($modeleStatut->obtenirTous(), $idLangue);
			//$donnees["modePaiement"] = $this->creerTabLangue($modeleModePaiement->obtenirTousDisponible(), $idLangue);
			//$donnees["expedition"]   = $this->creerTabLangue($modeleExpedition->obtenirTousDisponible(), $idLangue);
			//$donnees["typeCarburant"]   = $this->creerTabLangue($modeleTypeCarburant->obtenirTousDisponible(), $idLangue);
			//$donnees["transmission"]    = $this->creerTabLangue($modeleTransmission->obtenirTousDisponible(), $idLangue);
			//$donnees["typeCarrosserie"] = $this->creerTabLangue($modeleTypeCarrosserie->obtenirTousDisponible(), $idLangue);

			if (isset($params["action"])) {
				// Switch en fonction de l'action qui est envoyée en paramètre de la requête
				// Ce switch détermine la vue $vue et obtient le modèle $data
				switch($params["action"]) {
					// Affichage de la liste des marques
					case "gestionMarque":
						// Nombre des marques affichées sur une page
        				$marquesParPage = 10;
        				// Obtenir un nombre toutes les marques dans la base de données
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

						//Par defaut, on trie par id
						if (isset($_GET["tri"])) $tri = $_GET["tri"];
						else $tri = 'id';
						//Par defaut, on tri dans l'ordre ascendente
						if (isset($_GET["ordre"])) $ordre = $_GET["ordre"];
						else $ordre = 'ASC';
						//Passer les paramètres à la vue
						$donnees["tri"] = $tri;
						$donnees["ordre"] = $ordre;
						$this->afficheVue("listeDonnees", $donnees);
						$donnees["marques"] = $modeleMarque->obtenirMarques($depart, $marquesParPage, $tri, $ordre);
						$this->afficheVue("gestionMarque", $donnees);
						break;
					case "afficherFormulaireMarque":
						$donnees["usager"] = $_SESSION["usager"];
						$this->afficheVue("listeDonnees", $donnees);
						// Si le parametres id est existe, on affiche le formulaire pour la modification
						if (isset($params["id"])) {
							$donnees["marque"] = $modeleMarque->obtenirParId($params["id"]);
							$this->afficheVue("formulaireMarque", $donnees);
						} else { // Sinon, on affiche le formulaire pour l'ajout
							$this->afficheVue("formulaireMarque", $donnees);
						}
						break;
					// Affichage de la liste des modèles
					case "gestionModele":
						// Nombre des modeles affichées sur une page
        				$modelesParPage = 10;
        				// Obtenir un nombre toutes les modeles dans la base de données
						$nbModelesTotal = $modeleModele->obtenirNombreModeles();
						// Calculer le nombre des pages 
        				$donnees["nbPages"] = ceil($nbModelesTotal / $modelesParPage);
        				if (isset($_GET["page"]) AND !empty($_GET["page"]) AND $_GET["page"] > 0 AND $_GET["page"] <= $donnees["nbPages"]) 
        				{
           					$_GET["page"] = intval($_GET["page"]);
            				$donnees["pageCourante"] = $_GET["page"];
        				} else 
        				{
            				$donnees["pageCourante"] = 1;
        				}
    
        				$depart = ($donnees["pageCourante"] - 1) * $modelesParPage;
						
						//Par defaut, on trie par id
						if (isset($_GET["tri"])) $tri = $_GET["tri"];
						else $tri = 'id';
						//Par defaut, on tri dans l'ordre ascendente
						if (isset($_GET["ordre"])) $ordre = $_GET["ordre"];
						else $ordre = 'ASC';
						//Passer les paramètres à la vue
						$donnees["tri"] = $tri;
						$donnees["ordre"] = $ordre;

						$this->afficheVue("listeDonnees", $donnees);
						$donnees["modeles"] = $modeleModele->obtenirTousAvecMarque($depart, $modelesParPage, $tri, $ordre);
						$this->afficheVue("gestionModele", $donnees);
						break;
					case "afficherFormulaireModele":
						$donnees["usager"] = $_SESSION["usager"];
						$this->afficheVue("listeDonnees", $donnees);
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
					// Affichage de la liste des couleurs
					case "gestionCouleur":
                        // Nombre des marques affichées sur une page
        				$couleursParPage = 10;
        				// Obtenir un nombre toutes les marques dans la base de données
						$nbCouleursTotal = $modeleCouleur->obtenirNombreCouleurs() / 2;
						// Calculer le nombre des pages 
        				$donnees["nbPages"] = ceil($nbCouleursTotal / $couleursParPage);
        				if (isset($_GET["page"]) AND !empty($_GET["page"]) AND $_GET["page"] > 0 AND $_GET["page"] <= $donnees["nbPages"]) 
        				{
           					$_GET["page"] = intval($_GET["page"]);
            				$donnees["pageCourante"] = $_GET["page"];
        				} else 
        				{
            				$donnees["pageCourante"] = 1;
        				}
    
        				$depart = ($donnees["pageCourante"] - 1) * $couleursParPage;

						//Par defaut, on trie par id
						if (isset($_GET["tri"])) $tri = $_GET["tri"];
						else $tri = 'id';
						//Par defaut, on tri dans l'ordre ascendente
						if (isset($_GET["ordre"])) $ordre = $_GET["ordre"];
						else $ordre = 'ASC';
						//Passer les paramètres à la vue
						$donnees["tri"] = $tri;
						$donnees["ordre"] = $ordre;
                        
						$this->afficheVue("listeDonnees", $donnees);

                        $donnees["couleurs"] = $modeleCouleur->obtenirParIdLangueCouleurs($depart, $couleursParPage, $tri, $ordre, $idLangue);
						$this->afficheVue("gestionCouleur", $donnees);
						break;
                    
                    case "afficherFormulaireCouleur":
                        $donnees["usager"] = $_SESSION["usager"];
						$this->afficheVue("listeDonnees", $donnees);

						// Si le parametres id existe, on affiche le formulaire pour la modification
						if (isset($params["id"])) {
							$donnees["couleur"] = $modeleCouleur->obtenirParIdCouleurs($params["id"]);
							$this->afficheVue("formulaireCouleur", $donnees);
						} else { // Sinon, on affiche le formulaire pour l'ajout
							$this->afficheVue("formulaireCouleur", $donnees);
						}
                        break;

					// Affichage de la liste des voitures
					case "gestionVoiture":
//                         //PH
//                         //GARDER CE COMMENTAIRE. C'EST IMPORTANT POUR L'INSTANT.
//                         $texte = 
//                                 'Une ligne,
// deux, lignes,
// trois lignes';
//                         CreerPDF::creationPDF('test', 'Invoice', $texte);
						// Nombre des voitures affichées sur une page
        				$voituresParPage = 10;
        				// Obtenir un nombre toutes les voitures dans la base de données
						$nbVoituresTotal = $modeleVoiture->combienVoitures();
						// Calculer le nombre des pages 
        				$donnees["nbPages"] = ceil($nbVoituresTotal / $voituresParPage);
        				if (isset($_GET["page"]) AND !empty($_GET["page"]) AND $_GET["page"] > 0 AND $_GET["page"] <= $donnees["nbPages"]) 
        				{
           					$_GET["page"] = intval($_GET["page"]);
            				$donnees["pageCourante"] = $_GET["page"];
        				} else 
        				{
            				$donnees["pageCourante"] = 1;
        				}
    
        				$depart = ($donnees["pageCourante"] - 1) * $voituresParPage;
						
						//Par defaut, on trie par id
						if (isset($_GET["tri"])) $tri = $_GET["tri"];
						else $tri = 'id';
						//Par defaut, on tri dans l'ordre ascendente
						if (isset($_GET["ordre"])) $ordre = $_GET["ordre"];
						else $ordre = 'ASC';
					
						//Passer les paramètres à la vue
						$donnees["tri"] = $tri;
						$donnees["ordre"] = $ordre;
						$this->afficheVue("listeDonnees", $donnees);
						$donnees["voitures"] = $modeleVoiture->obtenirToutesVoituresAvecTri($depart, $voituresParPage, $tri, $ordre, $idLangue);
						$this->afficheVue("gestionVoiture", $donnees);
						break;
					// Afficher le formulaire d'ajout ou de la modification
					case "afficherFormulaireVoiture":
						$donnees["usager"] = $_SESSION["usager"];
						// Obtenir toutes les marques
						$donnees["marques"] = $modeleMarque->obtenirTousDisponible();
						// Obtenir toutes les modeles
						$donnees["modeles"] = $modeleModele->obtenirTousDisponible();
						// Obtenir toutes les années
						$donnees["annees"] = $modeleAnnee->obtenirTousDisponible();
						// Obtenir toutes les motopropulseur
						$donnees["motopropulseurs"]  = $modeleMotopropulseur->obtenirTousDisponible();
						// Obtenir toutes les types de carburant
						$donnees["typesCarburant"]   = $this->creerTabLangue($modeleTypeCarburant->obtenirTousDisponible(), $idLangue);
						// Obtenir toutes les couleurs
						$donnees["couleurs"]         = $this->creerTabLangue($modeleCouleur->obtenirTousDisponible(), $idLangue);
						// Obtenir toutes les types de transmission
						$donnees["transmissions"]    = $this->creerTabLangue($modeleTransmission->obtenirTousDisponible(), $idLangue);
						// Obtenir toutes les types de carrosserie
						$donnees["typesCarrosserie"] = $this->creerTabLangue($modeleTypeCarrosserie->obtenirTousDisponible(), $idLangue);

						// Si le parametres id est existe, on affiche le formulaire pour la modification
						if (isset($params["id"])) {
							// Obtenir les données à propos de la voiture avec id 
							$donnees["voiture"] = $modeleVoiture->obtenirParId($params["id"]);
							// Obtenir les images pour une voiture choisie
							$donnees["images"] = $modeleVoiture->obtenirImagesParIdVoiture($params["id"]);
							// Obtenir les descriptions pour une voiture choisie
							$donnees["descriptions"] = $modeleVoiture->obtenirDescriptionParId($params["id"]);
						}
						$donnees["langues"] = $modeleVoiture->obtenirLangues();
						$this->afficheVue("listeDonnees", $donnees);
						$this->afficheVue("formulaireVoiture", $donnees);
						break;

                    case "gestionTaxe":
                        // Nombre des marques affichées sur une page
                        $taxesParPage = 10;
                        // Obtenir un nombre toutes les marques dans la base de données
                        $nbTaxesTotal = $modeleTaxe->obtenirNombreTaxes();
                        // Calculer le nombre des pages 
                        $donnees["nbPages"] = ceil($nbTaxesTotal / $taxesParPage);
                        if (isset($_GET["page"]) AND !empty($_GET["page"]) AND $_GET["page"] > 0 AND $_GET["page"] <= $donnees["nbPages"]) 
                        {
                            $_GET["page"] = intval($_GET["page"]);
                            $donnees["pageCourante"] = $_GET["page"];
                        } else 
                        {
                            $donnees["pageCourante"] = 1;
                        }
    
                        $depart = ($donnees["pageCourante"] - 1) * $taxesParPage;

                        //Par defaut, on trie par id
                        if (isset($_GET["tri"])) $tri = $_GET["tri"];
                        else $tri = 'taxe.id';
                        //Par defaut, on tri dans l'ordre ascendente
                        if (isset($_GET["ordre"])) $ordre = $_GET["ordre"];
                        else $ordre = 'ASC';
                        //Passer les paramètres à la vue
                        $donnees["tri"] = $tri;
                        $donnees["ordre"] = $ordre;
                        $this->afficheVue("listeDonnees", $donnees);
                        $donnees["taxes"] = $modeleTaxe->obtenirTaxes($depart, $taxesParPage, $tri, $ordre, $idLangue);
                        $this->afficheVue("gestionTaxe", $donnees);
                        break;

                    case "afficherFormulaireTaxe":
                        $donnees["usager"] = $_SESSION["usager"];
                        $this->afficheVue("listeDonnees", $donnees);
                        // On ajoute la liste des province pour le select du formulaire.
                        $donnees["province"] = $modeleProvince->obtenirToutParLangueProvince($idLangue);
                        // Si le parametres id existe, on affiche le formulaire pour la modification
                        if (isset($params["id"])) {
                            $donnees["taxe"] = $modeleTaxe->obtenirTaxeParId($params["id"], $idLangue);
                            $this->afficheVue("formulaireTaxe", $donnees);
                        } else { // Sinon, on affiche le formulaire pour l'ajout
                            $this->afficheVue("formulaireTaxe", $donnees);
                        }
                    	break;
					
					case "gestionCommande":
                        // Nombre des commandes affichées sur une page
                        $commandesParPage = 10;
                        // Obtenir un nombre toutes les commandes dans la base de données
                        $nbCommandesTotal = $modeleFacture->obtenirNombreCommandes();
                        // Calculer le nombre des pages 
                        $donnees["nbPages"] = ceil($nbCommandesTotal / $commandesParPage);
                        if (isset($_GET["page"]) AND !empty($_GET["page"]) AND $_GET["page"] > 0 AND $_GET["page"] <= $donnees["nbPages"]) 
                        {
                            $_GET["page"] = intval($_GET["page"]);
                            $donnees["pageCourante"] = $_GET["page"];
                        } else 
                        {
                            $donnees["pageCourante"] = 1;
                        }
    
                        $depart = ($donnees["pageCourante"] - 1) * $commandesParPage;

                        //Par defaut, on trie par id
                        if (isset($_GET["tri"])) $tri = $_GET["tri"];
                        else $tri = 'id';
                        //Par defaut, on tri dans l'ordre ascendente
                        if (isset($_GET["ordre"])) $ordre = $_GET["ordre"];
                        else $ordre = 'ASC';
                        //Passer les paramètres à la vue
                        $donnees["tri"] = $tri;
                        $donnees["ordre"] = $ordre;
                        $this->afficheVue("listeDonnees", $donnees);
                        $donnees["commandes"] = $modeleFacture->obtenirToutCommandesAvecTri($depart, $commandesParPage, $tri, $ordre, $idLangue);
                        $this->afficheVue("gestionCommande", $donnees);
                        break;

					case "afficherFormulaireCommande":
						// Obtenir tous les status
						$donnees["statut"]   = $this->creerTabLangue($modeleStatut->obtenirTous(), $idLangue);
						
						$this->afficheVue("listeDonnees", $donnees);
						// Si le parametres id existe, on affiche le formulaire pour la modification
						if (isset($params["id"])) {
							$donnees["commande"] = $modeleFacture->obtenirCommandeParId($params["id"], $idLangue);
							$donnees["voitures"] = $modeleVoiture->obtenirTousParIdFacture($params["id"]);
							$this->afficheVue("formulaireCommande", $donnees);
						} 
						break;
					default:
						// Action par défaut
						$this->afficheVue("listeDonnees", $donnees);
						$this->afficheVue("pageDonnees", $donnees);
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