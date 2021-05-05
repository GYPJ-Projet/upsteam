class FormulaireVoiture {
    constructor(el) {
        this._el = el;
        this._elPrixAchat = this._el.querySelector("#prixAchat");
        this._elPrixVente = this._el.querySelector("#prixVente");

        this.init();
    }

    init = () => {
        //Brancher le gestionnaire click sur l'élément input prix d'achat
        this._elPrixAchat.addEventListener('input', (e) => {
            e.preventDefault();

            this._elPrixVente.value = (this._elPrixAchat.value * 1.25);
        });
    }

}