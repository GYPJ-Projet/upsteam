<?php
    class Modele_Marque extends BaseDAO {
        private $classe = "Marque";

        // Permet à l'instance de dire dans quelle table de la BD elle doit aller chercher les données
		public function getNomTable() {
			return "marque";
		}

<<<<<<< HEAD
		// Méthode qui retourne le nom de l'instance correspondant à ce modèle.
		public function getNomInstance() {
			return "Marque";
		}
=======
        // Méthode qui retourne le nom de l'instance correspondant à ce modèle.
        public function getNomInstance() {
            return "Marque";
        }
>>>>>>> 0169392804f6c05625dcd4d57e580bdf7a24706c

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
        public function sauvegarder(Marque $laMarque) {
            // Est-ce que la marque que j'essaie de sauvegarder existe déjà (id différent de zéro)
            if($laMarque->getId() != 0)
            {
                // Mise à jour de la marque 
                $requete = "UPDATE marque SET nom = :n, disponibilite = :d WHERE id = :i";
                $requetePreparee = $this->db->prepare($requete);
                $id            = $laMarque->getId(); 
                $nom           = $laMarque->getNom();
                $disponibilite = $laMarque->getDisponibilite();
                $requetePreparee->bindParam(":i", $id);
                $requetePreparee->bindParam(":n", $nom);
                $requetePreparee->bindParam(":d", $disponibilite);
                $requetePreparee->execute();
            }
            else
            {
                // Ajout d'une nouvelle marque
                $requete = "INSERT INTO marque(nom) VALUES (:n)";
                $requetePreparee = $this->db->prepare($requete);
                $requetePreparee->bindParam(":n", $nom);
                $requetePreparee->execute();
            }
        }

        /**
         * Obtient la liste de tout les marques
         */
        public function obtenirToutMarqueDispo(){
            try {
				$requete = "SELECT nom FROM marque WHERE disponibilite = 1 ORDER BY nom";
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