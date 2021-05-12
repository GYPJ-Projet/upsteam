<section class="pageDonnees">
<?php
    if (isset($donnees["usager"])) $usager = $donnees["usager"];
    $langue = $donnees["langue"];
    if (isset($donnees["commande"])) $commande = $donnees["commande"];
    if (isset($donnees["voitures"])) $voitures = $donnees["voitures"];
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
            <table class="table table--facture">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Photo</th>
                        <th><?= $langue["nom_marque"] ?></th>
                        <th><?= $langue["nom_modele"] ?></th>
                        <th><?= $langue["nom_annee"] ?></th>
                        <th><?= $langue["nom_prixVente"] ?></th>
                    </tr>
                </thead>
                <tbody>
<?php
                foreach ($voitures as $voiture) {
?>         
                    <tr>
                        <td><?= $voiture["id"] ?></td>
                        <td><a href="?Voiture&action=descriptionVoiture&id=<?= $voiture["id"] ?>">
<?php 
                    if (isset($voiture["photo"])) {
?>
                        <img class="photoPetit" src="<?= REPERTOIRE_IMAGES . $voiture["id"]. '/'. $voiture["photo"] ?>" alt="Photo">
<?php
                    } else {
?>
                        <p><?= $langue["sansPhoto"] ?></p>
<?php
                    }
?>
                    </a></td>
                        <td><?= $voiture["nomMarque"] ?></td>
                        <td><?= $voiture["nomModele"] ?></td>
                        <td><?= $voiture["annee"] ?></td>
                        <td><?= $voiture["prixVenteFinal"] ?></td>
                    </tr>   
<?php       
                }   
?>
            </tbody>
            </table>
            <input type="hidden" name="id" value="<?= $commande["id"] ?>"/><br/>
            <input class="bouton" type="submit" value="<?= $langue['button_soumettre'] ?>"/>    
        </form>
    </div>
</section>

</div>