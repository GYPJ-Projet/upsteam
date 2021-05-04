class Entete{
    constructor(el){
        this._el =  el;  
        /* Gestion Langue*/                                                          
        this._elCodeLangue = this._el.querySelector('[data-js-codeLangue]');
        this._elLangue = this._el.querySelector('[data-js-langue]');
        this._elControleur = document.querySelector('[data-js-controleur]');
        this._elControleurAction = document.querySelector('[data-js-controleur-action]');
        
       /* Panier */
       this._panier = document.querySelector('[data-js-panier]');
       this._nbrVoiture = document.querySelector('[data-js-nombre-voiture]'); 
        
        this.init();
    }

    init = ()=> {
        
        this._elCodeLangue.addEventListener('click', this.changerLangue); 

        this.verifierPanier();             
    }

    // Le chargement de la page dans la langue choisie
    changerLangue = () => {
        let nomControleur = this._elControleur.dataset.jsControleur,
            repertoireLangue = this._elLangue.dataset.jsLangue,
            contoleurAction  = this._elControleurAction.dataset.jsControleurAction;
           
        window.location.href = `index.php?${nomControleur}&action=changerLangue&langue=${repertoireLangue}&controleur-action=${contoleurAction}`;
        
    }

    verifierPanier = () => {
        if (localStorage.getItem('nombreVoiture')) {
            if (this._panier.classList.contains('vide')) { 
                this._panier.classList.replace('vide', 'fill');
                this._nbrVoiture.textContent = parseInt(localStorage.getItem('nombreVoiture'));
            }
        }
    }
}