<?php
    var_dump($donnees["annees"]);
    $langue = $donnees["langue"];
    if ($donnees["voiture"]) $voiture = $donnees["voiture"];
?>

<h2><?= (isset($voiture)) ? $langue["formulaire_modif_voiture"] : $langue["formulaire_ajout_voiture"] ?></h2>
<form class="formulaire" action="index.php?GestionDonnees_AJAX&action=sauvegarderModele" method="post">
    <label for="marque"><?= $langue["nom_marque"] ?> : </label>
    <select name="idMarque" id="idMarque" required>
        <option value=""><?= $langue["option"] ?></option>
<?php
        foreach ($donnees["marques"] as $marque) {
?>         
            <option value="<?= $marque->getId() ?>" <?= (isset($voiture) && $voiture["idMarque"] == $marque->getId()) ? "selected" : "" ?>>
                <?= $marque->getNom() ?>
            </option>      
<?php
        }
?> 
    </select><br>
    <label for="modele"><?= $langue["nom_modele"] ?> : </label>
    <select name="idModele" id="idModele" required>
        <option value=""><?= $langue["option"] ?></option>
<?php
        foreach ($donnees["modeles"] as $modele) {
?>         
            <option value="<?= $modele->getId() ?>" <?= (isset($voiture) && $voiture["idModele"] == $modele->getId()) ? "selected" : "" ?>>
                <?= $modele->getNom() ?>
            </option>      
<?php
        }
?>              
    </select><br>
    <label for="annee"><?= $langue["nom_annee"] ?> : </label>
    <select name="idAnnee" id="idAnnee" required>
        <option value=""><?= $langue["option"] ?></option>
<?php
        foreach ($donnees["annees"] as $annee) {
?>         
            <option value="<?= $annee->getId() ?>" <?= (isset($voiture) && $voiture["idAnnee"] == $annee->getId()) ? "selected" : "" ?>>
                <?= $annee->getAnnee() ?>
            </option>      
<?php
        }
?> 
    </select><br>
    <label for="kilometrage"><?= $langue["nom_kilometrage"] ?> : </label>
    <input type="number" name="kilometrage" id="kilometrage" value="<?= (isset($voiture)) ? $voiture["kilometrage"] : "" ?>"/><br>
<?php
    if (isset($voiture)) {
?>
        <label for="disponibilite"><?= $langue["disponibilite"] ?> : </label>
        <input type="checkbox" name="disponibilite" id="disponibilite" <?= (isset($voiture) && $voiture["disponibilite"] == 1) ? "checked" : "" ?>/><br>
<?php
    }
?>
    
    <input type="hidden" name="id" value="<?= (isset($modele)) ? $modele->getId() : 0 ?>"/><br/>
    <input class="bouton" type="submit" value="<?= $langue['button_soumettre'] ?>"/>
</form>
