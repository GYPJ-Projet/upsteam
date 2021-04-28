<section class="pageDonnees">
<?php 
    $langue = $donnees["langue"];
    $pageCourante = $donnees["pageCourante"];
    $nbPages = $donnees["nbPages"]; 
?>
        <h1><?= $langue["gestion_marques"] ?></h1>

    <div data-js-component="GestionMarque">
        <button class="bouton" data-js-ajouter><?= $langue["button_ajouter"] ?></button>
        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th><?= $langue["nom_marque"] ?></th>
                    <th><?= $langue["disponibilite"] ?></th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
        <?php

            foreach ($donnees["marques"] as $marque) {
        ?>
                <tr>
                    <td><?= $marque->getId() ?></td>
                    <td><?= $marque->getNom() ?></td>
                    <td><?= ($marque->getDisponibilite() == true)? $langue["texte_oui"] : "" ?></td>
                    <td><button data-js-modifier data-js-id=<?= $marque->getId() ?>><?= $langue["button_modifier"] ?></button></td>
                </tr>                 
        <?php
            }
        ?>
            </tbody>
        </table>
        <div class="pagination">
<?php
            if($pageCourante > 1) echo '<a href="index.php?GestionDonnees&action=gestionMarque&page='. ($pageCourante - 1) .'" class="fleche"><<</a>'; 
            for ($j = 1; $j <= $nbPages; $j++) {
                if ($j == $pageCourante) {
                    echo '<a href="index.php?GestionDonnees&action=gestionMarque&page='.$j.'" class="page-active">Page '.$j.'</a>';
                } 
            }
            if($pageCourante < $nbPages) echo '<a href="index.php?GestionDonnees&action=gestionMarque&page='. ($pageCourante + 1) .'" class="fleche">>></a>';
?>
        </div>
    </div>
</section>

</div>