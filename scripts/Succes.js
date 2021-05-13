class Succes {

       constructor(el) {
        this._el = el;       // l'élément conteneur de grille de l'instance ListeVoitures

        /* Panier */
       this._panier     = document.querySelector('[data-js-panier]');
       this._nbrVoiture = document.querySelector('[data-js-nombre-voiture]'); 
       let nbrVoiture = parseInt(sessionStorage.getItem('nombreVoiture')); 

 
        this.init();
  
    }

    // Initialisation de la class Succes pour simplement enlever les local storage
    // que nous n'avons plus besoin car on vide la panier d'achat. 
    init = () => {
        sessionStorage.removeItem("panierAchat");  
        sessionStorage.removeItem("nombreVoiture"); 
        this._panier.classList.replace('fill', 'vide');
        this._nbrVoiture.innerHTML = '';
    }
    
}

