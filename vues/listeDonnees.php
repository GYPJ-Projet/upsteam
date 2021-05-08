<?php 
    $langue = $donnees["langue"];
?>
<div class="bodyConteneur" data-js-controleur="GestionDonnees">
    <aside class="listeDonnees">
        <ul>
            <li><a href="index.php?GestionDonnees&action=gestionMarque"><?= $langue["nom_marque"] ?></a></li>
            <li><a href="index.php?GestionDonnees&action=gestionModele"><?= $langue["nom_modele"] ?></a></li>
            <li><a href="index.php?GestionDonnees&action=gestionCouleur"><?= $langue["nom_couleur"] ?></a></li>
            <li><a href="index.php?GestionDonnees&action=gestionVoiture"><?= $langue["nom_voiture"] ?></a></li>
            <li><a href="index.php?GestionDonnees&action=gestionTaxe"><?= $langue["nom_taxe"] ?></a></li>
        </ul>
    </aside>
