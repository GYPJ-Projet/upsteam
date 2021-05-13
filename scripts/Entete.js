class Entete{
    constructor(el){
        this._el =  el;  
        /* Gestion Langue*/                                                          
        this._elCodeLangue = this._el.querySelector('[data-js-codeLangue]');
        this._elLangue = this._el.querySelector('[data-js-langue]');
        this._elDeconnexion = this._el.querySelector('[data-js-deconnexion]');
        this._elControleur = document.querySelector('[data-js-controleur]');
        this._elControleurAction = document.querySelector('[data-js-controleur-action]');
        
       /* Panier */
       this._panier = document.querySelector('[data-js-panier]');
       this._nbrVoiture = document.querySelector('[data-js-nombre-voiture]'); 
        
        this.init();

    }

    init = ()=> {
        
        this._elCodeLangue.addEventListener('click', this.changerLangue); 
        if(this._elDeconnexion){
            this._elDeconnexion.addEventListener('click', this.deconnexion); 
        }

        this.verifierPanier();  
        this._panier.addEventListener('click', this.afficherCommande); 
    }

    // Le chargement de la page dans la langue choisie
    changerLangue = () => {
        let nomControleur = this._elControleur.dataset.jsControleur,
            repertoireLangue = this._elLangue.dataset.jsLangue,
            contoleurAction  = this._elControleurAction.dataset.jsControleurAction;
           
        window.location.href = `index.php?${nomControleur}&action=changerLangue&langue=${repertoireLangue}&controleur-action=${contoleurAction}`;
        
    }

    verifierPanier = () => {
        if (sessionStorage.getItem('nombreVoiture')) {
            if (this._panier.classList.contains('vide')) { 
                this._panier.classList.replace('vide', 'fill');
                this._nbrVoiture.innerHTML = parseInt(sessionStorage.getItem('nombreVoiture'));
            }
        }
    }

    afficherCommande = () => {
        if (sessionStorage.getItem('panierAchat')) { 
                         
            let panier = sessionStorage.getItem("panierAchat");  
            
            window.location.href = "index.php?Commande&action=afficherCommande&panier=" + panier;            
        } 
    }

    /**
     * PH
     * Remove les locals storages à la déconnexion.
     */
    deconnexion= () =>{
        if (sessionStorage.getItem('panierAchat')) { 
            sessionStorage.removeItem("panierAchat"); 
            sessionStorage.removeItem("nombreVoiture");  
        }
        window.location.href = "index.php?Usager&action=deconnexion";
    }
}
