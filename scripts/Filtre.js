class Filtre{
    constructor(element){
        //les éléments du filtre.
        this._element =                     element;
        this._listeMarquesSelectionnes =    [];
        this._listeMarquesAffiches =        this._element.querySelectorAll('[data-js-marque]');
        this._SymbolesPlus =                this._element.querySelectorAll('[data-js-SymbolePlus]');

        this.init();
    }

    init =()=>{

        this.gestionPlus();
        this.listeModelesSelectionnes();



    }

    /**
     * Pour chaque liste on permet de réduire ou agrandir la taille de la liste.
     */
    gestionPlus =()=>{
        for(let symbolePlus of this._SymbolesPlus){
            symbolePlus.addEventListener('click', ()=>{
                let cible = symbolePlus.parentNode.nextElementSibling,
                    plusGris = symbolePlus.firstElementChild,
                    plusBleu = symbolePlus.lastElementChild;

                //On cache si non caché et vise versa. 
                if(!cible.classList.contains('cacher')){
                    plusGris.classList.add('cacher');
                    plusBleu.classList.remove('cacher');
                    cible.classList.add('cacher');
                }else{
                    plusGris.classList.remove('cacher');
                    plusBleu.classList.add('cacher');
                    cible.classList.remove('cacher');
                }
            });
        }
    }

    /**
     * Crée les eventListeners qui:
     * Lors d'un clique sur un modele ajoute ou retire le modele de la liste
     * qui sera utiliser pour faire la requête ajax.
     * Finalement, appel populationModele.
     */
    listeModelesSelectionnes =()=>{
        for(let marque of this._listeMarquesAffiches){
            marque.addEventListener('click', ()=>{
                let exist = false;
                for(let i = 0, j = this._listeMarquesSelectionnes.length; i<=j; i++){
                    if(parseInt(marque.dataset.jsMarque) === parseInt(this._listeMarquesSelectionnes[i])){
                        exist = true;
                        this._listeMarquesSelectionnes.splice(i,1);
                    }
                }
                if(exist === false){
                    this._listeMarquesSelectionnes.push(marque.dataset.jsMarque);
                }
                console.log(this._listeMarquesSelectionnes);
                // this.populationModele();
            });
        }
    }

    populationModele =()=>{
        let liste = "";
        if(this._listeMarquesSelectionnes.length === 0){
            console.log('0');
        }else{
            // si un seul élement dans la liste.
            if(this._listeMarquesSelectionnes.length === 1){
                liste += this._listeMarquesSelectionnes[0];
            }else{
                for(let i=0, j=this._listeMarquesSelectionnes.length; i<j; i++){
                    liste += this._listeMarquesSelectionnes[i];
                    liste += ',';
                }
            }
        }
        console.log('liste: ',liste);
    }
}