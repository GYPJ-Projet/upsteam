<?php
    class Modele_Marque extends BaseDAO {
        private $classe = "Marque";

        // Permet à l'instance de dire dans quelle table de la BD elle doit aller chercher les données
		public function getNomTable() {
			return "marque";
		}

        // Permet à l'instance de dire la clé primaire (ou composé, s'il y en a 2 ou plus) 
		// de la table retrouné par la 
		public function getClePrimaire1() {
            return "id";
        }

        // Pas de cle primaire no. 2
        public function getClePrimaire2() {
            return "";
        }

        // Permet de sauvegarder la marque dans la base de données
        public function sauvegarder($id, $nom, $disponibilite) {
            //est-ce que le sujet que j'essaie de sauvegarder existe déjà (id différent de zéro)
            if($id != 0)
            {
                //mise à jour --
                $requete = "UPDATE marque  SET nom = :n, disponibilite = :d WHERE id = " . $id;
                $requetePreparee = $this->db->prepare($requete);
                $requetePreparee->bindParam(":n", $nom);
                $requetePreparee->bindParam(":d", $disponibilite);
                $requetePreparee->execute();
            }
            else
            {
                //ajout d'une nouvelle marque
                $requete = "INSERT INTO marque(nom) VALUES (:n)";
                $requetePreparee = $this->db->prepare($requete);
                $requetePreparee->bindParam(":n", $nom);
                $requetePreparee->execute();
            }
        }
    }
?>