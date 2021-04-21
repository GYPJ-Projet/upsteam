<?php

    class Modele_Usager extends BaseDAO {

        // Méthode qui retourne le nom la table de la BD de cette classe modele
        public function getNomTable() {
            return "usager";
        }


        // Méthode qui retourne la cle primaire de cette table de la BD
        public function getClePrimaire1() {
            return "id";
        }


        // Pas de cle primaire no. 2
        public function getClePrimaire2() {
            return "";
        }


        //  On valide l'authentification de l'usager en comparant  le mot de passe qu'il a saisie avec celui de la BD.
        public function authentification($nomUsager, $motDePasse) {

            $id = 0; // l'id de l'usager vaut 0 si usager est invalide lor de la répone

            //déterminer si la combinaison nomUsager / motDePasse est valide
            $requete = "SELECT * FROM usager WHERE nomUsager=:user";
            $requetePreparee = $this->db->prepare($requete);
            $requetePreparee->bindParam(":user", $nomUsager);
            $requetePreparee->execute();
            $requetePreparee->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, "Usager");
            $unUsager = $requetePreparee->fetch();

            //y'a-t-il une rangée retournée (est-ce que l'usager avec ce nomUsager existe?)
            if ($unUsager) {
                //utiliser password_verify pour comparer le mot de passe tapé par l'usager avec le mot de passe encrypté contenu dans la base de données
                if (password_verify($motDePasse, $unUsager->getMotDePasse()))
                    $id = $unUsager->getId();
            }
            
            return $id; 
        }


        // Méthode qui sauvegarde un usager modifié ou un nouvel usager dans la BD.
        public function sauvegarde(Usager $unUsager) {
           //est-ce que l'usager que j'essaie de sauvegarder existe déjà (id différent de zéro)
            if($unUsager->getId() != 0) {
                //mise à jour -- UPDATE usager SET...
            } else {
                //ajout d'un nouvel usager
                $requete = "INSERT INTO usager(nomUsager, motPasse, idRole) 
                             VALUES (:usager, :mdp, :idRole)";
                $requetePreparee = $this->db->prepare($requete);
                $nomUsager    = $unUsager->getNomUsager();
                $motDePasse   = $unUsager->getMotDePasse();
                $idRole       = $unUsager->getIdRole();  
                $requetePreparee->bindParam(":usager", $nomUsager); 
                $requetePreparee->bindParam(":mdp", $motDePasse);
                $requetePreparee->bindParam(":idRole", $idRole);
                $requetePreparee->execute();
            }
        }
        
    }

?>