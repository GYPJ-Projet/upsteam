<?php
    abstract class BaseDAO {
        //objet PDO contenant une connexion à la base de données
        protected $db;

        public function __construct(PDO $connexion) {
            $this->db = $connexion;
        }

        //méthodes abstraites à être définies plus tard
        abstract function getNomTable();
        abstract function getNomInstance();
        abstract function getClePrimaire1();
        abstract function getClePrimaire2();

        //lecture (READ)
        public function obtenirParId($id) {
            try {
                $requete = "SELECT * FROM " . strtolower($this->getNomTable()) . " WHERE " . $this->getClePrimaire1() . "=:id";
                $requetePreparee = $this->db->prepare($requete);
                $requetePreparee->bindParam(":id", $id);
                $requetePreparee->execute();
                $requetePreparee->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, $this->getNomInstance()); 
                $uneInstance =  $requetePreparee->fetch();
                return $uneInstance;
			}	
			catch(Exception $exc) {
				return 0;
			}
        }

        //lecture (READ)
        public function obtenirParId1Id2($id1, $id2) {
            try {
                $requete = "SELECT * FROM " . strtolower($this->getNomTable()) . 
                            " WHERE " . $this->getClePrimaire1() . "=:id1"  . 
                            " AND "   . $this->getClePrimaire2() . "=:id2";
                $requetePreparee = $this->db->prepare($requete);
                $requetePreparee->bindParam(":id1", $id1);
                $requetePreparee->bindParam(":id2", $id2);
                $requetePreparee->execute();
                $requetePreparee->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, $this->getNomInstance()); 
                $uneInstance =  $requetePreparee->fetch();
                return $uneInstance;
			}	
			catch(Exception $exc) {
				return 0;
			}
        }

        //lecture tout
        public function obtenirTous() {
            try {
                $requete = "SELECT * FROM " . $this->getNomTable();
                $requetePreparee = $this->db->prepare($requete);
                $requetePreparee->execute();
                $requetePreparee->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, $this->getNomInstance()); 
                $lesInstances =  $requetePreparee->fetchAll();
                return $lesInstances;
            }	
            catch(Exception $exc) {
                return 0;
            }
        }

        //lecture tout ce qui est disponible dans la table
        public function obtenirTousDisponible() {
            try {
                $requete = "SELECT * FROM " . $this->getNomTable() . " WHERE disponibilite = true";
                $requetePreparee = $this->db->prepare($requete);
                $requetePreparee->bindParam(":id", $id);
                $requetePreparee->execute();
                $requetePreparee->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, $this->getNomInstance()); 
                $lesInstances =  $requetePreparee->fetchAll();
                return $lesInstances;
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