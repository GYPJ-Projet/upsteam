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