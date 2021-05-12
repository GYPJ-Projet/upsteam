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

			$statutPaypalCorrespondant = array("PENDING"=> 1, 
											   "COMPLETED"=> 3);
			
			// On charge les fichiers de langue selon la langue choisi par l'usager.
			$donnees["langue"] = $this->chargerLangue($params);

			$idLangue = $donnees["langue"]["idLangue"]; // On récupère l'ID de la langue

			$this->afficheVue("tete");
			$this->afficheVue("entete", $donnees);
            $this->afficheVue("menu", $donnees);

			// On pointes sur les modèles que la voiture a besoin.
			$modeleStatut = $this->obtenirDAO("TabLangues", "statut");  // Notez que pas de champ Disponibilite dans cette table
			$modeleModePaiement = $this->obtenirDAO("TabLangues", "modepaiement");
			$modeleExpedition = $this->obtenirDAO("TabLangues", "expedition");
			$modeleFacture = $this->obtenirDAO("Facture");
			$modeleListeAchat= $this->obtenirDAO("ListeAchat");



			// On prend les données dans la langue qu'il faut afficher.	
			$donnees["statut"]   = $this->creerTabLangue($modeleStatut->obtenirTous(), $idLangue);
			$donnees["modePaiement"] = $this->creerTabLangue($modeleModePaiement->obtenirTousDisponible(), $idLangue);
			$donnees["expedition"]   = $this->creerTabLangue($modeleExpedition->obtenirTousDisponible(), $idLangue);


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

						$this->afficheVue("afficherCommande", $donnees);

						break;      
						
					case "sauvegarderCommande" :

						// Sauvegarde de la commande du client 
						// Si on a reçu les paramètres Panier .

						if( isset($params["panier"]) && 
						    isset($params["details"]) && 
							isset($params["taxeFederale"]) && 
							isset($params["taxeProvinciale"]) && 
							isset($_SESSION["usager"])) {

							// Si l'usager exite on prend la province où il habite.
							$idClient = $_SESSION["usager"]->getId();
							$details = json_decode($params["details"], true);

							$laTaxeFederale = json_decode($params["taxeFederale"],true);
							if ($params["taxeProvinciale"] != null) {
								$laTaxeProvinciale = json_decode($params["taxeProvinciale"],true);
							} else {
								$laTaxeProvinciale = null;
							}
							Debug::toLog("class Controleur_Commande - function traite - case sauvegarderCommande - details[purchase_units]: ", $details["purchase_units"] );

              $capture = $details["purchase_units"][0]["payments"]["captures"][0];

 							$paypalStatus         = $capture["status"];
							$paypalNoAutorisation = $capture["id"];
							$paypalTime           = $capture["update_time"];
							$paypalTotal          = $capture["amount"]["value"];
							$idStatut             = $statutPaypalCorrespondant[strtoupper($paypalStatus)]; 
							$idExpedition         = 2;
							$idModePaiement       = 5;
							$taxeFederale         = floatval($laTaxeFederale['taux']);
							if ($laTaxeProvinciale != null) {
								$taxeProvinciale  = floatval($laTaxeProvinciale['taux']);
							} else {
								$taxeProvinciale  = 0.00;
							}
							
 							$dateTime = strtotime($paypalTime);
							$date = date('Y-m-d H:i:s', $dateTime); 

							Debug::toLog("class Controleur_Commande - function traite - case sauvegarderCommande - params panier: ", json_decode($params["panier"],true));
							Debug::toLog("class Controleur_Commande - function traite - case sauvegarderCommande - idClient : ", $idClient );
							Debug::toLog("class Controleur_Commande - function traite - case sauvegarderCommande - foreach(tabPanier as panier) - taxeFederale : ", $taxeFederale);
							Debug::toLog("class Controleur_Commande - function traite - case sauvegarderCommande - foreach(tabPanier as panier) - taxeProvinciale : ", $taxeProvinciale);
							Debug::toLog("class Controleur_Commande - function traite - case sauvegarderCommande - paypalNoAutorisation : ", $paypalNoAutorisation);
							Debug::toLog("class Controleur_Commande - function traite - case sauvegarderCommande - paypalStatus : ", $paypalStatus); 
							Debug::toLog("class Controleur_Commande - function traite - case sauvegarderCommande - date : ", $date);
							
							$nouvelleFacture = new Facture(0, $idClient, $date , $paypalTotal, $idStatut,
							                               $idExpedition, $idModePaiement ,
														   $paypalNoAutorisation);
							
						    $idCommande = $modeleFacture->sauvegarder($nouvelleFacture);
							// Debug::toLog("class Controleur_Commande - function traite - case sauvegarderCommande - idCommande : ", $idCommande);

							// on converti le JSON reçu en array
							$tabPanier = json_decode($params["panier"], true);
                            Debug::toLog($tabPanier);
                            Debug::toLog($params["panier"]);

						    //  On sauvegarede chacune des voitues acheté dans la liste d'achat.
							foreach ($tabPanier as $panier) {
								if ($panier != null) {
									$prix = floatval($panier["prix"]);
									$totalTaxeFederale = round(($prix * $taxeFederale), 2);
									$totalTaxeProvinciale = round(($prix * $taxeProvinciale), 2);
									$prixTotal = $prix + $totalTaxeFederale + $totalTaxeProvinciale;
									// Debug::toLog("class Controleur_Commande - function traite - case sauvegarderCommande - foreach(tabPanier as panier) - prix : ", $prix);
									// Debug::toLog("class Controleur_Commande - function traite - case sauvegarderCommande - foreach(tabPanier as panier) - totalTaxeFederale : ", $totalTaxeFederale);
									// Debug::toLog("class Controleur_Commande - function traite - case sauvegarderCommande - foreach(tabPanier as panier) - totalTaxeProvinciale : ", $totalTaxeProvinciale);
									// Debug::toLog("class Controleur_Commande - function traite - case sauvegarderCommande - foreach(tabPanier as panier) - prixTotal : ", $prixTotal);

									$nouvelleListeAchat = new ListeAchat($idCommande, intval($panier["id"]), $prixTotal);
									$idCommande = $modeleListeAchat->sauvegarder($nouvelleListeAchat);

								}
							}
						} else {
							// Debug::toLog("class Controleur_Commande - function traite - case sauvegarderCommande - ELSE ");
						}

						$this->afficheVue("succes", $donnees);

						break;  
				}			
			} else {
				// traitement à determiner ici
			}

			//$this->afficheVue("piedDePage", $donnees);
		}
	}
?>