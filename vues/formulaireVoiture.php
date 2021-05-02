<?php
    var_dump($donnees["annees"]);
    $langue = $donnees["langue"];
    if ($donnees["voiture"]) $voiture = $donnees["voiture"];
?>

<h2><?= (isset($voiture)) ? $langue["formulaire_modif_voiture"] : $langue["formulaire_ajout_voiture"] ?></h2>
<form class="formulaire" action="index.php?GestionDonnees_AJAX&action=sauvegarderVoiture" method="post">
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
    <input type="number" name="kilometrage" min="0" id="kilometrage" value="<?= (isset($voiture)) ? $voiture["kilometrage"] : "" ?>" required/><br>
    <label for="dateArrivee"><?= $langue["nom_dateArrivee"] ?> : </label>
    <input type="date" name="dateArrivee" id="dateArrivee" value="<?= (isset($voiture)) ? $voiture["dateArivee"] : "" ?>" required/><br>
    <label for="prixAchat"><?= $langue["nom_prixAchat"] ?> : </label>
    <input type="number" placeholder="0.00" min="0" step="0.01" name="prixAchat" id="prixAchat" value="<?= (isset($voiture)) ? $voiture["prixAchat"] : "" ?>" required/><br>
    <label for="prixVente"><?= $langue["nom_prixVente"] ?> : </label>
    <input type="number" placeholder="0.00" min="0" step="0.01" name="prixVente" id="prixVente" value="<?= (isset($voiture)) ? $voiture["prixVente"] : "" ?>" required/><br>
    <label for="motopropulseur"><?= $langue["nom_motopropulseur"] ?> : </label>
    <select name="idMotopropulseur" id="idMotopropulseur" required>
        <option value=""><?= $langue["option"] ?></option>
<?php
        foreach ($donnees["motopropulseurs"] as $motopropulseur) {
?>         
            <option value="<?= $motopropulseur->getId() ?>" <?= (isset($voiture) && $voiture["idMotopropulseur"] == $motopropulseur->getId()) ? "selected" : "" ?>>
                <?= $motopropulseur->getNom() ?>
            </option>      
<?php
        }
?> 
    </select><br>
    <label for="idTypeCarburant"><?= $langue["nom_carburant"] ?> : </label>
    <select name="idTypeCarburant" id="idTypeCarburant" required>
        <option value=""><?= $langue["option"] ?></option>
<?php
        for ($i = 1, $l = count($donnees["typesCarburant"]); $i <= $l; $i++) {
            $typeCarburant = $donnees["typesCarburant"][$i];
            if (isset($typeCarburant)) {
?>         
                <option value="<?= $i ?>" <?= (isset($voiture) && $voiture["idTypeCarburant"] == $i) ? "selected" : "" ?>>
                    <?= $typeCarburant ?>
                </option>      
<?php       }
        }
?> 
    </select><br>
    <label for="idCouleur"><?= $langue["nom_couleur"] ?> : </label>
    <select name="idCouleur" id="idCouleur" required>
        <option value=""><?= $langue["option"] ?></option>
<?php
        for ($i = 1, $l = count($donnees["couleurs"]); $i <= $l; $i++) {
            $couleur = $donnees["couleurs"][$i];
            if (isset($typeCarburant)) {
?>         
                <option value="<?= $i ?>" <?= (isset($voiture) && $voiture["idCouleur"] == $i) ? "selected" : "" ?>>
                    <?= $couleur ?>
                </option>      
<?php       }
        }
?> 
    </select><br>
    <label for="idTransmission"><?= $langue["nom_transmission"] ?> : </label>
    <select name="idTransmission" id="idTransmission" required>
        <option value=""><?= $langue["option"] ?></option>
<?php
        for ($i = 1, $l = count($donnees["transmissions"]); $i <= $l; $i++) {
            $transmission = $donnees["transmissions"][$i];
            if (isset($transmission)) {
?>         
                <option value="<?= $i ?>" <?= (isset($voiture) && $voiture["idTransmission"] == $i) ? "selected" : "" ?>>
                    <?= $transmission ?>
                </option>      
<?php       }
        }
?> 
    </select><br>
    <label for="idTypeCarrosserie"><?= $langue["nom_carrosserie"] ?> : </label>
    <select name="idTypeCarrosserie" id="idTypeCarrosserie" required>
        <option value=""><?= $langue["option"] ?></option>
<?php
        for ($i = 1, $l = count($donnees["typesCarrosserie"]); $i <= $l; $i++) {
            $carrosserie = $donnees["typesCarrosserie"][$i];
            if (isset($transmission)) {
?>         
                <option value="<?= $i ?>" <?= (isset($voiture) && $voiture["idTypeCarrosserie"] == $i) ? "selected" : "" ?>>
                    <?= $carrosserie ?>
                </option>      
<?php       }
        }
?> 
    </select><br>
    <label for="vna"><?= $langue["nom_vna"] ?> : </label>
    <input type="text" name="vna" id="vna" value="<?= (isset($voiture)) ? $voiture["vna"] : "" ?>" required/><br>
    
<?php
    /*<label for="description"><?= $langue["nom_description"] ?> : </label>
    <input type="text" name="description" id="description" value="<?= (isset($voiture)) ? $voiture["description"] : "" ?>" required/><br>*/
    if (isset($voiture)) {
?>
        <label for="disponibilite"><?= $langue["disponibilite"] ?> : </label>
        <input type="checkbox" name="disponibilite" id="disponibilite" <?= (isset($voiture) && $voiture["disponibilite"] == 1) ? "checked" : "" ?>/><br>
<?php
    }
?>
    
    <input type="hidden" name="id" value="<?= (isset($voiture)) ? $voiture["id"] : 0 ?>"/><br/>
    <input type="hidden" name="page" value="<?= (isset($donnees["page"])) ? $donnees["page"] : 1 ?>"/><br/>
    <input class="bouton" type="submit" value="<?= $langue['button_soumettre'] ?>"/>
</form>
