<section class="pageDonnees">
<?php 
    $langue = $donnees["langue"]; 
?>
        <h1><?= $langue["gestion_modeles"] ?></h1>

    <div data-js-component="GestionModele">

        <table>
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
                    <td><?= $modele->getId() ?></td>
                    <td><?= $modele->getNom() ?></td>
                    <td><?= $modele->getIdMarque() ?></td>
                    <td><?= ($modele->getDisponibilite() == true)? $langue["texte_oui"] : "" ?></td>
                    <td><button data-js-modifier data-js-id=<?= $modele->getId() ?>><?= $langue["button_modifier"] ?></button></td>
                </tr>                 
        <?php
            }
        ?>
            </tbody>
        </table>
        <button class="bouton" data-js-ajouter><?= $langue["button_ajouter"] ?></button>
    <div>
</section>
</div>