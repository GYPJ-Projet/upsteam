<?php

    class Modele_Usager extends BaseDAO {


        // Méthode qui retourne le nom la table de la BD de cette classe Modele_Usager
        public function getNomTable() {
            return "usager";
        }


        // Méthode qui retourne le nom de l'instance correspondant à ce modèle.
		public function getNomInstance() {
			return "Usager";
		}


        // Méthode qui retourne la clé primaire de cette table de la BD
        public function getClePrimaire1() {
            return "id";
        }


        // Pas de clé primaire no. 2
        public function getClePrimaire2() {
            return "";
        }

        //  On valide l'authentification de l'usager en comparant  le mot de passe qu'il a saisie avec celui de la BD.
        public function authentification($courriel) {

            $id = 0; // l'id de l'usager vaut 0 si usager est invalide lor de la répone

            //déterminer si la combinaison nomUsager / motDePasse est valide
            $requete = "SELECT *
                        FROM usager 
                        JOIN langue ON langue.id = usager.idLangue
                        WHERE courriel=:courriel";
            $requetePreparee = $this->db->prepare($requete);
            $requetePreparee->bindParam(":courriel", $courriel);
            $requetePreparee->execute();
            $requetePreparee->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, "Usager");
            return $requetePreparee->fetch();
        }


        // Méthode qui sauvegarde un usager modifié ou un nouvel usager dans la BD.
        public function sauvegarde(Usager $unUsager) {
           //est-ce que l'usager que j'essaie de sauvegarder existe déjà (id différent de zéro)
            if($unUsager->getId() != 0) {
                //mise à jour -- UPDATE usager SET...
            } else {
                //ajout d'un nouvel usager
                $requete = "INSERT INTO usager(nomUsager, motPasse, nom, prenom, dateNaissance, 
                                               adresse, codePostal, idVille, telephone, 
                                               telephoneCellulaire, courriel, idLangue,
                                               idRole, disponibilite)
                             VALUES (:usager, :mdp, :nom, :prenom, :dateNaissance, :adresse, 
                                     :codePostal, :idVille, :telephone, :telephoneCellulaire, 
                                     :courriel, :idLangue, :idRole)";
                $requetePreparee = $this->db->prepare($requete);
                $nomUsager              = $unUsager->getNomUsager();
                $motDePasse             = $unUsager->getMotDePasse();
                $nom                    = $unUsager->getNom();
                $prenom                 = $unUsager->getPrenom();
                $dateNaissance          = $unUsager->getDateNaissance();
                $adresse                = $unUsager->getAdresse();
                $codePostal             = $unUsager->getCodePostal();
                $idVille                = $unUsager->getIdVille();
                $telephone              = $unUsager->getTelephone();
                $telephoneCellulaire    = $unUsager->getTelephoneCellulaire();
                $courriel               = $unUsager->getCourriel();
                $idLangue               = $unUsager->getIdLangue();
                $idRole                 = $unUsager->getIdRole();  
                $requetePreparee->bindParam(":usager", $nomUsager); 
                $requetePreparee->bindParam(":mdp", $motDePasse);
                $requetePreparee->bindParam(":nom", $nom); 
                $requetePreparee->bindParam(":prenom", $prenom);
                $requetePreparee->bindParam(":dateNaissance", $dateNaissance);
                $requetePreparee->bindParam(":adresse"  , $adresse); 
                $requetePreparee->bindParam(":codePostal", $codePostal);
                $requetePreparee->bindParam(":idVille", $idVille);
                $requetePreparee->bindParam(":telephone", $telephone); 
                $requetePreparee->bindParam(":telephoneCellulaire", $telephoneCellulaire);
                $requetePreparee->bindParam(":courriel", $courriel); 
                $requetePreparee->bindParam(":idLangue", $idLangue);
                $requetePreparee->bindParam(":idRole", $idRole);
                $requetePreparee->execute();
            }

        }
        
    }

?>