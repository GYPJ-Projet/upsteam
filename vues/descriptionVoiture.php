<?php

	$langue = $donnees["langue"];
	$voiture = $donnees["voiture"];

?>
<body >
	<div data-js-controleur="Voiture"  data-js-controleur-action="descriptionVoiture&id=<?=$voiture["id"] ?>">  

	<div class="description" data-js-component="DescriptionVoiture">
        <div class="swiper-container">
            <div class="swiper-wrapper">
<?php
	foreach ($donnees["images"]  as $unImage) {
		$tableauLienImage = explode("/",$unImage["lien"]);
		$altImage = $tableauLienImage[Count($tableauLienImage)-1];
?>  
            	<div class="swiper-slide"><img src="<?=$unImage["lien"] ?>" alt="<?= $altImage ?>" class="swiper-image"></div>
<?php
	}
?>               
            </div>
            <!-- Add Pagination -->
            <div class="swiper-pagination"></div>

            <!-- Add Arrows -->
            <div class="swiper-button-next"></div>
            <div class="swiper-button-prev"></div>
        </div>

		<div class="descriptionVoiture" data-js-voiture="<?=$voiture["id"] ?>">
			<h2><?= $langue['titreDescription'] ?> <?=$voiture["nomMarque"] ?> <?=$voiture["nomModele"] ?> <?=$voiture["annee"] ?></h2>
			<div class="divColonne">
				<ul class="ulListeDescription">
					<li class="ilListeDescription"><span><?= $langue["modele"] ?>: </span> <span><?=$voiture["nomModele"] ?></span></li>
					<li class="ilListeDescription"><span><?= $langue["habitacle"] ?>: </span><span class="valeur"><?= $donnees["typeCarrosserie"][$voiture["idTypeCarrosserie"]]?></span></li>
					<li class="ilListeDescription"><span><?= $langue["couleur"] ?>: </span><span class="valeur"><?= $donnees["couleur"][$voiture["idTypeCarrosserie"]]?></span></li>
					<li class="ilListeDescription"><span><?= $langue["kilometrage"] ?>: </span><span class="valeur"><?= $voiture["kilometrage"]?></span> km</li>
				</ul>	
				<ul class="ulListeDescription">
					<li class="ilListeDescription"><span><?= $langue["transmission"] ?>: </span><span class="valeur"><?= $donnees["transmission"][$voiture["idTransmission"]]?></span></li>
					<li class="ilListeDescription"><span><?= $langue["carburant"] ?>:</span><span class="valeur"><?= $donnees["typeCarburant"][$voiture["idTypeCarburant"]]?></span></li>
					<li class="ilListeDescription"><span><?= $langue["prix"] ?>: </span><span class="valeur"><?=$voiture["prixVente"] ?>$</span></li>
				</ul>			
			</div>
		</div>
	</div>
	<div class="ajouter-panier" data-js-ajouter-panier>
			<button class="btn-ajouter-panier btn--hidden" data-js-btn>Voir plus</button>
	</div>

