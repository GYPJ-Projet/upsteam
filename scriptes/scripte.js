document.addEventListener('DOMContentLoaded', () => {
    let composants = document.querySelectorAll('[data-js-composant]');

    for (let i = 0, l = composants.length; i < l; i++) {
        
        let composantDataSet = composants[i].dataset.jsComposant,
            composantElement = composants[i];
        
        for (let cle of Object.keys(cartographieClasses)) {
            if (componentDataSet == cle) {
                new cartographieClasses[composantDataSet](composantElement);
            }
        }
    }
});