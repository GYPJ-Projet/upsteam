<?php
    // on retourne seulement la réponse, soit le nombre de voitures qu'il y a dans la BD.
	foreach ($donnees["NombreDeVoitures"] as $count) {
		echo $count["NombreDeVoitures"];
	}
?> 