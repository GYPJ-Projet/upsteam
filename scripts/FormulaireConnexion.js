class FormulaireConnexion{
    constructor(el){
        this._el                =  el;                                                            
        this._elBtnCreerCompte  = this._el.querySelector('[data-js-btnCreerCompte]');
        
        this.init();
    }

    init = ()=> {
        
        this._elBtnCreerCompte.addEventListener('click', this.creerCompte);  
    }

    creerCompte = ()=> {
        window.location.href ='index.php?Usager&action=creerUsager';
    }
}