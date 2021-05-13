class TraiterCommande {

    constructor(el) {
        this._el = el;
        this._elMagasiner = this._el.querySelector('[data-js-magasiner]'); 
        this._elCommander = this._el.querySelector('[data-js-commander]');  
        this._elPasserCmd = this._el.querySelector('[data-js-passer-commande]');  
        this._elTotalPartiel = this._el.querySelector('[data-js-total-partiel]'); 
        this._elTotalFinal = this._el.querySelector('[data-js-total-final]'); 
        this._elTaxation = this._el.querySelector('[data-js-taxation]'); 
        this._elExpedition = this._el.querySelector('[data-js-expedition]'); 
        this._elTotal = this._el.querySelector('[data-js-total]'); 
        this._elTvq = this._el.querySelector('[data-js-tvq]'); 
        this._elTps = this._el.querySelector('[data-js-tps]'); 
        this._elTexteTaxeFederale =  this._el.querySelector('[data-js-texte-taxe-federale]');
        this._elTexteTaxeProvinciale =  this._el.querySelector('[data-js-texte-taxe-provinciale]');
        this._elPProvinciale = this._el.querySelector('[data-js-p-provinciale]');
        
        this._taxeFederale = null;   // Ce seront dorenavant des objets
        this._taxeProvinciale = null;
               
        this.init();          
    }

    init = (e) => {
        //this._elTotal.addEventListener('change', this.sauvegarder); 

        this._elMagasiner.addEventListener('click', this.continuerMagasinage);
        this._elCommander.addEventListener('click', this.passerCommande);
        this._elExpedition.addEventListener('change', this.expedition);
    }
   
    continuerMagasinage = () => {
        window.location.href = 'index.php?Voiture';
    }

    passerCommande = () => {
        this._taxeFederale = Taxes.getTaxeFederale();
        this._taxeProvinciale = Taxes.getTaxeProvinciale();
      
        let taxeFederale = parseFloat(this._taxeFederale['taux']);
        let taxeProvinciale = 0.00;

        // on affiche le texte de la taxe Fédérale
        this._elTexteTaxeFederale.innerHTML = this._taxeFederale['nomTaxe'] + " :";

        // Si la taxe provinciale existe, on l'affiche
        if (this._taxeProvinciale != null ) {

            this._elTexteTaxeProvinciale.innerHTML = this._taxeProvinciale['nomTaxe'] + " :";
            taxeProvinciale =  parseFloat(this._taxeProvinciale['taux']);
        } else {
            this._elPProvinciale.classList.add('hidden');
        }

        this._elPasserCmd.classList.add('hidden');
        this._elTotalFinal.classList.remove('hidden');
       
        this.calculTaxe(taxeFederale, taxeProvinciale);
    }

    calculTaxe = (taxeFederale, taxeProvinciale) => {
        let montantPartiel =  parseFloat(this._elTotalPartiel.innerHTML),
            tps = (montantPartiel * taxeFederale).toFixed(2),
            tvq = 0,
            total = 0;
      
        if (this._taxeProvinciale != null ) {
            tvq = (montantPartiel * taxeProvinciale).toFixed(2);
            this._elTvq.innerHTML = tvq;
        }

        total = parseFloat(tps) + parseFloat(tvq) + montantPartiel;

        this._elTps.innerHTML = tps;         
        this._elTotal.innerHTML = total;
    }

    expedition = () => {
        
        sessionStorage.setItem('idExpedition', this._elExpedition.value);

        if(parseInt(this._elExpedition.value) > 0) {
            this._elTaxation.classList.remove('hidden');   
        }
        else {
            this._elTaxation.classList.add('hidden');
        }
    }
}