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

        /**
         * PH
         * Pour populer la liste des usagers.
         */
        public function obtenirToutDisponibleAvecTri($indexDepart, $nombreVoulu, $tri, $ordre){
            try {
				$requete = "SELECT usager.* ,
                                    province.nom AS nomProvince,
                                    langue.nom AS nomLangue,
                                    role.nom AS nomRole
                            FROM usager 
                            JOIN province ON province.id = usager.idProvince
                            JOIN langue ON langue.id = usager.idLangue
                            JOIN role ON role.id = usager.idRole
                            WHERE province.idLangue = usager.idLangue
                            ORDER BY $tri $ordre
                            LIMIT $indexDepart, $nombreVoulu";
				$requetePreparee = $this->db->prepare($requete);
				$requetePreparee->execute();
				return $requetePreparee->fetchAll();
			}
			catch(Exception $exc) {
				return 0;
			}
        }
		// Méthode qui retourne le nombre d'usager qu'il y a dans la BD
		public function combienUsager() {
			try {
				$requete = "SELECT COUNT(*) AS nombreUsager FROM " . $this->getNomTable();
				$requetePreparee = $this->db->prepare($requete);
				$requetePreparee->execute();
				return $requetePreparee->fetchColumn();
			}
			catch(Exception $exc) {
				return 0;
			}
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
            //ajout d'un nouvel usager
            $requete = "INSERT INTO usager(motPasse, nom, prenom, dateNaissance, 
                                            adresse, codePostal, ville, telephone, 
                                            telephoneCellulaire, courriel, idLangue,
                                            idRole, idProvince)
                            VALUES (:mdp, :nom, :prenom, :dateNaissance, :adresse, 
                                    :codePostal, :ville, :telephone, :telephoneCellulaire, 
                                    :courriel, :idLangue, :idRole, :idProvince)";
            $requetePreparee        = $this->db->prepare($requete);
            $motDePasse             = $unUsager->getMotPasse();
            $nom                    = $unUsager->getNom();
            $prenom                 = $unUsager->getPrenom();
            $dateNaissance          = $unUsager->getDateNaissance();
            $adresse                = $unUsager->getAdresse();
            $codePostal             = $unUsager->getCodePostal();
            $ville                  = $unUsager->getVille();
            $idProvince             = $unUsager->getIdProvince();
            $telephone              = $unUsager->getTelephone();
            $telephoneCellulaire    = $unUsager->getTelephoneCellulaire();
            $courriel               = $unUsager->getCourriel();
            $idLangue               = $unUsager->getIdLangue();
            $idRole                 = $unUsager->getIdRole();  
            $requetePreparee->bindParam(":mdp", $motDePasse);
            $requetePreparee->bindParam(":nom", $nom); 
            $requetePreparee->bindParam(":prenom", $prenom);
            $requetePreparee->bindParam(":dateNaissance", $dateNaissance);
            $requetePreparee->bindParam(":adresse"  , $adresse); 
            $requetePreparee->bindParam(":codePostal", $codePostal);
            $requetePreparee->bindParam(":ville", $ville);
            $requetePreparee->bindParam(":idProvince", $idProvince);
            $requetePreparee->bindParam(":telephone", $telephone); 
            $requetePreparee->bindParam(":telephoneCellulaire", $telephoneCellulaire);
            $requetePreparee->bindParam(":courriel", $courriel); 
            $requetePreparee->bindParam(":idLangue", $idLangue);
            $requetePreparee->bindParam(":idRole", $idRole);
            return $requetePreparee->execute();
        }

        public function modifieAvecMotPasse(Usager $unUsager) {
            // $requete = "UPDATE usager
            //             SET"

            // Vérifier le params['role'] pour lui mettre une valeur par défaut dans le contrôleur!
        }
        public function modifieSansMotPasse(Usager $unUsager) {}
        
    }

?>