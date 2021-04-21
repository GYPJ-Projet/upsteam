<?php
    abstract class BaseDAO {
        //objet PDO contenant une connexion à la base de données
        protected $db;

        public function __construct(PDO $connexion) {
            $this->db = $connexion;
        }

        //méthodes abstraites à être définies plus tard
        abstract function getNomTable();
        abstract function getClePrimaire1();
        abstract function getClePrimaire2();

        //lecture (READ)
        public function obtenirParId($id) {
            try {
				$stmt = $this->db->query("SELECT * FROM " . $this->getNomTable() . " WHERE " . $this->getClePrimaire1() . "=" . $id);
				$stmt->execute();
				return $stmt->fetch();
			}	
			catch(Exception $exc) {
				return 0;
			}

        }

        //lecture (READ)
        public function obtenirParId1Id2($id1, $id2) {
            try {
				$stmt = $this->db->query("SELECT * FROM " . $this->getNomTable() . " WHERE " . 
                                          $this->getClePrimaire1() . "=" . $id1 . " AND " .
                                          $this->getClePrimaire2() . "=" . $id2);
				$stmt->execute();
				return $stmt->fetch();
			}	
			catch(Exception $exc) {
				return 0;
			}
        }

        //lecture tout
        public function obtenirTous() {
            try {
                $stmt = $this->db->query("SELECT * FROM " . $this->getNomTable()); 
                $stmt->execute(); 
                return $stmt->fetchAll();
            }	
            catch(Exception $exc) {
                return 0;
            }
        }


        //suppression (DELETE)
        public function supprime($id) {
            try {
                $requete = "DELETE FROM " . $this->getNomTable() . " WHERE " . $this->getClePrimaire() . "=:id";
                $requetePreparee = $this->db->prepare($requete);
                $requetePreparee->bindParam(":id", $id);
                $requetePreparee->execute();

                //on retourne le nombre de rangées affectées 
                return $requetePreparee->rowCount();
            }	
            catch(Exception $exc) {
                return 0;
            }
        }
        
    }

?>