class GestionMarque {
    constructor(el) {
        this._el = el;
        this._elsBtnModifier = this._el.querySelectorAll('[data-js-modifier]');
        this._elsBtnSupprimer = this._el.querySelectorAll('[data-js-supprimer]');

        this.init();
    }

    init = () => {

        //Brancher le gestionnaire click sur les bouttons Modifier
        for (let i = 0, l = this._elsBtnModifier.length; i < l; i++) {
            this._elsBtnModifier[i].addEventListener('click', (e) => {
                e.preventDefault();
                
                this.modifierMarque(e.target.dataset.jsId);
            });
        }

        //Brancher le gestionnaire click sur les bouttons Supprimer
        for (let i = 0, l = this._elsBtnSupprimer.length; i < l; i++) {
            this._elsBtnSupprimer[i].addEventListener('click', (e) => {
                e.preventDefault();
                
                console.log(e.target.dataset.jsId);
            });
        }
    }

    modifierMarque = (id) => {
        // Déclaration de l'objet XMLHttpRequest
        var xhr;
        xhr = new XMLHttpRequest();
        
        // Initialisation de la requète
        if (xhr) {	

            // Ouverture de la requète : fichier recherché
            xhr.open('GET', 'index.php?GestionDonnees_AJAX&action=afficherFormulaireMarque&id=' + id);

            xhr.addEventListener('readystatechange', () => {

                if (xhr.readyState === 4) {							
                    if (xhr.status === 200) {

                        // Les données ont été reçues
                        // Traitement du DOM
                        this._el.innerHTML = xhr.responseText;

                    } else if (xhr.status === 404) {
                        console.log('Le fichier appelé dans la méthode open() n’existe pas.');
                    }
                }
            });

            // Envoi de la requète
            xhr.send();
        }
    }
}