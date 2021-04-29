<?php

	$langue = $donnees["langue"];
	$voiture = $donnees["voiture"];

?>
<body >
	
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
		    <h2>Spécifications de la <?=$voiture["nomMarque"] ?> <?=$voiture["nomModele"] ?> <?=$voiture["annee"] ?></h2>
			<ul class="ulBlock">
				<li class="liste">Modèle: <span><?=$voiture["nomModele"] ?></span></li>
				<li class="liste"><span><?= $langue["habitacle"] ?>: </span><span class="valeur"><?= $donnees["typeCarrosserie"][$voiture["idTypeCarrosserie"]]?></span></li>
				<li class="liste"><span><?= $langue["kilometrage"] ?>: </span><span class="valeur"><?= $voiture["kilometrage"]?></span> km</li>
			</ul>			
		</div>
	</div>
	<div class="ajouter-panier" data-js-ajouter-panier>
			<button class="btn-ajouter-panier btn--hidden" data-js-btn>Voir plus</button>
	</div>

