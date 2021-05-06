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
        $modeleUsager           = $this->obtenirDAO("Usager");
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

            /**
             * PH
             * On test pour savoir si champs valide.
             * Si oui: on sauvegarde dans la bd. - retour vers page d'acceuil.
             * Si non retour vers page de création.
             */
            case "sauvegarderUsager":
                Debug::tolog($params);
                $usager =  new Usager(  $params['id'], $params['motPasse'], $params['courriel'], $params['nom'],
                                        $params['prenom'], $params['dateNaissance'], $params['adresse'], 
                                        $params['codePostal'], $params['ville'], $params['telephone'],  
                                        $params['cellulaire'], $params['langue'], $params['role'], $params['province']);
                //Test les paramètre reçus.
                $test = $this->testCreation($params, $donnees);
                $valide = $test[0];
                $donnees['erreurs'] = $test[1];

                // PH Test si c'est une modification (update table)
                if(isset($params['modif'])){
                    Debug::toLog('modif');
                }else{          //On procède àu test et à l'ajoût
                    
                    // Test si le courriel existe déjà.
                    $testCourriel = $modeleUsager->authentification($params["courriel"]);
                    if ($testCourriel === false){       //Courriel exite déjà ou non?
                        if($valide === true){           //Le formulaire est valide ou non?
                            $sauvegarde = $modeleUsager->sauvegarde($usager);
                            if(isset($params['retour'])){       //On vérifie quelle page ouvrir.
                                header("Location: index.php?Usager&action=gestionUsager");
                            }else{
                                $this->affiche($donnees);
                                $this->afficheVue("formulaireConnexion", $donnees);
                            }
                        }else{
                            // On retourne les données avec un message d'erreur
                            $donnees["usager"] = $usager;
                            $this->affiche($donnees);
                            $this->afficheVue("formulaireUsager", $donnees);
                        }
                    }else{
                        // Le courriel existe déjà, retour vers formulaire avec erreur.
                        $donnees['erreurs'] = $donnees['langue']['erreurCourrielExist'];
                        $donnees["usager"] = $usager;
                        $this->affiche($donnees);
                        $this->afficheVue("formulaireUsager", $donnees);
                    }
                }

                break;

            // PH
            // Affiche la liste des employés.
            case "gestionUsager":
                // Nombre d'usagé à affichés dans une page
        		$usagerParPage = 10;
                //Nbr usagers total.
                $nbUsagerTotal = $modeleUsager->combienUsager();
                // Calculer le nombre des pages.
        		$donnees["nbPages"] = ceil($nbUsagerTotal / $usagerParPage);
                // Génère la page courante.
                if (isset($_GET["page"]) AND !empty($_GET["page"]) AND $_GET["page"] > 0 AND $_GET["page"] <= $donnees["nbPages"]) 
                {
                    $_GET["page"] = intval($_GET["page"]);
                    $donnees["pageCourante"] = $_GET["page"];
                } else 
                {
                    $donnees["pageCourante"] = 1;
                }

        		$depart = ($donnees["pageCourante"] - 1) * $usagerParPage;

                //Par defaut, on trie par id
                if (isset($_GET["tri"])) $tri = $_GET["tri"];
                else $tri = 'id';
                //Par defaut, on tri dans l'ordre ascendente
                if (isset($_GET["ordre"])) $ordre = $_GET["ordre"];
                else $ordre = 'ASC';
                //Passer les paramètres à la vue
                $donnees["tri"] = $tri;
                $donnees["ordre"] = $ordre;

                $donnees["usager"] = $modeleUsager->obtenirToutDisponibleAvecTri($depart, $usagerParPage, $tri, $ordre);
                $this->affiche($donnees);
                $this->afficheVue("gestionUsager", $donnees);
                break;

            case "afficherFormulaireUsager":
                // Si le parametres id est existe, on affiche le formulaire pour la modification
                if (isset($params["id"])) {
                    // Obtenir les données à propos de la voiture avec id 
                    $donnees["usager"] = $modeleUsager->obtenirParId($params["id"]);
                }

                if(isset($params['retour']))$donnees['retour'] = $params['retour'];
                if(isset($params['modif']))$donnees['modif'] = $params['modif'];
                $this->affiche($donnees);
                $this->afficheVue("formulaireUsager", $donnees);
                break;
        }


        $this->afficheVue("piedDePage", $donnees);
    }

    /**
     * PH
     * Affichage de tête, entête et menu.
     */
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
        $erreur ="";
        $regCodePostal = "#^([a-zA-Z]\d[a-zA-Z])\ {0,1}(\d[a-zA-Z]\d)$#";
        $regTelephone = "#^[\+]?[(]?[0-9]{3}[)]?[-\s\.]?[0-9]{3}[-\s\.]?[0-9]{4,6}$#";
        
        
        if(!isset($params['nom']) || $params['nom'] === ""){
            $valide = false;
            $erreur .= $donnees['langue']['erreurNom'];
        }
        if(!isset($params['prenom']) || $params['prenom'] === ""){
            $valide = false;
            $erreur .= $donnees['langue']['erreurPrenom'];
        }
        if(!isset($params['courriel']) || $params['courriel'] === ""){
            $valide = false;
            $erreur .= $donnees['langue']['erreurCourriel'];
        }
        if(!isset($params['dateNaissance']) || $params['dateNaissance'] === ""){
            $valide = false;
            $erreur .= $donnees['langue']['erreurDateNaissance'];
        }
        if(!isset($params['adresse']) || $params['adresse'] === ""){
            $valide = false;
            $erreur .= $donnees['langue']['erreurAdresse'];
        }
        if(!isset($params['codePostal']) || preg_match($regCodePostal, $params['codePostal']) !== 1){
            $valide = false;
            $erreur .= $donnees['langue']['erreurCodePostal'];
        }
        if(!isset($params['province']) || $params['province'] === ""){
            $valide = false;
            $erreur .= $donnees['langue']['erreurProvince'];
        }
        if(!isset($params['ville']) || $params['ville'] === ""){
            $valide = false;
            $erreur .= $donnees['langue']['erreurVille'];
        }
        if(!isset($params['telephone']) || preg_match($regTelephone, $params['telephone']) !== 1){
            $valide = false;
            $erreur .= $donnees['langue']['erreurTelephone'];
        }
        if(!isset($params['cellulaire']) || preg_match($regTelephone, $params['telephone']) !== 1){
            $valide = false;
            $erreur .= $donnees['langue']['erreurCellulaire'];
        }
        if(!isset($params['langue']) || $params['langue'] === ""){
            $valide = false;
            $erreur .= $donnees['langue']['erreurLangue'];
        }
        if(!isset($params['motPasse'], $params['confMotPasse']) || $params['motPasse'] !== $params['confMotPasse']){
            $valide = false;
            $erreur .= $donnees['langue']['erreurMotPasse'];
        }


        return array($valide, $erreur);


    }
}
?>