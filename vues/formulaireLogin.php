<?php
    $langue = $donnees["langue"];       //Pour affichage des langues
?>
<section class="bodyConteneur">
    <div class="formulaireConnexion " data-js-controleur="Usager"  data-js-controleur-action="connexion"> 
        <h4><?= $langue['connexion'] ?></h4>
        <form class="connexion" action="index.php?Usager" method="post">
            <div class="iconeConteneur">
                <label for="courriel"><?= $langue['courriel'] ?></label> 
                <input type="text" name="courriel" placeholder="<?= $langue['tempCourriel'] ?>"/><br>
            </div>
            <div class="iconeConteneur">
                <label for="motPasse"> <?= $langue['motPasse'] ?> </label> 
                <input type="password" name="motPasse" placeholder="<?= $langue['tempMotPasse'] ?>" /><br>
            </div>
            <input type="hidden" name="action" value="authentifier"/>
            <input class="submit" type="submit" value="<?= $langue['btnConnexion'] ?>"/>
        </form>
        <h5><a href=""><?= $langue['creerCompte'] ?></a></h5>
    </div>
</section>
<?php

    if($donnees["erreurs"] != ""){
?>
        <p><?= $donnees["erreurs"] ?></p>

<?php
    }else{
?>
        <p></p>   
<?php
    }
?>