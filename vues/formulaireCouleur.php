<section class="pageDonnees">
<?php
    if (isset($donnees["usager"])) $usager = $donnees["usager"];
    $langue = $donnees["langue"];
    if (isset($donnees["couleur"])){
        $couleurFr = $donnees["couleur"][0];
        $couleurEn = $donnees["couleur"][1];

    }
?>

    <div data-js-controleur="GestionDonnees" data-js-controleur-action="afficherFormulaireCouleur">

        <h2><?= (isset($couleurFr)) ? $langue["formulaire_modif_couleur"] : $langue["formulaire_ajout_couleur"] ?></h2>
        <form class="formulaire" action='index.php?GestionDonnees_AJAX&action=sauvegarderCouleur<?= (isset($_GET["page"])) ? "&page=" . $_GET["page"] : "" ?>' method="post">
            <div class="champ">
                <label for="nomFr"><?= $langue["francais"] ?> : </label>
                <input type="text" name="nomFr" id="nomFr" value="<?= (isset($couleurFr)) ? $couleurFr->getNom() : "" ?>" required/>
            </div>

            <div class="champ">
                <label for="nomEn"><?= $langue["anglais"] ?> : </label>
                <input type="text" name="nomEn" id="nomEn" value="<?= (isset($couleurEn)) ? $couleurEn->getNom() : "" ?>" required/>
            </div>

        <?php
            if (isset($couleurFr) && $usager->getIdRole() == 1) {
        ?>
            <div class="champ">
                <label for="disponibilite"><?= $langue["disponibilite"] ?> : </label>
                <input type="checkbox" name="disponibilite" id="disponibilite" <?= (isset($couleurFr) && $couleurFr->getDisponibilite() == 1) ? "checked" : "" ?>/>
            </div>
            <?php
            }else{
                if(isset($couleurFr) && $couleurFr->getDisponibilite() == 1){
                    $resultat = 'on';
                }else{
                    $resultat = '';
                }
        ?>
                <input type="hidden" name="disponibilite" value="<?= $resultat ?>"/><br/>
        <?php
            }
        ?>
            <input type="hidden" name="id" value="<?= (isset($couleurFr)) ? $couleurFr->getId() : 0 ?>"/><br/>
            <input class="bouton" type="submit" value="<?= $langue['button_soumettre'] ?>"/>    
        </form>
    </div>
</section>

</div>