class Taxes {

    static _taxeFederale = 0;
    static _taxeProvinciale = 0; 
    static _taxesProvince = [];


    static getTaxeFederale() {
        return Taxes._taxeFederale;
    }

    static getTaxeProvinciale() {
        return Taxes._taxeProvinciale;
    }

    static getTaxesAreReady() {
        return Taxes._taxesAreReady;
    }

    // Pour la gestion des taxess de la province de l'usager, 
    // il faut aller les chercher.
    static getTaxes() {
        let elIdProvince = document.querySelector('[ data-js-province]'); 
       
        let idProvince = parseInt(elIdProvince.dataset.jsProvince);

        if ( idProvince != 0 ) {
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
                                Taxes._taxesProvince = JSON.parse(xhr.responseText);

                                Taxes.sauvegardeLesTaxes(idProvince);

                            } else {
                                Taxes._taxesProvince = [];

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


    static sauvegardeLesTaxes() {

        let arrayLength = 0;
        for (let i in Taxes._taxesProvince) {
            arrayLength++;
        }
  
        if ( arrayLength> 0) {
            
            // S'il y a 2 taxes dans cette province
            if (arrayLength == 2) {
                for (let i = 0; i < arrayLength; i++) {                  
                    if (Taxes._taxesProvince[i]["nomTaxe"] == "TPS") {
                        Taxes._taxeFederale = (parseFloat(Taxes._taxesProvince[i]["taux"]) / 100).toFixed(5);
                    } else {
                        Taxes._taxeProvinciale = (parseFloat(Taxes._taxesProvince[i]["taux"]) / 100).toFixed(5);
                    }
                }

            // S'il y a 1 seule  taxe dans cette province
            } else if (arrayLength == 1) {
                Taxes._taxeFederale = (parseFloat(Taxes._taxesProvince[0]["nomTaxe"]) / 100).toFixed(5);
                Taxes._taxeProvinciale = 0;
            }

            Taxes._taxesAreReady = true; // Les taxes sont prête

            console.log("class Taxes - addEventListener('DOMContentLoaded'  _taxeFederale ET _taxeProvinciale : ");
            console.log(Taxes._taxeFederale);
            console.log(Taxes._taxeProvinciale);
        }
    }

}