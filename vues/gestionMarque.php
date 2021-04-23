<section class="pageDonnees">
<?php 
    if (isset($donnees["titre"])) 
?>
    <h1><?= $donnees["titre"] ?></h1>
    <table>
        <thead>
            <tr>
                <th>id</th>
                <th>Marque</th>
                <th></th>
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
                <td><a href="index.php?Gestion&action=modifierMarque&id=<?= $marque["id"] ?>">Modifier</a></td>
                <td><a href="index.php?Gestion&action=supprimerMarque&id=<?= $marque["id"] ?>">Supprimer</a></td>
            </tr>                 
    <?php
        }
    ?>
        </tbody>
    </table>
</section>