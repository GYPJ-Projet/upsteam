class ListeVoitures {

       constructor(el) {
        this._el = el;       // l'élément grille de l'instance
        this._elGrille   =  this._el.querySelector('[data-js-results]'); // Element Grille 
        this._elVoiture  =  this._el.querySelector('[data-js-voiture]'); // Element Voiture
        this._elAside    =  document.querySelector('[data-js-component="Filtre"]'); // Element aside
      
        

        console.log("class ListeVoitures - conctructor: ");
        console.log(this._elGrille);

        this.init();
    
    }

    // Initialisation de la class ListeVoiture pour lui donner vie, soit gérer 
    // la largeur de l'écran seulement !
    init = () => {
        this.displayWindowSize(); // On vérifie la granndeur de l'écran en partant.

        window.addEventListener('resize', this.displayWindowSize);  
    }
    
    
    
    // Affiche la grille de  la section voiture en fonction de la taille de la page.
    displayWindowSize = () =>{
        console.log("class ListeVoitures - function displayWindowSize: window.innerWidth :");
        console.log(window.innerWidth);
        console.log(iPhone);


        if (window.innerWidth <= iPhone) {

            // On retire la classe grille--? qui existe
            if (this._elGrille.classList.contains("grille--2")) {
                console.log("class ListeVoitures - function displayWindowSize - remove grille--2");
                this._elGrille.classList.remove('grille--2');
            } else if (this._elGrille.classList.contains("grille--3")) {
                console.log("class ListeVoitures - function displayWindowSize - remove grille--3");
                this._elGrille.classList.remove('grille--3');
            } else if (this._elGrille.classList.contains("grille--4")) {
                console.log("class ListeVoitures - function displayWindowSize - remove grille--4");
                this._elGrille.classList.remove('grille--4');
            }  

            console.log("class ListeVoitures - function displayWindowSize - add grille--1");
            // On ajoute la classe avec une seul colonne 
            if (!this._elGrille.classList.contains("grille--1")) {
                this._elGrille.classList.add('grille--1');
            }
            
        } else {
            // On retire la classe grille--? qui existe
            if (this._elGrille.classList.contains("grille--1")) {
                console.log("class ListeVoitures - function displayWindowSize - remove grille--1");
                this._elGrille.classList.remove('grille--1');
            } else if (this._elGrille.classList.contains("grille--3")) {
                console.log("class ListeVoitures - function displayWindowSize - remove grille--3");
                this._elGrille.classList.remove('grille--3');
            } else if (this._elGrille.classList.contains("grille--4")) {
                console.log("class ListeVoitures - function displayWindowSize - remove grille--4");
                this._elGrille.classList.remove('grille--4');
            }  

            console.log("class ListeVoitures - function displayWindowSize - add grille--2");
             // On ajoute la classe avec deux colonne 
            this._elGrille.classList.add('grille--2');
        }
    }
}