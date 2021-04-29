<?php
    class Modele_Modele extends BaseDAO {

        // Permet à l'instance de dire dans quelle table de la BD elle doit aller chercher les données
		public function getNomTable() {
			return "modele";
		}

        // Méthode qui retourne le nom de l'instance correspondant à ce modèle.
        public function getNomInstance() {
            return "Modele";
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

        // Permet d'obtenir toutes les modèles avec l'information à propos de la marque
        public function obtenirTousAvecMarque() {

            try {
                $requete = "SELECT marque.nom AS nomMarque, marque.id AS idMarque, modele.id, modele.nom, modele.disponibilite
                            FROM modele
                            JOIN marque ON modele.idMarque = marque.id
                            ORDER BY modele.id";
                $requetePreparee = $this->db->prepare($requete);
                $requetePreparee->execute(); 
                return $requetePreparee->fetchAll();
            }
			  catch(Exception $exc) {
				return 0;
			}   

      }

        // Permet de sauvegarder la modele dans la base de données
        public function sauvegarder(Modele $laModele) {
            // Est-ce que la modele que j'essaie de sauvegarder existe déjà (id différent de zéro)
            if($laModele->getId() != 0)
            {
                // Mise à jour de la modele 
                $requete = "UPDATE modele SET nom = :n, idMarque = :idM, disponibilite = :d WHERE id = :i";
                $requetePreparee = $this->db->prepare($requete);
                $id              = $laModele->getId(); 
                $nom             = $laModele->getNom();
                $idMarque        = $laModele->getIdMarque();
                $disponibilite   = $laModele->getDisponibilite();
                $requetePreparee->bindParam(":i", $id);
                $requetePreparee->bindParam(":n", $nom);
                $requetePreparee->bindParam(":idM", $idMarque);
                $requetePreparee->bindParam(":d", $disponibilite);
                $requetePreparee->execute();
            }
            else
            {
                // Ajout d'une nouvelle modele
                $requete = "INSERT INTO modele(nom, idMarque) VALUES (:n, :idM)";
                $requetePreparee = $this->db->prepare($requete);

                $nom             = $laModele->getNom();

                $idMarque        = $laModele->getIdMarque();
                $requetePreparee->bindParam(":n", $nom);
                $requetePreparee->bindParam(":idM", $idMarque);
                $requetePreparee->execute();
            }
        }

        /**
         * PH
        * Obtient la liste de tout les modèles
        */
        public function obtenirToutDisponible(){
            try {
				$requete = "SELECT modele.nom, modele.id
                            FROM modele
                            JOIN marque ON modele.idMarque = marque.id
                            WHERE marque.disponibilite = 1 AND modele.disponibilite = 1";
				$requetePreparee = $this->db->prepare($requete);
				$requetePreparee->execute();
				return $requetePreparee->fetchAll();
			}
			catch(Exception $exc) {
				return 0;
			}
        }

        /**
         * PH
         * Obtient la liste des voiture filtrés par la marque.
         */
        public function rechercheParMarque($liste){
            try {
				$requete = "SELECT modele.nom, modele.id
                            FROM modele
                            WHERE idMarque in (".$liste.")
                            AND modele.disponibilite = 1";
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