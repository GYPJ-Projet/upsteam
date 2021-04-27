<?php
    class Modele_Couleur extends BaseDAO {

        // Permet à l'instance de dire dans quelle table de la BD elle doit aller chercher les données
		public function getNomTable() {
			return "couleur";
		}

        // Méthode qui retourne le nom de l'instance correspondant à ce modèle.
        public function getNomInstance() {
            return "Couleur";
        }

        // Permet à l'instance de dire la clé primaire (ou composé, s'il y en a 2 ou plus) 
		// de la table retrouné par la 
		public function getClePrimaire1() {
            return "id";
        }

        // Pas de cle primaire no. 2
        public function getClePrimaire2() {
            return "idLangue";
        }

        // Permet de sauvegarder la couleur dans la base de données
        public function sauvegarder(Couleur $laCouleur) {
            // Est-ce que la couleur que j'essaie de sauvegarder existe déjà (id différent de zéro)
            if($laCouleur->getId() != 0)
            {
                // Mise à jour de la couleur 
                $requete = "UPDATE couleur SET nom = :n, disponibilite = :d WHERE id = :i AND idLangue = :idL";
                $requetePreparee = $this->db->prepare($requete);
                $id              = $laCouleur->getId();
                $idLangue        = $laCouleur->getIdLangue();  
                $nom             = $laCouleur->getNom();
                $disponibilite   = $laCouleur->getDisponibilite();
                $requetePreparee->bindParam(":i", $id);
                $requetePreparee->bindParam(":idL", $idLangue);
                $requetePreparee->bindParam(":n", $nom);
                $requetePreparee->bindParam(":d", $disponibilite);
                $requetePreparee->execute();
            }
            else
            {
                // Ajout d'une nouvelle couleur
                $requete = "INSERT INTO couleur(nom) VALUES (:n)";
                $requetePreparee = $this->db->prepare($requete);
                $nom             = $laCouleur->getNom();
                $requetePreparee->bindParam(":n", $nom);
                $requetePreparee->execute();
            }
        }
    }
?>