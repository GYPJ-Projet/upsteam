<?php
    class Modele_ListeAchat extends BaseDAO {

        // Permet à l'instance de dire dans quelle table de la BD elle doit aller chercher les données
		public function getNomTable() {
			return "listeachat";
		}

        // Méthode qui retourne le nom de l'instance correspondant à ce modèle.
        public function getNomInstance() {
            return "ListeAchat";
        }

        // Permet à l'instance de dire la clé primaire (ou composé, s'il y en a 2 ou plus) 
		// de la table retrouné par la 
		public function getClePrimaire1() {
            return "idCommande";
        }

        // Pas de cle primaire no. 2
        public function getClePrimaire2() {
            return "idVoiture";
        }
        
        public function sauvegarder(ListeAchat $uneCommande) {

            // Ajout d'une nouvelle commande à la liste d'achat
            $requete = "INSERT INTO listeachat(idCommande, idVoiture, prixVenteFinal) VALUES (:idCommande, :idVoiture, :prixVenteFinal)";
            $requetePreparee = $this->db->prepare($requete);
            $idCommande        = $uneCommande->getIdCommande(); 
            $idVoiture         = $uneCommande->getIdVoiture();
            $prixVenteFinal    = $uneCommande->getPrixVenteFinal();
            $requetePreparee->bindParam(":idCommande", $idCommande);
            $requetePreparee->bindParam(":idVoiture", $idVoiture);
            $requetePreparee->bindParam(":prixVenteFinal", $prixVenteFinal);
            $requetePreparee->execute();
        }
    }
?>