class Voiture {

       constructor(el) {
        this._el = el;       // l'élément Voiture de l'instance

        this._id = parseInt(this._el.dataset.jsVoiture); // Le numéro de l'ID de cet article 

        this.init();
    
    }

    //  Initialisation de la class Produits pour lui donner vie !
    init = () => {
        this._el.addEventListener('click', this.descriptionVoiture);   
    }
    
    
    // Les transferts du menu
    descriptionVoiture = (e) =>{
        e.preventDefault();
        window.location.href = 'index.php?Voiture&action=descriptionVoiture&id=' + this._id;
    }

 
  
}