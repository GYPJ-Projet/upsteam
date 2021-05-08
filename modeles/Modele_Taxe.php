<?php
    class Modele_Taxe extends BaseDAO {

        // Permet à l'instance de dire dans quelle table de la BD elle doit aller chercher les données
		public function getNomTable() {
			return "taxe";
		}

        // Méthode qui retourne le nom de l'instance correspondant à ce modèle.
        public function getNomInstance() {
            return "Taxe";
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

        public function obtenirTaxeParId($id){
            try {
				$requete = "SELECT  id AS idTaxe, 
                                    nom AS nomTaxe, 
                                    taux, 
                                    disponibilite, 
                                    idProvince
                            FROM taxe 
                            WHERE id = $id";
				$requetePreparee = $this->db->prepare($requete);
				$requetePreparee->execute();
                $requetePreparee->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, $this->getNomInstance());
				return $requetePreparee->fetch();
			}
			catch(Exception $exc) {
				return 0;
			}
        }

        // Permet d'obtenir le nombre de toutes les marques dans la bd
        public function obtenirNombreTaxes() {
            try {
				$requete = "SELECT COUNT(id) AS nb FROM Taxe";
				$requetePreparee = $this->db->prepare($requete);
				$requetePreparee->execute();
				return $requetePreparee->fetchColumn();
			}
			catch(Exception $exc) {
				return 0;
			}
        }

        // Permet d'obtenir les marques dans une plage donnée
        public function obtenirTaxes($depart, $taxesParPage, $tri, $ordre, $idLangue) {
            try {
				$requete = "SELECT  taxe.id AS idTaxe, 
                                    taxe.nom AS nomTaxe, 
                                    taux, 
                                    disponibilite, 
                                    province.nom AS nomProvince
                            FROM taxe 
                            JOIN province ON taxe.idProvince = province.id
                            WHERE province.idLangue = $idLangue
                            ORDER BY $tri $ordre 
                            LIMIT $depart, $taxesParPage";
				$requetePreparee = $this->db->prepare($requete);
				$requetePreparee->execute();
                $requetePreparee->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, $this->getNomInstance());
				return $requetePreparee->fetchAll();
			}
			catch(Exception $exc) {
				return 0;
			}
        }

        public function sauvegarder(Taxe $laTaxe) {
            // Est-ce que la taxe que j'essaie de sauvegarder existe déjà (id différent de zéro)
            if($laTaxe->getIdTaxe() != 0)
            {
                // Mise à jour de la taxe 
                $requete = "UPDATE taxe 
                            SET nom = :nom,
                                taux = :taux,
                                idProvince = :idProvince,
                                disponibilite = :disponibilite 
                            WHERE id = :id";
                $requetePreparee = $this->db->prepare($requete);
                $id              = $laTaxe->getIdTaxe(); 
                $nom             = $laTaxe->getNomTaxe();
                $taux            = $laTaxe->getTaux();
                $disponibilite   = $laTaxe->getDisponibilite();
                $idProvince      = $laTaxe->getIdProvince();
                $requetePreparee->bindParam(":id", $id);
                $requetePreparee->bindParam(":nom", $nom);
                $requetePreparee->bindParam(":taux", $taux);
                $requetePreparee->bindParam(":disponibilite", $disponibilite);
                $requetePreparee->bindParam(":idProvince", $idProvince);
                $requetePreparee->execute();
            }
            else
            {
                // Ajout d'une nouvelle taxe
                $requete = "INSERT INTO taxe(nom, taux, idProvince) VALUES (:nom, :taux, :idProvince)";
                $requetePreparee = $this->db->prepare($requete);
                $nom             = $laTaxe->getNomTaxe();
                $taux            = $laTaxe->getTaux();
                $idProvince      = $laTaxe->getIdProvince();
                $requetePreparee->bindParam(":nom", $nom);
                $requetePreparee->bindParam(":taux", $taux);
                $requetePreparee->bindParam(":idProvince", $idProvince);
                $requetePreparee->execute();
            }
        }
    }
?>