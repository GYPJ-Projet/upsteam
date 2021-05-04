class TraiterPanier {

       constructor(el) {
        this._el = el;       // l'élément Voiture de l'instance

         /* Détail de la voiture */
        this._id = this._el.querySelector('[data-js-voiture]');
        this._marque = this._el.querySelector('[data-js-marque]');
        this._modele = this._el.querySelector('[data-js-modele]');
        this._annee = this._el.querySelector('[data-js-annee]');
        this._habitacle = this._el.querySelector('[data-js-habitacle]');
        this._couleur = this._el.querySelector('[data-js-couleur]');
        this._kilometrage = this._el.querySelector('[data-js-kilometrage]');
        this._transmission = this._el.querySelector('[data-js-transmission]');
        this._carburant = this._el.querySelector('[data-js-carburant]');
        this._prix = this._el.querySelector('[data-js-prix]');

        /*Bouton Ajout Panier */
        this._elBouton =  this._el.querySelector('[data-js-btn]');

        /* Panier */
        this._Panier = document.querySelector('[data-js-panier]');
        this._elNbrItem = document.querySelector('[data-js-nombre-item]');        

        this.init();    
    }

    //  Initialisation de la class Produits pour lui donner vie !
    init = () => {
        // Utilisation de la librairie Swiper au chargement de la page seulement
        window.addEventListener('DOMContentLoaded', () => {
            this.gestionCarrouselle();
 
            /* this._el.addEventListener('click', this.descriptionVoiture);    */
        });
    }
    
    
    // Les transferts du menu
    descriptionVoiture = (e) =>{
        e.preventDefault();
        window.location.href = 'index.php?Voiture&action=descriptionVoiture&id=' + this._id;
    }

     // Méthode qui appelle un plugin qui gère le carrouselle que le prof Simon  nous a enseigné
     gestionCarrouselle = () =>{
        
        let swiper = new Swiper('.swiper-container', {
        
            // Optional parameters
            slidesPerView: 1,
            spaceBetween: 30, 
            loop: true,
            centeredSlides: true,
            autoplay: {
                delay: 10000,
                disableOnInteraction: false,
            },
        
            pagination: {
                el: '.swiper-pagination',
            },
    
            // Navigation arrows
            navigation: {
            nextEl: '.swiper-button-next',
            prevEl: '.swiper-button-prev',
            },
        });
    }
}