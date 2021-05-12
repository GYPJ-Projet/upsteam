<?php

	$langue = $donnees["langue"];
    
	$langue["releve_de_transaction"]    = 'RELEVÉ DE TRANSACTION';
$langue["merci"]                    = 'Merci beaucoup';
$langue["confirmation"]             = 'de votre achat dont vous retrouverez tous les d&eacute;tails ci-dessous.';
$langue["expedition"]               = 'Votre commmande sera prêtes dans 2 jours, vous pourrez passer la prendre !';

     
?>
<div>
    <h4><?= $langue["merci"] ?>, <?=$_SESSION["usager"]->getPrenom(); ?>, <?= $langue["confirmation"] ?></h4>
    <h4><?= $langue["expedition"] ?></h4>
    <iframe src="pdf/<?= $donnees['paypalNoAutorisation'] ?>" width="100%" height="1000px" frameborder="0"></iframe>
    <?php
    

        /*  CreerPDF::creationRecuPDF($donnees["paypalNoAutorisation"], 
                                    $langue["releve_de_transaction"], 
                                    $donnees["panier"] , 
                                    $donnees["date"], 
                                    json_decode($donnees["taxeFederale"],true), 
                                    json_decode($donnees["taxeProvinciale"],true), 'I'); */
    ?>
</div>