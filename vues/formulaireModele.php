<?php
    $langue = $donnees["langue"];
    if ($donnees["modele"]) $modele = $donnees["modele"];
?>

<h2><?= (isset($modele)) ? $langue["formulaire_modif_modele"] : $langue["formulaire_ajout_modele"] ?></h2>
<form class="formulaire" action="index.php?GestionDonnees_AJAX&action=sauvegarderModele" method="post">
    <label for="nom"><?= $langue["nom_modele"] ?> : </label>
    <input type="text" name="nom" id="nom" value="<?= (isset($modele)) ? $modele->getNom() : "" ?>"/><br/>
    <label for="marque"><?= $langue["nom_marque"] ?> : </label>
    <select name="idMarque" id="idMarque">
        <option value=""><?= $langue["option"] ?></option>
<?php
        foreach ($donnees["marques"] as $marque) {
?>         
            <option value="<?= $marque->getId() ?>" <?= (isset($modele) && $marque->getId() == $modele->getIdMarque()) ? "selected" : "" ?>>
                <?= $marque->getNom() ?>
            </option>      
<?php
        }
?>        
    </select>
<?php
    if (isset($modele)) {
?>
        <label for="disponibilite"><?= $langue["disponibilite"] ?> : </label>
        <input type="checkbox" name="disponibilite" id="disponibilite" <?= (isset($modele) && $modele->getDisponibilite() == 1) ? "checked" : "" ?>/><br>
<?php
    }
?>
    
    <input type="hidden" name="id" value="<?= (isset($modele)) ? $modele->getId() : 0 ?>"/><br/>
    <input class="bouton" type="submit" value="<?= $langue['button_soumettre'] ?>"/>
</form>
