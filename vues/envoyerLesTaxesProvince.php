<?php

    $lesTaxesJSON = json_encode($donnees["taxes"], JSON_FORCE_OBJECT);
    Debug::toLog($lesTaxesJSON, "vue  envoyerLesTaxesProvince  - lesTaxesJSON :");

    // on retourne le tableau des taxes de la province demandé
	  echo $lesTaxesJSON;

?> 