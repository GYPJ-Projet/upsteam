<?php
    use JetBrains\PhpStorm\Language;
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\SMTP;
    use PHPMailer\PHPMailer\Exception;

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

                /**
                 * PH
                 * Vérifie si l'usager est dans la bd.
                 * Test si un token est en attente.
                 * authentifie l'usager si possible.
                 */
                case "authentifier":
                    // On valide l'authentification de l'usager 
                    if (isset($params["courriel"], $params["motPasse"])) {
                        $unUsager = $modeleUsager->authentification($params["courriel"]);
                        $token = $unUsager->getToken();
                        // Si son authentification est valide 
                        if ($unUsager !== false) {
                            if($unUsager->getMotPasse() === $params["motPasse"]){       //Test du mot de passe.
                                if($token === null || $token === ''){                                    //Test de l'existence d'un token.
                                    $_SESSION["usager"] = $unUsager;
                                    header("Location: index.php");
                                }else{
                                    $donnees["erreurs"] = $donnees['langue']['erreurToken'];  // L'authentification n'est pas bonne 
                                    $this->affiche($donnees);
                                    $this->afficheVue("formulaireConnexion", $donnees);
                                }
                            }else{
                                $donnees["erreurs"] = $donnees['langue']['erreurConnexion'];  // L'authentification n'est pas bonne 
                                $this->affiche($donnees);
                                $this->afficheVue("formulaireConnexion", $donnees);
                            }
                        }else{
                            $donnees["erreurs"] = $donnees['langue']['erreurConnexion'];  // L'authentification n'est pas bonne 
                            $this->affiche($donnees);
                            $this->afficheVue("formulaireConnexion", $donnees);
                        }

                    } else {
                        $donnees["erreurs"] = $donnees['langue']['erreurConnexion'];  // L'authentification n'est pas bonne 
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
                 * Si oui: 
                 *      on sauvegarde dans la bd
                 *      Envoie d'un courriel de confirmation
                 *      retour vers page d'acceuil.
                 * Si non retour vers page de création.
                 */
                case "sauvegarderUsager":
                    if(!isset($params['idRole'])){
                        $params['idRole'] = 3;
                    }
                    $usager =  new Usager(  $params['id'], $params['motPasse'], $params['courriel'], $params['nom'],
                                            $params['prenom'], $params['dateNaissance'], $params['adresse'], 
                                            $params['codePostal'], $params['ville'], $params['telephone'],  
                                            $params['cellulaire'], $params['langue'], $params['idRole'], $params['province']);

                    //Test les paramètre reçus.
                    $test = $this->testCreation($params, $donnees);
                    $valide = $test[0];
                    $donnees['erreurs'] = $test[1];

                    // PH Test si c'est une modification (update table)
                    if(isset($params['modif'])){
                        $modeleUsager->sauvegarde($usager);
                        $unUsager = $modeleUsager->authentification($params["courriel"]);
                        $_SESSION['usager'] = $unUsager;
                        if(isset($params['retour'])){                           //Si on arrive du menu de gestion employer
                            header("Location: index.php?Usager&action=gestionUsager");
                        }else{                                                  //Si on arrive du menu de modif d'un usager.
                            header("Location: index.php");
                        }
                    }else{          //On procède àu test et à l'ajoût
                        
                        // Test si le courriel existe déjà.
                        $testCourriel = $modeleUsager->authentification($params["courriel"]);
                        if ($testCourriel === false){       //Courriel exite déjà ou non?
                            if($valide === true){           //Le formulaire est valide ou non?
                                $token = $this->fabriqueToken();
                                $usager->setToken($token);
                                $sauvegarde = $modeleUsager->sauvegarde($usager);

                                //On redéfinie l'usager selon les données de la bd.
                                $resultat = $modeleUsager->obtenirUsagerParToken($token);

                                $usager =  new Usager(  $resultat['id'], $resultat['motPasse'], $resultat['courriel'], $resultat['nom'],
                                                        $resultat['prenom'], $resultat['dateNaissance'], $resultat['adresse'], 
                                                        $resultat['codePostal'], $resultat['ville'], $resultat['telephone'],  
                                                        $resultat['telephoneCellulaire'], $resultat['idLangue'], $resultat['idRole'],
                                                        $resultat['idProvince'], $resultat['token']);

                                //Prépare et envoie d'un courriel à l'utilisateur 
                                //pour confirmation de création de compte.
                                $lien = '<a href="http://127.0.0.1/GYPJ-Projet/upstream/index.php?Usager&action=validationCompte&token=' . $usager->getToken() . '&id=' . $usager->getId() . '">'. $donnees['langue']['courrielSubjectNouveau'] .'</a>';
                                $msg = "<h1>V&eacute;hicules d'occasion</h1><br>";
                                $msg .= "<p>" . $donnees['langue']['courrielNouveau'] ."</p><br>";
                                $msg .= $lien;
                                $courriel = $usager->getCourriel();
                                $this->envoieCourriel($courriel, $donnees['langue']['courrielSubjectNouveau'], $msg);

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
                /**
                 * PH
                 * Valide que les informations reçu sont valide
                 * si ok:
                 *      retire le token de la bd.
                 *      transfert vers une page de confirmation.
                 * sinon
                 *      transfert vers une page d'erreur.
                 */
                case "validationCompte":
                    if(isset($params['id'], $params['token'])){
                        //On définie l'usager selon les données de la bd.
                        $resultat = $modeleUsager->obtenirUsagerParToken($params['token']);
                        $usager =  new Usager(  $resultat['id'], $resultat['motPasse'], $resultat['courriel'], $resultat['nom'],
                                                $resultat['prenom'], $resultat['dateNaissance'], $resultat['adresse'], 
                                                $resultat['codePostal'], $resultat['ville'], $resultat['telephone'],  
                                                $resultat['telephoneCellulaire'], $resultat['idLangue'], $resultat['idRole'],
                                                $resultat['idProvince'], $resultat['token']);
                        
                        if($usager->getId() === $params['id']){
                            $modeleUsager->retireToken($usager->getId());
                            $donnees['resultat'] = 'validationSucces';
                            $this->affiche($donnees);
                            $this->afficheVue("retourCourriel", $donnees);
                        }else{
                            $donnees['resultat'] = 'validationEchec';
                            $this->affiche($donnees);
                            $this->afficheVue("retourCourriel", $donnees);
                        }
                    }
                    break;

                /**
                 * PH
                 * Affiche la page de confirmation de mot de passe perdu.
                 */
                case "formulaireMotPassePerdu":
                    $this->affiche($donnees);
                    $this->afficheVue("formulaireMotPassePerdu", $donnees);
                    break;

                /**
                 * PH
                 * Affiche la page de modification des information d'un employer.
                 */
                case "formulaireMonProfil":
                    if(isset($params['modif']))$donnees['modif'] = $params['modif'];
                    $donnees["usager"] = $_SESSION['usager'];
                    $this->affiche($donnees);
                    $this->afficheVue("formulaireUsager", $donnees);
                    break;
                
                /**
                 * PH
                 * Génére un nouveau mot de passe.
                 * Intègre le mot de passe à la bd.
                 * Envoie un courriel avec le nouveau mot de passe.
                 */
                case "envoieMotPassePerdu":
                    if(isset($params['courriel'])){
                        $motPasse = $this->fabriqueToken();
                        $resultat = $modeleUsager->changeMotPasse($params['courriel'], $motPasse);
                        
                        //Prépare et envoie d'un courriel à l'utilisateur 
                        //pour changement du mot de passe.
                        $msg = "<h1>V&eacute;hicules d'occasion</h1><br>";
                        $msg .= "<p>" . $donnees['langue']['motPassePerduPresentation'] ."</p><br>";
                        $msg .= "<p>" . $motPasse ."</p><br>";
                        $courriel = $params['courriel'];
                        $this->envoieCourriel($courriel, $donnees['langue']['courrielSubjectChangement'], $msg);
                        header("Location: index.php?Usager&action=connexion");

                        break;
                    }
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

        /**
         * PH
         * Fabrique un token.
         */
        public function fabriqueToken(){
            $resultat = uniqid();  
            return $resultat;
        }

        /**
         * PH
         * On doit fournir
         * Le courriel du destinataire
         * Le sujet du courriel
         * Le contenue du courriel.
         */
        public function envoieCourriel($adrCourriel, $sujet, $message){
            require 'lib/PHPMailer.php';
            require 'lib/SMTP.php';
            require 'lib/Exception.php';


            //paramètres de connexion et envoie
            $courriel = new PHPMailer();
            $courriel->isSMTP();
            $courriel->Host = "smtp.gmail.com";
            $courriel->SMTPAuth = "true";
            $courriel->SMTPSecure = "tls";
            $courriel->Port = "587";
            $courriel->Username = "gypj.projet@gmail.com";
            $courriel->Password = 'VLLMcRi3R4EGta2IGZyvIp87gEB5';
            $courriel->Subject = $sujet;
            $courriel->setFrom('gypj.projet@gmail.com');
            $courriel->isHTML(true);
            $courriel->Body = $message;
            $courriel->addAddress($adrCourriel);
            $courriel->send();
            $courriel->smtpClose();
        }
    }
?>