<?php

	foreach ($donnees["voitures"] as $voiture) {
		$altImage = (explode("/",$voiture["photos"]))[3];
?>
		<article class="grille__item voiture" data-js-voiture="<?=$voiture["id"] ?>"  data-js-component="Voiture">
			<h4><?=$voiture["nomMarque"] ?> <?=$voiture["nomModele"] ?> <?=$voiture["annee"] ?></h4>
		    <img src="<?=$voiture["photos"]?>" alt="<?= $altImage ?>" class="gallery__image">
			<h4>Kilométrage: <?=$voiture["kilometrage"]?></h4>
			<h4>Transmission: <?= $donnees["transmission"][$voiture["idTransmission"]]?></h4>
			<h4>Groupe motopropulseur: <?= $voiture["nomMotoPropulseur"] ?></h4>
			<h4>Carburant: <?= $donnees["typeCarburant"][$voiture["idTypeCarburant"]]?></h4>
			<h4>Habitacle: <?= $donnees["typeCarrosserie"][$voiture["idTypeCarrosserie"]]?></h4>
			<h4>Prix: <?=$voiture["prixVente"] ?>$</h4>
		</article>
<?php
	}
?>
