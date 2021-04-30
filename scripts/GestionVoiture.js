class GestionVoiture {
    constructor(el) {
        this._el = el;
        this._elsBtnModifier = this._el.querySelectorAll('[data-js-modifier]');
        this._elBtnAjouter = this._el.querySelector('[data-js-ajouter]');
        this._elsTri = this._el.querySelectorAll('[data-js-tri]');
        this.page = this._el.querySelector('[data-js-page]').dataset.jsPage;

        this.init();
    }

    init = () => {

        //Brancher le gestionnaire click sur les symboles Trier
        for (let i = 0, l = this._elsTri.length; i < l; i++) {
            this._elsTri[i].addEventListener('click', (e) => {
                e.preventDefault();
                
                //Cacher le symbole de tri
                e.target.parentNode.classList.add("inactif");
                //Afficher tous les autres boutons 
                this.activer(i);
                //Trier les champs, redireger vers controleur
                let tri = e.target.dataset.jsTri;
                let ordre = e.target.dataset.jsOrdre;
                if (tri == undefined) tri = e.target.parentNode.dataset.jsTri;
                if (ordre == undefined) ordre = e.target.parentNode.dataset.jsOrdre;

                window.location.href = 'index.php?GestionDonnees&action=gestionVoiture&tri=' + tri + '&ordre=' + ordre + '&page=' + this.page;
            });
        }
        
        //Brancher le gestionnaire click sur les bouttons Modifier
        for (let i = 0, l = this._elsBtnModifier.length; i < l; i++) {
            this._elsBtnModifier[i].addEventListener('click', (e) => {
                e.preventDefault();
                
                this.modifierVoiture(e.target.dataset.jsId);
            });
        }

        //Brancher le gestionnaire click sur les bouttons Ajouter
        this._elBtnAjouter.addEventListener('click', (e) => {
            e.preventDefault();
            
            this.modifierVoiture(0);
        });

    }

    // Activer les autres boutons pour pouvoir trier
    activer = (i) => {
        var els = Array.from(this._elsTri);
        els.splice(i, 1);
        for (let i = 0, l = els.length; i < l; i++) {
            els[i].firstChild.classList.remove("inactif");
        }
    }
                
    modifierVoiture = (id) => {
        // Déclaration de l'objet XMLHttpRequest
        var xhr;
        xhr = new XMLHttpRequest();
        
        // Initialisation de la requète
        if (xhr) {	

            // Ouverture de la requète : fichier recherché
            xhr.open('GET', 'index.php?GestionDonnees_AJAX&action=afficherFormulaireVoiture&id=' + id + '&page=' + this.page);

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