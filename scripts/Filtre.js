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
                this.populationModele();
            });
        }
    }

    populationModele =()=>{
        // Fabrique une liste utilisable pour SQL.
        let liste = "";
        if(this._listeMarquesSelectionnes.length > 0){
            console.log('liste non vide');
            for(let i=0, j=this._listeMarquesSelectionnes.length; i<j; i++){
                liste += this._listeMarquesSelectionnes[i];
                if(i+1 < j){
                    liste += ',';
                }
            }
        }

        // Ajax qui appel 

        // Déclaration de l'objet XMLHttpRequest
        let xhr;
        xhr = new XMLHttpRequest();

        //Initialisation de la requète
        if (xhr) {
            // Ouverture de la requète : fichier recherché
            xhr.open('GET', `index.php?Store_AJAX&action=checkClient&email=${this._infoClient.email}`);
            
            xhr.addEventListener("readystatechange", () => {
                if (xhr.readyState === 4) {							
                    if (xhr.status === 200) {
                        // Les données ont été reçues ont les affiches
                        let data = JSON.parse(xhr.response);
                        if(data === false){
                            this.addClient();
                        }else{
                            this._clientKey = true;
                            this.checkValid();
                        }
                        
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