class FormulaireVoiture {
    constructor(el) {
        this._el = el;
        this._elPrixAchat = this._el.querySelector("#prixAchat");
        this._elPrixVente = this._el.querySelector("#prixVente");
        this._elMarque = this._el.querySelector('[data-js-marque]');
        this._elModele = this._el.querySelector('[data-js-modele]');

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
        
        //Brancher le gestionnaire click sur le boutton Soumettre
        /*this._elSoumettre.addEventListener('click', (e) => {
            e.preventDefault();
            
            //Enregistrer les données à propos de la voiture dans la bd table Voiture
            //Retourner id de voiture ajoutée
            this.sauvegarderVoiture();
            //Créer le repertoire avec le nom - id de voiture
            //Placer les images dans ce repertoire 
            //Enregistrer les images de la voiture dans la bd table images
            this.sauvegarderImages();

             //Enregistrer les descriptions dans la bd
            for (let i = 0, l = this._elsDescription.length; i < l; i++) {
                this.sauvegarderDescription(this._elsDescription[i]);
            }

            //window.location.href = 'index.php?GestionDonnees&action=gestionVoiture';
        });*/
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