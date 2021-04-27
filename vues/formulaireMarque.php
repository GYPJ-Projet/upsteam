<?php
    $langue = $donnees["langue"];
    if ($donnees["marque"]) $marque = $donnees["marque"];
?>

<h2><?= (isset($marque)) ? $langue["formulaire_modif_marque"] : $langue["formulaire_ajout_marque"] ?></h2>
<form class="formulaire" action="index.php?GestionDonnees_AJAX&action=sauvegarderMarque" method="post">
    <label for="nom"><?= $langue["nom_marque"] ?> : </label>
    <input type="text" name="nom" id="nom" value="<?= (isset($marque)) ? $marque->getNom() : "" ?>"/><br/>
<?php
    if (isset($marque)) {
?>
        <label for="disponibilite"><?= $langue["disponibilite"] ?> : </label>
        <input type="checkbox" name="disponibilite" id="disponibilite" <?= (isset($marque) && $marque->getDisponibilite() == 1) ? "checked" : "" ?>/><br>
<?php
    }
?>
    
    <input type="hidden" name="id" value="<?= (isset($marque)) ? $marque->getId() : 0 ?>"/><br/>
    <input class="bouton" type="submit" value="<?= $langue['button_soumettre'] ?>"/>
</form>
