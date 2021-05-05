<?php

use JetBrains\PhpStorm\Language;

class Controleur_Usager extends BaseControleur {

    // Méthode qui retourne le nom du contrôleur
    public function getNomControleur() {
        return "Usager";
    }
    

    // La fonction qui sera appelée par le routeur
    public function traite(array $params) {
        $donnees = array();
        $vue = "";


        // On charge les fichiers de langue selon la langue choisi par l'usager.
        $donnees["langue"] = $this->chargerLangue($params);
        $idLangue = $donnees["langue"]["idLangue"]; // On récupère l'ID de la langue

        // modele pour obtention des informations de bd.
        $modeleProvince         = $this->obtenirDAO("TabLangues", "province");
        $modeleLangue           = $this->obtenirDAO("Langue");
        $modeleRole             = $this->obtenirDAO("Role");
        $donnees["province"]    = $this->creerTabLangue($modeleProvince->obtenirTous(), $idLangue);
        $donnees["choixLangue"] = $modeleLangue->obtenirTout();
        $donnees["role"]        = $modeleRole->obtenirTout();

        if (isset($params["action"])) {
            $action = $params["action"]; 
        } else {
                //action par défaut
            $action = "login";
        }

        //détermine la vue, remplir le modèle approprié
        switch($action) {
            case "connexion":
                //faire afficher le formulaire de login
                $donnees["erreurs"] = "";
                
                $this->affiche($donnees);
                $this->afficheVue("formulaireConnexion", $donnees);

                break;

            case "authentifier":
                // On valide l'authentification de l'usager 
                if (isset($params["courriel"], $params["motPasse"])) {

                    $modeleUsager = $this->obtenirDAO("Usager");

                    $unUsager = $modeleUsager->authentification($params["courriel"]);

                    // Si son authentification est valide 
                    if ($unUsager !== false) {
                        if($unUsager->getMotPasse() === $params["motPasse"]){
                            $_SESSION["usager"] = $unUsager;
                        header("Location: index.php");

                        }else{
                            $donnees["erreurs"] = "Combinaison nom d'usager / mot de passe invalide.";  // L'authentification n'est pas bonne 
                            $this->affiche($donnees);
                            $this->afficheVue("formulaireConnexion", $donnees);
                        }
                    }else{
                        $donnees["erreurs"] = "Combinaison nom d'usager / mot de passe invalide.";  // L'authentification n'est pas bonne 
                        $this->affiche($donnees);
                        $this->afficheVue("formulaireConnexion", $donnees);
                    }

                } else {
                    $donnees["erreurs"] = "Combinaison nom d'usager / mot de passe invalide.";  // L'authentification n'est pas bonne 
                    // On recommence la connexion de l'usager. 
                    $this->affiche($donnees);                
                    $this->afficheVue("formulaireConnexion", $donnees);
                }
                break;
            case "deconnexion":
                // Détruit toutes les variables de session car l'usager quitte la session.
                $_SESSION = array();
    
                // Si vous voulez détruire complètement la session, effacez également
                // le cookie de session.
                // Note : cela détruira la session et pas seulement les données de session !
                if (ini_get("session.use_cookies")) {
                    $params = session_get_cookie_params();
                    setcookie(session_name(), '', time() - 42000,
                        $params["path"], $params["domain"],
                        $params["secure"], $params["httponly"]
                    );
                }
    
                // Finalement, on détruit la session.
                session_destroy();
    
                //redirection vers le formulaire de login
                header("Location: index.php");  
                break;

            case "creerUsager":
                $this->affiche($donnees);
                $this->afficheVue("formulaireUsager", $donnees);

                break;

            case "sauvegarderUsager":
                Debug::toLog($params);

                $test = $this->testCreation($params, $donnees);
                $valide = $test[0];
                $donnees['erreurs'] = $test[1];

                if($valide === true){
                    Debug::toLog("BINGO");
                }else{
                    $this->affiche($donnees);
                    $this->afficheVue("formulaireUsager", $donnees);
                }

                break;
        }
        $this->afficheVue("piedDePage", $donnees);
    }

    public function affiche($donnees) {
        $this->afficheVue("tete");
        $this->afficheVue("entete", $donnees);
        $this->afficheVue("menu", $donnees);
        
    }

    /**
     * PH 
     * Test de validité des champs de création / modif d'un usagé
     */
    public function testCreation($params, $donnees){
        $valide = true;
        $donnees["erreurs"] ="";
        if(!isset($params['nom']) || $params['nom'] === ""){
            $valide = false;
            $erreur += $donnees['langue']['erreurNom'];
        }
        if(!isset($params['prenom']) || $params['prenom'] === ""){
            $valide = false;
            $erreur += $donnees['langue']['erreurNom'];
        }
        if(!isset($params['courriel']) || $params['courriel'] === ""){
            $valide = false;
            $erreur += $donnees['langue']['erreurNom'];
        }
        if(!isset($params['dateNaissance']) || $params['dateNaissance'] === ""){
            $valide = false;
            $erreur += $donnees['langue']['erreurNom'];
        }
        if(!isset($params['adresse']) || $params['adresse'] === ""){
            $valide = false;
            $erreur += $donnees['langue']['erreurNom'];
        }
        if(!isset($params['codePostal']) || $params['codePostal'] === ""){
            $valide = false;
            $erreur += $donnees['langue']['erreurNom'];
        }
        if(!isset($params['province']) || $params['province'] === ""){
            $valide = false;
            $erreur += $donnees['langue']['erreurNom'];
        }
        if(!isset($params['ville']) || $params['ville'] === ""){
            $valide = false;
            $erreur += $donnees['langue']['erreurNom'];
        }
        if(!isset($params['telephone']) || $params['telephone'] === ""){
            $valide = false;
            $erreur += $donnees['langue']['erreurNom'];
        }
        if(!isset($params['cellulaire']) || $params['cellulaire'] === ""){
            $valide = false;
            $erreur += $donnees['langue']['erreurNom'];
        }
        if(!isset($params['langue']) || $params['langue'] === ""){
            $valide = false;
            $erreur += $donnees['langue']['erreurNom'];
        }

        return array($valide, $donnees);


    }
}
?>