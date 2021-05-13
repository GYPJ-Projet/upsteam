<?php
	$langue = $donnees["langue"]; 
 ?>
<div data-js-component="Succes">
    <div class="contenueConteneur" data-js-controleur="Commande" data-js-controleur-action="sauvegarderCommande">

    <h4 class="merci"><?= $langue["merci"] ?>, <span class="usager_achat"><?=$_SESSION["usager"]->getPrenom(); ?></span>, <?= $langue["confirmation"] ?></h4>
    <h4 class="expedition"><?= $langue["expedition"] ?></h4>
    <iframe class="recu" src="pdf/<?= $donnees['paypalNoAutorisation'] ?>" width="100%" height="1000px" frameborder="0"></iframe>

</div>