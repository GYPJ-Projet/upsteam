class Entete{
    constructor(el){
        this._el =  el;                                                            
        this._elCodeLangue = this._el.querySelector('[data-js-codeLangue]');
        this._elLangue = this._el.querySelector('[data-js-langue]');
        this._elNbrItem = this._el.querySelector('[data-js-nombre-item]');
        this._elPanier = this._el.querySelector('[data-js-panier]');
        this._elControleur = document.querySelector('[data-js-controleur]');
        this._elControleurAction = document.querySelector('[data-js-controleur-action]');
        
        this.init();
    }

    init = ()=> {
        
        this._elCodeLangue.addEventListener('click', this.changerLangue);  
        this._elPanier.addEventListener('click', this.gestionPanier);           
    }

    // Le chargement de la page dans la langue choisie
    changerLangue = () => {
        let nomControleur = this._elControleur.dataset.jsControleur,
            repertoireLangue = this._elLangue.dataset.jsLangue,
            contoleurAction  = this._elControleurAction.dataset.jsControleurAction;
           
        window.location.href = `index.php?${nomControleur}&action=changerLangue&langue=${repertoireLangue}&controleur-action=${contoleurAction}`;
        
    }

    gestionPanier = () => {
        /*if (localStorage.getItem('itemNumber')) {
            if (this._elCart.classList.contains('empty')) { 
                this._elCart.classList.replace('empty', 'fill');
                this._elItemNumber.textContent = parseInt(sessionStorage.getItem('itemNumber'));
            }
        }*/
    }
}