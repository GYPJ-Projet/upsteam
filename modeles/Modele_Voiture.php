<?php
	class Modele_Voiture extends BaseDAO {
		
		public function getNomTable() {
			return "voiture";
		}	

		public function getClePrimaire1() {
            return "id";
        }

		// Pas de cle primaire no. 2
        public function getClePrimaire2() {
            return "";
        }


		// Méthode qui retourne le nombre de voitures qu'il y a dans la BD
		public function combienVoitures() {
			try {
				$requete = "SELECT COUNT(*) AS NombreDeVoitures FROM " . $this->getNomTable();
				$requetePreparee = $this->db->prepare($requete);
				$requetePreparee->execute();
				return $requetePreparee->fetchAll();
			}
			catch(Exception $exc) {
				return 0;
			}
		}
		

		// Méthode qui permet de prendre les enregistrements voiture selon  index et le nombre désiré
		public function obtenirLeNombreVoulu($indexDepart, $nombreVoulu, $tri) {
			try {
				$stmt = $this->db->query("SELECT voiture.*, modele.nom AS nomModele, marque.nom AS nomMarque, annee.annee AS annee, motopropulseur.nom AS nomMotoPropulseur
											FROM voiture
											JOIN modele ON modele.id = voiture.idModele 
											JOIN marque ON marque.id = modele.idMarque 
											JOIN annee ON annee.id = voiture.idAnnee
											JOIN motopropulseur ON motopropulseur.id = voiture.idMotopropulseur 
											ORDER BY " .$tri. "
											LIMIT " . $indexDepart . ", " . $nombreVoulu
										);					
				$stmt->execute();
				/* $lesVoitures = $stmt->fetchAll(PDO::FETCH_CLASS, "Voiture"); */
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
				 $requete = "INSERT INTO voiture(idModele, idAnnee,kilometrage, photos, dateArrivee,
				  								 prixAchat, prixVente, idMotopropulseur, idTypeCarburant,
												 idCouleur, idTransmission, idTypeCarrosserie ) 
							 VALUES (:idModele, :idAnnee, :kilometrage, :photos, :dateArrivee,
							         :prixAchat, :prixVente, :idMotopropulseur, :idTypeCarburant, 
									 :idCouleur, :idTransmission, :idTypeCarrosserie)";
				 $requetePreparee = $this->db->prepare($requete);
				 $idModele          = $uneVoiture->getIdModele();
				 $idAnnee           = $uneVoiture->getIdAnnee();
				 $kilometrage       = $uneVoiture->getKilometrage();
				 $photos            = $uneVoiture->getPhotos();
    			 $dateArrivee       = $uneVoiture->getDateArrivee();
				 $prixAchat         = $uneVoiture->getPrixAchat();
				 $prixVente         = $uneVoiture->getPrixVente();
				 $idMotopropulseur  = $uneVoiture->getIdMotopropulseur();
				 $idTypeCarburant   = $uneVoiture->getIdTypeCarburant();
				 $idCouleur         = $uneVoiture->getIdCouleur();
				 $idTransmission    = $uneVoiture->getIdTransmission();
				 $idTypeCarrosserie = $uneVoiture->getIdTypeCarrosserie(); 
				 $requetePreparee->bindParam(":idModele", $idModele); 
				 $requetePreparee->bindParam(":idAnnee", $idAnnee);
				 $requetePreparee->bindParam(":kilometrage", $kilometrage);
				 $requetePreparee->bindParam(":photos"  , $photos); 
				 $requetePreparee->bindParam(":dateArrivee", $dateArrivee);
				 $requetePreparee->bindParam(":prixAchat", $prixAchat);
				 $requetePreparee->bindParam(":prixVente", $prixVente); 
				 $requetePreparee->bindParam(":idMotopropulseur", $idMotopropulseur);
				 $requetePreparee->bindParam(":idTypeCarburant", $idTypeCarburant);
				 $requetePreparee->bindParam(":idCouleur", $idCouleur); 
				 $requetePreparee->bindParam(":idTransmission", $idTransmission);
				 $requetePreparee->bindParam(":idTypeCarrosserie", $idTypeCarrosserie);
				 $requetePreparee->execute();
			 }
		 }
	}
?>