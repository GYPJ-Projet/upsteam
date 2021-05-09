class Taxes {

    constructor(el) {
        this._el = el;
        this._taxesProvince = [];

        console.log("class Taxes - fonction constructor - this._el : ");
        console.log(this._el);

        this.init();
    }

    //  Initialisation de la class Taxes lui donner vie !
    init = () => {

        console.log("class Taxes - fonction init - this._elIdProvince : ");
        console.log(this._el.dataset.jsProvince);

        let idProvince = parseInt(this._el.dataset.jsProvince);


        

        // Si l'id de la province dans cette page web est different de l'id province en cours... 
        if ( idProvince != taxeIdProvince ) {
            
            console.log("class Taxes - fonction init - idProvince != taxeIdProvince  - taxeIdProvince : ");
            console.log(taxeIdProvince);
            // On début,  il faut aller chercher le nombre de tuiles (items) qu'il y a dans la BD
            // pour pouvoir gérer l'affichage à partir de ListeVoitures.js
            this.getTaxesDeLaProvince(idProvince);
        }
    
    }

    sauvegarderLesTaxes = (idProvince) => {

        let arrayLength = 0;
        for (let i in this._taxesProvince) {
            arrayLength++;
        }

        console.log("class Taxes - fonction sauvegarderLesTaxes IN - arrayLength : ");
        console.log(arrayLength);
  
        if ( arrayLength> 0) {
            // On conserve l'id de la Province à qui appartient les taxes.
            taxeIdProvince = idProvince;

            console.log("class Taxes - fonction sauvegarderLesTaxes - taxeIdProvince: ")
            console.log(taxeIdProvince);

            // S'il y a 2 taxes dans cette province
            if (arrayLength == 2) {
                for (let i = 0; i < arrayLength; i++) {
                    console.log("class Taxes - fonction init - FOR   nomTaxe: ")
                    console.log(this._taxesProvince[i]["nomTaxe"]);
                    
                    if (this._taxesProvince[i]["nomTaxe"] == "TPS") {
                        console.log("class Taxes - fonction init - == TPS   taux: ")
                        console.log(this._taxesProvince[i]["taux"]);
        
                        taxeFederale = (parseFloat(this._taxesProvince[i]["taux"]) / 100).toFixed(5);
                    } else {
                        taxeProvinciale = (parseFloat(this._taxesProvince[i]["taux"]) / 100).toFixed(5);
                    }
                }

            // S'il y a 1 seule  taxe dans cette province
            } else if (arrayLength == 1) {
                taxeFederale = (parseFloat(this._taxesProvince[0]["nomTaxe"]) / 100).toFixed(5);
                taxeProvinciale = 0;
            }

            console.log("class Taxes - addEventListener('DOMContentLoaded'  taxeFederale ET taxeProvinciale : ");
            console.log(taxeFederale);
            console.log(taxeProvinciale);
        }
    }

    // Pour la gestion des taxess de la province de l'usager, 
    // il faut aller les chercher.
    getTaxesDeLaProvince = (idProvince) => {

        // Déclaration de l'objet XMLHttpRequest
        var xhr;
        xhr = new XMLHttpRequest();
        
        // Initialisation de la requête
        if (xhr) {	

            // Ouverture de la requête : fichier recherché
            xhr.open('GET', `index.php?Taxes_AJAX&action=getTaxesProvince&idProvince=${idProvince}`);

            xhr.addEventListener('readystatechange', () => {

                if (xhr.readyState === 4) {							
                    if (xhr.status === 200) {

                        // Les données ont été reçues
                        // Traitement de la réponse
                        if (xhr.response != 'ERREUR') {
                            // on converti le tableau JSON reçu en array litéraux.
                            this._taxesProvince = JSON.parse(xhr.responseText);
                            console.log("class Taxes - fonction getTaxesDeLaProvince - xhr.response -> this._taxesProvince[0] : ")
                            console.log(this._taxesProvince[0]);
                            console.log("class Taxes - fonction getTaxesDeLaProvince - xhr.response -> this._taxesProvince[1] : ")
                            console.log(this._taxesProvince[1]);

                            this.sauvegarderLesTaxes(idProvince);

                        } else {
                            this._taxesProvince = [];
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