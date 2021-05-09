class TraiterCommande {

    constructor(el) {
        this._el = el;
        this._elMagasiner = this._el.querySelector('[data-js-magasiner]'); 
        this._elCommander = this._el.querySelector('[data-js-commander]');  
        this._elTotalPartiel = this._el.querySelector('h3'); 
        this._elTotalFinal = this._el.querySelector('[data-js-total-final]'); 
        this._elTotal = this._el.querySelector('[data-js-total]'); 
        this._elTvq = this._el.querySelector('[data-js-tvq]'); 
        this._elTps = this._el.querySelector('[data-js-tps]'); 
                
                
        this.init();
        console.log(this._el); 
        console.log(this._elTotalFinal); 
        console.log(this._elTotalPartiel);
        console.log(this._elMagasiner);  
        console.log(this._elCommander);
        console.log(this._elTotal);
        console.log(this._elTvq);
        console.log(this._elTps); 
          
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
        this._elTotalPartiel.classList.add('hidden');
        this._elTotalFinal.classList.remove('hidden');
    }
}