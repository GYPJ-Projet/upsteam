<?php
    abstract class BaseControleur {

        // Fonction abstraite que les enfants doivent définir sans faute.
        public abstract function traite(array $params);

        // Méthode qui permet aux Contrôleur d'appeler les vue ou simplement
        // envoyer des données pour la demande du AJAX.
        public function afficheVue($nomVue, $donnees = null) {
            $cheminVue = RACINE . "vues/" . $nomVue . ".php";
            
            if(file_exists($cheminVue))
            {
                //n.b. le paramètre $donnees sera utilisé DIRECTEMENT dans la vue
                include_once($cheminVue);
            }
            else
            {
                trigger_error("La vue spécifiée est introuvable.");
            }
        }

        // Méthode qui génère le modele demandé 
        public function obtenirDAO($nomModele, $nomTable = null) {
            $classe = "Modele_" . $nomModele;

            if(class_exists($classe)) {
                //on créé la connexion à la BD (les constantes sont dans config.php)
                $connexionPDO = BDUsine::getBD(TYPEBD, NOMBD, HOTE, USAGER, MDP);
                if ($nomTable != null) { 
                    //on crée une instance de la classe Modele_$nomModele avec son paramètre
                    $objetModele = new $classe($connexionPDO, $nomTable); 
                } else {
                    //on crée une instance de la classe Modele_$nomModele 
                    $objetModele = new $classe($connexionPDO);
                }

                if($objetModele instanceof BaseDAO) {
                    return $objetModele;
                }
                else
                    trigger_error("Modèle invalide!");  
            }
            else
                trigger_error("La classe $classe n'existe pas.");
        }

        // Méthode qui crée un tableau de langue selon la langue demandée
        // Noter que c'est méthode est pour traiter les tables de langues de la BD seulement
        public function creerTabLangue(array $tab, $idLangue) { 
            $tabResultat = array(); 
            foreach($tab as $element) {
                if ($element["idLangue"] == $idLangue) {
                    $tabResultat[$element["id"]] = $element["nom"]; 
                }
            }
            return $tabResultat;
        }   
    }

?>