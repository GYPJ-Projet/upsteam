<section class="pageDonnees">
<?php
    if (isset($donnees["usager"])) $usager = $donnees["usager"];
    $langue = $donnees["langue"];
    if (isset($donnees["modele"])) $modele = $donnees["modele"];
?>
    <div data-js-controleur="GestionDonnees" data-js-controleur-action="afficherFormulaireModele">

        <h2><?= (isset($modele)) ? $langue["formulaire_modif_modele"] : $langue["formulaire_ajout_modele"] ?></h2>
        <form class="formulaire" action="index.php?GestionDonnees_AJAX&action=sauvegarderModele<?= (isset($_GET["page"])) ? "&page=" . $_GET["page"] : "" ?>" method="post">
            <label for="nom"><?= $langue["nom_modele"] ?> : </label>
            <input type="text" name="nom" id="nom" value="<?= (isset($modele)) ? $modele->getNom() : "" ?>" required/><br/>
            <label for="marque"><?= $langue["nom_marque"] ?> : </label>
            <select name="idMarque" id="idMarque" required>
                <option value=""><?= $langue["option"] ?></option>
        <?php
                foreach ($donnees["marques"] as $marque) {
        ?>         
                    <option value="<?= $marque->getId() ?>" <?= (isset($modele) && $modele->getIdMarque() == $marque->getId()) ? "selected" : "" ?>>
                        <?= $marque->getNom() ?>
                    </option>      
        <?php
                }
        ?>        
            </select><br>
        <?php
            if (isset($modele) && $usager->getIdRole() == 1) {
        ?>
                <label for="disponibilite"><?= $langue["disponibilite"] ?> : </label>
                <input type="checkbox" name="disponibilite" id="disponibilite" <?= (isset($modele) && $modele->getDisponibilite() == 1) ? "checked" : "" ?>/><br>
        <?php
            }else{
                if(isset($modele) && $modele->getDisponibilite() == 1){
                    $resultat = 'on';
                }else{
                    $resultat = '';
                }
        ?>
                <input type="hidden" name="disponibilite" value="<?= $resultat ?>"/><br/>
        <?php
            }
        ?>
            
            <input type="hidden" name="id" value="<?= (isset($modele)) ? $modele->getId() : 0 ?>"/><br/>
            <input class="bouton" type="submit" value="<?= $langue['button_soumettre'] ?>"/>
        </form>
    </div>
</section>

</div>