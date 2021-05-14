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
                    
                    $montantSousTotal += floatval($uneVoiture['prix']);                                      //Clacul du sous total de la commande
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
                                <p class="montant"> <?= $langue['prix'] ?> : <span data-js-prix><?= number_format($uneVoiture['prix'], 2, '.', '') ?></span> $ </p>                                
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
                <p class="total" data-js-partiel><?= $langue['totalPartiel']?> : <span data-js-total-partiel> <?= number_format($montantSousTotal, 2, '.', '') ?></span> $</p>
                <button class="magasiner" data-js-magasiner><?= $langue['continuer'] ?></button></br>
                <button class="button" data-js-commander><?= $langue['passerCommande'] ?></button>
            </div>
            <div class="hidden expedition" data-js-total-final>
               
                <label class="label_commande" for="expedition"><?= $langue["choix-expedition"] ?> : </label>
                <select class="select_commande" name="expedition" id="expedition" data-js-expedition required>
                    <option value="0"><?= $langue["option"] ?></option>
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
            </div> 
            <div class="hidden taxationConteneur" data-js-taxation>  
                <div class="taxation">
                    <div class="taxeConteneur"><p data-js-partiel><?= $langue['totalPartiel']?> : </p> <p> <span data-js-total-partiel> <?= number_format($montantSousTotal, 2, '.', '') ?></span><span>$</span></p></div>
                    <div class="taxeConteneur"><p class="tps" data-js-texte-taxe-federale></p> <p><span data-js-tps></span><span>$</span></p></div>
                    <div class="taxeConteneur" data-js-div-provinciale><p class="tvq" data-js-texte-taxe-provinciale></p> <p><span data-js-tvq></span><span>$</span></p></div>
                    <div class="taxeConteneur"><p class="total-final"><?= $langue['total']?> : </p> <p><span data-js-total></span><span>$</span></p></div>
                </div>
                <div class="paypal"> 
                    <div id="paypal-button-container" data-js-component="Paypal"></div>
                </div>
            </div>
        </section>
    </div>    
</div>
    