<section class="pageDonnees">
<?php 
    $langue = $donnees["langue"];
    $pageCourante = $donnees["pageCourante"];
    $nbPages = $donnees["nbPages"];
    $tri = $donnees["tri"];
    $ordre = $donnees["ordre"];
?>
        <h1><?= $langue["gestion_taxe"] ?></h1>

    <div data-js-component="GestionTaxe" data-js-controleur-action="gestionTaxe">
    <a class="bouton" href="index.php?GestionDonnees&action=afficherFormulaireTaxe&page=<?= $pageCourante ?>" data-js-ajouter><?= $langue["button_ajouter"] ?></a>
        <table class="table">
            <thead>
                <tr>
                    <th>
                        <span>ID</span>
                        <div class="sourisPointer symboleTri">
                            <svg class='<?= ($tri == 'taxe.id' && $ordre == "ASC")? "inactif" : "" ?>' xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1000 1000" version="1.1" fill="#333333" width="1vw" height="1vw" data-js-tri="taxe.id" data-js-ordre="ASC"><path d="M10 132.5h980l-489.9 735L10 132.5z"/></svg>
                            <svg class='<?= ($tri == 'taxe.id' && $ordre == "DESC")? "inactif" : "" ?>' xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1000 1000" version="1.1" fill="#333333" width="1vw" height="1vw" data-js-tri="taxe.id" data-js-ordre="DESC"><path d="M10 881.1h980L500 118.9 10 881.1z"/></svg>
                        </div>
                    </th>
                    <th>
                        <span><?= $langue["nom_taxe"] ?></span>
                        <div class="sourisPointer symboleTri">
                            <svg class='<?= ($tri == 'taxe.nom' && $ordre == "ASC")? "inactif" : "" ?>' xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1000 1000" version="1.1" fill="#333333" width="1vw" height="1vw" data-js-tri="taxe.nom" data-js-ordre="ASC"><path d="M10 132.5h980l-489.9 735L10 132.5z"/></svg>
                            <svg class='<?= ($tri == 'taxe.nom' && $ordre == "DESC")? "inactif" : "" ?>' xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1000 1000" version="1.1" fill="#333333" width="1vw" height="1vw" data-js-tri="taxe.nom" data-js-ordre="DESC"><path d="M10 881.1h980L500 118.9 10 881.1z"/></svg>
                        </div>
                    </th>
                    <th>
                        <span><?= $langue["nom_taux"] ?></span>
                        <div class="sourisPointer symboleTri">
                            <svg class='<?= ($tri == 'taux' && $ordre == "ASC")? "inactif" : "" ?>' xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1000 1000" version="1.1" fill="#333333" width="1vw" height="1vw" data-js-tri="taux" data-js-ordre="ASC"><path d="M10 132.5h980l-489.9 735L10 132.5z"/></svg>
                            <svg class='<?= ($tri == 'taux' && $ordre == "DESC")? "inactif" : "" ?>' xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1000 1000" version="1.1" fill="#333333" width="1vw" height="1vw" data-js-tri="taux" data-js-ordre="DESC"><path d="M10 881.1h980L500 118.9 10 881.1z"/></svg>
                        </div>
                    </th>
                    <th>
                        <span><?= $langue["nom_province"] ?></span>
                        <div class="sourisPointer symboleTri">
                            <svg class='<?= ($tri == 'idProvince' && $ordre == "ASC")? "inactif" : "" ?>' xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1000 1000" version="1.1" fill="#333333" width="1vw" height="1vw" data-js-tri="idProvince" data-js-ordre="ASC"><path d="M10 132.5h980l-489.9 735L10 132.5z"/></svg>
                            <svg class='<?= ($tri == 'idProvince' && $ordre == "DESC")? "inactif" : "" ?>' xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1000 1000" version="1.1" fill="#333333" width="1vw" height="1vw" data-js-tri="idProvince" data-js-ordre="DESC"><path d="M10 881.1h980L500 118.9 10 881.1z"/></svg>
                        </div>
                    </th>
                    <th>
                        <span><?= $langue["disponibilite"] ?></span>
                        <div class="sourisPointer symboleTri">
                            <svg class='<?= ($tri == 'disponibilite' && $ordre == "ASC")? "inactif" : "" ?>' xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1000 1000" version="1.1" fill="#333333" width="1vw" height="1vw" data-js-tri="disponibilite" data-js-ordre="ASC"><path d="M10 132.5h980l-489.9 735L10 132.5z"/></svg>
                            <svg class='<?= ($tri == 'disponibilite' && $ordre == "DESC")? "inactif" : "" ?>' xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1000 1000" version="1.1" fill="#333333" width="1vw" height="1vw" data-js-tri="disponibilite" data-js-ordre="DESC"><path d="M10 881.1h980L500 118.9 10 881.1z"/></svg>
                        </div>
                    </th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
<?php
            foreach ($donnees["taxes"] as $taxe) {
?>
                <tr>
                    <td><?= $taxe->getIdTaxe() ?></td>
                    <td><?= $taxe->getNomTaxe() ?></td>
                    <td><?= $taxe->getTaux() ?></td>
                    <td><?= $taxe->getNomProvince() ?></td>
                    <td><?= ($taxe->getDisponibilite() == true)? $langue["texte_oui"] : "" ?></td>
                    <td><a href="index.php?GestionDonnees&action=afficherFormulaireTaxe&id=<?= $taxe->getIdTaxe() ?>&page=<?= $pageCourante ?>" data-js-modifier data-js-id=<?= $taxe->getIdTaxe() ?>><?= $langue["button_modifier"] ?></a></td>
                </tr>                 
<?php
            }
?>
            </tbody>
        </table>
        <div class="pagination">
<?php
            if($pageCourante > 1) echo '<p data-js-page="'. ($pageCourante - 1) .'" class="fleche"><<</p>'; 
            for ($j = 1; $j <= $nbPages; $j++) {
                if ($j == $pageCourante) {
                    echo '<p class="page-active" data-js-pageActive="'.$j.'">Page '.$j.'</p>';
                } 
            }
            if($pageCourante < $nbPages) echo '<p data-js-page="'. ($pageCourante + 1) .'" class="fleche">>></p>';
?>
        </div>
    <div>
</section>
</div>