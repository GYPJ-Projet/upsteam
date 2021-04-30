<section class="pageDonnees">
<?php 
    $langue = $donnees["langue"];
    $pageCourante = $donnees["pageCourante"];
    $nbPages = $donnees["nbPages"];
?>
        <h1><?= $langue["gestion_modeles"] ?></h1>

    <div data-js-component="GestionModele">
        <button class="bouton" data-js-ajouter><?= $langue["button_ajouter"] ?></button>
        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th><?= $langue["nom_modele"] ?></th>
                    <th><?= $langue["nom_marque"] ?></th>
                    <th><?= $langue["disponibilite"] ?></th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
<?php
            foreach ($donnees["modeles"] as $modele) {
?>
                <tr>
                    <td><?= $modele["id"] ?></td>
                    <td><?= $modele["nom"] ?></td>
                    <td><?= $modele["nomMarque"] ?></td>
                    <td><?= ($modele["disponibilite"] == true)? $langue["texte_oui"] : "" ?></td>
                    <td><button data-js-modifier data-js-id=<?= $modele["id"] ?>><?= $langue["button_modifier"] ?></button></td>
                </tr>                 
<?php
            }
?>
            </tbody>
        </table>
        <div class="pagination">
<?php
            if($pageCourante > 1) echo '<a href="index.php?GestionDonnees&action=gestionModele&page='. ($pageCourante - 1) .'" class="fleche"><<</a>'; 
            for ($j = 1; $j <= $nbPages; $j++) {
                if ($j == $pageCourante) {
                    echo '<p class="page-active" data-js-page="'.$j.'">Page '.$j.'</p>';
                } 
            }
            if($pageCourante < $nbPages) echo '<a href="index.php?GestionDonnees&action=gestionModele&page='. ($pageCourante + 1) .'" class="fleche">>></a>';
?>
        </div>
    <div>
</section>
</div>