<?php 
    $langue = $donnees["langue"];       //Pour affichage des langues
?>

<body >
    <div class="bodyConteneur" data-js-bodyConteneur>
        <aside class="filtre">
            <form class="formConteneur" action="">

                <!-- TITRE -->
                <div class="filtreSection filtreSectionTop">
                    <p class="titreFiltre"><?=$langue["filtreFiltres"]?></p>
                </div>
                
                <!-- PRIX -->
                <div class="filtreSection">
                    <p class="titreSection"><?=$langue["filtreFiltres"]?></p>
                    <select class="sousMenuContenue filtreInputColor" name="" id="">
                        <option value="null"><?=$langue["filtreChoisirPrix"]?></option>
                        <option value=""><?=$langue["filtrePrix0_1500"]?></option>
                        <option value=""><?=$langue["filtrePrix1500_5000"]?></option>
                        <option value=""><?=$langue["filtrePrix5000_10000"]?></option>
                        <option value=""><?=$langue["filtrePrix10000_20000"]?></option>
                        <option value=""><?=$langue["filtrePrix20000_30000"]?></option>
                        <option value=""><?=$langue["filtrePrix30000_60000"]?></option>
                        <option value=""><?=$langue["filtrePrix60000"]?></option>
                    </select>
                </div>
                
                <!-- MARQUE -->
                <div class="filtreSection grille_voitures">
                    <p class="titreSection"><?=$langue["filtreMarque"]?></p>
                    <div class="grille grille--2 liste">
<?php
                    foreach($donnees["toutesMarquesDispo"] as $marque){
?>  
                        <div class="listeConteneur">
                            <label for="<?=$marque["nom"]?>"><?=$marque["nom"]?></label>
                            <input class="radio" type="checkbox" id="<?=$marque["nom"]?>" name="<?=$marque["nom"]?>" value="<?=$marque["nom"]?>">
                        </div>
<?php                        
                    }
?>
                    </div>
                </div>
                
                <!-- MODELE -->
                <div class="filtreSection grille_voitures">
                    <p class="titreSection"><?=$langue["filtreModele"]?></p>
                    <div class="grille grille--2 liste">
<?php
                    foreach($donnees["toutesModeleDispo"] as $modele){
?>  
                        <div class="listeConteneur">
                            <label for="<?=$modele["nom"]?>"><?=$modele["nom"]?></label>
                            <input class="radio" type="checkbox" id="<?=$modele["nom"]?>" name="<?=$modele["nom"]?>" value="<?=$modele["nom"]?>">
                        </div>
<?php                        
                    }
?>
                    </div>
                </div>
                
                <!-- ANNEE -->
                <div class="filtreSection">
                    <p class="titreSection"><?=$langue["filtreAnnee"]?></p>
                    <div class="sousMenuConteneur">
                        <div class="sousMenuContenue">
                        <label for="anneeMin"><?=$langue["filtreAnneeDebut"]?></label>
                        <input class="filtreInputWidth filtreInputColor" id="anneeMin" min="1800" max="9999" value="<?php echo date("Y")-5; ?>" type="number">
                        </div>
                        <div class="sousMenuContenue">
                            <label for="anneeMax"><?=$langue["filtreAnneeFin"]?></label>
                            <input class="filtreInputWidth filtreInputColor" id="anneeMax" min="1800" max="9999" value="<?php echo date("Y"); ?>" type="number">
                        </div>

                    </div>
                </div>

                <!-- KM -->
                <div class="filtreSection">
                    <p class="titreSection"><?=$langue["filtreKilometrage"]?></p>
                    <select class="sousMenuContenue filtreInputColor" name="" id="">
                        <option value=""><?=$langue["filtreChoisirKm"]?></option>
                        <option value=""><?=$langue["filtreKm0_10000"]?></option>
                        <option value=""><?=$langue["filtreKm10000_25000"]?></option>
                        <option value=""><?=$langue["filtreKm25000_50000"]?></option>
                        <option value=""><?=$langue["filtreKm50000_100000"]?></option>
                        <option value=""><?=$langue["filtreKm100000"]?></option>
                    </select>
                </div>

                <!-- CARBURANT -->
                <div class="filtreSection">
                    <p class="titreSection"><?=$langue["filtreCarburant"]?></p>
                    <div class="sousMenuConteneur">
                        <div class="sousMenuContenueRadio">
                            <label for="essence"><?=$langue["filtreEssence"]?></label>
                            <input class="radio" type="radio" name="carburant" id="essence" value="essence">
                        </div>
                        <div class="sousMenuContenueRadio">
                            <label for="diesel"><?=$langue["filtreDiesel"]?></label>
                            <input class="radio" type="radio" name="carburant" id="diesel" value="diesel">
                        </div>
                    </div>
                </div>

                <!-- CARROSERIE -->
                <div class="filtreSection">
                    <p class="titreSection"><?=$langue["filtreCarroserie"]?></p>
                    <div class="grille grille--2 liste">
<?php
                    foreach($donnees["toutesCarrosserieDispo"] as $carrosserie){
?>  
                        <div class="listeConteneur">
                            <label for="<?=$carrosserie["nom"]?>"><?=$carrosserie["nom"]?></label>
                            <input class="radio" type="checkbox" id="<?=$carrosserie["nom"]?>" name="<?=$carrosserie["nom"]?>" value="<?=$carrosserie["nom"]?>">
                        </div>
<?php                        
                    }
?>
                    </div>
                </div>

                <!-- TRANSMISSION -->
                <div class="filtreSection">
                    <p class="titreSection"><?=$langue["filtreTransmission"]?></p>
                    <div class="sousMenuConteneur">
                        <div class="sousMenuContenueRadio">
                            <label for="manuel"><?=$langue["filtreManuel"]?></label>
                            <input class="radio" type="radio" name="transmission" id="manuel" value="manuel">
                        </div>
                        <div class="sousMenuContenueRadio">
                            <label for="automatique"><?=$langue["filtreAutomatique"]?></label>
                            <input class="radio" type="radio" name="transmission" id="automatique" value="automatique">
                        </div>
                    </div>
                </div>

                <!-- PROPULSION -->
                <div class="filtreSection">
                    <p class="titreSection"><?=$langue["filtrePropulsion"]?></p>

                    <div class="sousMenuConteneur">
                        <div class="sousMenuContenueRadio">
                            <label for="2x4"><?=$langue["filtre2x4"]?></label>
                            <input class="radio" type="radio" name="propulsion" id="2x4" value="2x4">
                        </div>
                        <div class="sousMenuContenueRadio">
                            <label for="4x4"><?=$langue["filtre4x4"]?></label>
                            <input class="radio" type="radio" name="propulsion" id="4x4" value="4x4">
                        </div>
                    </div>
                </div>

                <!-- FILTRER -->
                <div class="filtreSection filtreSectionBottom sousMenuConteneur">
                    <button><?=$langue["filtreFiltrer"]?></button>
                </div>

            </form>
        </aside>
        <main data-js-component="ListeVoitures">
            <section class="grille_voitures">
                <div class="grille grille--2" data-js-results>

