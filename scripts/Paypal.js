class Paypal {

       constructor(el) {
        this._el = el;       // l'élément bouton paypal 
 

        this.init();
    
    }

    //  Initialisation de la class Produits pour lui donner vie !
    init = () => {

        // This function displays Smart Payment Buttons on your web page.
        paypal.Buttons({
            funding: {
               disallowed: [ paypal.FUNDING.CREDIT ],
               disallowed: [ paypal.FUNDING.CARD ],
               disallowed: [ paypal.FUNDING.VENMO ],
               disallowed: [ paypal.FUNDING.PAYLATER ]
            },

            createOrder: function(data, actions) {
                // This function sets up the details of the transaction, including the amount and line item details.
                return actions.order.create({
                  purchase_units: [{
                    amount: {
                      value: '0.01'
                    }
                  }]
                });
            },

            onApprove: function(data, actions) {
              // This function captures the funds from the transaction.
              return actions.order.capture().then(function(details) {
                // This function shows a transaction success message to your buyer.
                alert('Transaction completed by ' + details.payer.name.given_name);
              });
            }
   
          }).render('#paypal-button-container');
    

       
    }

}