class Filtre{
    constructor(element){
        //les éléments du filtre.
        this._element =                     element;
        this._listeMarquesSelectionnes =    [];
        this._elListeMarque =               this._element.querySelector('[data-js-modeleConteneur]')
        this._listeMarquesAffiches =        this._element.querySelectorAll('[data-js-marque]');
        this._SymbolesPlus =                this._element.querySelectorAll('[data-js-SymbolePlus]');
        this._elInputs =                    this._element.querySelectorAll('input');

        console.log('this._elInputs: ',this._elInputs);

        this.init();
    }

    init =()=>{

        this.gestionPlus();
        this.populationModele();
        this.listeModelesSelectionnes();
        this.gestionFiltre();
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

    /**
     * Commence par créer une liste utilisable par le sql.
     * Fabrique la "querystring" qui sera utilisé pour le AJAX
     *      Option1: tout les modèles
     *      Option2: seulement les modèles sélectionnés.
     * Call AJAX et popule la liste de modele dans le filtre
     */
    populationModele =()=>{
        // Fabrique une liste utilisable pour SQL.
        let liste = "",
            chaineRequete="index.php?Voiture_AJAX&action=",
            xhr = new XMLHttpRequest();

        if(this._listeMarquesSelectionnes.length > 0){
            for(let i=0, j=this._listeMarquesSelectionnes.length; i<j; i++){
                liste += this._listeMarquesSelectionnes[i];
                if(i+1 < j){
                    liste += ',';
                }
            }
        }

        // On fabrique la chaîne de requête.
        if(this._listeMarquesSelectionnes.length <= 0 ){
            chaineRequete += 'obtenirToutModele';
        }else{
            chaineRequete += 'obtenirSelectionModele&liste=' + liste;
        }

        // Initialisation de la requète AJAX.
        if (xhr) {
            // Ouverture de la requète : fichier recherché
            xhr.open('GET', chaineRequete);
            
            xhr.addEventListener("readystatechange", () => {
                if (xhr.readyState === 4) {							
                    if (xhr.status === 200) {
                        // Les données ont été reçues ont les affiches
                        let data = JSON.parse(xhr.response),
                            resultat = "";

                        // Traitement et affichage.
                        if(data != false){
                            for(let element of data){
                                resultat += `   <div class="listeConteneur">
                                                    <label for="${element.nom}">${element.nom}</label>
                                                    <input class="radio" type="checkbox" id="${element.nom}" name="${element.nom}" value="${element.nom}" data-js-modele="${element.id}">
                                                </div>`;
                            }
                            this._elListeMarque.innerHTML = resultat;
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

    gestionFiltre =()=>{
        for(let marque of this._listeMarquesAffiches){
            marque.addEventListener('click', ()=>{
                console.log('test');
            });
        }
    }
}