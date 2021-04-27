<?php
    class Modele_Marque extends BaseDAO {
        private $classe = "Marque";

        // Permet à l'instance de dire dans quelle table de la BD elle doit aller chercher les données
		public function getNomTable() {
			return "marque";
		}

		// Méthode qui retourne le nom de l'instance correspondant à ce modèle.
		public function getNomInstance() {
			return "Marque";
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
                //ajout d'une nouvelle réponse
                /*$requete = "INSERT INTO reponses(titre, texte, dateCreation, nomUsager, idSujet) VALUES (:ti, :te,:d,:u,:idS)";
                $requetePreparee = $this->db->prepare($requete);
                $titre = $laReponse->getTitre();
                $texte = $laReponse->getTexte();
                $date = $laReponse->getDateCreation();
                $nomUsager = $laReponse->getNomUsager();
                $idSujet = $laReponse->getIdSujet();
                $requetePreparee->bindParam(":ti", $titre);
                $requetePreparee->bindParam(":te", $texte);
                $requetePreparee->bindParam(":d", $date);
                $requetePreparee->bindParam(":u", $nomUsager);
                $requetePreparee->bindParam(":idS", $idSujet);
                $requetePreparee->execute();*/
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