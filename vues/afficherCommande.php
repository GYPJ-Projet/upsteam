<?php 
   $langue = $donnees["langue"];
   if (isset($donnees["expedition"] )) $expedition = $donnees["expedition"];
   if (isset($donnees["modePaiement"])) $modePaiement = $donnees["modePaiement"];
?>

<div class="bodyConteneur" data-js-controleur="Commande" data-js-controleur-action='afficherCommande&panier=<?= json_encode($donnees['panier']) ?>'>

    <div class="listepanierConteneur">
        <section class="listepanier" data-js-component="TraiterCommande">

            <h2 class="titre"><?= $langue['confirmationCommande'] ?></h2><hr>

            <ul data-js-liste>
<?php 
            //Opération pour caluler le panier courant
            $montantSousTotal = 0;  
            foreach($donnees["panier"] as $uneVoiture) { 
                if ($uneVoiture != null) { 
                    //$montant = $uneVoiture['prix']  *  $uneVoiture['quantite'];         //Calcul montant de la voiture,
                    
                    $montantSousTotal += $uneVoiture['prix'];                                      //Clacul du sous total de la commande
?>
                    <li class="liste" data-js-component="CommandeVoiture" data-js-commandeVoiture="<?= $uneVoiture['id'] ?>">
                        <p class="commande"> <?= $uneVoiture['marque'] ?> <?= $uneVoiture['modele'] ?> <?= $uneVoiture['annee'] ?></p>
                        <div class="detail">
                            <div class="img-commamde">
                                <img src="<?= $uneVoiture['image'] ?>">
                            </div>
                            <div class="info">
                                <p> <?= $langue['couleur'] ?> : <span><?= $uneVoiture['couleur'] ?> </span></p>
                                <p> <?= $langue['kilometrage'] ?> : <span><?= $uneVoiture['kilometrage'] ?> </span></p>
                                <p> <?= $langue["transmission"] ?> : <span><?= $uneVoiture['transmission'] ?></span> </p><br>
                                <p class="montant"> <?= $langue['prix'] ?> : <span data-js-prix><?= $uneVoiture['prix'] ?></span> $ </p>                                
                                <p class="hidden"> <?= $langue['quantite'] ?> : <span data-js-quantite><?= $uneVoiture['quantite'] ?> </span></p>                                
                               <!--  <p class="montant"> < ?= $langue['montant'] ?> : <span data-js-montant>< ?= floatval($montant) ?> </span> $ </p> -->
                            </div>
                            <div class="retrait">
                                    <button class="buttonRetrait" data-js-retrait><?= $langue['retirer'] ?></button>
                            </div>
                        </div>
                        <hr>
                    </li>                                      
<?php
                }
            }            
?>
            </ul>

            <div data-js-passer-commande>
                <p class="total" data-js-partiel><?= $langue['totalPartiel']?> : <span data-js-total-partiel> <?= $montantSousTotal ?></span> $</p>
                <button class="magasiner" data-js-magasiner><?= $langue['continuer'] ?></button></br>
                <button class="button" data-js-commander><?= $langue['passerCommande'] ?></button>
            </div>
            <div class="hidden" data-js-total-final>
               
                <label for="expedition"><?= $langue["choix-expedition"] ?> : </label>
                <select name="expedition" id="expedition" required>
                    <option value=""><?= $langue["option"] ?></option>
<?php
                    for ($i = 1; $i <= count($donnees["expedition"]); $i++) {
?>         
                    <option value="<?= $i ?>">
                        <?= $donnees["expedition"][$i] ?>
                    </option>      
<?php
                    }
?>  
                </select><br><hr>
               
                <div class="taxation">
                    <p  data-js-partiel><?= $langue['totalPartiel']?> : <span>$</span> <span data-js-total-partiel> <?= $montantSousTotal ?></span> </p>
                    <p class="tps">TPS : <span>$</span> <span data-js-tvq></span></p>
                    <p class="tvq">TVQ : <span>$</span> <span data-js-tps></span></p>
                    <p class="total-final"><?= $langue['total']?> : <span>$</span><span data-js-total></span> </p>
                </div>
                
                <div class="paiement">
                    <p><?= $langue['payer'] ?> : </p>
<!-- < ?php
                    foreach($donnees["modePaiement"] as $modePaiement) { 
                        
?> -->
                    <div id="paypal-button-container" data-js-component="Paypal"></div>
                </div>
<!-- < ?php
                    }
?> -->
                </div>
        </section>
    </div>    
</div>
    