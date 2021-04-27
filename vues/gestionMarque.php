<section class="pageDonnees">
<?php 
    $langue = $donnees["langue"]; 
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
    <div>
</section>
</div>