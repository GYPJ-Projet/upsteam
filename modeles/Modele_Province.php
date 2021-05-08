<?php
    class Modele_Province extends BaseDAO {

        // Permet à l'instance de dire dans quelle table de la BD elle doit aller chercher les données
		public function getNomTable() {
			return "province";
		}

        // Méthode qui retourne le nom de l'instance correspondant à ce modèle.
        public function getNomInstance() {
            return "Province";
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

        public function obtenirToutParLangueProvince($idLangue){
            try {
				$requete = "SELECT *
                            FROM province
                            WHERE idLangue = $idLangue";
				$requetePreparee = $this->db->prepare($requete);
				$requetePreparee->execute();
                $requetePreparee->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, $this->getNomInstance());
				return $requetePreparee->fetchAll();
			}
			catch(Exception $exc) {
				return 0;
			}
        }
    }
?>