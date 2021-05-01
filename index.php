<?php
    require_once("config.php");
    //appel du routeur

    //première chose : initialiser la session de l'usager
    session_start();

    Routeur::route();
?>