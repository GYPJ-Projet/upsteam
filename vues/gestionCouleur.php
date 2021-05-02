<section class="pageDonnees">
<?php 
    $langue = $donnees["langue"];
?>
        <h1><?= $langue["gestion_couleurs"] ?></h1>

    <div data-js-component="GestionCouleur" data-js-controleur-action="gestionCouleur">
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
            for ($i = 1, $l = count($donnees["couleurs"]); $i <= $l; $i++) {
                $couleur = $donnees["couleurs"][$i];
                if (isset($couleur)) {
?>         
                    <tr>
                        <td><?= $i ?></td>
                        <td><?= $couleur ?></td>
                        <td><button data-js-modifier data-js-id=<?= $i ?>><?= $langue["button_modifier"] ?></button></td>
                    </tr>   
<?php       
                }
            }    
?>
            </tbody>
        </table>
    <div>
</section>
</div>