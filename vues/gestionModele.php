<section class="pageDonnees">
<?php 
    $langue = $donnees["langue"];
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
    <div>
</section>
</div>