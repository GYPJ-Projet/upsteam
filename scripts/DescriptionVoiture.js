class DescriptionVoiture {

       constructor(el) {
        this._el = el;       // l'élément Voiture de l'instance

        //Détail de la voiture 
        this._id = this._el.querySelector('[data-js-voiture]');
        this._image = this._el.querySelector('[data-js-image="0"]');
        this._marque = this._el.querySelector('[data-js-voiture-marque]');
        this._modele = this._el.querySelector('[data-js-voiture-modele]');
        this._annee = this._el.querySelector('[data-js-voiture-annee]');
        this._habitacle = this._el.querySelector('[data-js-voiture-habitacle]');
        this._couleur = this._el.querySelector('[data-js-voiture-couleur]');
        this._kilometrage = this._el.querySelector('[data-js-voiture-kilometrage]');
        this._transmission = this._el.querySelector('[data-js-voiture-transmission]');
        this._carburant = this._el.querySelector('[data-js-voiture-carburant]');
        this._prix = this._el.querySelector('[data-js-voiture-prix]');

        /*Bouton Ajout Panier */
        this._elBouton =  this._el.querySelector('[data-js-btn]');
  
        /* Panier */
        this._panier = document.querySelector('[data-js-panier]');
        this._nbrVoiture = document.querySelector('[data-js-nombre-voiture]');   
          
        console.log(this._el); 
        console.log(this._image.src); 
        console.log(this._id.dataset.jsVoiture);       
        console.log(this._marque.dataset.jsVoitureMarque);       
        console.log(this._modele.dataset.jsVoitureModele);       
        console.log(this._annee.dataset.jsVoitureAnnee);       
        console.log(this._habitacle.dataset.jsVoitureHabitacle);       
        console.log(this._couleur.dataset.jsVoitureCouleur);       
        console.log(this._kilometrage.dataset.jsVoitureKilometrage);       
        console.log(this._transmission.dataset.jsVoitureTransmission);       
        console.log(this._carburant.dataset.jsVoitureCarburant);       
        console.log(this._prix.dataset.jsVoiturePrix);       
        console.log(this._elBouton);
        console.log(this._panier);
        console.log(this._nbrVoiture);


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
            
            // Rendre le Panier est cliquable
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
        } else {
            let nbrVoiture = parseInt(localStorage.getItem('nombreVoiture')) + 1;
            localStorage.setItem('nombreVoiture', nbrVoiture);
            this._nbrVoiture.innerHTML = nbrVoiture;
        }
            
        // Ajouter le produit dans le sessionStorage panierAchat
        let voiture = {},
            panier;                    

        if (!localStorage.getItem('panierAchat')) { 

            panier = [];
            voiture.id = this._id.dataset.jsVoiture;
            voiture.image = this._image.src;   
            voiture.marque = this._marque.dataset.jsVoitureMarque;
            voiture.modele = this._modele.dataset.jsVoitureModele;
            voiture.annee = this._annee.dataset.jsVoitureAnnee;
            voiture.habitacle = this._habitacle.dataset.jsVoitureHabitacle;
            voiture.couleur = this._couleur.dataset.jsVoitureCouleur;
            voiture.kilometrage = this._kilometrage.dataset.jsVoitureKilometrage;
            voiture.transmission = this._transmission.dataset.jsVoitureTransmission;
            voiture.carburant = this._carburant.dataset.jsVoitureCarburant;
            voiture.prix = this._prix.dataset.jsVoiturePrix;
            voiture.quantite = 1;
                    
            panier.push(voiture);       
            localStorage.setItem('panierAchat', JSON.stringify(panier));
       }
        
        else {
            panier = JSON.parse(localStorage.getItem('panierAchat'));

            let idVoiture = this._id.dataset.jsVoiture,
                nbrIdVoiture = false;
            if (panier.length > 0) { 
                for(let i = 0; i < panier.length; i++) {  //Boucle à travers les voitures présents,
                    if (idVoiture === panier[i].id) {
                        nbrIdVoiture = true;                 //Incrémente si c'est le même item qu'on ajoute dans le panier
                        panier[i].quantite++;               //On augmente la quantité du panier à cahque ajout.
                    }                
                } 
                    
                if (nbrIdVoiture == false) {
                            
                    voiture.id = this._id.dataset.jsVoiture;
                    voiture.image = this._image.src;   
                    voiture.marque = this._marque.dataset.jsVoitureMarque;
                    voiture.modele = this._modele.dataset.jsVoitureModele;
                    voiture.annee = this._annee.dataset.jsVoitureAnnee;
                    voiture.habitacle = this._habitacle.dataset.jsVoitureHabitacle;
                    voiture.couleur = this._couleur.dataset.jsVoitureCouleur;
                    voiture.kilometrage = this._kilometrage.dataset.jsVoitureKilometrage;
                    voiture.transmission = this._transmission.dataset.jsVoitureTransmission;
                    voiture.carburant = this._carburant.dataset.jsVoitureCarburant;
                    voiture.prix = this._prix.dataset.jsVoiturePrix;
                    voiture.quantite = 1;
                            
                    panier.push(voiture);

                }
            } else {
                voiture.id = this._id.dataset.jsVoiture;
                voiture.image = this._image.src;   
                voiture.marque = this._marque.dataset.jsVoitureMarque;
                voiture.modele = this._modele.dataset.jsVoitureModele;
                voiture.annee = this._annee.dataset.jsVoitureAnnee;
                voiture.habitacle = this._habitacle.dataset.jsVoitureHabitacle;
                voiture.couleur = this._couleur.dataset.jsVoitureCouleur;
                voiture.kilometrage = this._kilometrage.dataset.jsVoitureKilometrage;
                voiture.transmission = this._transmission.dataset.jsVoitureTransmission;
                voiture.carburant = this._carburant.dataset.jsVoitureCarburant;
                voiture.prix = this._prix.dataset.jsVoiturePrix;
                voiture.quantite = 1;
                        
                panier.push(voiture);
            }   
            
            localStorage.setItem('panierAchat', JSON.stringify(panier));
        }          
    }
}
