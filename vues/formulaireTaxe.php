<section class="pageDonnees">
<?php
    if (isset($donnees["usager"])) $usager = $donnees["usager"];
    $langue = $donnees["langue"];
    if (isset($donnees["taxe"])) $taxe = $donnees["taxe"];
    if (isset($donnees["taxe"])) Debug::toLog('taxe',$taxe);
    // if (isset($donnees["taxe"])) Debug::toLog('taxe getNom',$taxe->getNomTaxe());
    
?>
    <div data-js-controleur="GestionDonnees" data-js-controleur-action="afficherFormulaireTaxe">
        <h2><?= (isset($taxe)) ? $langue["formulaire_modif_taxe"] : $langue["formulaire_ajout_taxe"] ?></h2>
        <form class="formulaire" action='index.php?GestionDonnees_AJAX&action=sauvegarderTaxe<?= (isset($_GET["page"])) ? "&page=" . $_GET["page"] : "" ?>' method="post">
            <div class="champ">
                <label for="nom"><?= $langue["nom_taxe"] ?> : </label>
                <input type="text" name="nom" id="nom" value="<?= (isset($taxe)) ? $taxe->getNomTaxe() : "" ?>" required/>
            </div>
            <div class="champ">
                <label for="taux"><?= $langue["nom_taxe"] ?> : </label>
                <input type="text" name="taux" id="taux" value="<?= (isset($taxe)) ? $taxe->getTaux() : "" ?>" required/>
            </div>
            <div class="champ">
                <label for="nom"><?= $langue["nom_taxe"] ?> : </label>
                <input type="text" name="nom" id="nom" value="<?= (isset($taxe)) ? $taxe->getNomTaxe() : "" ?>" required/>
            </div>
            <div class="champ">
                <label for="nom"><?= $langue["nom_taxe"] ?> : </label>
                <input type="text" name="nom" id="nom" value="<?= (isset($taxe)) ? $taxe->getNomTaxe() : "" ?>" required/>
            </div>
        <?php
            if (isset($taxe) && $usager->getIdRole() == 1) {
        ?>
            <div class="champ">
                <label for="disponibilite"><?= $langue["disponibilite"] ?> : </label>
                <input type="checkbox" name="disponibilite" id="disponibilite" <?= (isset($taxe) && $taxe->getDisponibilite() == 1) ? "checked" : "" ?>/>
            </div>
        <?php
            }
        ?>
            <input type="hidden" name="id" value="<?= (isset($taxe)) ? $taxe->getIdTaxe() : 0 ?>"/><br/>
            <input class="bouton" type="submit" value="<?= $langue['button_soumettre'] ?>"/>    
        </form>
    </div>
</section>

</div>