class Filtre{
    constructor(element){
        //les éléments du filtre.
        this._element =                     element;
        this._elBoutonVoirPlus =            document.querySelector('[data-js-btn]');                        //Pour cacher lorsque le filtre
        this._iconeFiltre =                 document.querySelector('[data-js-iconeFiltre]');                //Icône de filtre. pour petite fenêtre.
        this._listeMarquesSelectionnes =    [];                                                             //Pour populer les modèles
        this._elListeModele =               this._element.querySelector('[data-js-modeleListeConteneur]');  //Pour pouvoir afficher dedans.
        this._listeMarquesAffiches =        this._element.querySelectorAll('[data-js-marque]');             //Toutes les marques!
        this._SymbolesPlus =                this._element.querySelectorAll('[data-js-SymbolePlus]');        //Gestion des bouton +
        this._elBoutonFiltre =              this._element.querySelector('[data-js-boutonFiltre]');          //pour eventlistener
        this._elBoutonVider =               this._element.querySelector('[data-js-boutonVider]');           //pour eventlistener


        this._elConteneurPrix =             this._element.querySelector('[data-js-prixConteneur]');         //Liste des conteneur de section pour
        this._elConteneurMarque =           this._element.querySelector('[data-js-marqueConteneur]');       //filtrer les listes d'item sélectionnés.
        this._elConteneurModele =           this._element.querySelector('[data-js-modeleConteneur]');
        this._elConteneurAnnee =            this._element.querySelector('[data-js-anneeConteneur]');
        this._elConteneurKm =               this._element.querySelector('[data-js-kmConteneur]');
        this._elConteneurCarburant =        this._element.querySelector('[data-js-carburantConteneur]');
        this._elConteneurCarrosserie =      this._element.querySelector('[data-js-carrosserieConteneur]');
        this._elConteneurTransmission =     this._element.querySelector('[data-js-transmissionConteneur]');
        this._elConteneurPropulsion =       this._element.querySelector('[data-js-propulsionConteneur]');

        
        this.init();
    }

    init =()=>{

        this.displayWindowSize(); // On vérifie la grandeur de l'écran en partant.
        
        window.addEventListener('resize', this.displayWindowSize);                  //Gestion de l'affichage du type de menu burger ou non.
        window.addEventListener('load',this.demarragePage);
        this._elBoutonVider.addEventListener('click', this.viderFiltre);            //Redémarre la page afin de ne plus avoir de filtre.

        this.gestionPlus();
        this.populationModele();
        this.clickModelesSelectionnes();
        this.gestionFiltre();
        this.viderFiltre();

        this._iconeFiltre.addEventListener('click', this.boutonBurger);             //Gestion du clique de l'icone
    }

    /**
     * PH
     * S'assure d'afficher les modèles adéquats en fonction des choix utilisateurs
     * au démarrage de la page.
     * Aussi cache le bouton "Voir plus", si le filtre est activé.
     */
    demarragePage =()=>{
        for(let marque of this._listeMarquesAffiches){

            if(marque.checked === true){
                this._listeMarquesSelectionnes.push(marque.dataset.jsMarque);
            }
            this.populationModele();
        }

        this.cacheBoutonVoirPlus();
    }

    /**
     * PH
     * Crée les eventListeners qui:
     * Lors d'un clique sur un modele ajoute ou retire le modele de la liste
     * qui sera utiliser pour faire la requête ajax.
     * Finalement, appel populationModele.
     */
    clickModelesSelectionnes =()=>{
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
     * PH
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
            modeleRecu = this._elConteneurModele.dataset.jsModeleconteneur, //Pour permettre de sélectionner les modèles sélectionner au retour dans la page.
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
                                                    <input class="radio" type="checkbox" id="${element.nom}" name="${element.nom}" value="${element.nom}" data-js-modele="${element.id}" ${(modeleRecu.search(element.nom) != -1) ? "checked" : ""}>
                                                </div>`;
                            }
                            this._elListeModele.innerHTML = resultat;
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

    /**
     * PH
     * On fabrique la "querystring" qui va appeler la requête SQL.
     * Finalement, on appel le controleur.
     */
    gestionFiltre =()=>{
        this._elBoutonFiltre.addEventListener('click', (evt)=>{
            evt.preventDefault();
            let inputPrix           = this._elConteneurPrix.querySelector('select'),
                inputMarque         = this._elConteneurMarque.querySelectorAll('input'),
                inputModele         = this._elConteneurModele.querySelectorAll('input'),
                inputAnnee          = this._elConteneurAnnee.querySelectorAll('input'),
                inputKm             = this._elConteneurKm.querySelector('select'),
                inputCarburant      = this._elConteneurCarburant.querySelectorAll('input'),
                inputCarrosserie    = this._elConteneurCarrosserie.querySelectorAll('input'),
                inputTransmission   = this._elConteneurTransmission.querySelectorAll('input'),
                inputPropulsion     = this._elConteneurPropulsion.querySelectorAll('input'),
                resultat            ='';

                this.testAnnee(inputAnnee);
  
            //On vérifie le contenur de tout les champs par section de recherche.
            let prixResultat = '&' + inputPrix.value,
                marqueResultat = '&marques=' + this.verifSection(inputMarque, 'marque.nom'),
                modeleResultat = '&modele=' + this.verifSection(inputModele, 'modele.nom'),
                anneeResultat = `&anneeDeb=${inputAnnee[0].value}&anneeFin=${inputAnnee[1].value}`,
                kmResultat = '&' + inputKm.value,
                carburantResultat = '&carburant=' + this.verifSection(inputCarburant, 'typecarburant.nom'),
                carrosserieResultat = '&carrosserie=' + this.verifSection(inputCarrosserie, 'typecarrosserie.nom'),
                transmissionResultat = '&transmission=' + this.verifSection(inputTransmission, 'transmission.nom'),
                propulsionResultat = '&propulsion=' + this.verifSection(inputPropulsion, 'motopropulseur.nom');

            // CHAÎNE DE REQUÊTE ***************************************

            resultat += 'index.php?Voiture&action=filtre'
                    + prixResultat
                    + marqueResultat
                    + modeleResultat
                    + anneeResultat
                    + kmResultat
                    + carburantResultat
                    + carrosserieResultat
                    + transmissionResultat
                    + propulsionResultat;

            window.location.href = resultat;
        });
    }

    /**
     * PH
     * Test pour savoir si la chaine retourner par verifList est vide.
     * Si vide: on retourne le paramètre siVide
     * Sinon on utilise ce que verifList à trouvé.
     * @param {*} leInput Liste de input à tester
     * @param {*} siVide  paramètre qui doit être envoyé au modele si aucune sélection.
     * @returns 
     */
    verifSection =(leInput, siVide)=>{
        let resultat = '',
            temp = '';

        temp = this.verifList(leInput);

        if(temp === ''){
            temp = siVide;
        }
        return resultat += temp;
    }


    /**
     * PH
     * liste toutes les option qui sont "checked".
     * Pour les checkbox comme les marques.
     * @param {*} leInput La série de inputs à vérifier
     * @returns 
     */
    verifList = (leInput) =>{
        let listeTemp = '';
    
        for(let i = 0, j = leInput.length; i<j ; i++ ){
            if(leInput[i].checked){
                if(listeTemp.length > 0){
                    listeTemp += ',';
                }
                listeTemp += `'${leInput[i].value}'`;
            }
        }
        return listeTemp;
    }

    /**
     * PH
     * Séri de validation des années.
     * Seul paramètre avec input direct de l'usagé.
     * Test:
     *      Année Début vide
     *      Année Fin vide
     *      Année Début plus élevé que Année Fin.
     * 
     * @param {*} leInput Les deux champs à tester.
     */
    testAnnee = (leInput) =>{
        if(leInput[0].value === ""){
            leInput[0].value = new Date().getFullYear() - 20;
        }

        if(leInput[1].value === ""){
            leInput[1].value = new Date().getFullYear() + 1;
        }

        if(leInput[0].value > leInput[1].value){
            leInput[0].value = new Date().getFullYear() - 20;
            leInput[1].value = new Date().getFullYear() + 1;
        }
    }

    /**
     * PH
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
     * Cache le bouton filtre en ajoutant la classe cacher.
     */
    cacheBoutonVoirPlus =()=>{
        if(this._element.dataset.jsAction === 'filtre'){
            this._elBoutonVoirPlus.classList.add('cacher');
        }
    }


        /**
     * Affiche le menu en fonction de la taille de la page.
     */
    displayWindowSize = () =>{
        // if(window.innerWidth <= 414 && this._iconeBurger.classList.contains('cacher')){
        if(window.innerWidth <= iPhone){
            this._iconeFiltre.classList.remove('cacher');
            this._element.classList.add('burger');
            this._element.classList.add('cacher');
        }else{
        // }else if(window.innerWidth >= 414 &&! this._iconeBurger.classList.contains('cacher')){
            this._iconeFiltre.classList.add('cacher');
            this._element.classList.remove('burger');
            this._element.classList.remove('cacher');
        }

    }

    /**
     * Gère l'état du menu en fonction de l'évènement de 
     * clique sur un bouton.
     */
    boutonBurger = ()=>{
        if(this._element.classList.contains('cacher')){
        this._element.classList.remove('cacher');
        }else{
        this._element.classList.add('cacher');
        }
    }

    viderFiltre =(e)=>{
        e.preventDefault();
        window.location.href ='index.php?Voiture';
    }
}