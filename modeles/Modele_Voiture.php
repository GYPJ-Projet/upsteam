<?php
	class Modele_Voiture extends BaseDAO {

		// Méthode qui retourne le nom la table de la BD de cette classe  Modele_Voiture
		public function getNomTable() {
			return "voiture";
		}	

		// Méthode qui retourne le nom de l'instance correspondant à ce modèle.
		public function getNomInstance() {
			return "Voiture";
		}
		
        // Méthode qui retourne la clé primaire de cette table de la BD
		public function getClePrimaire1() {
            return "id";
        }

		// Pas de clé primaire no. 2
        public function getClePrimaire2() {
            return "";
        }

		// Méthode qui retourne le nombre de voitures qu'il y a dans la BD
		public function combienVoitures() {
			try {
				$requete = "SELECT COUNT(*) AS NombreDeVoitures FROM " . $this->getNomTable();
				$requetePreparee = $this->db->prepare($requete);
				$requetePreparee->execute();
				return $requetePreparee->fetchColumn();
			}
			catch(Exception $exc) {
				return 0;
			}
		}

		public function obtenirParId($id) {
            try {
				$stmt = $this->db->query("SELECT voiture.*, 
					marque.id AS idMarque,
					modele.nom AS nomModele, 
					marque.nom AS nomMarque, 
					annee.annee AS annee, 
					motopropulseur.nom AS nomMotoPropulseur 
					FROM voiture 
					JOIN modele ON modele.id = voiture.idModele 
					JOIN marque ON marque.id = modele.idMarque  
					JOIN annee ON annee.id = voiture.idAnnee 
					JOIN motopropulseur ON motopropulseur.id = voiture.idMotopropulseur 
					WHERE voiture.id = " . $id);	
				$stmt->execute();
				return $stmt->fetch();	

			}	
			catch(Exception $exc) {
				return 0;
			}
        }

		public function obtenirImagesParIdVoiture($id) {
            try {
				$stmt = $this->db->query("SELECT * FROM image WHERE idVoiture = " . $id . " 
										  ORDER BY sort");	
				$stmt->execute();
				return $stmt->fetchAll();	

			}	
			catch(Exception $exc) {
				return 0;
			}
        }

		// Méthode qui permet de prendre toutes les voiture triées selon index et le nombre désiré 
		public function obtenirToutesVoituresAvecTri($indexDepart, $nombreVoulu, $tri, $ordre) {
			try {
				$stmt = $this->db->query("SELECT voiture.*,
												 marque.id AS idMarque, 
				                                 modele.nom AS nomModele, 
				                                 marque.nom AS nomMarque, 
												 annee.annee AS annee, 
												 motopropulseur.nom AS nomMotoPropulseur, 
												 image.lien AS lienPhotoPrincipale 
											FROM voiture 
											JOIN modele ON modele.id = voiture.idModele 
											JOIN marque ON marque.id = modele.idMarque  
											JOIN annee ON annee.id = voiture.idAnnee 
											JOIN motopropulseur ON motopropulseur.id = voiture.idMotopropulseur 
											JOIN image ON image.idVoiture = voiture.id  
											ORDER BY " . $tri .  " " . $ordre .  "
											LIMIT " . $indexDepart . ", " . $nombreVoulu
										);		
													
				$stmt->execute();
				return $stmt->fetchAll();
			}
			catch(Exception $exc) {
				return 0;
			}
		}

		// Méthode qui permet de prendre les enregistrements voiture selon  index et le nombre désiré
		public function obtenirLeNombreVoulu($indexDepart, $nombreVoulu, $tri) {
			try {
				$stmt = $this->db->query("SELECT voiture.*, 
				                                 modele.nom AS nomModele, 
				                                 marque.nom AS nomMarque, 
												 annee.annee AS annee, 
												 motopropulseur.nom AS nomMotoPropulseur, 
												 image.lien AS lienPhotoPrincipale 
											FROM voiture 
											JOIN modele ON modele.id = voiture.idModele 
											JOIN marque ON marque.id = modele.idMarque  
											JOIN annee ON annee.id = voiture.idAnnee 
											JOIN motopropulseur ON motopropulseur.id = voiture.idMotopropulseur 
											JOIN image ON image.idVoiture = voiture.id AND image.sort = 0 
											WHERE voiture.disponibilite = 1
											ORDER BY " .$tri. "
											LIMIT " . $indexDepart . ", " . $nombreVoulu
										);		
													
				$stmt->execute();
				return $stmt->fetchAll();
			}
			catch(Exception $exc) {
				return 0;
			}
		}
		
		// Méthode qui sauvegarde une voiture modifiée ou une nouvelle voiture dans la BD.
		public function sauvegarde(Voiture $uneVoiture) {
			//est-ce que la voiture que j'essaie de sauvegarder existe déjà (id différent de zéro)
			if($uneVoiture->getId() != 0) {
				//mise à jour -- UPDATE voiture SET...
			} else {
				//ajout d'une nouvelle voiture
				$requete = "INSERT INTO voiture(idModele, idAnnee,kilometrage, dateArivee,
												prixAchat, prixVente, idMotopropulseur, idTypeCarburant,
												idCouleur, idTransmission, idTypeCarrosserie, disponibilite, vna) 
							VALUES (:idModele, :idAnnee, :kilometrage, :dateArrivee,
									:prixAchat, :prixVente, :idMotopropulseur, :idTypeCarburant, 
									:idCouleur, :idTransmission, :idTypeCarrosserie, :vna)";
				$requetePreparee = $this->db->prepare($requete);
				$idModele          = $uneVoiture->getIdModele();
				$idAnnee           = $uneVoiture->getIdAnnee();
				$kilometrage       = $uneVoiture->getKilometrage();
				$dateArrivee       = $uneVoiture->getDateArrivee();
				$prixAchat         = $uneVoiture->getPrixAchat();
				$prixVente         = $uneVoiture->getPrixVente();
				$idMotopropulseur  = $uneVoiture->getIdMotopropulseur();
				$idTypeCarburant   = $uneVoiture->getIdTypeCarburant();
				$idCouleur         = $uneVoiture->getIdCouleur();
				$idTransmission    = $uneVoiture->getIdTransmission();
				$idTypeCarrosserie = $uneVoiture->getIdTypeCarrosserie();
				$vna               = $uneVoiture->getVna();
				   
				$requetePreparee->bindParam(":idModele", $idModele); 
				$requetePreparee->bindParam(":idAnnee", $idAnnee);
				$requetePreparee->bindParam(":kilometrage", $kilometrage);
				$requetePreparee->bindParam(":dateArrivee", $dateArrivee);
				$requetePreparee->bindParam(":prixAchat", $prixAchat);
				$requetePreparee->bindParam(":prixVente", $prixVente); 
				$requetePreparee->bindParam(":idMotopropulseur", $idMotopropulseur);
				$requetePreparee->bindParam(":idTypeCarburant", $idTypeCarburant);
				$requetePreparee->bindParam(":idCouleur", $idCouleur); 
				$requetePreparee->bindParam(":idTransmission", $idTransmission);
				$requetePreparee->bindParam(":idTypeCarrosserie", $idTypeCarrosserie);
				$requetePreparee->bindParam(":vna", $vna);
				$requetePreparee->execute();
			}
		}

        /**
         * PH
         * Pour obtenir les voitures qui sont filtrer dans Filtre.js.
         */
        public function obtenirVoitureFiltrer($prixMin, $prixMax, $marques, $modele, $anneeDeb, $anneeFin, $kmMin, $kmMax, $carburant, $carrosserie, $transmission, $propulsion) {
            try {
				$stmt =$this->db->query("SELECT DISTINCT voiture.*, 
                                                modele.nom AS nomModele, 
                                                marque.nom AS nomMarque, 
                                                annee.annee AS annee, 
                                                motopropulseur.nom AS nomMotoPropulseur,
                                                marque.id AS idMarque,
                                                image.lien AS lienPhotoPrincipale 
                                        FROM voiture 
                                        JOIN modele ON modele.id = voiture.idModele 
                                        JOIN marque ON marque.id = modele.idMarque  
                                        JOIN annee ON annee.id = voiture.idAnnee 
                                        JOIN motopropulseur ON motopropulseur.id = voiture.idMotopropulseur 
                                        JOIN typecarrosserie ON typecarrosserie.id = voiture.idTypecarrosserie
                                        JOIN transmission ON transmission.id = voiture.idTransmission
                                        JOIN typecarburant ON typecarburant.id = voiture.idTypecarburant
                                        JOIN image ON image.idVoiture = voiture.id AND image.sort = 0 
                                        WHERE marque.disponibilite = 1 AND modele.disponibilite = 1
                                        AND prixVente BETWEEN $prixMin AND $prixMax
                                        AND marque.nom IN ($marques)
                                        AND modele.nom IN ($modele)
                                        AND annee.annee BETWEEN $anneeDeb AND $anneeFin
                                        AND kilometrage BETWEEN $kmMin AND $kmMax
                                        AND typecarburant.nom IN ($carburant)
                                        AND typecarrosserie.nom IN ($carrosserie)
                                        AND transmission.nom IN ($transmission)
                                        AND motopropulseur.nom IN ($propulsion)
                                        ORDER BY `voiture`.`id` ASC");
                $stmt->execute();
                return $stmt->fetchAll();

            }
            catch(Exception $exc) {
                return 0;
            }
        }

    /**
     * PH
     * Pour obtenir les voitures qui sont rechercher dans Chercher.js.
     */
        public function obtenirVoitureChercher($critere) {
            try {
				$stmt =$this->db->query("SELECT DISTINCT voiture.*, 
                                                modele.nom AS nomModele, 
                                                marque.nom AS nomMarque, 
                                                annee.annee AS annee, 
                                                motopropulseur.nom AS nomMotoPropulseur,
                                                marque.id AS idMarque,
                                                image.lien AS lienPhotoPrincipale 
                                        FROM voiture 
                                        JOIN modele ON modele.id = voiture.idModele 
										JOIN marque ON marque.id = modele.idMarque  
										JOIN annee ON annee.id = voiture.idAnnee 
										JOIN motopropulseur ON motopropulseur.id = voiture.idMotopropulseur 
										JOIN image ON image.idVoiture = voiture.id AND image.sort = 0 
                                        WHERE voiture.disponibilite = 1
                                        AND (marque.nom LIKE $critere
                                        OR modele.nom LIKE $critere
                                        OR annee.annee LIKE $critere)");
                $stmt->execute();
                return $stmt->fetchAll();

            }
            catch(Exception $exc) {
                return 0;
            }
        }
    }
?>