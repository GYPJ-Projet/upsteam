<?php
	$langue = $donnees["langue"];
?>

<body>
	<div class="bodyConteneur" data-js-controleur="Erreur404"  data-js-controleur-action=""> 
		<div class="erreur404Conteneur">
			<div class="mainbox">
				<div class="err">4 0 4</div>
				<div class="msg"><?= $langue['message_404'] ?></div>
			</div>
		</div>
		<div class="btn-erreur-404">
			<a href='index.php?Voiture'><button class="btn-404-accueil"><?= $langue['retourner_accueil'] ?></button></a>
		</div>	
	</div>	
</body>
