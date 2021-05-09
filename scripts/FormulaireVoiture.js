class FormulaireVoiture {
    constructor(el) {
        this._el = el;
        this._elPrixAchat = this._el.querySelector("#prixAchat");
        this._elPrixVente = this._el.querySelector("#prixVente");
        this._elMarque = this._el.querySelector('[data-js-marque]');
        this._elModele = this._el.querySelector('[data-js-modele]');
        // this._elImages = this._el.querySelector('[data-js-images]');
        // this._elImageTouche = this._el.querySelector('[data-js-imageTouche]');

        this.init();
    }

    init = () => {
        //Brancher le gestionnaire input sur l'élément input prix d'achat
        this._elPrixAchat.addEventListener('input', (e) => {
            e.preventDefault();

            this._elPrixVente.value = (this._elPrixAchat.value * 1.25);
        });

        //Brancher le gestionnaire input sur l'élément select marque de la voiture
        this._elMarque.addEventListener('change', (e) => {
            e.preventDefault();

            this.afficherModeleParIdMarque(this._elMarque.value);
        });

        //Vérifie que l'on a modifié ou non les images
        // this._elImages.addEventListener('click', (e) => {
        //     e.preventDefault();

        //     this._elImageTouche.dataset.jsImageTouche = true;
        // });
    
    }
     
    afficherModeleParIdMarque = (idMarque) => {
        // Déclaration de l'objet XMLHttpRequest
        var xhr;
        xhr = new XMLHttpRequest();
        
        // Initialisation de la requète
        if (xhr) {	

            // Ouverture de la requète : fichier recherché
            xhr.open('GET', 'index.php?GestionDonnees_AJAX&action=afficheModeleParIdMarque&idMarque=' + idMarque);

            xhr.addEventListener('readystatechange', () => {

                if (xhr.readyState === 4) {							
                    if (xhr.status === 200) {

                       // Les données ont été reçues ont les affiches
                       let data = JSON.parse(xhr.response),
                       resultat = '<option value="">...</option>';

                        // Traitement et affichage.
                        if(data != false){
                            for(let element of data){
                                resultat += `   <option value="${element.id}">${element.nom}</option>`;
                            }
                        }
                        this._elModele.innerHTML = resultat;

                    } else if (xhr.status === 404) {
                        console.log('Le fichier appelé dans la méthode open() n’existe pas.');
                    }
                }
            });

            // Envoi de la requète
            xhr.send();
        }
    }

}