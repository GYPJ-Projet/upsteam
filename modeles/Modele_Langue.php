<?php
    class Modele_Langue extends BaseDAO {

        // Permet à l'instance de dire dans quelle table de la BD elle doit aller chercher les données
		public function getNomTable() {
			return "langue";
		}

        // Méthode qui retourne le nom de l'instance correspondant à ce modèle.
        public function getNomInstance() {
            return "Langue";
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

        // Permet d'obtenir le nombre de toutes les marques dans la bd
        public function obtenirTout() {
            try {
				$requete = "SELECT * FROM langue";
				$requetePreparee = $this->db->prepare($requete);
				$requetePreparee->execute();
				return $requetePreparee->fetchAll();
			}
			catch(Exception $exc) {
				return 0;
			}
        }
    }
?>