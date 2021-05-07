<?php
    $langue = $donnees["langue"];

    switch($donnees['resultat']) {
        case "validationSucces":
            $message = $langue['validationSucces'];
            break;
        case "validationEchec":
            $message = $langue['validationEchec'];
            break;
    }

?>

<div class="bodyConteneur">
    <section class="tampon"></section>
    <section class="pageDonnees">
        <div data-js-component="RetourCourriel" data-js-controleur="Usager" data-js-controleur-action="validationCompte">
            <h2><?= $message ?></h2>
        </div>
    </section>
</div>


