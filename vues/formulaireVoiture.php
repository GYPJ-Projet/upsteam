<section class="pageDonnees">
<?php
    $langueInfo = $donnees["langue"];
    if (isset($donnees["usager"])) $usager = $donnees["usager"];
    if (isset($donnees["voiture"])) $voiture = $donnees["voiture"];
    if (isset($donnees["images"])) $images = $donnees["images"];
    if (isset($donnees["descriptions"])) $descriptions = $donnees["descriptions"];
    if (isset($donnees["langues"])) $langues = $donnees["langues"];
?>
    <div data-js-component="FormulaireVoiture" data-js-controleur-action="afficherFormulaireVoiture">
        <h2><?= (isset($voiture)) ? $langueInfo["formulaire_modif_voiture"] : $langueInfo["formulaire_ajout_voiture"] ?></h2>
        <form class="formulaire" enctype="multipart/form-data" action="index.php?GestionDonnees_AJAX&action=sauvegarderVoiture" method="post" data-js-form>
            <label for="marque"><?= $langueInfo["nom_marque"] ?> : </label>
            <select name="idMarque" id="idMarque" data-js-marque required>
                <option value=""><?= $langueInfo["option"] ?></option>
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
            <label for="modele"><?= $langueInfo["nom_modele"] ?> : </label>
            <select name="idModele" id="idModele" data-js-modele required>
                <option value=""><?= $langueInfo["option"] ?></option>
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
            <label for="annee"><?= $langueInfo["nom_annee"] ?> : </label>
            <select name="idAnnee" id="idAnnee" required>
                <option value=""><?= $langueInfo["option"] ?></option>
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
            <label for="kilometrage"><?= $langueInfo["nom_kilometrage"] ?> : </label>
            <input type="number" name="kilometrage" min="0" id="kilometrage" value="<?= (isset($voiture)) ? $voiture["kilometrage"] : "" ?>" required/><br>
            <label for="dateArrivee"><?= $langueInfo["nom_dateArrivee"] ?> : </label>
            <input type="date" name="dateArrivee" id="dateArrivee" value="<?= (isset($voiture)) ? $voiture["dateArivee"] : "" ?>" required/><br>
            <label for="prixAchat"><?= $langueInfo["nom_prixAchat"] ?> : </label>
            <input type="number" placeholder="0.00" min="0" step="0.01" name="prixAchat" id="prixAchat" value="<?= (isset($voiture)) ? $voiture["prixAchat"] : "" ?>" required/><br>
            <label for="prixVente"><?= $langueInfo["nom_prixVente"] ?> : </label>
            <input type="number" placeholder="0.00" min="0" step="0.01" name="prixVente" id="prixVente" value="<?= (isset($voiture)) ? $voiture["prixVente"] : "" ?>" required/><br>
            <label for="motopropulseur"><?= $langueInfo["nom_motopropulseur"] ?> : </label>
            <select name="idMotopropulseur" id="idMotopropulseur" required>
                <option value=""><?= $langueInfo["option"] ?></option>
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
            <label for="idTypeCarburant"><?= $langueInfo["nom_carburant"] ?> : </label>
            <select name="idTypeCarburant" id="idTypeCarburant" required>
                <option value=""><?= $langueInfo["option"] ?></option>
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
            <label for="idCouleur"><?= $langueInfo["nom_couleur"] ?> : </label>
            <select name="idCouleur" id="idCouleur" required>
                <option value=""><?= $langueInfo["option"] ?></option>
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
            <label for="idTransmission"><?= $langueInfo["nom_transmission"] ?> : </label>
            <select name="idTransmission" id="idTransmission" required>
                <option value=""><?= $langueInfo["option"] ?></option>
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
            <label for="idTypeCarrosserie"><?= $langueInfo["nom_carrosserie"] ?> : </label>
            <select name="idTypeCarrosserie" id="idTypeCarrosserie" required>
                <option value=""><?= $langueInfo["option"] ?></option>
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
            <label for="vna"><?= $langueInfo["nom_vna"] ?> : </label>
            <input type="text" name="vna" id="vna" value="<?= (isset($voiture)) ? $voiture["vna"] : "" ?>" required/><br>
            <p><?= $langueInfo["nom_description"] ?></p>
            <div class="description" >
        <?php
                if (isset($descriptions)) {
                    foreach ($descriptions as $description) {
        ?>
                        <div>
                            <label for="<?=$description["code"]?>"><?= $description["nomLangue"] ?> : </label>
                            <textarea name="<?=$description["code"]?>" id="<?=$description["code"]?>" data-js-description required><?= $description["nom"] ?></textarea><br>
                        </div>          
        <?php            
                    }
                } else {
                    foreach ($langues as $langue) {
        ?>
                        <div>
                            <label for="<?= $langue["code"] ?>"><?= $langue["nom"] ?></label>
                            <textarea  name="<?= $langue["code"] ?>" id="<?= $langue["code"] ?>" data-js-description required></textarea><br>
                        </div>          
        <?php            
                    }
                }
        ?>           
            </div>
<?php
            if (isset($images)) {
?>
            <div class="form-images">
<?php                
                foreach ($images as $image) {
?>
                    <div class="form-image">
                        <div class="croix" data-js-imageId="<?= $image["id"] ?>" data-js-imageNom="<?= $image["lien"] ?>">x</div>
                        <img src="<?= REPERTOIRE_IMAGES.$voiture["id"].'/'.$image["lien"] ?>" alt="Image">
                    </div>
<?php
                }
?>   
            </div>
<?php
            }
?>
            <div>
                <label for="images"><?= $langueInfo["nom_joindre"] ?> : </label>
                <input type="file" name="images[]" multiple accept=".jpg, .jpeg, .png" data-js-images <?= (isset($voiture)) ? "" : "required" ?>/>
            </div>
        <?php
            
            if (isset($voiture) && $usager->getIdRole() == 1) {
        ?>
                <label for="disponibilite"><?= $langueInfo["disponibilite"] ?> : </label>
                <input type="checkbox" name="disponibilite" id="disponibilite" <?= (isset($voiture) && $voiture["disponibilite"] == 1) ? "checked" : "" ?>/><br>
        <?php
            }else{
                if(isset($voiture) && $voiture["disponibilite"] == 1){
                    $resultat = 'on';
                }else{
                    $resultat = '';
                }
        ?>
                <input type="hidden" name="disponibilite" value="<?= $resultat ?>"/><br/>
        <?php
            }
        ?>
            <input type="hidden" name="id" value="<?= (isset($voiture)) ? $voiture["id"] : 0 ?>" data-js-idVoiture="<?= (isset($voiture)) ? $voiture["id"] : 0 ?>"/><br/>
            <input type="hidden" name="page" value="<?= (isset($donnees["page"])) ? $donnees["page"] : 1 ?>"/><br/>
            <input class="bouton" type="submit" value="<?= $langueInfo['button_soumettre'] ?>" data-js-soumettre/>
        </form>
    </div>
</section>
</div>
