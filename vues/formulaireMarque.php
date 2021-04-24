<h2><?= $donnees["titreFormulaire"] ?></h2>
<form action="index.php?GestionDonnees&action=sauvegarderMarque" method="post">
    <label for="nom">Marque : </label>
    <input type="text" name="nom" id="nom" value="<?= $donnees["marque"]["nom"] ?>"/><br/>
    <label for="disponibilite">Disponibilité : </label>
    <input type="checkbox" name="disponibilite" id="disponibilite" <?= ($donnees["marque"]["disponibilite"] == 1) ? "checked" : "" ?>/><br>
    <input type="hidden" name="id" value="<?= $donnees["marque"]["id"] ?>"/><br/>
    <input type="submit" value="Soumettre"/>
</form>
