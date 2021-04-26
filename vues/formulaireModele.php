<?php
    $langue = $donnees["langue"];
    if ($donnees["modele"]) $modele = $donnees["modele"];
?>

<h2><?= (isset($modele)) ? $langue["formulaire_modif"] : $langue["formulaire_ajout"] ?></h2>
<form class="formulaire" action="index.php?GestionDonnees&action=sauvegarderModele" method="post">
    <label for="nom"><?= $langue["nom_modele"] ?> : </label>
    <input type="text" name="nom" id="nom" value="<?= (isset($modele)) ? $modele->getNom() : "" ?>"/><br/>
<?php
    if (isset($modele)) {
?>
        <label for="disponibilite"><?= $langue["disponibilite"] ?> : </label>
        <input type="checkbox" name="disponibilite" id="disponibilite" <?= (isset($marque) && $marque->getDisponibilite() == 1) ? "checked" : "" ?>/><br>
<?php
    }
?>
    
    <input type="hidden" name="id" value="<?= (isset($modele)) ? $modele->getId() : 0 ?>"/><br/>
    <input class="bouton" type="submit" value="<?= $langue['button_soumettre'] ?>"/>
</form>
