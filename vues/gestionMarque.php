<section class="pageDonnees">
<?php 
    if (isset($donnees["titre"])) 
?>
        <h1><?= $donnees["titre"] ?></h1>

    <div data-js-component="GestionMarque">

        <table>
            <thead>
                <tr>
                    <th>id</th>
                    <th>Marque</th>
                    <th>Disponibilite</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
        <?php

            foreach ($donnees["marques"] as $marque) {
        ?>
                <tr>
                    <td><?= $marque["id"] ?></td>
                    <td><?= $marque["nom"] ?></td>
                    <td><?= $marque["disponibilite"] ?></td>
                    <td><button data-js-modifier data-js-id=<?= $marque["id"] ?>>Modifier</button></td>
                </tr>                 
        <?php
            }
        ?>
            </tbody>
        </table>
    <div>
</section>