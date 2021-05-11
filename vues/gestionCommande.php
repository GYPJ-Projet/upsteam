<section class="pageDonnees">
<?php 
    $langue = $donnees["langue"];
    $pageCourante = $donnees["pageCourante"];
    $nbPages = $donnees["nbPages"];
    $tri = $donnees["tri"];
    $ordre = $donnees["ordre"];
?>
        <h1><?= $langue["gestion_commande"] ?></h1>
<?php
    if (isset($donnees["commandes"]) && !empty($donnees["commandes"])) {
?>
    <div data-js-component="GestionCommande" data-js-controleur-action="gestionCommande">
        <div class="defilementDonnees">
            <table class="table">
                <thead>
                    <tr>
                        <th>
                            <span>ID</span>
                            <div class="sourisPointer symboleTri">
                                <svg class='<?= ($tri == 'id' && $ordre == "ASC")? "inactif" : "" ?>' xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1000 1000" version="1.1" fill="#333333" width="1vw" height="1vw" data-js-tri="id" data-js-ordre="ASC"><path d="M10 132.5h980l-489.9 735L10 132.5z"/></svg>
                                <svg class='<?= ($tri == 'id' && $ordre == "DESC")? "inactif" : "" ?>' xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1000 1000" version="1.1" fill="#333333" width="1vw" height="1vw" data-js-tri="id" data-js-ordre="DESC"><path d="M10 881.1h980L500 118.9 10 881.1z"/></svg>
                            </div>
                        </th>
                        <th>
                            <span><?= $langue["nom_client"] ?></span>
                            <div class="sourisPointer symboleTri">
                                <svg class='<?= ($tri == 'idClient' && $ordre == "ASC")? "inactif" : "" ?>' xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1000 1000" version="1.1" fill="#333333" width="1vw" height="1vw" data-js-tri="idClient" data-js-ordre="ASC"><path d="M10 132.5h980l-489.9 735L10 132.5z"/></svg>
                                <svg class='<?= ($tri == 'idClient' && $ordre == "DESC")? "inactif" : "" ?>' xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1000 1000" version="1.1" fill="#333333" width="1vw" height="1vw" data-js-tri="idClient" data-js-ordre="DESC"><path d="M10 881.1h980L500 118.9 10 881.1z"/></svg>
                            </div>
                        </th>
                        <th>
                            <span><?= $langue["nom_date"] ?></span>
                            <div class="sourisPointer symboleTri">
                                <svg class='<?= ($tri == 'date' && $ordre == "ASC")? "inactif" : "" ?>' xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1000 1000" version="1.1" fill="#333333" width="1vw" height="1vw" data-js-tri="date" data-js-ordre="ASC"><path d="M10 132.5h980l-489.9 735L10 132.5z"/></svg>
                                <svg class='<?= ($tri == 'date' && $ordre == "DESC")? "inactif" : "" ?>' xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1000 1000" version="1.1" fill="#333333" width="1vw" height="1vw" data-js-tri="date" data-js-ordre="DESC"><path d="M10 881.1h980L500 118.9 10 881.1z"/></svg>
                            </div>
                        </th>
                        <th>
                            <span><?= $langue["nom_nbVoitures"] ?></span>
                            <div class="sourisPointer symboleTri">
                                <svg class='<?= ($tri == 'nbVoitures' && $ordre == "ASC")? "inactif" : "" ?>' xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1000 1000" version="1.1" fill="#333333" width="1vw" height="1vw" data-js-tri="nbVoitures" data-js-ordre="ASC"><path d="M10 132.5h980l-489.9 735L10 132.5z"/></svg>
                                <svg class='<?= ($tri == 'nbVoitures' && $ordre == "DESC")? "inactif" : "" ?>' xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1000 1000" version="1.1" fill="#333333" width="1vw" height="1vw" data-js-tri="nbVoitures" data-js-ordre="DESC"><path d="M10 881.1h980L500 118.9 10 881.1z"/></svg>
                            </div>
                        </th>
                        <th>
                            <span><?= $langue["nom_prixTotal"] ?></span>
                            <div class="sourisPointer symboleTri">
                                <svg class='<?= ($tri == 'prixTotal' && $ordre == "ASC")? "inactif" : "" ?>' xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1000 1000" version="1.1" fill="#333333" width="1vw" height="1vw" data-js-tri="prixTotal" data-js-ordre="ASC"><path d="M10 132.5h980l-489.9 735L10 132.5z"/></svg>
                                <svg class='<?= ($tri == 'prixTotal' && $ordre == "DESC")? "inactif" : "" ?>' xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1000 1000" version="1.1" fill="#333333" width="1vw" height="1vw" data-js-tri="prixTotal" data-js-ordre="DESC"><path d="M10 881.1h980L500 118.9 10 881.1z"/></svg>
                            </div>
                        </th>
                        <th>
                            <span><?= $langue["nom_statut"] ?></span>
                            <div class="sourisPointer symboleTri">
                                <svg class='<?= ($tri == 'nomStatut' && $ordre == "ASC")? "inactif" : "" ?>' xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1000 1000" version="1.1" fill="#333333" width="1vw" height="1vw" data-js-tri="nomStatut" data-js-ordre="ASC"><path d="M10 132.5h980l-489.9 735L10 132.5z"/></svg>
                                <svg class='<?= ($tri == 'nomStatut' && $ordre == "DESC")? "inactif" : "" ?>' xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1000 1000" version="1.1" fill="#333333" width="1vw" height="1vw" data-js-tri="nomStatut" data-js-ordre="DESC"><path d="M10 881.1h980L500 118.9 10 881.1z"/></svg>
                            </div>
                        </th>
                        <th>
                            <span><?= $langue["nom_expedition"] ?></span>
                            <div class="sourisPointer symboleTri">
                                <svg class='<?= ($tri == 'nomExpedition' && $ordre == "ASC")? "inactif" : "" ?>' xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1000 1000" version="1.1" fill="#333333" width="1vw" height="1vw" data-js-tri="nomExpedition" data-js-ordre="ASC"><path d="M10 132.5h980l-489.9 735L10 132.5z"/></svg>
                                <svg class='<?= ($tri == 'nomExpedition' && $ordre == "DESC")? "inactif" : "" ?>' xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1000 1000" version="1.1" fill="#333333" width="1vw" height="1vw" data-js-tri="nomExpedition" data-js-ordre="DESC"><path d="M10 881.1h980L500 118.9 10 881.1z"/></svg>
                            </div>
                        </th>
                        <th>
                            <span><?= $langue["nom_modePaiement"] ?></span>
                            <div class="sourisPointer symboleTri">
                                <svg class='<?= ($tri == 'nomModePaiement' && $ordre == "ASC")? "inactif" : "" ?>' xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1000 1000" version="1.1" fill="#333333" width="1vw" height="1vw" data-js-tri="nomModePaiement" data-js-ordre="ASC"><path d="M10 132.5h980l-489.9 735L10 132.5z"/></svg>
                                <svg class='<?= ($tri == 'nomModePaiement' && $ordre == "DESC")? "inactif" : "" ?>' xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1000 1000" version="1.1" fill="#333333" width="1vw" height="1vw" data-js-tri="nomModePaiement" data-js-ordre="DESC"><path d="M10 881.1h980L500 118.9 10 881.1z"/></svg>
                            </div>
                        </th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
    <?php
                foreach ($donnees["commandes"] as $commande) {
    ?>
                    <tr>
                        <td><?= $commande["id"] ?></td>
                        <td><?= $commande["idClient"] . " - " . $commande["nomClient"] ?></td>
                        <td><?= $commande["date"] ?></td>
                        <td><?= $commande["nbVoitures"] ?></td>
                        <td><?= $commande["prixTotal"] ?></td>
                        <td><?= $commande["nomStatus"] ?></td>
                        <td><?= $commande["nomExpedition"] ?></td>
                        <td><?= $commande["nomModePaiement"] ?></td>
                        <td><a href="index.php?GestionDonnees&action=afficherFormulaireCommande&id=<?= $commande["id"] ?>&page=<?= $pageCourante ?>" data-js-modifier data-js-id=<?= $commande["id"] ?>><?= $langue["button_modifier"] ?></a></td>
                    </tr>    
    <?php
                }
    ?>
                </tbody>
            </table>
        </div>
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
<?php        
    } else {
        echo "<h2>".$langue["section_vide"]."</h2>";
    }
?>     
</section>
</div>