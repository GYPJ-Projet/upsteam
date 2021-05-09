class DescriptionVoiture {

       constructor(el) {
        this._el = el;       // l'élément Voiture de l'instance

        //Détail de la voiture 
        this._elId = this._el.querySelector('[data-js-voiture]');
        this._elImage = this._el.querySelector('[data-js-image="0"]');
        this._elMarque = this._el.querySelector('[data-js-voiture-marque]');
        this._elModele = this._el.querySelector('[data-js-voiture-modele]');
        this._elAnnee = this._el.querySelector('[data-js-voiture-annee]');
        this._elHabitacle = this._el.querySelector('[data-js-voiture-habitacle]');
        this._elCouleur = this._el.querySelector('[data-js-voiture-couleur]');
        this._elKilometrage = this._el.querySelector('[data-js-voiture-kilometrage]');
        this._elTransmission = this._el.querySelector('[data-js-voiture-transmission]');
        this._elCarburant = this._el.querySelector('[data-js-voiture-carburant]');
        this._elPrix = this._el.querySelector('[data-js-voiture-prix]');

        /*Bouton Ajout Panier */
        this._elBouton =  this._el.querySelector('[data-js-btn]');
  
        /* Panier */
        this._panier = document.querySelector('[data-js-panier]');
        this._nbrVoiture = document.querySelector('[data-js-nombre-voiture]');   
          
        this.init();    
    }

    //  Initialisation de la class Produits pour lui donner vie !
    init = () => {
        // Utilisation de la librairie Swiper au chargement de la page seulement
        window.addEventListener('DOMContentLoaded', () => {
            this.gestionCarrouselle();            
        });

        this._elBouton.addEventListener('click', (e) => {
            e.preventDefault();
            
            // le Panier est cliquable
            if (this._panier.classList.contains('vide')) { 
                this._panier.classList.replace('vide', 'fill');
            }

            this.ajoutDansPanier();   

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

    
    ajoutDansPanier = (e) => {

       // Incrémente le nombre de voiture affiché dans le header
        if (!localStorage.getItem('nombreVoiture')) {

            localStorage.setItem('nombreVoiture', 1);

            this._nbrVoiture.innerHTML = 1;
        }
        else {
            let nbrVoiture = parseInt(localStorage.getItem('nombreVoiture')) + 1;
            localStorage.setItem('nombreVoiture', nbrVoiture);
            this._nbrVoiture.innerHTML = nbrVoiture;
        }
            
        // Ajouter le produit dans le sessionStorage panierAchat
        let panier = [];                    

        if (!localStorage.getItem('panierAchat')) { 

            this.creerPanier(panier);                
                   
            localStorage.setItem('panierAchat', JSON.stringify(panier));
       }
        
        else {
            panier = JSON.parse(localStorage.getItem('panierAchat'));

            let idVoiture = this._elId.dataset.jsVoiture,
                existVoiture = false;
            if (panier.length > 0) { 
                for(let i = 0; i < panier.length; i++) {        //Boucle à travers les voitures présents,
                    if(panier[i] != null) { 
                        if (idVoiture === panier[i].id) {
                            existVoiture = true;                 //Incrémente si c'est le même item qu'on ajoute dans le panier
                            panier[i].quantite++;               //On augmente la quantité du panier à cahque ajout.
                        }
                    }                
                } 
                    
                if (existVoiture == false) {

                    this.creerPanier(panier);                    
                }
                
            } else {

                this.creerPanier(panier);                
            }   
            
            localStorage.setItem('panierAchat', JSON.stringify(panier));
        }          
    }

    creerPanier = (panier) => {
        let voiture = {};
        
        voiture.id = this._elId.dataset.jsVoiture;
        voiture.image = this._elImage.src;   
        voiture.marque = this._elMarque.dataset.jsVoitureMarque;
        voiture.modele = this._elModele.dataset.jsVoitureModele;
        voiture.annee = this._elAnnee.dataset.jsVoitureAnnee;
        voiture.habitacle = this._elHabitacle.dataset.jsVoitureHabitacle;
        voiture.couleur = this._elCouleur.dataset.jsVoitureCouleur;
        voiture.kilometrage = this._elKilometrage.dataset.jsVoitureKilometrage;
        voiture.transmission = this._elTransmission.dataset.jsVoitureTransmission;
        voiture.carburant = this._elCarburant.dataset.jsVoitureCarburant;
        voiture.prix = this._elPrix.dataset.jsVoiturePrix;
        voiture.quantite = 1;

        //panier.push(voiture);
        panier[parseInt(voiture.id)] = voiture;
    }
}
