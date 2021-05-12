<?php
	$langue = $donnees["langue"];  
?>
<div>
    <h4><?= $langue["merci"] ?>, <?=$_SESSION["usager"]->getPrenom(); ?>, <?= $langue["confirmation"] ?></h4>
    <h4><?= $langue["expedition"] ?></h4>
    <iframe src="pdf/<?= $donnees['paypalNoAutorisation'] ?>" width="100%" height="1000px" frameborder="0"></iframe>

</div>