<?php
//définition de la racine du projet
//define("RACINE", $_SERVER["DOCUMENT_ROOT"] . "/ProjetMVCAvecBD/");
define("RACINE", "");
//définition des constantes de connexion à la BD
define("TYPEBD", "mysql");
define("HOTE", "localhost");
define("NOMBD", "vehicules");
define("USAGER", "root");
define("MDP", "");
define("REPERTOIRE_IMAGES", "./images/");
define("ADDRESSE_SITE", "http://127.0.0.1/GYPJ-Projet");


//définition de la fonction d'autoload
function mon_autoloader($classe)
{
    //liste des répertoires à fouiller pour trouver les classes 
    //si vous en ajoutez, ajoutez le ici aussi
    $repertoires = array(
        RACINE . "controleurs/",
        RACINE . "modeles/",
        RACINE . "lib/",
        RACINE . "vues/"
    );

    foreach($repertoires as $rep)
    {
        if(file_exists($rep . $classe . ".php"))
        {
            require_once($rep . $classe . ".php");
            return;
        }
    }

}

//enregistrer cette fonction comme étant notre autoloader
spl_autoload_register("mon_autoloader");

?>