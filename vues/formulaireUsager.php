<?php
    $langue = $donnees["langue"];
    if (isset($donnees["usager"])) $usager = $donnees["usager"];
?>
<section class="pageDonnees">
    <div data-js-component="formulaireUsager" data-js-controleur="Usager" data-js-controleur-action="sauvegarderUsager">
        <h2><?= (isset($usager)) ? $langue["formulaire_modif_usager"] : $langue["formulaire_ajout_usager"] ?></h2>
        <form class="formulaire" action="index.php?Usager&action=sauvegarderUsager" method="post">
            <label for="nom"><?= $langue["nom_usager"] ?> : </label>
            <input type="text" name="nom" min="0" id="nom" value="<?= (isset($usager)) ? $usager["nom_usager"] : "" ?>" required/><br>

            <label for="prenom"><?= $langue["prenom_usager"] ?> : </label>
            <input type="text" name="prenom" min="0" id="prenom" value="<?= (isset($usager)) ? $usager["prenom_usager"] : "" ?>" required/><br>
            
            <label for="courriel"><?= $langue["courriel"] ?> : </label>
            <input type="email" name="courriel" min="0" id="courriel" value="<?= (isset($usager)) ? $usager["courriel"] : "" ?>" required/><br>
            
            <label for="dateNaissance"><?= $langue["dateNaissance"] ?> : </label>
            <input type="date" name="dateNaissance" min="0" id="dateNaissance" value="<?= (isset($usager)) ? $usager["dateNaissance"] : "" ?>" required/><br>
            
            <label for="adresse"><?= $langue["adresse"] ?> : </label>
            <input type="text" name="adresse" min="0" id="adresse" value="<?= (isset($usager)) ? $usager["adresse"] : "" ?>" required/><br>
            
            <label for="codePostal"><?= $langue["codePostal"] ?> : </label>
            <input type="text" name="codePostal" min="0" id="codePostal" value="<?= (isset($usager)) ? $usager["codePostal"] : "" ?>" required/><br>
            
            <label for="province"><?= $langue["province"] ?> : </label>
            <select name="province" id="province" required>
                <option value=""><?= $langue["option"] ?></option>
<?php
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
            <input type="text" name="ville" min="0" id="ville" value="<?= (isset($usager)) ? $usager["ville"] : "" ?>" required/><br>

            <label for="telephone"><?= $langue["telephone"] ?> : </label>
            <input type="text" name="telephone" min="0" id="telephone" value="<?= (isset($usager)) ? $usager["telephone"] : "" ?>" required/><br>
            
            <label for="cellulaire"><?= $langue["cellulaire"] ?> : </label>
            <input type="text" name="cellulaire" min="0" id="cellulaire" value="<?= (isset($usager)) ? $usager["cellulaire"] : "" ?>" required/><br>

            <label for="langue"><?= $langue["langue"] ?> : </label>
            <select name="langue" id="langue" required>
                <option value=""><?= $langue["option"] ?></option>
<?php
                for ($i = 0; $i < count($donnees["choixLangue"]); $i++) {
?>         
                <option value="<?= $i + 1 ?>" <?= (isset($usager) && $usager->getIdLangue() == $i) ? "selected" : "" ?>>
                    <?= $donnees["choixLangue"][$i]['nom'] ?>
                </option>      
<?php
                }
?>  
            </select><br>

<?php
            if(isset($usager) &&$usager.getIdRole <= 2) {
?> 
            <label for="role"><?= $langue["role"] ?> : </label>
            <select name="role" id="role" required>
                <option value=""><?= $langue["option"] ?></option>
<?php
                for ($i = 0; $i < count($donnees["role"]); $i++) {
?>         
                <option value="<?= $i + 1 ?>" <?= (isset($usager) && $usager->getIdRole() == $i) ? "selected" : "" ?>>
                    <?= $donnees["role"][$i]['nom'] ?>
                </option>
<?php
                }   //Fin du for
?>  
            </select><br>

<?php
            }//Fin du if
?>
<?php
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

            <input type="hidden" name="id" value="<?= (isset($usager)) ? $usager["id"] : 0 ?>"/><br/>
            <input type="hidden" name="page" value="<?= (isset($donnees["page"])) ? $donnees["page"] : 1 ?>"/><br/>
            <input class="bouton" type="submit" value="<?= $langue['button_soumettre'] ?>"/>
        </form>
    </div>



</section>


