<?php 
    $langue = $donnees["langue"];
?>
<div class="bodyConteneur" data-js-Controleur="GestionDonnees">
    <aside class="listeDonnees">
        <ul>
            <li><a href="index.php?GestionDonnees&action=gestionMarque"><?= $langue["nom_marque"] ?></a></li>
            <li><a href="index.php?GestionDonnees&action=gestionModele"><?= $langue["nom_modele"] ?></a></li>
            <li><a href="index.php?GestionDonnees&action=gestionCouleur"><?= $langue["nom_couleur"] ?></a></li>
            <li><a href="index.php?GestionDonnees&action=gestionVoiture"><?= $langue["nom_voiture"] ?></a></li>
        </ul>
    </aside>
