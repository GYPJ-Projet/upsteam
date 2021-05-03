class MenuConteneur{
    constructor(element){
        this._element =                 element;                                                            //les éléments du menu.
        this._menuAcceuil =             this._element.querySelector('[data-js-menuAcceuil]');
        this._menuMonProfil =           this._element.querySelector('[data-js-menuMonProfil]');
        this._menuGestionDonnees =      this._element.querySelector('[data-js-menuGestionDonnees]');
        this._menuGestionEmployes =     this._element.querySelector('[data-js-menuGestionEmployes]');
        this._menuGestionCommandes =    this._element.querySelector('[data-js-menuGestionCommandes]');
        this._iconeBurger =             document.querySelector('[data-js-iconeBurger]');

        this.init();
    }

    init =()=>{
        this.displayWindowSize();

        this._menuAcceuil.addEventListener('click', this.menuAcceuil);                      //Les eventslisteners du menu
        if (this._menuMonProfil != null)
            this._menuMonProfil.addEventListener('click', this.menuMonProfil);
        
        if (this._menuGestionDonnees != null)
            this._menuGestionDonnees.addEventListener('click', this.menuGestionDonnees);
        
        if (this._menuGestionEmployes != null)
            this._menuGestionEmployes.addEventListener('click', this.menuGestionEmployes);
        
        if (this._menuGestionCommandes != null)
            this._menuGestionCommandes.addEventListener('click', this.menuGestionCommandes);

        this._iconeBurger.addEventListener('click', this.boutonBurger);             //Gestion du clique de l'icone

        window.addEventListener('resize', this.displayWindowSize);                  //Gestion de l'affichage du type de menu burger ou non.
    }

    // Les transferts du menu
    menuAcceuil = () =>{
        window.location.href = 'index.php?Voiture';
    }

    menuMonProfil = () =>{
        window.location = 'index.php?Usager';
    }

    menuGestionDonnees = () =>{
        window.location.href = 'index.php?GestionDonnees';
    }

    menuGestionEmployes = () =>{
        window.location.href = 'index.php?GestionUsagers';
    }

    menuGestionCommandes = () =>{
        window.location.href = 'index.php?GestionCommandes';
    }

    /**
     * Affiche le menu en fonction de la taille de la page.
     */
    displayWindowSize = () =>{
        // if(window.innerWidth <= 414 && this._iconeBurger.classList.contains('cacher')){
        if(window.innerWidth <= iPhone){
            this._iconeBurger.classList.remove('cacher');
            this._element.classList.add('burger');
            this._element.classList.add('cacher');
        }else{
        // }else if(window.innerWidth >= 414 &&! this._iconeBurger.classList.contains('cacher')){
            this._iconeBurger.classList.add('cacher');
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
}