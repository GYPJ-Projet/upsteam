class CommandeVoiture {

    constructor(el) {
        this._el = el;
        this._elPlus = this._el.querySelector('[data-js-qtePlus]');
        this._elMoins = this._el.querySelector('[data-js-qteMoins]');
        this._elQteVoiture = this._el.querySelector('[data-js-quantite]');
        this._elPrix = this._el.querySelector('[data-js-prix]');
        this._elMontant = this._el.querySelector('[data-js-montant]');
        this._elTotalPartiel = document.querySelector('[data-js-total-patiel]'); 
        this._panier = JSON.parse(localStorage.getItem('panierAchat'));
        this._idVoiture = parseInt(this._el.dataset.jsCommandevoiture);
        this._elControleurAction = document.querySelector('[data-js-controleur-action]');  
            
        
        Taxes.getTaxes();

        this.init();
    }

    init = () => {

        this._elPlus.addEventListener('click', (e) => {
            e.preventDefault();
                     
            this.ajouterVoiture();
        });

        this._elMoins.addEventListener('click', (e) => {
            e.preventDefault();
            this.retirerVoiture();
        });
    }
    
    ajouterVoiture = (e) => {
        let qte = parseInt(this._elQteVoiture.innerHTML);
        let montant =  parseInt(this._elMontant.innerHTML);
        let prix =  parseInt(this._elPrix.innerHTML);
        let sousTotal = parseInt(this._elTotalPartiel.innerHTML);
        let taxeFederale = Taxes.getTaxeFederale();
        let taxeProvinciale = Taxes.getTaxeProvinciale();

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
        let taxeFederale = Taxes.getTaxeFederale();
        let taxeProvinciale = Taxes.getTaxeProvinciale();
 
        if (qte > 0) { 
            qte--;  
            this._panier[this._idVoiture].quantite--; 
            localStorage.setItem('panierAchat', JSON.stringify(this._panier));      
            this._elControleurAction.dataset.jsControleurAction = `afficherCommande&panier= ${JSON.stringify(this._panier)}`;   
           
            montant = prix * qte;
            sousTotal -= prix;

            this._elQteVoiture.innerHTML = qte;
            this._elMontant.innerHTML = montant;
            this._elTotalPartiel.innerHTML = sousTotal;

            if (qte == 0) this._elMoins.disabled = true;
        } 
    }
}