<?php
	class Modele_TabLangues extends BaseDAO {

		private $nomTable;

		public function __construct($connexionPDO, $uneTableBD)
        {
			parent::__construct($connexionPDO);
            $this->nomTable = $uneTableBD;
        }
		
		public function getNomTable() {
			return $this->nomTable;
		}	

		public function getClePrimaire1() {
            return "id";
        }

		public function getClePrimaire2() {
            return "idLangue";
        }
	

		// Méthode qui sauvegarde une langue modifiée ou une nouvelle langue dans la BD.
		public function sauvegarde(TabLangue $uneLangue) {
			//est-ce que la langue que j'essaie de sauvegarder existe déjà (id différent de zéro)
			 if($uneLangue->getId() != 0) {
				 //mise à jour -- UPDATE couleur SET...
			 } else {
				 //ajout d'une nouvelle voiture
				 $requete = "INSERT INTO" . $this->getNomTable() . "(idLangue, nom) VALUES (:idLangue, :nom)";
				 $requetePreparee = $this->db->prepare($requete);
				 $idLangue = $uneLangue->getIdLangue();
				 $nom      = $uneLangue->getNom();
				 $requetePreparee->bindParam(":idLangue", $idLangue); 
				 $requetePreparee->bindParam(":nom", $nom);
				 $requetePreparee->execute();
			 }
		 }
	}
?>