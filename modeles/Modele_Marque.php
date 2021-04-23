<?php
    class Modele_Marque extends BaseDAO {
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
    }
?>