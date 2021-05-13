<?php
  /* 	use JetBrains\PhpStorm\Language; */

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
			$modeleVoiture = $this->obtenirDAO("Voiture");


			// On prend les données dans la langue qu'il faut afficher.	
			$donnees["statut"]   = $this->creerTabLangue($modeleStatut->obtenirTous(), $idLangue);
			$donnees["modePaiement"] = $this->creerTabLangue($modeleModePaiement->obtenirTousDisponible(), $idLangue);
			$donnees["expedition"]   = $this->creerTabLangue($modeleExpedition->obtenirTousDisponible(), $idLangue);

			Debug::toLog("class Controleur_Commande - function traite - params :", $params);
            // Si on a reçu une action, on la traite...
			if (isset($params["action"])) {

				// Switch en fonction de l'action qui est envoyée en paramètre de la requête
				// Ce switch détermine la vue $vue et obtient le modèle $data
				switch($params["action"]) {

					case "afficherCommande" :

						if (isset($_SESSION["paypalNoAutorisation"])) {
							unset($_SESSION["paypalNoAutorisation"]);
							unset($_SESSION["idExpedition"]);
						}

						// Affichage de la commande du client 
						// Si on a reçu les paramètres Panier .
						if (isset($params["panier"])) {
							// on converti le tableau reçu en array
							$donnees["panier"] = json_decode($params["panier"], true);
						}

						$this->afficheVue("afficherCommande", $donnees);

						break;      
						
					case "sauvegarderCommande" :
                        Debug::toLog('sauvegarderCommande - IN');
						
						if (isset($_SESSION["paypalNoAutorisation"])) {
							$paypalNoAutorisation = $_SESSION["paypalNoAutorisation"];
						} else {
							$paypalNoAutorisation = '';
						}
						if (isset($_SESSION["idExpedition"])) {
							$idExpedition = $_SESSION["idExpedition"];
							switch( $idExpedition ) {
								case "1" :
									$donnees["expedition"] = $donnees["langue"]["expedition_local"];
									break;

								default :
									$donnees["expedition"] = $donnees["langue"]["expedition_ramassage"];
								    break;
							}
						} else {
							$donnees["expedition"] = '';
						}

                        Debug::toLog('sauvegarderCommande - AVANT PARAMS', $params);
						// Sauvegarde de la commande du client 
						// Si on a reçu les paramètres Panier .
						if( isset($params["panier"]) && 
							isset($params["status"]) && 
							isset($params["noAutorisation"]) && 
							isset($params["time"]) && 
							isset($params["total"]) && 
							isset($params["taxeFederale"]) && 
							isset($params["taxeProvinciale"]) && 
							isset($params["expedition"]) && 
							isset($_SESSION["usager"])) {
                        Debug::toLog('sauvegarderCommande - APRÈS PARAMS', $params);

 						    $titreRecuPDF = $donnees["langue"]["releve_de_transaction"];

							// Si l'usager exite on prend la province où il habite.
							$idClient = $_SESSION["usager"]->getId();


							$laTaxeFederale = json_decode($params["taxeFederale"],true);
							if ($params["taxeProvinciale"] != null) {
								$laTaxeProvinciale = json_decode($params["taxeProvinciale"],true);
							} else {
								$laTaxeProvinciale = null;
							}


 							$paypalStatus         = $params["status"];
							$paypalNoAutorisation = $params["noAutorisation"];
							$paypalTime           = $params["time"];
							$paypalTotal          = $params["total"];
							$idStatut             = $statutPaypalCorrespondant[strtoupper($paypalStatus)]; 
							$idExpedition         = intval($params["expedition"]);
							$idModePaiement       = 5;
							$taxeFederale         = floatval($laTaxeFederale['taux']);
							if ($laTaxeProvinciale != null) {
								$taxeProvinciale  = floatval($laTaxeProvinciale['taux']);
							} else {
								$taxeProvinciale  = 0.00;
							}
							
 							$dateTime = strtotime($paypalTime);
							$date = date('Y-m-d H:i:s', $dateTime); 
							
							switch( $idExpedition ) {
								case "1" :
									$donnees["expedition"] = $donnees["langue"]["expedition_local"];
									break;

								default :
									$donnees["expedition"] = $donnees["langue"]["expedition_ramassage"];
								    break;
							}

                            Debug::toLog('sauvegarderCommande - AVANT NEW FACTURE');

							$nouvelleFacture = new Facture(0, $idClient, $date , $paypalTotal, $idStatut,
														$idExpedition, $idModePaiement ,
														$paypalNoAutorisation);
							
                            Debug::toLog('sauvegarderCommande - APRÈS NEW FACTURE', $nouvelleFacture);

							$idCommande = $modeleFacture->sauvegarder($nouvelleFacture);

							$donnees["paypalNoAutorisation"] = $paypalNoAutorisation;

							// on converti le JSON reçu en array
							$tabPanier = json_decode($params["panier"], true);

						    //  On sauvegarede chacune des voitues acheté dans la liste d'achat.
							foreach ($tabPanier as $panier) {
								if ($panier != null) {
									$idVoiture = intval($panier["id"]);
									$prix = floatval($panier["prix"]);
									$totalTaxeFederale = round(($prix * $taxeFederale), 2);
									$totalTaxeProvinciale = round(($prix * $taxeProvinciale), 2);
									$prixTotal = $prix + $totalTaxeFederale + $totalTaxeProvinciale;
									$nouvelleListeAchat = new ListeAchat($idCommande, intval($panier["id"]), $prixTotal);
									$modeleListeAchat->sauvegarder($nouvelleListeAchat);
									$uneVoiture = $modeleVoiture->obtenirParId($idVoiture);
									
									if ($uneVoiture) {
										$uneVoiture->setDisponibilite(0);
										$modeleVoiture->sauvegarde($uneVoiture);
									}
								}
							}
							
							// CreerPDF::creationRecuPDF($donnees["langue"], $paypalNoAutorisation, $titreRecuPDF, $params["panier"], $date, $idCommande, $laTaxeFederale, $laTaxeProvinciale, 'F');
							$_SESSION["paypalNoAutorisation"] = $paypalNoAutorisation;
							$_SESSION["idExpedition"] = $idExpedition;
						
							//Prépare et envoie d'un courriel à l'utilisateur 
							//pour lui envoyer son reçu de son achat.
							$msg = "<h1>V&eacute;hicules d'occasion</h1><br>";
							$msg .= "<p>" . $donnees["langue"]['courrielAchatApprouve'] ."</p><br>";
							$fichier = "pdf/" . $paypalNoAutorisation . ".pdf";
							$courriel = $_SESSION["usager"]->getCourriel();

							$this->afficheVue("succes", $donnees);

							// Courriel::envoieCourriel($donnees["langue"], $courriel, $donnees["langue"]['courrielSubjectApprouve'], $msg, $fichier);

						} else {
							$donnees["paypalNoAutorisation"] = $paypalNoAutorisation;
							$this->afficheVue("succes", $donnees);
						}
		
						break;  
				}			
			} else {
				// traitement à determiner ici
			}

			$this->afficheVue("piedDePage", $donnees);
		}
	}
?>