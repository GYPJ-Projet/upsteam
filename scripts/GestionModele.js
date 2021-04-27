class GestionModele {
    constructor(el) {
        this._el = el;
        this._elsBtnModifier = this._el.querySelectorAll('[data-js-modifier]');
        this._elBtnAjouter = this._el.querySelector('[data-js-ajouter]');

        this.init();
    }

    init = () => {

        //Brancher le gestionnaire click sur les bouttons Modifier
        for (let i = 0, l = this._elsBtnModifier.length; i < l; i++) {
            this._elsBtnModifier[i].addEventListener('click', (e) => {
                e.preventDefault();
                
                this.modifierModele(e.target.dataset.jsId);
            });
        }

        //Brancher le gestionnaire click sur les bouttons Ajouter
        this._elBtnAjouter.addEventListener('click', (e) => {
            e.preventDefault();
            
            this.modifierModele(0);
        });

    }

    modifierModele = (id) => {
        // Déclaration de l'objet XMLHttpRequest
        var xhr;
        xhr = new XMLHttpRequest();
        
        // Initialisation de la requète
        if (xhr) {	

            // Ouverture de la requète : fichier recherché
            xhr.open('GET', 'index.php?GestionDonnees_AJAX&action=afficherFormulaireModele&id=' + id);

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