<?php
    $langue = $donnees["langue"];       //Pour affichage des langues
?>
<section class="formulaireConnexionConteneur contenueConteneur">
    <div class="formulaireConnexion" data-js-controleur="Usager"  data-js-controleur-action="formulaireMotPassePerdu"> 
        <h4><?= $langue['motPassePerduTitre'] ?></h4>
        <form class="formulaireConnexionform" action="index.php?Usager" method="post">

            <div class="formulaireConnexionInput">
                <label for="courriel"><?= $langue['courriel'] ?></label> 
                <input class="formulaireConnexionInput" size="30" type="text" name="courriel" placeholder="<?= $langue['tempCourriel'] ?>" required /><br>
            </div>

            <p class="margeHautSousSection"><?= $langue['motPassePerduExplication'] ?></p>

            <input type="hidden" name="action" value="envoieMotPassePerdu"/>
            <input class="boutonFormCreerCompte sourisPointer" type="submit" value="<?= $langue['btnMotPassePerdu'] ?>"/>
        </form>
    </div>
</section>
<?php

    if(isset($donnees["erreurs"]) && $donnees["erreurs"] != ""){
?>
        <p class="connexionErreur"><?= $donnees["erreurs"] ?></p>

<?php
    }else{
?>
        <p></p>   
<?php
    }
?>