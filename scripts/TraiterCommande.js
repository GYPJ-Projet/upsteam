class TraiterCommande {

    constructor(el) {
        this._el = el;
        this._elMagasiner = this._el.querySelector('[data-js-magasiner]'); 
        this._elCommander = this._el.querySelector('[data-js-commander]');  
        this._elTotalPartiel = this._el.querySelector('[data-js-total-partiel]'); 
        this._elTotalFinal = this._el.querySelector('[data-js-total-final]'); 
        this._elTotal = this._el.querySelector('[data-js-total]'); 
        this._elTvq = this._el.querySelector('[data-js-tvq]'); 
        this._elTps = this._el.querySelector('[data-js-tps]'); 
                
        this._taxeFederale = 0;
        this._taxeProvinciale = 0;
               
        this.init();          
    }

    init = (e) => {
        //this._elTotal.addEventListener('change', this.sauvegarder); 

        this._elMagasiner.addEventListener('click', this.continuerMagasinage);
        this._elCommander.addEventListener('click', this.passerCommande);
        
    }
   
    continuerMagasinage = () => {
        window.location.href = 'index.php?Voiture';
    }

    passerCommande = () => {
        this._elMagasiner.classList.add('hidden');
        this._elCommander.classList.add('hidden');
        this._elTotalFinal.classList.remove('hidden');
        this._taxeFederale = Taxes.getTaxeFederale();
        this._taxeProvinciale = Taxes.getTaxeProvinciale();
       
        this.calculTaxe();
    }

    calculTaxe = () => {
        let montantPartiel =  parseFloat(this._elTotalPartiel.innerHTML),
            tvq = (montantPartiel * this._taxeProvinciale).toFixed(2),
            tps = (montantPartiel * this._taxeFederale).toFixed(2),
            total = parseFloat(tvq) + parseFloat(tps) + montantPartiel;

        this._elTvq.innerHTML = tvq;
        this._elTps.innerHTML = tps;
        this._elTotal.innerHTML = total;
    }
}