<?php
    class Controleur_Usager extends BaseControleur {

        // Méthode qui retourne le nom du contrôleur
        public function getNomControleur() {
			return "Usager";
		}
		


        public function traite(array $params) {
            $donnees = array();
            $vue = "";

            // On charge les fichiers de langue selon la langue choisi par l'usager.
            $donnees["langue"] = $this->chargerLangue($params);

            $idLangue = $donnees["langue"]["idLangue"]; // On récupère l'ID de la langue

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
                            }
                        }else{
                            $donnees["erreurs"] = "Combinaison nom d'usager / mot de passe invalide.";  // L'authentification n'est pas bonne 
                            $this->affiche($donnees);                  
                        }

                    } else {
                        $donnees["erreurs"] = "Combinaison nom d'usager / mot de passe invalide.";  // L'authentification n'est pas bonne 
                        // On recommence la connexion de l'usager. 
                        $this->affiche($donnees);                
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
            }
            $this->afficheVue("piedDePage", $donnees);
        }

        public function affiche($donnees) {
            $this->afficheVue("tete");
            $this->afficheVue("entete", $donnees);
            $this->afficheVue("menu", $donnees);
            $this->afficheVue("formulaireLogin", $donnees);
        }
    }
?>