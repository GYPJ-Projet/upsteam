<?php

	$langue = $donnees["langue"];
	
	foreach ($donnees["voitures"] as $voiture) {
		$tableauLienImage = explode("/",$voiture["lienPhotoPrincipale"]);
		$altImage = $tableauLienImage[Count($tableauLienImage)-1];
?>
		<article class="grille__item voiture" data-js-voiture="<?=$voiture["id"] ?>"  data-js-component="Voiture">
			<h2><?=$voiture["nomMarque"] ?> <?=$voiture["nomModele"] ?><br><?=$voiture["annee"] ?></h2>
		    <img src="<?=$voiture["lienPhotoPrincipale"] ?>" alt="<?= $altImage ?>" class="gallery__image">
			<div><span><?= $langue["kilometrage"] ?>:</span> <span class="valeur"><?= $voiture["kilometrage"]?> km</span></div>
<!-- 			<div><span>< ?= $langue["transmission"] ?>:</span> <span class="valeur">< ?= $donnees["transmission"][$voiture["idTransmission"]]?></span></div>
			<div><span>< ?= $langue["motopropulseur"] ?>:</span> <span class="valeur">< ?= $voiture["nomMotoPropulseur"] ?></span></div>
			<div><span>< ?= $langue["carburant"] ?>:</span> <span class="valeur">< ?= $donnees["typeCarburant"][$voiture["idTypeCarburant"]]?></span></div> -->
			<div><span><?= $langue["habitacle"] ?>:</span> <span class="valeur"><?= $donnees["typeCarrosserie"][$voiture["idTypeCarrosserie"]]?></span></div>
			<div><span><?= $langue["prix"] ?>:</span> <span class="valeur"><?=$voiture["prixVente"] ?>$</span></div>
		</article>
<?php
	}
?>
