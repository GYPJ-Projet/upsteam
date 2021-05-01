class Chercher{
    constructor(element){
        this._element =                 element;                                                            //les éléments du menu.
        this._elBoutonVoirPlus =            document.querySelector('[data-js-btn]');                        //Pour cacher lorsque le filtre

        this.init();
    }

    init =()=>{
        window.addEventListener('load',this.demarragePage);
        this._element.addEventListener('change', this.chercher);
        
    }

    /**
     * PH
     * Pour gestion du démarrage de la page.
     * -Cache bouton "voir plus"  si nécessaire
     */
    demarragePage =()=>{
        this.cacheBoutonVoirPlus();
    }

    /**
    * Cache le bouton filtre en ajoutant la classe cacher si action = 'chercher'.
    */
    cacheBoutonVoirPlus =()=>{
        if(this._element.dataset.jsAction === 'chercher'){
            this._elBoutonVoirPlus.classList.add('cacher');
        }
    }

    /**
     * PH
     * Prépare la "querystring" et procéde vers le controleur.
     */
    chercher =()=>{
        let resultat = 'index.php?Voiture&action=chercher&critere=',
            contenue = "'" + this._element.value +  "'";
        
        resultat +=  contenue

        window.location.href = resultat;
    }
}