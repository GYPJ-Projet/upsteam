class VoirPlus {

    constructor(el) {
        this._el = el;
        this._elResults   = document.querySelector('[data-js-results]');
        this._elBtnMore   = this._el.querySelector('[data-js-btn]');

        this._nombreDeTuiles = 0;           // nombre de voitures dans la BD
        this._indexDepart = 12;               // indexe du voitures à aller chercher dans la BD
        this._nombreTuilesParPages = 12;    // Nombre de voitures maximum dans un page
        this._nombreTotalDeTuilesAffiche = 0;
        this._estLaFin = false;   
        this._existeSession = false;

        this.init();
    }

    //  Initialisation de la class VoirPlus pour lui donner vie !
    init = (e) => {

         // On début,  il faut aller chercher le nombre de tuiles (items) qu'il y a dans la BD
        // pour pouvoir gérer l'affichage à partir de ListeVoitures.js
        this.getNombreDeTuiles();

        // S'il reste des tuilles à afficher, on affiche le bouton Voir Plus
        if (this._indexDepart < this._nombreDeTuiles) {
            this._elBtnMore.classList.remove("btn--hidden");
        }   


        // Au clic du bouton Voir Plus
        this._elBtnMore.addEventListener('click', (e) => {
            e.preventDefault();

            // On affiche la liste des voitures suivant
            this. showListeTuiles(this._indexDepart, this._nombreTuilesParPages, 'id');  

        });
    }


    // Pour la gestion de l'affichage de la liste des tuiles, 
    // il faut savoir le nombre de tuiles (voitures) dans la BD.
    getNombreDeTuiles = () => {

        // Déclaration de l'objet XMLHttpRequest
        var xhr;
        xhr = new XMLHttpRequest();
        
        // Initialisation de la requête
        if (xhr) {	

            // Ouverture de la requête : fichier recherché
            xhr.open('GET', 'index.php?Voiture_AJAX&action=combienVoitures');

            xhr.addEventListener('readystatechange', () => {

                if (xhr.readyState === 4) {							
                        if (xhr.status === 200) {

                        // Les données ont été reçues
                        // Traitement de la réponse
                        this._nombreDeTuiles = parseInt(xhr.response);
                        
                        // S'il reste des voitures à afficher, on affiche le bouton Voir Plus
                        if (this._nombreDeTuiles > this._nombreTuilesParPages) {
                            this._elBtnMore.classList.remove("btn--hidden");
                        }

                    } else if (xhr.status === 404) {
                        console.log('Le fichier appelé dans la méthode open() n’existe pas.');
                    }
                }
            });

            // Envoi de la requête
            xhr.send();
        }
    }


    // AJAX du Bouton Voir plus qui permet d'afficher la suite des voitures 
    // que l'usager veut voir
    showListeTuiles = (indexDepart,  nombreTuilesPourAfficher, leTri) => {

        // Déclaration de l'objet XMLHttpRequest
        var xhr;
        xhr = new XMLHttpRequest();
        
        // Initialisation de la requête
        if (xhr) {	

            // Ouverture de la requête : fichier recherché et les paramètres du tri
            // est des enregistrements que l'on veut aller chercher dans la BD.
            xhr.open('GET', 'index.php?Voiture_AJAX&action=afficheListeVoitures' +
                            '&indexDepart=' + indexDepart + 
                            '&combien='     + nombreTuilesPourAfficher +
                            '&tri='         + leTri);

            xhr.addEventListener('readystatechange', () => { 

                if (xhr.readyState === 4) {							
                    if (xhr.status === 200) {

                        // Les données ont été reçues
                        // Traitement du DOM

                        // Affiche selon l'ordre du tri demandé
                        this._elResults.innerHTML += xhr.responseText;

                        // On crée les nouvelle Voiture et ou on recrée les anciennes parmis lesquelles il
                        // y en a des nouvelles lors du tri. Donc on les refait tous dans ce cas car
                        //  nombreTuilesPourAfficher équivaut à l'ensemble des voitures affiché dans l'écran
                        let elVoitures = document.querySelectorAll('[data-js-voiture]');
                        
                        for (let i = 0, l = elVoitures.length; i < l; i++) {
                             new Voiture(elVoitures[i]);
                        }

                        // S'il reste des tuiles dans la BD pour les afficher
                        // il faut afficher le bouton "Voir plus"
                        this._nombreTotalDeTuilesAffiche = elVoitures.length;

                        // S'il reste des tuiles à afficher, il faut afficher le bouton Voir Plus.
                        if  (this._nombreTotalDeTuilesAffiche < this._nombreDeTuiles) {
                            this._elBtnMore.classList.remove("btn--hidden");

                            // On met à jour le compteur
                            this._indexDepart += this._nombreTuilesParPages;
                        } else {
                            this._elBtnMore.classList.add("btn--hidden");  // Sinon on le retire de la vue
                        }
                    } else if (xhr.status === 404) {
                        console.log('Le fichier appelé dans la méthode open() n’existe pas.');
                    }
                }
            });

            // Envoi de la requête
            xhr.send();
        }
    }
}