class FormulaireVoiture {
    constructor(el) {
        this._el = el;
        this._elPrixAchat = this._el.querySelector("#prixAchat");
        this._elPrixVente = this._el.querySelector("#prixVente");
        this._elMarque = this._el.querySelector('[data-js-marque]');
        this._elModele = this._el.querySelector('[data-js-modele]');
        
        this._elsCroix = this._el.querySelectorAll('[data-js-imageId]');
        this._elVoiture = this._el.querySelector('[data-js-idVoiture]').dataset.jsIdvoiture;

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

        for (let i = 0, l = this._elsCroix.length; i < l; i++) {
            this._elsCroix[i].addEventListener('click', (e) => {
                // Supprimer l'image dans la bd
                this.supprimerImage(e.target);
                // Supprimer l'image dans le formulaire
                this.supprimerImageFormulaire(e.target);
            }) 
        }
    
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

    supprimerImage = (el) => {

        let xhr;
		xhr = new XMLHttpRequest();
		
		if (xhr) {

            xhr.open('POST', 'index.php?GestionDonnees_AJAX&action=supprimerImage');
            xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

			xhr.addEventListener('readystatechange', () => {
				if (xhr.readyState === 4) {
					if (xhr.status === 200) {
						
					} else if (xhr.status === 404) {
						console.log('Le fichier appelé dans la méthode open() n’existe pas.');
					}
				}
			});

            // Send the request
			xhr.send('&id=' + el.dataset.jsImageid + '&idVoiture=' + this._elVoiture + '&nomImage=' + el.dataset.jsImagenom);
        }
    }

    supprimerImageFormulaire = (el) => {
        el.parentNode.remove();
    }
}