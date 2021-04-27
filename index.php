<?php
    require_once("config.php");
    //appel du routeur

    //première chose : initialiser la session de l'usager
    session_start();

  /*   Debug::creation_fichier_log(); */
    
    Routeur::route();
    
?>