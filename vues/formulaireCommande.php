<section class="pageDonnees">
<?php
    if (isset($donnees["usager"])) $usager = $donnees["usager"];
    $langue = $donnees["langue"];
    if (isset($donnees["commande"])) $commande = $donnees["commande"];
?>

    <div data-js-controleur="GestionDonnees" data-js-controleur-action="afficherFormulaireCommande">
        <h2><?= $langue["facture"] . $commande["id"] ?><br/><span><?= $langue["nom_date"] ?> : <?= $commande["date"] ?></span></h2>
        <form class="formulaire" action='index.php?GestionDonnees_AJAX&action=sauvegarderCommande<?= (isset($_GET["page"])) ? "&page=" . $_GET["page"] : "" ?>' method="post">
            <div class="flex">
            <div>
            <div class="champ">
                <label for="nom"><?= $langue["nom_client"] ?> : </label>
                <span><?= $commande["idClient"] . " - " . $commande["nomClient"] ?></span>
            </div>
            
            <div class="champ">
                <label for="nomExpedition"><?= $langue["nom_expedition"] ?> : </label>
                <span><?= $commande["nomExpedition"] ?></span>
            </div>
            <div class="champ">
                <label for="nomModePaiement"><?= $langue["nom_modePaiement"] ?> : </label>
                <span><?= $commande["nomModePaiement"] ?></span>
            </div>
            <div class="champ">
                <label for="idStatut"><?= $langue["nom_statut"] ?> : </label>
                <select name="idStatut" id="idStatut" required>
                    <option value=""><?= $langue["option"] ?></option>
<?php   
                    for ($i = 1, $l = count($donnees["statut"]); $i <= $l; $i++) {
                        $statut = $donnees["statut"][$i];
                        if (isset($statut)) {
            ?>         
                            <option value="<?= $i ?>" <?= (isset($commande) && $commande["idStatut"] == $i) ? "selected" : "" ?>>
                                <?= $statut ?>
                            </option>      
            <?php       }
                    }
?>          
                </select><br>
            </div>
            </div>
            <div>   
                <p><?= $langue["nom_prixTotal"] . " : "?></p>
                <span class="total"><?= $commande["prixTotal"] ?></span>  
            </div>
            </div>
            <table>
                
            </table>
            <input type="hidden" name="id" value="<?= $commande["id"] ?>"/><br/>
            <input class="bouton" type="submit" value="<?= $langue['button_soumettre'] ?>"/>    
        </form>
    </div>
</section>

</div>