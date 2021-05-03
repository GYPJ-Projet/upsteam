<?php
	class Modele_Client extends BaseDAO {
		
		// Permet à l'instance de dire dans quelle table de la BD elle doit aller chercher les données
		public function getNomTable() {
			return "client";
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

		public function sauvegarde(Client $unClient) {
			//est-ce que le client  que j'essaie de sauvegarder existe déjà (id différent de zéro)
			 if($unClient->getId() != 0) {
				 //mise à jour -- UPDATE client SET...
			 } else {
				 //ajout d'une nouveau client
				 $requete = "INSERT INTO client(nom, prenom, dateNaissance, adresse, codePostal,
				  								 idVille, telephone, telephoneCellulaire, courriel,
												 idUsager, idLangue ) 
							VALUES (:nom, :prenom, :dateNaissance, :adresse, :codePostal, :idVille, 
							        :telephone, :telephoneCellulaire, :courriel, :idUsager, :idLangue)";
				 $requetePreparee = $this->db->prepare($requete);
				 $nom            = $unClient->getNom();
				 $prenom         = $unClient->getPrenom();
				 $dateNaissance  = $unClient->getDateNaissance();
				 $adresse        = $unClient->getAdresse();
    			 $codePostal     = $unClient->getCodePostal();
				 $idVille        = $unClient->getIdVille();
				 $telephone      = $unClient->getTelephone();
				 $telephoneCellulaire = $unClient->getTelephoneCellulaire();
				 $courriel       = $unClient->getCourriel();
				 $idUsager       = $unClient->getIdUsager();
				 $idLangue       = $unClient->getIdLangue();

				 $requetePreparee->bindParam(":nom", $nom); 
				 $requetePreparee->bindParam(":prenom", $prenom);
				 $requetePreparee->bindParam(":dateNaissance", $dateNaissance);
				 $requetePreparee->bindParam(":adresse"  , $adresse); 
				 $requetePreparee->bindParam(":codePostal", $codePostal);
				 $requetePreparee->bindParam(":idVille", $idVille);
				 $requetePreparee->bindParam(":telephone", $telephone); 
				 $requetePreparee->bindParam(":telephoneCellulaire", $telephoneCellulaire);
				 $requetePreparee->bindParam(":courriel", $courriel);
				 $requetePreparee->bindParam(":idUsager", $idUsager); 
				 $requetePreparee->bindParam(":idLangue", $idLangue);
				 $requetePreparee->execute();
			 }
		 }
	}
?>