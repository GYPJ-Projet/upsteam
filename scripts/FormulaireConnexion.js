class FormulaireConnexion{
    constructor(el){
        this._el                =  el;                                                            
        this._elBtnCreerCompte  = this._el.querySelector('[data-js-btnCreerCompte]');
        this._elBtnMotPassePerdu  = this._el.querySelector('[data-js-btnMotPassePerdu]');
        
        this.init();
    }

    init = ()=> {
        
        this._elBtnCreerCompte.addEventListener('click', this.creerCompte);  
        this._elBtnMotPassePerdu.addEventListener('click', this.motPassePerdu);  
    }

    creerCompte = ()=> {
        window.location.href ='index.php?Usager&action=creerUsager';
    }

    motPassePerdu = ()=> {
        window.location.href ='index.php?Usager&action=formulaireMotPassePerdu';
    }

}