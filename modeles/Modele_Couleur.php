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

        // Permet d'obtenir le nombre de toutes les couleurs dans la bd
        public function obtenirNombreCouleurs() {
            try {
                $requete = "SELECT COUNT(id) AS nb FROM Couleur";
                $requetePreparee = $this->db->prepare($requete);
                $requetePreparee->execute();
                return $requetePreparee->fetchColumn();
            }
            catch(Exception $exc) {
                return 0;
            }
        }

        // Permet d'obtenir les couleurs dans une plage donnée
        public function obtenirParIdLangueCouleurs($depart, $marquesParPage, $tri, $ordre, $idLangue) {
            try {
				$requete = "SELECT id, idLangue, nom, disponibilite 
                            FROM couleur
                            WHERE idLangue = $idLangue
                            ORDER BY $tri $ordre 
                            LIMIT $depart, $marquesParPage";
				$requetePreparee = $this->db->prepare($requete);
				$requetePreparee->execute();
                $requetePreparee->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, $this->getNomInstance());
				return $requetePreparee->fetchAll();
			}
			catch(Exception $exc) {
				return 0;
			}
        }

        // Permet d'obtenir les couleurs dans une plage donnée
        public function obtenirParIdCouleurs($id) {
            try {
				$requete = "SELECT id, idLangue, nom, disponibilite 
                            FROM couleur
                            WHERE id = $id";
				$requetePreparee = $this->db->prepare($requete);
				$requetePreparee->execute();
                $requetePreparee->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, $this->getNomInstance());
				return $requetePreparee->fetchAll();
			}
			catch(Exception $exc) {
				return 0;
			}
        }

        // Permet d'obtenir les couleurs dans une plage donnée
        public function obtenirMaxId() {
            try {
				$requete = "SELECT MAX(id) 
                            FROM couleur";
				$requetePreparee = $this->db->prepare($requete);
				$requetePreparee->execute();
				return $requetePreparee->fetchColumn();
			}
			catch(Exception $exc) {
				return 0;
			}
        }


        // Permet de sauvegarder la couleur dans la base de données
        public function sauvegarder(Couleur $laCouleur, $maxId) {
            // Est-ce que la couleur que j'essaie de sauvegarder existe déjà (id différent de zéro)
            if($laCouleur->getId() != 0)
            {
                // Mise à jour de la couleur 
                $requete = "UPDATE couleur 
                            SET nom = :nom,
                                disponibilite = :disponibilite 
                            WHERE id = :id
                            AND idLangue = :idLangue";
                $requetePreparee = $this->db->prepare($requete);
                $id              = $laCouleur->getId(); 
                $idLangue        = $laCouleur->getIdLangue();
                $nom             = $laCouleur->getNom();
                $disponibilite   = $laCouleur->getDisponibilite();
                $requetePreparee->bindParam(":id", $id);
                $requetePreparee->bindParam(":idLangue", $idLangue);
                $requetePreparee->bindParam(":nom", $nom);
                $requetePreparee->bindParam(":disponibilite", $disponibilite);
                $requetePreparee->execute();
            }
            else
            {
                // Ajout d'une nouvelle marque
                $requete = "INSERT INTO couleur(id, idLangue, nom, disponibilite) VALUES (:id, :idLangue, :nom, :disponibilite)";
                $requetePreparee    = $this->db->prepare($requete);
                $idLangue           = $laCouleur->getIdLangue();
                $nom                = $laCouleur->getNom();
                $disponibilite      = 1;
                $requetePreparee->bindParam(":id", $maxId);
                $requetePreparee->bindParam(":idLangue", $idLangue);
                $requetePreparee->bindParam(":nom", $nom);
                $requetePreparee->bindParam(":disponibilite", $disponibilite);
                $requetePreparee->execute();
            }
        }
    }
?>