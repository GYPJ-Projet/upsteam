class Entete{
    constructor(el){
        this._el =  el;                                                            
        this._elCodeLangue = this._el.querySelector('[data-js-langue]');
        this._elNbrItem = this._el.querySelector('[data-js-nombre-item]');
        this._elPanier = this._el.querySelector('[data-js-panier]');
        this._elControleur = document.querySelector('[data-js-controleur]')
        console.log(this._el);
        console.log(this._elCodeLangue);
        console.log(this._elControleur);
        console.log(this._elNbrItem);
        console.log(this._elPanier);
        console.log(this._elControleur.dataset.jsControleur);
        //console.log(this._elCodeLangue.dataset.jsLangue);
        

        this.init();
    }

    init =()=>{
        
        this._elCodeLangue.addEventListener('click', this.langueChoisie);              
            
    }
    // Les transferts de la page dans la langue choisie
    langueChoisie = () =>{
        let nomControleur = this._elControleur.dataset.jsControleur;
        window.location.href = 'index.php?nomControleur&action=changerLangue&langue=fr-fr';
    }
}