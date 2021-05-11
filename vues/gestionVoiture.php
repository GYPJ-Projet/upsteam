<section class="pageDonnees">
<?php 
    $langue = $donnees["langue"];
    $pageCourante = $donnees["pageCourante"];
    $nbPages = $donnees["nbPages"];
    $tri = $donnees["tri"];
    $ordre = $donnees["ordre"];
?>
        <h1><?= $langue["gestion_voitures"] ?></h1>


    <div data-js-component="GestionVoiture" data-js-controleur-action="gestionVoiture">

        <a class="bouton" href="index.php?GestionDonnees&action=afficherFormulaireVoiture&page=<?= $pageCourante ?>" data-js-ajouter><?= $langue["button_ajouter"] ?></a>    
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
                    <th>Photo</th>
                    <th>
                        <span><?= $langue["nom_marque"] ?></span>
                        <div class="sourisPointer symboleTri">
                            <svg class='<?= ($tri == 'nomMarque' && $ordre == "ASC")? "inactif" : "" ?>' xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1000 1000" version="1.1" fill="#333333" width="1vw" height="1vw" data-js-tri="nomMarque" data-js-ordre="ASC"><path d="M10 132.5h980l-489.9 735L10 132.5z"/></svg>
                            <svg class='<?= ($tri == 'nomMarque' && $ordre == "DESC")? "inactif" : "" ?>'xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1000 1000" version="1.1" fill="#333333" width="1vw" height="1vw" data-js-tri="nomMarque" data-js-ordre="DESC"><path d="M10 881.1h980L500 118.9 10 881.1z"/></svg>
                        </div>
                    </th>
                    <th>
                        <span><?= $langue["nom_modele"] ?></span>
                        <div class="sourisPointer symboleTri">
                            <svg class='<?= ($tri == 'nomModele' && $ordre == "ASC")? "inactif" : "" ?>' xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1000 1000" version="1.1" fill="#333333" width="1vw" height="1vw" data-js-tri="nomModele" data-js-ordre="ASC"><path d="M10 132.5h980l-489.9 735L10 132.5z"/></svg>
                            <svg class='<?= ($tri == 'nomModele' && $ordre == "DESC")? "inactif" : "" ?>'xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1000 1000" version="1.1" fill="#333333" width="1vw" height="1vw" data-js-tri="nomModele" data-js-ordre="DESC"><path d="M10 881.1h980L500 118.9 10 881.1z"/></svg>
                        </div>
                    </th>
                    <th>
                        <span><?= $langue["nom_annee"] ?></span>
                        <div class="sourisPointer symboleTri">
                            <svg class='<?= ($tri == 'annee' && $ordre == "ASC")? "inactif" : "" ?>' xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1000 1000" version="1.1" fill="#333333" width="1vw" height="1vw" data-js-tri="annee" data-js-ordre="ASC"><path d="M10 132.5h980l-489.9 735L10 132.5z"/></svg>
                            <svg class='<?= ($tri == 'annee' && $ordre == "DESC")? "inactif" : "" ?>'xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1000 1000" version="1.1" fill="#333333" width="1vw" height="1vw" data-js-tri="annee" data-js-ordre="DESC"><path d="M10 881.1h980L500 118.9 10 881.1z"/></svg>
                        </div>
                    </th>
                    <th>
                        <span><?= $langue["nom_kilometrage"] ?></span>
                        <div class="sourisPointer symboleTri">
                            <svg class='<?= ($tri == 'kilometrage' && $ordre == "ASC")? "inactif" : "" ?>' xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1000 1000" version="1.1" fill="#333333" width="1vw" height="1vw" data-js-tri="kilometrage" data-js-ordre="ASC"><path d="M10 132.5h980l-489.9 735L10 132.5z"/></svg>
                            <svg class='<?= ($tri == 'kilometrage' && $ordre == "DESC")? "inactif" : "" ?>'xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1000 1000" version="1.1" fill="#333333" width="1vw" height="1vw" data-js-tri="kilometrage" data-js-ordre="DESC"><path d="M10 881.1h980L500 118.9 10 881.1z"/></svg>
                        </div>
                    </th>
                    <th>
                        <span><?= $langue["nom_dateArrivee"] ?></span>
                        <div class="sourisPointer symboleTri">
                            <svg class='<?= ($tri == 'dateArivee' && $ordre == "ASC")? "inactif" : "" ?>' xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1000 1000" version="1.1" fill="#333333" width="1vw" height="1vw" data-js-tri="dateArivee" data-js-ordre="ASC"><path d="M10 132.5h980l-489.9 735L10 132.5z"/></svg>
                            <svg class='<?= ($tri == 'dateArivee' && $ordre == "DESC")? "inactif" : "" ?>'xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1000 1000" version="1.1" fill="#333333" width="1vw" height="1vw" data-js-tri="dateArivee" data-js-ordre="DESC"><path d="M10 881.1h980L500 118.9 10 881.1z"/></svg>
                        </div>
                    </th>
                    <th>
                        <span><?= $langue["nom_prixAchat"] ?></span>
                        <div class="sourisPointer symboleTri">
                            <svg class='<?= ($tri == 'prixAchat' && $ordre == "ASC")? "inactif" : "" ?>' xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1000 1000" version="1.1" fill="#333333" width="1vw" height="1vw" data-js-tri="prixAchat" data-js-ordre="ASC"><path d="M10 132.5h980l-489.9 735L10 132.5z"/></svg>
                            <svg class='<?= ($tri == 'prixAchat' && $ordre == "DESC")? "inactif" : "" ?>'xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1000 1000" version="1.1" fill="#333333" width="1vw" height="1vw" data-js-tri="prixAchat" data-js-ordre="DESC"><path d="M10 881.1h980L500 118.9 10 881.1z"/></svg>
                        </div>
                    </th>
                    <th>
                        <span><?= $langue["nom_prixVente"] ?></span>
                        <div class="sourisPointer symboleTri">
                            <svg class='<?= ($tri == 'prixVente' && $ordre == "ASC")? "inactif" : "" ?>' xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1000 1000" version="1.1" fill="#333333" width="1vw" height="1vw" data-js-tri="prixVente" data-js-ordre="ASC"><path d="M10 132.5h980l-489.9 735L10 132.5z"/></svg>
                            <svg class='<?= ($tri == 'prixVente' && $ordre == "DESC")? "inactif" : "" ?>'xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1000 1000" version="1.1" fill="#333333" width="1vw" height="1vw" data-js-tri="prixVente" data-js-ordre="DESC"><path d="M10 881.1h980L500 118.9 10 881.1z"/></svg>
                        </div>
                    </th>
                    <th>
                        <span><?= $langue["nom_motopropulseur"] ?></span>
                        <div class="sourisPointer symboleTri">
                            <svg class='<?= ($tri == 'nomMotoPropulseur' && $ordre == "ASC")? "inactif" : "" ?>' xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1000 1000" version="1.1" fill="#333333" width="1vw" height="1vw" data-js-tri="nomMotoPropulseur" data-js-ordre="ASC"><path d="M10 132.5h980l-489.9 735L10 132.5z"/></svg>
                            <svg class='<?= ($tri == 'nomMotoPropulseur' && $ordre == "DESC")? "inactif" : "" ?>'xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1000 1000" version="1.1" fill="#333333" width="1vw" height="1vw" data-js-tri="nomMotoPropulseur" data-js-ordre="DESC"><path d="M10 881.1h980L500 118.9 10 881.1z"/></svg>
                        </div>
                    </th>
                    <th>
                        <span><?= $langue["nom_carburant"] ?></span>
                        <div class="sourisPointer symboleTri">
                            <svg class='<?= ($tri == 'nomTypeCarburant' && $ordre == "ASC")? "inactif" : "" ?>' xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1000 1000" version="1.1" fill="#333333" width="1vw" height="1vw" data-js-tri="nomTypeCarburant" data-js-ordre="ASC"><path d="M10 132.5h980l-489.9 735L10 132.5z"/></svg>
                            <svg class='<?= ($tri == 'nomTypeCarburant' && $ordre == "DESC")? "inactif" : "" ?>'xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1000 1000" version="1.1" fill="#333333" width="1vw" height="1vw" data-js-tri="nomTypeCarburant" data-js-ordre="DESC"><path d="M10 881.1h980L500 118.9 10 881.1z"/></svg>
                        </div>
                    </th>
                    <th>
                        <span><?= $langue["nom_couleur"] ?></span>
                        <div class="sourisPointer symboleTri">
                            <svg class='<?= ($tri == 'nomCouleur' && $ordre == "ASC")? "inactif" : "" ?>' xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1000 1000" version="1.1" fill="#333333" width="1vw" height="1vw" data-js-tri="nomCouleur" data-js-ordre="ASC"><path d="M10 132.5h980l-489.9 735L10 132.5z"/></svg>
                            <svg class='<?= ($tri == 'nomCouleur' && $ordre == "DESC")? "inactif" : "" ?>'xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1000 1000" version="1.1" fill="#333333" width="1vw" height="1vw" data-js-tri="nomCouleur" data-js-ordre="DESC"><path d="M10 881.1h980L500 118.9 10 881.1z"/></svg>
                        </div>
                    </th>
                    <th>
                        <span><?= $langue["nom_transmission"] ?></span>
                        <div class="sourisPointer symboleTri">
                            <svg class='<?= ($tri == 'nomTransmission' && $ordre == "ASC")? "inactif" : "" ?>' xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1000 1000" version="1.1" fill="#333333" width="1vw" height="1vw" data-js-tri="nomTransmission" data-js-ordre="ASC"><path d="M10 132.5h980l-489.9 735L10 132.5z"/></svg>
                            <svg class='<?= ($tri == 'nomTransmission' && $ordre == "DESC")? "inactif" : "" ?>'xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1000 1000" version="1.1" fill="#333333" width="1vw" height="1vw" data-js-tri="nomTransmission" data-js-ordre="DESC"><path d="M10 881.1h980L500 118.9 10 881.1z"/></svg>
                        </div>
                    </th>
                    <th>
                        <span><?= $langue["nom_carrosserie"] ?></span>
                        <div class="sourisPointer symboleTri">
                            <svg class='<?= ($tri == 'nomTypeCarrosserie' && $ordre == "ASC")? "inactif" : "" ?>' xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1000 1000" version="1.1" fill="#333333" width="1vw" height="1vw" data-js-tri="nomTypeCarrosserie" data-js-ordre="ASC"><path d="M10 132.5h980l-489.9 735L10 132.5z"/></svg>
                            <svg class='<?= ($tri == 'nomTypeCarrosserie' && $ordre == "DESC")? "inactif" : "" ?>'xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1000 1000" version="1.1" fill="#333333" width="1vw" height="1vw" data-js-tri="nomTypeCarrosserie" data-js-ordre="DESC"><path d="M10 881.1h980L500 118.9 10 881.1z"/></svg>
                        </div>
                    </th>
                    <th>
                        <span><?= $langue["nom_vna"] ?></span>
                        <div class="sourisPointer symboleTri">
                            <svg class='<?= ($tri == 'vna' && $ordre == "ASC")? "inactif" : "" ?>' xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1000 1000" version="1.1" fill="#333333" width="1vw" height="1vw" data-js-tri="vna" data-js-ordre="ASC"><path d="M10 132.5h980l-489.9 735L10 132.5z"/></svg>
                            <svg class='<?= ($tri == 'vna' && $ordre == "DESC")? "inactif" : "" ?>'xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1000 1000" version="1.1" fill="#333333" width="1vw" height="1vw" data-js-tri="vna" data-js-ordre="DESC"><path d="M10 881.1h980L500 118.9 10 881.1z"/></svg>
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

            foreach ($donnees["voitures"] as $voiture) {
        ?>
                <tr>
                    <td><?= $voiture["id"] ?></td>
                    <td><a href="?Voiture&action=descriptionVoiture&id=<?= $voiture["id"] ?>">
<?php 
                    if (isset($voiture["lienPhotoPrincipale"])) {
?>
                        <img class="photoPetit" src="<?= REPERTOIRE_IMAGES . $voiture["id"]. '/'. $voiture["lienPhotoPrincipale"] ?>" alt="Photo">
<?php
                    } else {
?>
                        <p><?= $langue["sansPhoto"] ?></p>
<?php
                    }
?>
                    </a></td>
                    <td><?= $voiture["nomMarque"] ?></td>
                    <td><?= $voiture["nomModele"] ?></td>
                    <td><?= $voiture["annee"] ?></td>
                    <td><?= $voiture["kilometrage"] ?></td>
                    <td><?= $voiture["dateArivee"] ?></td>
                    <td><?= $voiture["prixAchat"] ?></td>
                    <td><?= $voiture["prixVente"] ?></td>
                    <td><?= $voiture["nomMotoPropulseur"] ?></td>
                    <td><?= $voiture["nomTypeCarburant"] ?></td>
                    <td><?= $voiture["nomCouleur"] ?></td>
                    <td><?= $voiture["nomTransmission"] ?></td>
                    <td><?= $voiture["nomTypeCarrosserie"] ?></td>
                    <td><?= $voiture["vna"] ?></td>
                    <td><?= ($voiture["disponibilite"] == true)? $langue["texte_oui"] : "" ?></td>
                    <td><a href="index.php?GestionDonnees&action=afficherFormulaireVoiture&id=<?= $voiture["id"] ?>&page=<?= $pageCourante ?>" data-js-modifier data-js-id=<?= $voiture["id"] ?>><?= $langue["button_modifier"] ?></a></td>
                </tr>                 
        <?php
            }
        ?>
            </tbody>
        </table>
        </div>
        <div class="pagination" data-js-pagination>
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
    </div>
</section>

</div>