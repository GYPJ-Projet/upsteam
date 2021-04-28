<?php 
    $langue = $donnees["langue"];       //Pour affichage des langues
?>

<div class="iconeBurger sourisPointer cacher" data-js-iconeBurger>
    <svg width="30px" height="30px" enable-background="new 0 0 122.879 103.609" version="1.1" viewBox="0 0 122.879 103.609" xml:space="preserve" xmlns="http://www.w3.org/2000/svg"><path d="m10.368 0h102.14c5.703 0 10.367 4.665 10.367 10.367s-4.664 10.368-10.367 10.368h-102.14c-5.702 0-10.368-4.665-10.368-10.367 0-5.703 4.666-10.368 10.368-10.368zm0 82.875h102.14c5.703 0 10.367 4.665 10.367 10.367s-4.664 10.367-10.367 10.367h-102.14c-5.702 0-10.368-4.665-10.368-10.367s4.666-10.367 10.368-10.367zm0-41.437h102.14c5.703 0 10.367 4.665 10.367 10.367s-4.664 10.368-10.367 10.368h-102.14c-5.702 0-10.368-4.666-10.368-10.368s4.666-10.367 10.368-10.367z" clip-rule="evenodd" fill-rule="evenodd"/></svg>
</div>

<nav class="menuConteneur nonBurger " data-js-component="MenuConteneur">
    <div class="menuContenu sourisPointer" data-js-menuAcceuil><p><?=$langue["menu_accueil"]?></p></div>
    <div class="menuContenu sourisPointer" data-js-menuMonProfil><p><?=$langue["profil"]?></p></div>
    <div class="menuContenu sourisPointer" data-js-menuGestionDonnees><p><?=$langue["donnees"]?></p></div>
    <div class="menuContenu sourisPointer" data-js-menuGestionEmployes><p><?=$langue["employes"]?></p></div>
    <div class="menuContenu sourisPointer" data-js-menuGestionCommandes><p><?=$langue["commandes"]?></p></div>
</nav>

