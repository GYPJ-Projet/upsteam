class DescriptionVoiture {

       constructor(el) {
        this._el = el;       // l'élément Voiture de l'instance

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