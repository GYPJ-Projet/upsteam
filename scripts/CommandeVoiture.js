class CommandeVoiture {

    constructor(el) {
        this._el = el;
        this._elRetrait = this._el.querySelector('[data-js-retrait]');
        this._elQteVoiture = this._el.querySelector('[data-js-quantite]');
        this._elPrix = this._el.querySelector('[data-js-prix]');
        this._elMontant = this._el.querySelector('[data-js-montant]');
        this._elTotalPartiel = document.querySelector('[data-js-total-partiel]'); 
        this._panier = JSON.parse(localStorage.getItem('panierAchat'));
        this._nbrVoiture = parseInt(localStorage.getItem('nombreVoiture')); 
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
    
    ajouterVoiture = (e) => {
        let qte = parseInt(this._elQteVoiture.innerHTML);
        let montant =  parseInt(this._elMontant.innerHTML);
        let prix =  parseInt(this._elPrix.innerHTML);
        let sousTotal = parseInt(this._elTotalPartiel.innerHTML);
        
        qte++;
        this._panier[this._idVoiture].quantite++;
        localStorage.setItem('panierAchat', JSON.stringify(this._panier));
        this._elControleurAction.dataset.jsControleurAction = `afficherCommande&panier= ${JSON.stringify(this._panier)}`;
        
        montant = prix * qte;
        sousTotal += prix;
        
        this._elQteVoiture.innerHTML = qte;
        this._elMontant.innerHTML = montant;
        this._elTotalPartiel.innerHTML = sousTotal;

        if (qte > 0) this._elMoins.disabled = false;

    }

    retirerVoiture = (e) => {        
        let qte = parseInt(this._elQteVoiture.innerHTML);
        let montant =  parseInt(this._elMontant.innerHTML);
        let prix =  parseInt(this._elPrix.innerHTML);
        let sousTotal = parseInt(this._elTotalPartiel.innerHTML);
 
        if (qte > 0) { 
            qte--;  
            this._panier[this._idVoiture].quantite--; 
            this._nbrVoiture = parseInt(localStorage.getItem('nombreVoiture')) - 1;
            localStorage.setItem('panierAchat', JSON.stringify(this._panier));      
            localStorage.setItem('nombreVoiture', JSON.stringify(this._nbrVoiture));      
            this._elControleurAction.dataset.jsControleurAction = `afficherCommande&panier= ${JSON.stringify(this._panier)}`;   
           
            montant = prix * qte;
            sousTotal -= prix;

            this._elQteVoiture.innerHTML = qte;
            this._elMontant.innerHTML = montant;
            this._elTotalPartiel.innerHTML = sousTotal;
            this._el.setAttribute('style', 'display:none');
            
            if (this._panier == null) {
                if (this._nbrVoiture == 0){
                    this._Commander.classList.add('hidden')
                }
            }
            
        } 
    }
}