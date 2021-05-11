class Taxes {

/*     static _taxeFederale = 0;
    static _taxeProvinciale = 0; */ 
    static _taxesProvince = [];
    static _arrayLength = 0;
    static _indexTaxeFederale = 0;
    static _indexTaxeProvinciale = -1;

    static getTaxeFederale() {
        return Taxes._taxesProvince[Taxes._indexTaxeFederale];
    }

    static getTaxeProvinciale() {
        let uneTaxe = null;
        if (Taxes._indexTaxeProvinciale != -1) {
            uneTaxe = Taxes._taxesProvince[Taxes._indexTaxeProvinciale];
        }

        return uneTaxe;
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
  
                                Taxes.sauvegarderLesTaxes();

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


    static sauvegarderLesTaxes() {

        Taxes._arrayLength = 0;
        for (let i in Taxes._taxesProvince) {
            Taxes._arrayLength++;
        }

        if ( Taxes._arrayLength > 0) {
            
            // S'il y a 2 taxes dans cette province
            if (Taxes._arrayLength == 2) {
                for (let i = 0; i < Taxes._arrayLength; i++) {
                    if (Taxes._taxesProvince[i]["nomTaxe"] == "TPS") {      
                        Taxes._taxesProvince[i]["taux"] = (parseFloat(Taxes._taxesProvince[i]["taux"]) / 100).toFixed(5);
                        Taxes._indexTaxeFederale = i;
                    } else {
                        Taxes._taxesProvince[i]["taux"] = (parseFloat(Taxes._taxesProvince[i]["taux"]) / 100).toFixed(5);
                        Taxes._indexTaxeProvinciale = i;
                    }
            }

            // S'il y a 1 seule  taxe dans cette province
            } else if (Taxes._arrayLength == 1) {
                Taxes._taxesProvince[0]["taux"] = (parseFloat(Taxes._taxesProvince[0]["taux"]) / 100).toFixed(5)
                Taxes._indexTaxeFederale = 0;
                Taxes._indexTaxeProvinciale = -1; // n'existe pas
            }

            Taxes._taxesAreReady = true; // Les taxes sont prête

            console.log("class Taxes - sauvegarderLesTaxes -  taxeFederale ET _axeProvinciale : ");
            console.log(Taxes._taxesProvince[Taxes._indexTaxeFederal]);
            if (Taxes._indexTaxeProvinciale != -1) {
                console.log(Taxes._taxesProvince[Taxes._indexTaxeProvinciale]);
            } else {
                console.log(null);
            }

        }
    }

}