class CommandeVoiture {

    constructor(el) {
        this._el = el;
        this._elRetrait = this._el.querySelector('[data-js-retrait]');
        this._elQteVoiture = this._el.querySelector('[data-js-quantite]');
        this._elPrix = this._el.querySelector('[data-js-prix]');
        this._elTotalPartiel = document.querySelector('[data-js-total-partiel]'); 
        this._panier = JSON.parse(localStorage.getItem('panierAchat'));
        this._nbrVoiture = document.querySelector('[data-js-nombre-voiture]');   
        this._idVoiture = parseInt(this._el.dataset.jsCommandevoiture);
        this._elControleurAction = document.querySelector('[data-js-controleur-action]');  
        this._Commander = document.querySelector('[data-js-commander]'); 

        Taxes.getTaxes();

        this.init();
    }

    init = () => {

        this._elRetrait.addEventListener('click', (e) => {
            e.preventDefault();
            this.retirerVoiture();
        });
    }    
    
   
    retirerVoiture = (e) => {        
        let qte = parseInt(this._elQteVoiture.innerHTML);
        let prix =  parseInt(this._elPrix.innerHTML);
        let sousTotal = parseInt(this._elTotalPartiel.innerHTML);
        let nbrVoiture = parseInt(localStorage.getItem('nombreVoiture')); 

        if (qte > 0) { 
            qte--;  
            this._panier[this._idVoiture] = null;
            nbrVoiture--;
           
            localStorage.setItem('panierAchat', JSON.stringify(this._panier));      
            localStorage.setItem('nombreVoiture', JSON.stringify(nbrVoiture));      
            this._elControleurAction.dataset.jsControleurAction = `afficherCommande&panier= ${JSON.stringify(this._panier)}`;   
           
            sousTotal -= prix;
           

            this._nbrVoiture.innerHTML = nbrVoiture;
            this._elQteVoiture.innerHTML = qte;
            this._elTotalPartiel.innerHTML = sousTotal;
            this._el.innerHTML = '';

            if (this._panier == null) {
                if (this._nbrVoiture == 0){
                    this._Commander.classList.add('hidden')
                }
            }
            
        } 
    }
}