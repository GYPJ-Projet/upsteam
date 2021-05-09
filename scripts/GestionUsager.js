class GestionUsager {
    constructor(el) {
        this._el = el;
        this._elsTri = this._el.querySelectorAll('[data-js-tri]');
        this._elsPage = this._el.querySelectorAll('[data-js-page]');
        this.pageActive = this._el.querySelector('[data-js-pageActive]');

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
                //Trier les champs
                let tri = e.target.dataset.jsTri;
                let ordre = e.target.dataset.jsOrdre;
                let page = this.pageActive.dataset.jsPageactive;
                
                if (tri == undefined) tri = e.target.parentNode.dataset.jsTri;
                if (ordre == undefined) ordre = e.target.parentNode.dataset.jsOrdre;
                if (page == undefined) page = 1;
                // Redireger vers controleur
                window.location.href = 'index.php?Usager&action=gestionUsager&tri=' + tri + '&ordre=' + ordre + '&page=' + page;
            });
        }

        //Brancher le gestionnaire click sur les bouttons Pagination
        for (let i = 0, l = this._elsPage.length; i < l; i++) {
            this._elsPage[i].addEventListener('click', (e) => {
                e.preventDefault();
                
                //Obtenir les parametères de tri
                let tri, ordre;
                for (let i = 0, l = this._elsTri.length; i < l; i++) {
                    if (this._elsTri[i].classList.contains("inactif")) {
                        tri = this._elsTri[i].dataset.jsTri;
                        ordre = this._elsTri[i].dataset.jsOrdre;
                    } 
                }
                
                //Obtenir le numéro de la page qu'il faut afficher
                let page = e.target.dataset.jsPage;
                
                if (tri == undefined) tri = 'id';
                if (ordre == undefined) ordre = 'ASC';
                if (page == undefined) page = '1';

                window.location.href = 'index.php?Usager&action=gestionUsager&tri=' + tri + '&ordre=' + ordre + '&page=' + page;
            });
        }

    }

    // Activer les autres boutons pour pouvoir trier
    activer = (i) => {
        var els = Array.from(this._elsTri);
        els.splice(i, 1);
        for (let i = 0, l = els.length; i < l; i++) {
            els[i].firstChild.classList.remove("inactif");
        }
    }
            
}