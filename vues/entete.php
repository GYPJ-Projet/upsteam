<?php 
    $langue = $donnees["langue"];       //Pour affichage des langues
    $actionRecu = '';
	$idProvince =  0;
    if(isset($_GET['action'])){
        $actionRecu = $_GET['action'];
    }

	// Si l'usager exite on prend la province où il habite.
	if(isset($_SESSION["usager"])) {
	 	$idProvince = $_SESSION["usager"]->getIdProvince();
	}
?>
<!-- data-js-component="Taxes" -->
<header data-js-component="Entete">
	<div class="enteteConteneur" data-js-province="<?= $idProvince ?>" >
		<a href="index.php?Voiture&action=Accueil">
			<img src="logo/logo_v2.svg" alt="logo" width="400px"height="170px">
		</a>
		<div class="enteteRecherche" >
			<input type="search" class="recherche" placeholder="<?=$langue['entete_recherche']?>" data-js-component="Chercher" data-js-action="<?= $actionRecu ?>">
		</div>
		<div class="entete__droit">
<?php
            if(isset($_SESSION["usager"])){ 
				/*$unUsager = $_SESSION["usager"];		
				<h4>Bienvenue : <?=  <?= $usager->getNom() ?> <?= $unUsager->getPrenom() ?> </h4>*/
					
?>
				
                <a href="index.php?Usager&action=deconnexion" class="connexion"><?= $langue['entete_deconnexion'] ?></a>
<?php
            } else{
?>
                <a href="index.php?Usager&action=connexion" class="connexion"><?= $langue['entete_connexion'] ?></a>
<?php
            }
?>
			<div class="entete__langue sourisPointer" data-js-langue="<?= $langue['repertoireLangue'] ?>">
				<p data-js-codeLangue>
					<?= $langue['entete_choix_langue'] ?>
				</p>
			</div>
			<div class="entete__panierAchat vide" data-js-panier>
				<span class="itemPanier" data-js-nombre-voiture></span>
				<svg version="1.0" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 160 160" class="entete__panier">
					<g transform="translate(0.000000,160.000000) scale(0.100000,-0.100000)">
						<path class="entete__panier__path" d="M14 1235 c-15 -38 2 -45 100 -45 l95 0 132 -402 c72 -222 136 -409 142 -416 7 -9 108 -12 466 -10 l456 3 0 25 0 25 -440 5 -439 5 -136 410 -135 410 -118 3 c-98 2 -118 0 -123 -13z"/>
						<path class="entete__panier__path" d="M416 1004 c-9 -8 -16 -22 -16 -31 0 -24 140 -455 156 -480 l14 -23 425 0 c361 0 426 2 438 15 17 17 167 459 167 492 0 12 -9 27 -19 33 -13 6 -214 10 -585 10 -500 0 -566 -2 -580 -16z"/>
						<path class="entete__panier__path" d="M589 291 c-20 -20 -29 -39 -29 -61 0 -43 47 -90 90 -90 43 0 90 47 90 90 0 43 -47 90 -90 90 -22 0 -41 -9 -61 -29z"/>
						<path class="entete__panier__path" d="M1189 291 c-20 -20 -29 -39 -29 -61 0 -43 47 -90 90 -90 43 0 90 47 90 90 0 43 -47 90 -90 90 -22 0 -41 -9 -61 -29z"/>
					</g>
				</svg>
			</div>
		</div>	
	</div>
</header>