<?php
    $langue = $donnees["langue"];       //Pour affichage des langues
?>
<section class="formulaireConnexionConteneur contenueConteneur" data-js-component="FormulaireConnexion">
    <div class="formulaireConnexion" data-js-controleur="Usager"  data-js-controleur-action="connexion"> 
        <h4><?= $langue['connexion'] ?></h4>
        <form class="formulaireConnexionform" action="index.php?Usager" method="post">

            <div class="formulaireConnexionInput">
                <label for="courriel"><?= $langue['courriel'] ?></label> 
                <input class="formulaireConnexionInput" size="30" type="text" name="courriel" placeholder="<?= $langue['tempCourriel'] ?>" required /><br>
            </div>

            <div class="formulaireConnexionInput">
                <label for="motPasse"> <?= $langue['motPasse'] ?> </label> 
                <input class="formulaireConnexionInput" size="30" type="password" name="motPasse" placeholder="<?= $langue['tempMotPasse'] ?>" required /><br>
            </div>

            <input type="hidden" name="action" value="authentifier"/>
            <input class="boutonFormConnexion sourisPointer" type="submit" value="<?= $langue['btnConnexion'] ?>"/>
        </form>
        <div class="boutonConteneur fondBlanc">
            <input class="boutonFormConnexion sourisPointer " type="button" value="<?= $langue['creerCompte'] ?>" data-js-btnCreerCompte/>
            <input class="boutonFormCreerCompte sourisPointer" type="button" value="<?= $langue['motPassePerdu'] ?>" data-js-btnMotPassePerdu/>
        </div>
    </div>
</section>
<?php

    if($donnees["erreurs"] != ""){
?>
        <p class="connexionErreur"><?= $donnees["erreurs"] ?></p>

<?php
    }else{
?>
        <p></p>   
<?php
    }
?>