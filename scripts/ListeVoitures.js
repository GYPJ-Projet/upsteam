class ListeVoitures {

       constructor(el) {
        this._el = el;       // l'élément conteneur de grille de l'instance ListeVoitures
        this._elGrille   =  this._el.querySelector('[data-js-results]'); // Element Grille 
        this._elAside    =  document.querySelector('[data-js-component="Filtre"]'); // Element aside
        this._elConteneur = document.querySelector('[data-js-bodyConteneur]');
 
        this.init();
    
    }

    // Initialisation de la class ListeVoitures pour lui donner vie, soit gérer 
    // la largeur de l'écran seulement !
    init = () => {
        this.displayWindowSize(); // On vérifie la grandeur de l'écran en partant.

        window.addEventListener('resize', this.displayWindowSize);  
    }
    
    
    // Affiche la grille de la section voiture en fonction de la taille de la page.
    // Calcule très difficiles, mais cela fonctionne bien pour le responsive de la 
    // grosseur de l'écran.
    displayWindowSize = () =>{

        // On prend la largeur du padding de l'élément "aside" calculé par le browser
        var largeurPaddingTuile = parseInt(getComputedStyle(this._elAside).marginLeft);

        // On calcule la largeur du conteneur des tuiles de voitures, soit de l'element "main"
        var largeurConteneurVoiture = this._elConteneur.clientWidth - this._elAside.clientWidth - (largeurPaddingTuile * 2) - 8; 

        // Si le conteneur peut contenir seulement une tuile dans l'écran 'un iPhone  
        if (largeurConteneurVoiture <= (iPhone + (largeurTuile-100)-1)) {
            // On retire la classe grille--? qui existe

            this.effacerClasseGrille(this._elGrille);
            
            // On ajoute la classe avec une seul colonne 
            this._elGrille.classList.add('grille--1');

          
        // Si le conteneur peut contenir seulement une tuile sans pouvoir en contenir 2 tuiles  ET que le conteneur entre dans l'écran d'un iPad
        } else if (largeurConteneurVoiture > largeurTuile && largeurConteneurVoiture <= ((largeurTuile*2) + largeurPaddingTuile) && largeurConteneurVoiture <= iPad) {
            this.effacerClasseGrille(this._elGrille);
           
            // On ajoute la classe avec deux colonne 
            this._elGrille.classList.add('grille--1');


        // Si le conteneur peut contenir 4 tuiles OU que le conteneur est plus grand que l'écran d'un iPadPro            
        } else if (largeurConteneurVoiture > ((largeurTuile*4) + (3*largeurPaddingTuile) + 26) || (largeurConteneurVoiture > iPadPro)) {
            // On retire la classe grille--? qui existe

            this.effacerClasseGrille(this._elGrille);

            // On ajoute la classe avec deux colonne 
            this._elGrille.classList.add('grille--4');


        // Si le conteneur peut contenir 3 tuiles OU que le conteneur est plus grand que l'écran d'un iPad ET
        // que le conteneur entre dans l'écran d'un iPadPro       
        } else if ((largeurConteneurVoiture > ((largeurTuile*3) + (2*largeurPaddingTuile) + 22)  || 
                    largeurConteneurVoiture > iPad) && largeurConteneurVoiture <= iPadPro) {
            // On retire la classe grille--? qui existe
            this.effacerClasseGrille(this._elGrille);

            // On ajoute la classe avec deux colonne 
            this._elGrille.classList.add('grille--3');
 

        // Si le conteneur peut contenir 2 tuiles ET que le conteneur entre dans l'écran d'un iPad       
        } else if (largeurConteneurVoiture > ((largeurTuile*2) + largeurPaddingTuile + 18)  && 
                   largeurConteneurVoiture <= iPad) {
            // On retire la classe grille--? qui existe
            this.effacerClasseGrille(this._elGrille);

             // On ajoute la classe avec deux colonne 
            this._elGrille.classList.add('grille--2');     
         }
    }

    // On retire la classe grille--? qui existe de l'element passé en paramètre
    effacerClasseGrille = (element) => {
        
        if (element.classList.contains("grille--1")) {
            element.classList.remove('grille--1');
        } else if (element.classList.contains("grille--2")) {
            element.classList.remove('grille--2');
        } else if (element.classList.contains("grille--3")) {
            element.classList.remove('grille--3');
        } else if (element.classList.contains("grille--4")) {          
            element.classList.remove('grille--4');
        }  
    }
}

