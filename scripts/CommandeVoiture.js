class CommandeVoiture {

    constructor(el) {
        this._el = el;
        this._elRetrait = this._el.querySelector('[data-js-retrait]');
        this._elQteVoiture = this._el.querySelector('[data-js-quantite]');
        this._elPrix = this._el.querySelector('[data-js-prix]');
        this._elTotalPartiel = document.querySelector('[data-js-total-partiel]'); 
        this._nbrVoiture = document.querySelector('[data-js-nombre-voiture]');   
        this._idVoiture = parseInt(this._el.dataset.jsCommandevoiture);
        this._elControleurAction = document.querySelector('[data-js-controleur-action]');  
        this._Commander = document.querySelector('[data-js-commander]');
        this._panier     = document.querySelector('[data-js-panier]'); 

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
        let nbrVoiture = parseInt(sessionStorage.getItem('nombreVoiture'));
        let panier = sessionStorage.getItem('panierAchat');
        panier = JSON.parse(panier); 


        if (qte > 0) { 
            qte--; 
            panier[this._idVoiture] = null;
            nbrVoiture--;

            
            sessionStorage.setItem('panierAchat', JSON.stringify(panier));      
            sessionStorage.setItem('nombreVoiture', JSON.stringify(nbrVoiture));      
            this._elControleurAction.dataset.jsControleurAction = `afficherCommande&panier= ${JSON.stringify(panier)}`;   
           
            sousTotal -= prix;
           

            this._nbrVoiture.innerHTML = nbrVoiture;
            this._elQteVoiture.innerHTML = qte;
            this._elTotalPartiel.innerHTML = sousTotal;
            this._el.innerHTML = '';

            // Si la dernière voiture était rétirée, on supprime sessionStorage
            if (nbrVoiture == 0) {
                sessionStorage.removeItem("panierAchat");  
                sessionStorage.removeItem("nombreVoiture"); 
                this._panier.classList.replace('fill', 'vide');
                this._nbrVoiture.innerHTML = '';
                window.location.href = 'index.php';
            }
            
            if (this._panier == null) {
                if (this._nbrVoiture == 0){
                    this._Commander.classList.add('hidden')
                }
            }
            
        } 
    }
}