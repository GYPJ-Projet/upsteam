<section class="pageDonnees">
<?php 
    $langue = $donnees["langue"];
?>
        <h1><?= $langue["gestion_couleurs"] ?></h1>

    <div data-js-component="GestionCouleur">
        <button class="bouton" data-js-ajouter><?= $langue["button_ajouter"] ?></button>
        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th><?= $langue["nom_langue"] ?></th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
<?php
            foreach ($donnees["couleurs"] as $couleur) {
?>
                <tr>
                    <td><?= $couleur["id"] ?></td>
                    <td><?= $couleur["nom"] ?></td>
                    <td><button data-js-modifier data-js-id=<?= $couleur["id"] ?>><?= $langue["button_modifier"] ?></button></td>
                </tr>                 
<?php
            }
?>
            </tbody>
        </table>
    <div>
</section>
</div>