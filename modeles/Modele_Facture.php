<?php

    class Modele_Facture extends BaseDAO {


        // Méthode qui retourne le nom la table de la BD de cette classe Modele_Facture
        public function getNomTable() {
            return "facture";
        }


        // Méthode qui retourne le nom de l'instance correspondant à ce modèle.
		public function getNomInstance() {
			return "Facture";
		}


        // Méthode qui retourne la clé primaire de cette table de la BD
        public function getClePrimaire1() {
            return "id";
        }


        // Pas de clé primaire no. 2
        public function getClePrimaire2() {
            return "";
        }

        // Permet d'obtenir le nombre de toutes les commandes dans la bd
        public function obtenirNombreCommandes() {
            try {
                $requete = "SELECT COUNT(id) AS nb FROM facture";
                $requetePreparee = $this->db->prepare($requete);
                $requetePreparee->execute();
                return $requetePreparee->fetchColumn();
            }
                catch(Exception $exc) {
                return 0;
            }
        }

        // Permet de changer le statut de la commande
        public function changerStatut($id, $idStatut) {
            try {
                $requete = "UPDATE facture SET idStatut = ". $idStatut. " WHERE id = ".$id;
                $requetePreparee = $this->db->prepare($requete);
                $requetePreparee->execute();
                return $requetePreparee->fetchColumn();
            }
                catch(Exception $exc) {
                return 0;
            }
        }

        public function obtenirCommandeParId($id, $idLangue) {
            try {
				$requete = "SELECT facture.*, CONCAT(usager.nom, ' ', usager.prenom) AS nomClient, statut.nom AS nomStatus, expedition.nom AS nomExpedition, modePaiement.nom AS nomModePaiement
                FROM facture
                JOIN usager ON facture.idClient = usager.id
                JOIN statut ON facture.idStatut = statut.id
                JOIN expedition ON facture.idExpedition = expedition.id
                JOIN modePaiement ON facture.idModePaiement = modePaiement.id
                WHERE statut.idLangue = $idLangue AND expedition.idLangue = $idLangue AND modePaiement.idLangue = $idLangue AND facture.id = " . $id;
				$requetePreparee = $this->db->prepare($requete);
				$requetePreparee->execute();
				return $requetePreparee->fetch();
			}
			catch(Exception $exc) {
				return 0;
			}
        }

        // Permet d'obtenir les commandes dans une plage donnée
        public function obtenirToutCommandesAvecTri($depart, $commandesParPage, $tri, $ordre, $idLangue) {
            try {
				$requete = "SELECT facture.*, CONCAT(usager.nom, ' ', usager.prenom) AS nomClient, statut.nom AS nomStatus, expedition.nom AS nomExpedition, 
                            modePaiement.nom AS nomModePaiement, COUNT(listeAchat.idVoiture) AS nbVoitures
                            FROM facture
                            JOIN usager ON facture.idClient = usager.id
                            JOIN statut ON facture.idStatut = statut.id
                            JOIN expedition ON facture.idExpedition = expedition.id
                            JOIN modePaiement ON facture.idModePaiement = modePaiement.id
                            JOIN listeAchat ON facture.id = listeAchat.idCommande
                            WHERE statut.idLangue = $idLangue AND expedition.idLangue = $idLangue AND modePaiement.idLangue = $idLangue 
                            GROUP BY facture.id
                            ORDER BY $tri $ordre 
                            
                            LIMIT $depart, $commandesParPage";
				$requetePreparee = $this->db->prepare($requete);
				$requetePreparee->execute();
				return $requetePreparee->fetchAll();
			}
			catch(Exception $exc) {
				return 0;
			}
        }
        
        // Méthode qui sauvegarde une facture modifié ou une nouvelle facture dans la BD.
        public function sauvegarder(Facture $uneFacture) {
            if($uneFacture->getId() != 0) {
                // Mise à jour de la facture serait ici...
			} else {
                //ajout d'une nouvelle Facture
                $requete = "INSERT INTO facture(idClient, date, prixTotal, 
                                                quantite, idStatut, idExpedition, idModePaiement, 
                                                noAutorisation)
                                VALUES (:idClient, :date, :prixTotal, :quantite, :idStatut, 
                                        :idExpedition, :idModePaiement, :noAutorisation)";
                $requetePreparee        = $this->db->prepare($requete);
                $idClient               = $uneFacture->getIdClient();
                $date                   = $uneFacture->getDate();
                $prixTotal              = $uneFacture->getPrixTotal();
                $quantite               = $uneFacture->getQuantite();
                $idStatut               = $uneFacture->getIdStatut();
                $idExpedition           = $uneFacture->getIdExpedition();
                $idModePaiement         = $uneFacture->getIdModePaiement();
                $noAutorisation         = $uneFacture->getNoAutorisation();
               
                $requetePreparee->bindParam(":idClient", $idClient);
                $requetePreparee->bindParam(":date", $date); 
                $requetePreparee->bindParam(":prixTotal", $prixTotal);
                $requetePreparee->bindParam(":quantite", $quantite);
                $requetePreparee->bindParam(":idStatut"  , $idStatut); 
                $requetePreparee->bindParam(":idExpedition", $idExpedition);
                $requetePreparee->bindParam(":idModePaiement", $idModePaiement);
                $requetePreparee->bindParam(":noAutorisation", $noAutorisation);
                $requetePreparee->execute();
                //on retourne l'identifiant de la dernière insertion
                return $this->db->lastInsertId();
            }
        }
    }

?>