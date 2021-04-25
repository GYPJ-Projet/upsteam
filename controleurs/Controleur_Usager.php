<?php
    class Controleur_Usager extends BaseControleur {

        // Méthode qui retourne le nom du contrôleur
        public function getNomControleur() {
			return "Usager";
		}

        public function traite(array $params) {
            $donnees = array();
            $vue = "";

            if (isset($params["action"])) {
                 $action = $params["action"]; 
            } else {
                 //action par défaut
                $action = "login";
            }

            // On charge les fichiers de langue selon la langue choisi par l'usager.
            $donnees["langue"] = $this->chargerLangue($params);

            $this->afficheVue("tete");
			$this->afficheVue("entete");
            $this->afficheVue("menu");

            //détermine la vue, remplir le modèle approprié
            switch($action) {
                case "login":
                    //faire afficher le formulaire de login
                    $donnees["erreurs"] = "";
                    $this->afficheVue("formulaireLogin",  $donnees);
                    break;
                case "authentifier":
                    // On valide l'authentification de l'usager 
                    if (isset($params["usager"], $params["pass"])) {
                        $modeleUsager = $this->obtenirDAO("Usager");
                        
                        $idUsager = $modeleUsager->authentification($params["usager"], $params["pass"]);

                        // Si son authentification est valide 
                        if ($idUsager > 0) {
                            // On sauvegarde l'instance de l'usager courant dans la variable de session usager
                            $_SESSION["usager"] =& $modeleUsager->obtenirParId($idUsager);
                         
                            // On affiche les voitures
                            header("Location: index.php?Voitures");  
                        } else {
                            $donnees["erreurs"] = "Combinaison nom d'usager / mot de passe invalide.";  // L'authentification n'est pas bonne 
                            // On recommence la connexion de l'usager. 
                            $this->afficheVue("formulaireLogin", $donnees);                  
                        }
                    }
                    break;
                case "logout":
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
                    header("Location: index.php?Usager&action=Login");  
                    break;
            }
            $this->afficheVue("piedDePage");
        }
    }
?>