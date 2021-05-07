<section class="pageDonnees">
<?php
    if (isset($donnees["usager"])) $usager = $donnees["usager"];
    $langue = $donnees["langue"];
    if (isset($donnees["marque"])) $marque = $donnees["marque"];
?>

<h2><?= (isset($marque)) ? $langue["formulaire_modif_marque"] : $langue["formulaire_ajout_marque"] ?></h2>
<form class="formulaire" action='index.php?GestionDonnees_AJAX&action=sauvegarderMarque<?= (isset($_GET["page"])) ? "&page=" . $_GET["page"] : "" ?>' method="post">
    <div class="champ">
        <label for="nom"><?= $langue["nom_marque"] ?> : </label>
        <input type="text" name="nom" id="nom" value="<?= (isset($marque)) ? $marque->getNom() : "" ?>" required/>
    </div>
<?php
    if (isset($marque) && $usager->getIdRole() == 1) {
?>
    <div class="champ">
        <label for="disponibilite"><?= $langue["disponibilite"] ?> : </label>
        <input type="checkbox" name="disponibilite" id="disponibilite" <?= (isset($marque) && $marque->getDisponibilite() == 1) ? "checked" : "" ?>/>
    </div>
<?php
    }
?>
    <input type="hidden" name="id" value="<?= (isset($marque)) ? $marque->getId() : 0 ?>"/><br/>
    <input class="bouton" type="submit" value="<?= $langue['button_soumettre'] ?>"/>    
</form>
</section>

</div>