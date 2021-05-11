<?php 
    $langue = $donnees["langue"];

?>

<div data-js-controleur="Commande" data-js-controleur-action='afficherCommande&panier=<?= json_encode($donnees['panier']) ?>'>
    <div class="listepanierConteneur">
        <section class="listepanier" data-js-component="TraiterCommande">

            <h2 class="titre"><?= $langue['confirmationCommande'] ?></h2><hr>

            <ul data-js-liste>
    <?php 
            //Opération pour caluler le panier courant
            $montantSousTotal = 0;  
            foreach($donnees["panier"] as $uneVoiture) { 
                if ($uneVoiture != null) { 
                    $montant = $uneVoiture['prix']  *  $uneVoiture['quantite'];         //Calcul montant de la voiture,
                    
                    $montantSousTotal += $montant;                                      //Clacul du sous total de la commande
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
                                <p> <?= $langue['prix'] ?> : <span data-js-prix><?= $uneVoiture['prix'] ?></span> $ </p>
                                <p> <?= $langue['quantite'] ?> : <span data-js-quantite><?= $uneVoiture['quantite'] ?> </span></p>                                
                                <p class="montant"> <?= $langue['montant'] ?> : <span data-js-montant><?= floatval($montant) ?> </span> $ </p>
<!-- < ?php
                            foreach($donnees["expedition"] as $expedier) {
?>  
                                <div class="expedition">
                                    <p>< ?= $langue['choix-expedition'] ?></p>
                                    <label for="< ?=$expedier["nom"]?>">< ?=$expedier["nom"]?></label>
                                    <input class="radio" type="checkbox" id="< ?=$expedier["nom"]?>" name="< ?=$expedier["nom"]?>" value="< ?=$expedier["nom"]?>" data-js-expedition="< ?=$expedier["id"]?>" < ?= (strpos($expedierRecu, $expedier["nom"]))? 'checked':''; ?> >
                                </div>
< ?php                        
                            }
?> -->                        
                                <div class="retrait">
                                    <button class="buttonRetrait" data-js-retrait><?= $langue['retirer'] ?></button>
                                </div>
                            </div>
                        </div>
                        <hr>
                    </li>                       
        <?php
                    }
                }            
        ?>
            </ul>

            <p class="total" data-js-partiel><?= $langue['totalPartiel']?> : <span data-js-total-partiel> <?= $montantSousTotal ?></span> $</p>
            <button class="magasiner" data-js-magasiner><?= $langue['continuer'] ?></button></br>
            <button class="button" data-js-commander><?= $langue['passerCommande'] ?></button>
            <div class="hidden taxation" data-js-total-final>
                <p class="tps">TPS : <span data-js-tvq></span> $ </p>
                <p class="tvq">TVQ : <span data-js-tps></span> $ </p>
                <p class="total-final"><?= $langue['total']?> : <span data-js-total></span> $ </p>
                <div class="paiement">
                    <p><?= $langue['payer'] ?> : </p>
                    <div id="paypal-button-container" data-js-component="Paypal"></div>
                    <button class="button" data-js-payer><?= $langue['credit'] ?></button>
                    <button class="button" data-js-payer><?= $langue['cash'] ?></button>
                </div>
            </div>
        </section>
    </div>    
</div>
    