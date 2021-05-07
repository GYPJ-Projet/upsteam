<?php
    $langue = $donnees["langue"];
    $retour = '';                   //Pour savoir vers quelle page retourner.
    $modif = '';                    //Pour savoir si création ou modification.
    if (isset($donnees["usager"])) $usager = $donnees["usager"];
    if (isset($donnees['retour'])) $retour = "&retour=" . $donnees['retour'];
    if (isset($donnees['modif'])) $modif = "&modif";


?>
<div class="bodyConteneur">
    <section class="tampon"></section>
    <section class="pageDonnees">
        <div data-js-component="formulaireConnexion" data-js-controleur="Usager" data-js-controleur-action="sauvegarderUsager" data-js-retour="<?= (isset($donnees['retour'])) ? $donnees['retour'] : '' ?>">
            <h2><?= (isset($usager)) ? $langue["formulaire_modif_usager"] : $langue["formulaire_ajout_usager"] ?></h2>
            <form class="formulaire" action="index.php?Usager&action=sauvegarderUsager<?= $retour . $modif?>" method="post">
                <label for="nom"><?= $langue["nom_usager"] ?> : </label>
                <input type="text" name="nom" min="0" id="nom" value="<?= (isset($usager)) ? $usager->getNom() : "" ?>" required/><br>
                
                <label for="prenom"><?= $langue["prenom_usager"] ?> : </label>
                <input type="text" name="prenom" min="0" id="prenom" value="<?= (isset($usager)) ? $usager->getPrenom() : "" ?>" required/><br>
                
                <label for="courriel"><?= $langue["courriel"] ?> : </label>
                <input type="email" name="courriel" min="0" id="courriel" value="<?= (isset($usager)) ? $usager->getCourriel() : "" ?>" required/><br>
                
                <label for="dateNaissance"><?= $langue["dateNaissance"] ?> : </label>
                <input type="date" name="dateNaissance" min="0" id="dateNaissance" value="<?= (isset($usager)) ? $usager->getDateNaissance() : "" ?>" required/><br>
                
                <label for="adresse"><?= $langue["adresse"] ?> : </label>
                <input type="text" name="adresse" min="0" id="adresse" value="<?= (isset($usager)) ? $usager->getAdresse() : "" ?>" required/><br>
                
                <label for="codePostal"><?= $langue["codePostal"] ?> : </label>
                <input type="text" name="codePostal" min="0" id="codePostal" value="<?= (isset($usager)) ? $usager->getCodePostal() : "" ?>" required/><br>
                
                <label for="province"><?= $langue["province"] ?> : </label>
                <select name="province" id="province" required>
                    <option value=""><?= $langue["option"] ?></option>
    <?php
                    // Debug::toLog($usager->getIdProvince());
                    for ($i = 1; $i <= count($donnees["province"]); $i++) {
    ?>         
                    <option value="<?= $i ?>" <?= (isset($usager) && $usager->getIdProvince() == $i) ? "selected" : "" ?>>
                        <?= $donnees["province"][$i] ?>
                    </option>      
    <?php
                    }
    ?>  
                </select><br>

                <label for="ville"><?= $langue["ville"] ?> : </label>
                <input type="text" name="ville" min="0" id="ville" value="<?= (isset($usager)) ? $usager->getVille() : "" ?>" required/><br>

                <label for="telephone"><?= $langue["telephone"] ?> : </label>
                <input type="text" name="telephone" min="0" id="telephone" value="<?= (isset($usager)) ? $usager->getTelephone() : "" ?>" required/><br>
                
                <label for="cellulaire"><?= $langue["cellulaire"] ?> : </label>
                <input type="text" name="cellulaire" min="0" id="cellulaire" value="<?= (isset($usager)) ? $usager->getTelephoneCellulaire() : "" ?>" required/><br>

                <label for="langue"><?= $langue["langue"] ?> : </label>
                <select name="langue" id="langue" required>
                    <option value=""><?= $langue["option"] ?></option>
    <?php
                    for ($i = 0; $i < count($donnees["choixLangue"]); $i++) {
    ?>         
                    <option value="<?= $i + 1 ?>" <?= (isset($usager) && $usager->getIdLangue() - 1 == $i) ? "selected" : "" ?>>
                        <?= $donnees["choixLangue"][$i]['nom'] ?>
                    </option>      
    <?php
                    }
    ?>  
                </select><br>

    <?php
                if(isset($_SESSION['usager']) && $_SESSION['usager']->getIdRole() == 1) {
    ?> 
                <label for="role"><?= $langue["role"] ?> : </label>
                <select name="role" id="role" required>
                    <option value=""><?= $langue["option"] ?></option>
    <?php
                    for ($i = 0; $i < count($donnees["role"]); $i++) {
    ?>         
                    <option value="<?= $i ?>" <?= (isset($usager) && $usager->getIdRole() == $i + 1) ? "selected" : "" ?>>
                        <?= $donnees["role"][$i]['nom'] ?>
                    </option>
    <?php
                    }   //Fin du for
    ?>  
                </select><br>

    <?php
                }//Fin du if
    ?>

                <label for="motPasse"><?= $langue["motPasse"] ?> : </label>
                <input type="password" name="motPasse" min="0" id="motPasse" value="" <?= (!isset($modif))? 'required' : '' ?>/><br>
                
                <label for="confMotPasse"><?= $langue["confMotPasse"] ?> : </label>
                <input type="password" name="confMotPasse" min="0" id="confMotPasse" value="" <?= (!isset($modif))? 'required' : '' ?>/><br>


    <?php
            // Debug::toLog($donnees["erreurs"]);
            if(isset($donnees["erreurs"]) && $donnees["erreurs"] != ""){
    ?>
            <p class="connexionErreur"><?= $donnees["erreurs"] ?></p>
    <?php
            }else{
    ?>
            <p></p>   
    <?php
            } //Fin if.
    ?>
                <input type="hidden" name="id" value="<?= (isset($usager)) ? $usager->getId() : 0 ?>"/><br/>
                <input type="hidden" name="page" value="<?= (isset($donnees["page"])) ? $donnees["page"] : 1 ?>"/><br/>
                <input class="bouton" type="submit" value="<?= $langue['button_soumettre'] ?>"/>
            </form>
        </div>
    </section>
</div>


