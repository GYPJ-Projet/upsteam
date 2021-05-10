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
                        <img src="<?= $uneVoiture['image'] ?>">
                        <div class="info">
                            <p> <?= $langue['couleur'] ?> : <span><?= $uneVoiture['couleur'] ?> </span></p>
                            <p> <?= $langue['kilometrage'] ?> : <span><?= $uneVoiture['kilometrage'] ?> </span></p>
                            <p> <?= $langue['prix'] ?> : <span data-js-prix><?= $uneVoiture['prix'] ?></span> $ </p>
                            <p> <?= $langue['quantite'] ?> : <span data-js-quantite><?= $uneVoiture['quantite'] ?> </span></p>
                            <div class="option">
                                <button class="buttonOption" data-js-qtePlus>+</button>
                                <button class="buttonOption" data-js-qteMoins>−</button>
                            </div>
                            <p class="montant"> <?= $langue['montant'] ?> : <span data-js-montant><?= floatval($montant) ?> </span> $ </p>
                        </div>
                    </li>    
                        <hr>
        <?php
                    }
                }            
        ?>
            </ul>

            <h3 class="total"><?= $langue['totalPartiel']?> : <span data-js-total-patiel> <?= $montantSousTotal ?></span> $<h3>
            <button class="magasiner" data-js-magasiner><?= $langue['continuer'] ?></button></br>
            <button class="button" data-js-commander><?= $langue['passerCommande'] ?></button>
            <div class="hidden total-final" data-js-total-final>
                <p><?= $langue['totalPartiel']?> : <span data-js-total-patiel> <?= $montantSousTotal ?></span> $ </p>
                <p>TPS : <span data-js-tvq></span> $ </p>
                <p>TVQ : <span data-js-tps></span> $ </p>
                <p><?= $langue['total']?> : <span data-js-total></span> $ </p>
                <div id="paypal-button-container" data-js-component="Paypal"></div>
            </div>
        </section>
    </div>    
</div>
    